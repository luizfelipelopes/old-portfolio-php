<?php

require_once '_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';

/**
 * PagSeguro.class [ MODEL SYSTEM ]
 * Classe responsável por executar transações do PagSeguro
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class CheckoutPagSeguro {

    private $paymentRequest;
    private $Data;
    private $Result;
    private $Error;

    public function __construct() {
        $this->paymentRequest = new PagSeguroPaymentRequest();
    }

    public function ExeTransacao(array $Itens) {

        $this->Data = $Itens;

        $this->addItens();
        $this->addEntrega();
        $this->addComprador();
        $this->addMoeda();
        $this->addReferenciaTransacao();
        $this->addPaginaRedirecionamento();
        $this->addDescontoPagamento();

        try {

            $credentials = PagSeguroConfig::getAccountCredentials();
            $checkoutUrl = $this->paymentRequest->register($credentials);

            $_SESSION['carrinho'] = null;
            $_SESSION['preco_total'] = null;
            $_SESSION['cupom'] = null;
            $this->Data = null;
            $_SESSION['clientelogin']['venda_registro'] = Check::Name($_SESSION['clientelogin']['cliente_name']) . '-' . $_SESSION['clientelogin']['cliente_id'] . '-' . date('Y-m-d') . '-' . substr(md5(time() + 1), 0, 10);

            header('Location: ' . $checkoutUrl);
        } catch (PagSeguroServiceException $e) {
            die($e->getMessage());
        }
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    private function addItens() {

        $read = new Read();

        for ($i = 0; $i < count($_SESSION['carrinho']); $i++):

            $read->ExeRead(VENDAS, "WHERE venda_registro = :vendareg", "vendareg={$_SESSION['clientelogin']['venda_registro']}");
            if ($read->getResult()[$i]):

                $this->paymentRequest->addItem(
                        $read->getResult()[$i]['venda_produto'], $read->getResult()[$i]['venda_name'], $read->getResult()[$i]['venda_quantidade'], $read->getResult()[$i]['venda_unidade']);

            endif;

        endfor;
    }

    private function addEntrega() {

        $busca = BuscaRapida::buscarCidade($_SESSION['clientelogin']['cliente_cidade']);
        $cidade = $busca[0]['cidade_nome'];
        $uf = $busca[0]['cidade_uf'];

        $sedexCode = PagSeguroShippingType::getCodeByType('SEDEX');
        $this->paymentRequest->setShippingType($sedexCode);
        $this->paymentRequest->setShippingCost(CUSTO_FRETE);
        $this->paymentRequest->setShippingAddress(
                $_SESSION['clientelogin']['cliente_cep'], $_SESSION['clientelogin']['cliente_endereco'], $_SESSION['clientelogin']['cliente_numero'], $_SESSION['clientelogin']['cliente_complemento'], $_SESSION['clientelogin']['cliente_bairro'], $cidade, $uf, 'BRA'
        );
    }

    private function addComprador() {

        $this->paymentRequest->setSender(
                $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'], $_SESSION['clientelogin']['cliente_email'], $_SESSION['clientelogin']['cliente_ddd'], $_SESSION['clientelogin']['cliente_telefone'], 'CPF', $_SESSION['clientelogin']['cliente_cpf']);
    }

    private function addMoeda($moeda = null) {

        $currency = ($moeda ? $moeda : 'BRL');

        $this->paymentRequest->setCurrency($currency);
    }

    private function addReferenciaTransacao() {
        $this->paymentRequest->setReference($_SESSION['clientelogin']['venda_registro']);
    }

    private function addPaginaRedirecionamento($url = null) {

        $pagina = ($url ? $url : HOME);

        $this->paymentRequest->setRedirectURL($pagina);
    }

    private function addPaginaNotificacoes($url = null) {

        $pagina = ($url ? $url : HOME);

        $this->paymentRequest->addParameter('notificationURL', $pagina);
    }

    private function addDescontoPagamento() {

        $desconto = 0;

        if ($_SESSION['preco_total'] > 20000):
            $desconto += 10.00;

        endif;

        if (isset($_SESSION['cupom'])):
            $readCupom = new Read;
            $readCupom->ExeRead(CUPONS, "WHERE cupom_codigo = :codigo", "codigo={$_SESSION['cupom']['codigo']}");
            if ($readCupom->getResult()):
                $desconto += $_SESSION['cupom']['desconto'] * 100;
            endif;
        endif;


        if ($desconto > 0):
            $this->paymentRequest->addPaymentMethodConfig('BOLETO', $desconto, 'DISCOUNT_PERCENT');
            $this->paymentRequest->addPaymentMethodConfig('CREDIT_CARD', $desconto, 'DISCOUNT_PERCENT');
        endif;


//        $this->paymentRequest->addPaymentMethodConfig('EFT', 2.90, 'DISCOUNT_PERCENT');
//        $this->paymentRequest->addPaymentMethodConfig('DEPOSIT', 3.45, 'DISCOUNT_PERCENT');
//        $this->paymentRequest->addPaymentMethodConfig('BALANCE', 0.01, 'DISCOUNT_PERCENT');
    }

}
