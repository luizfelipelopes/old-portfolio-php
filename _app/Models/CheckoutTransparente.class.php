<?php

/**
 * CheckoutTransparente.class [ MODEL ]
 * Classe Responsável pelo Chekout Transparente do PagSeguro
 * @copyright (c) 2018, Luiz Felipe C. Lopes [ FLOWSTATE ]
 */
class CheckoutTransparente {

    private $Dados;
    private $Result;
    private $Error;

    public function __construct(array $Dados = null) {
        $this->Dados = $Dados;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getError() {
        return $this->Error;
    }

    /**
     * <b>gerarSession()</b>: Gera a sessão do Checkout
     */
    public function gerarSession() {
        $data['token'] = (PAGSEGURO_ENV == 'sandbox' ? PAGSEGURO_TOKEN_SANDBOX : PAGSEGURO_TOKEN_PRODUCTION); //Token Pagseguro
        $this->ExeCURL($data, 'session');
    }

    /**
     * <b>inciarPagementoBoleto()</b>: Inicia o pagamento via boleto bancário.
     */
    public function inciarPagementoBoleto() {

        $data['token'] = (PAGSEGURO_ENV == 'sandbox' ? PAGSEGURO_TOKEN_SANDBOX : PAGSEGURO_TOKEN_PRODUCTION); //token sandbox ou produção
        $data['paymentMode'] = 'default';
        $data['senderHash'] = $this->Dados['carrinho_hash_boleto'];
        $data['paymentMethod'] = 'boleto';
        $data['receiverEmail'] = PAGSEGURO_EMAIL;
        $data['senderName'] = $this->Dados['carrinho_nome_boleto'];
        $data['senderAreaCode'] = $this->Dados['carrinho_ddd_boleto'];
        $data['senderPhone'] = $this->Dados['carrinho_telefone_boleto'];
        $data['senderEmail'] = $this->Dados['carrrinho_email_boleto'];
        $data['senderCPF'] = $this->Dados['carrinho_cpf_boleto'];
        $data['currency'] = 'BRL';
        
        $i = 1;
        foreach ($_SESSION['carrinho'] as $produto):
            $data['itemId' . $i] = $produto['produto_id'];
            $data['itemQuantity' . $i] = $produto['produto_quantidade'];
            $data['itemDescription' . $i] = $produto['produto_descricao'];
            $data['itemAmount' . $i] = $produto['produto_valor'];
            $i++;
        endforeach;
        
        $data['reference'] = rand(0, 999);
        $data['shippingAddressRequired'] = 'false';
        

        $this->ExeCURL($data, 'transaction');
    }

    /**
     * <b>inciarPagementoCartao()</b>: inicia o pagamento via cartão de crédito.
     */
    public function inciarPagementoCartao() {

        $data['token'] = (PAGSEGURO_ENV == 'sandbox' ? PAGSEGURO_TOKEN_SANDBOX : PAGSEGURO_TOKEN_PRODUCTION); //token sandbox ou produção
        $data['paymentMode'] = 'default';
        $data['senderHash'] = $this->Dados['carrinho_hash_cartao']; //gerado via javascript
        $data['creditCardToken'] = $this->Dados['tokenCartao_cartao']; //gerado via javascript
        $data['paymentMethod'] = 'creditCard';
        $data['receiverEmail'] = PAGSEGURO_EMAIL;
        $data['senderName'] = $this->Dados['carrinho_nome_cartao']; //nome do usuário deve conter nome e sobrenome
        $data['senderAreaCode'] = $this->Dados['carrinho_ddd_cartao'];
        $data['senderPhone'] = $this->Dados['carrinho_telefone_cartao'];
        $data['senderEmail'] = $this->Dados['carrrinho_email_cartao'];
        $data['senderCPF'] = $this->Dados['carrinho_cpf_cartao'];
        $data['installmentQuantity'] = $this->Dados['carrinho_parcelamento_cartao'];
        $data['noInterestInstallmentQuantity'] = '2';
        $data['installmentValue'] = number_format($this->Dados['carrinho_valor_parcela_cartao'], 2); //valor da parcela
        $data['cardNumber'] = $this->Dados['carrinho_numero_cartao'];
        $data['cvv'] = $this->Dados['carrinho_cvv_cartao'];
        $data['expirationMonth'] = $this->Dados['carrinho_mes_cartao'];
        $data['expirationYear'] = $this->Dados['carrinho_ano_cartao'];
        $data['creditCardHolderName'] = $this->Dados['carrinho_nome_titular_cartao']; //nome do titular
        $data['creditCardHolderCPF'] = str_replace(['-', '.'], '', $this->Dados['carrinho_cpf_titular_cartao']);
        $data['creditCardHolderBirthDate'] = date('d/m/Y', strtotime($this->Dados['carrinho_data_nascimento_titular_cartao']));
        $data['creditCardHolderAreaCode'] = $this->Dados['carrinho_ddd_titular_cartao'];
        $data['creditCardHolderPhone'] = $this->Dados['carrinho_telefone_titular_cartao'];
        $data['billingAddressStreet'] = $this->Dados['carrinho_rua_titualr_cartao'];
        $data['billingAddressNumber'] = $this->Dados['carrinho_numero_titular_cartao'];
        $data['billingAddressDistrict'] = $this->Dados['carrinho_bairro_titular_cartao'];
        $data['billingAddressPostalCode'] = $this->Dados['carrinho_cep_titular_cartao'];
        $data['billingAddressCity'] = $this->Dados['carrinho_cidade_titular_cartao'];
        $data['billingAddressState'] = $this->Dados['carrinho_uf_titular_cartao'];
        $data['billingAddressCountry'] = 'Brasil';
        $data['currency'] = 'BRL';
        $i = 1;
        
        foreach ($_SESSION['carrinho'] as $produto):
            $data['itemId' . $i] = $produto['produto_id'];
            $data['itemQuantity' . $i] = $produto['produto_quantidade'];
            $data['itemDescription' . $i] = $produto['produto_descricao'];
            $data['itemAmount' . $i] = $produto['produto_valor'];
            $i++;
        endforeach;

        $data['reference'] = rand(0, 999); //referencia qualquer do produto
        $data['shippingAddressRequired'] = 'false';


        $this->ExeCURL($data, 'transaction');
    }

    /**
     * <b>ExeCURL()</b>: Executa o CURL para comunicar com o PAGSEGURO e retornoar o XML
     * @param array $data
     * @param String $url
     */
    private function ExeCURL($data, $url) {

        $emailPagseguro = PAGSEGURO_EMAIL;

        $data = http_build_query($data);
        if ($url == 'transaction'):
            $url = 'https://ws.' . (PAGSEGURO_ENV == 'sandbox' ? 'sandbox.' : '') . 'pagseguro.uol.com.br/v2/transactions'; //URL de teste
        else:
            $url = 'https://ws.' . (PAGSEGURO_ENV == 'sandbox' ? 'sandbox.' : '') . 'pagseguro.uol.com.br/v2/sessions';
        endif;

        $curl = curl_init();

        $headers = array('Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');

            curl_setopt($curl, CURLOPT_URL, $url . "?email=" . $emailPagseguro);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        //curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_HEADER, false);
        $xml = curl_exec($curl);

        curl_close($curl);

        $xml = simplexml_load_string($xml);

        $this->Result = $xml;
    }

}
