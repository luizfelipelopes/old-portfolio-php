<?php

namespace Source\controllers;

use Source\Facades\ApplicationOrder;
use Source\Facades\DeliveryAddress;
use Source\Models\Address;
use Source\Support\Shipping;

/**
 * Classe responsável por tratar e manipular as informações entre a base de dados
 * de endereço e a interface com o usuário.
 * Class responsible for handling and manipulating information between the address
 * database and the user interface.
 */
class WebAddress extends Controller
{
    private $address;
    private $order;
    private $shipping;
    private $error;

    /**
     * Herda e inicializa os objetos necessários para a execução da classe.
     * Inherits and initializes the objects required for class execution.
     **/
    public function __construct($router)
    {
        parent::__construct($router);
        $this->address  = new DeliveryAddress();
        $this->order    = new ApplicationOrder();
        $this->shipping = new Shipping();
    }

    /**
     * Requere a página de endereço ao ser solicitada via URL.
     * Requires the address page when requested via URL.
     **/
    public function address(): void
    {
        echo $this->view->render($this->order->dirApp() . '/address.php', 
        ['goToUrl' => $this->order->verifyIncorrectAccess('address')]);
    }

    /**
     * Recupera a sessão de endereço selecionada no processo de compra.
     * Retrieves the selected address session in the purchase process.
     **/
    public function showSession(): void
    {
        echo json_encode(array_merge((array) $this->address->address(), $this->address->shipping()));
    }

    /**
     * Cadastra novo endereço de entrega do usuário.
     * Register the user's new shipping address.
     **/
    public function add(array $data): void
    {

        $data = $this->filterPostRequest();
        $data = $this->validateData($data);

        $id = $this->saveAddressBD($data);

        if ($this->error) {
            $jSon['error'] = $this->error;
            echo json_encode($jSon);
            return;
        }

        $this->address->add((new Address())->findById($id));

        $this->showShipping($this->address->address()->cep);

        $this->order->addAddress();

        $this->nextStep();
    }

    /**
     * Salva o endereço do usuário na base de dados.
     * Saves the user's address to the database.
     * @param array $data
     * @return int
     */
    private function saveAddressBD(array $data):  ? int
    {

        $newAddress             = new Address();
        $newAddress->user_id    = $this->order->showOrder()['user']->id;
        $newAddress->name       = $data['name'];
        $newAddress->cep        = $data['cep'];
        $newAddress->logradouro = $data['logradouro'];
        $newAddress->number     = $data['number'];
        $newAddress->complement = $data['complement'];
        $newAddress->bairro     = $data['bairro'];
        $newAddress->city       = $data['city'];
        $newAddress->uf         = $data['uf'];
        $id                     = $newAddress->save();

        if ($newAddress->fail()) {
            $this->error = $newAddress->fail()->getMessage();
            return null;
        }

        return $id;

    }

    /**
     * Exibe as opções de frete de entrega disponíveis para o usuário.
     * Displays delivery shipping options available to the user.
     **/
    public function showShipping(int $cep) : void
    {

        $data = [

            "nCdServico"          => "04014,04510",
            "sCepOrigem"          => "21921840",
            "sCepDestino"         => $cep,
            "nVlPeso"             => "1",
            "nCdFormato"          => 3,
            "nVlComprimento"      => 20.5,
            "nVlAltura"           => 20,
            "nVlLargura"          => 20,
            "nVlDiametro"         => 0,
            "sCdMaoPropria"       => "n",
            "nVlValorDeclarado"   => 0,
            "sCdAvisoRecebimento" => "n",
            "StrRetorno"          => "xml",
            "nIndicaCalculo"      => 3,

        ];

        $this->shipping->byPriceDeadline($data);
        $arrayShipping = json_decode(json_encode(simplexml_load_string($this->shipping->callback())), true);
        $arrayFrete    = [];

        foreach ($arrayShipping['cServico'] as $key => $frete) {

            $tipo         = ($frete["Codigo"] == '04014' ? 'SEDEX' : 'PAC');
            $arrayFrete[] = ["code" => $frete["Codigo"], "type"                                                      => $tipo,
                "value"                 => number_format(str_replace(',', '.', $frete["Valor"]), 2, '.', ''), "deadline" => $frete["PrazoEntrega"]];

        }

        $this->address->addShipping($arrayFrete[0]);

    }

    /**
     * Valida e trata os dados de entrada fornecidos pelo usuário.
     */
    private function validateData(array $data):  ? array
    {

        if (in_array('', $data)) {
            $this->error = 'Preencha os campos obrigatórios!';
            return null;
        }

        $data['cep'] = str_replace(['.'], '', $data['cep']);

        return $data;

    }

    /**
     * Retorna o link para próxima etapa de compra do usuário.
     * Returns the link to the user's next purchase step.
     **/
    public function nextStep() : void
    {
        echo json_encode($this->order->nextStepPayment());
    }

    /**
     * Atualiza endereço de compra do usuário.
     * Updates the user's purchase address.
     **/
    public function update(array $data): void
    {

    }

    /**
     * Remove endereço de compra do usuário.
     * Deletes the user's purchase address.
     **/
    public function remove(int $id): void
    {

    }

    /**
     * Recupera o endereço de entrega e o tipo de frete selecionado pelo usuário.
     * Retrieves the shipping address and shipping type selected by the user.
     **/
    public function selectAddressShipping(array $data): void
    {

    }

}
