<?php

/**
 * TransacoesPagSeguro.class [ TIPO ]
 * Método respons´vel por receber e tratar as notificações de transação da Loja
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class TransacoesPagSeguro {

    private $Error;
    private $Result;
    private $credentials;

    public function __construct() {
        $this->credentials = PagSeguroConfig::getAccountCredentials();
    }

    public function ExeNotificacoes() {

        $this->getNotificacoes();
    }

    public function getTransacoesPorData($dataInicio, $dataFim) {

        $hrs = ($dataFim == date('Y-m-d') ? date('H:i:s') : '23:59:59');

        try {

            $response = PagSeguroTransactionSearchService::searchByDate(
                            $this->credentials, 1, 100, $dataInicio . 'T10:30:00', $dataFim . 'T' . $hrs);

            if ($response->getTransactions() == null || empty($response->getTransactions())):
                $this->Error = ['Não há nenhuma transação no intervalo de data estabelecida', WS_INFOR];
                $this->Result = false;
            else:
                $this->Result = $response->getTransactions();
            endif;
        } catch (PagSeguroServiceException $e) {
            $e->getMessage();
            $this->Error = ['Erro ao conectar com o PagSeguro. Por favor, tente novamente  daqui a alguns instantes.', WS_ALERT];
        }
    }

    public function getTransacoesPorCodigoTransacao($transacao) {

        try {

            $response = PagSeguroTransactionSearchService::searchByCode($this->credentials, $transacao);

            $this->Result = $response;
        } catch (PagSeguroServiceException $e) {

            $this->Error = ['Não há nenhuma transação com este código', WS_INFOR];
            $this->Result = false;
            $e->getMessage();
        }
    }

    public function getTransacaoPorCodigoReferecia($referencia) {

        try {

            $response = PagSeguroTransactionSearchService::searchByReference(
                            $this->credentials, $referencia);

            $this->Result = $response;
        } catch (PagSeguroServiceException $e) {
            $this->Error = ['Não há nenhuma transação com este código', WS_INFOR];
            $this->Result = false;
            $e->getMessage();
        }
    }

    public function getTransacaoCanceladaPorData($dataInicio, $dataFim) {

        $hrs = ($dataFim == date('Y-m-d') ? date('H:i:s') : '23:59:59');

        try {

            $response = PagSeguroTransactionSearchService::searchAbandoned(
                            $this->credentials, 1, 100, $dataInicio . 'T00:00:00', $dataFim . 'T' . $hrs);
            $this->Result = $response->getTransactions();
        } catch (PagSeguroServiceException $e) {
            $this->Error = ['Não há nenhuma transação no intervalo de data estabelecida'];
            $this->Result = false;
            $e->getMessage();
        }
    }

    public function solicitarEstorno($transaction, $valor) {

        try {

            $response = PagSeguroRefundService::createRefundRequest(
                            $this->credentials, $transaction, $valor);

            $this->Error = ['Valor estornado com sucesso!'];
            $this->Result = $response;
        } catch (PagSeguroServiceException $e) {
            $this->Error = ['Erro ao estornar valor!'];
            $this->Result = false;
            echo $e->getMessage();
        }
    }

    public function cancelarTransacao($transaction) {

        try {

            $response = PagSeguroCancelService::requestCancel(
                            $this->credentials, $transaction);

            $this->Error = ['Transação cancelada com sucesso!'];
            $this->Result = $response;
        } catch (PagSeguroServiceException $e) {
            $this->Error = ['Erro ao cancelar transacao!'];
            $this->Result = false;
            echo $e->getMessage();
        }
    }

    public function atualizarBD($i) {
        $read = new Read();
        $update = new Update();

//        $this->getTransacoesPorData($dataInicio, $dataFim);

        if ($this->getResult()):

            $read->ExeRead(VENDAS, "WHERE venda_registro = :reference", "reference={$this->getResult()[$i]->getReference()}");

            if ($read->getResult()):

                foreach ($read->getResult() as $res):

                    if ($res['venda_status'] != $this->getResult()[$i]->getStatus()->getValue()):

                        $res['venda_status'] = $this->getResult()[$i]->getStatus()->getValue();

                        $update->ExeUpdate(VENDAS, $res, "WHERE venda_id = :id AND venda_registro = :reference", "id={$res['venda_id']}&reference={$this->getResult()[$i]->getReference()}");
                        if ($update->getResult()):
//                    echo 'Atualizado com sucesso!';
                        else:
//                    echo 'Erro ao atualizar!';
                        endif;

                    endif;

                endforeach;


            endif;


        endif;
    }

    public function getStatusTransacao($Status) {

        $resposta = null;

        switch ($Status):
            case '1':
                $resposta = "Aguardando Pagamento  <br>";
                break;
            case '2':
                $resposta = "Em Análise  <br>";
                break;
            case '3':
                $resposta = "Paga  <br>";
                break;
            case '4':
                $resposta = "Entregue  <br>";
                break;
            case '5':
                $resposta = "Em Disputa  <br>";
                break;
            case '6':
                $resposta = "Devolvida  <br>";
                break;
            case '7':
                $resposta = "Cancelada  <br>";
                break;

            default:
                $resposta = "Transação Inexistente";

        endswitch;

        return $resposta;
    }

    public function getFormaDePagamento($formaPagamento) {

        $resposta = null;


        switch ($formaPagamento):
            case '1':
                $resposta = "Cartão de Crédito ";
//                $resposta .= "(pagamento em {$this->Result->getInstallmentCount()}x) <br>";
                break;
            case '2':
                $resposta = "Boleto  <br>";
                break;
            case '3':
                $resposta = "Débito online (TEF)  <br>";
                break;
            case '4':
                $resposta = "Saldo PagSeguro  <br>";
                break;
            case '5':
                $resposta = "Oi Paggo  <br>";
                break;
            case '7':
                $resposta = "Depósito em Conta  <br>";
                break;
//            default :
//                $resposta = "Forma de Pagamento Inexistente";

        endswitch;

        return $resposta;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    private function getNotificacoes() {


        if (isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'):


            if (count($_POST) > 0):

                if (isset($_POST['notificationCode'])):



                    $url = 'https://ws.pagseguro.uol.com.br/v2/transactions/notifications/' . $_POST['notificationCode'] . '?email=' . $this->credentials->getEmail() . '&token=' . $this->credentials->getToken();
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    $transactionCurl = curl_exec($curl);
                    $http = curl_getinfo($curl);


                    if ($transactionCurl == 'Unauthorized'):
                        print_r($transactionCurl);
                        exit;
                    endif;

                    curl_close($curl);
                    $transaction = simplexml_load_string($transactionCurl);


                    if (count($transaction->error) > 0):
                        print_r($transaction);
                        exit;

                    endif;


                    $hoje = date("Y-m-d");
                    $file = fopen("LogPagSeguro.{$hoje}.txt", "ab");
                    $hour = date("H:i:s T");
                    fwrite($file, "Log de Notificações e consulta\r\r\r\r\n\n\n\n");
                    fwrite($file, "Hora da consulta: {$hour}\r\r\r\r\n\n\n\n");
                    fwrite($file, "HTTP: {$http['http_code']}\r\r\r\r\n\n\n\n");
                    fwrite($file, "Código de Notificação: {$_POST['notificationCode']}\r\r\r\r\n\n\n\n");
                    fwrite($file, "Código de Transação: {$transaction->code}\r\r\r\r\n\n\n\n");
                    fwrite($file, "Status de Transação: {$transaction->status}\r\r\r\r\n\n\n\n");
                    fwrite($file, "-------------------------------------------------------------------------------------------------------------\\\\r\\\\n");
                    fclose($file);


//        var_dump($transaction->installmentCount);
//        var_dump($transaction->reference);
//        var_dump($transaction);


                    $read = new Read();
                    $read->ExeRead(VENDAS, "WHERE venda_registro = :registro", "registro={$transaction->reference}");
                    if ($read->getResult()):

                        echo "Registro encontrado!!";
//                        var_dump($read->getResult()[0]['venda_registro']);
                    
//                        ARRAY DE IDS PARA O PIXEL DO FACEBOOK
                        $SessionCart = array();
                        $i = 0;
                        foreach($read->getResult() as $produtos):
                            
                            $SessionCart += [$i => 'product_' . $produtos['venda_produto']];
                            $i++;
                        endforeach;

                        $data = [
                            'venda_transacao' => $transaction->code,
                            'venda_status' => $transaction->status,
                            'venda_atualizacao' => substr($transaction->lastEventDate, 0, 10) . ' ' . substr($transaction->lastEventDate, 11, 8),
                            'venda_pagamento' => $transaction->paymentMethod->type,
                            'venda_parcela' => $transaction->installmentCount,
                            'venda_taxa' => $transaction->feeAmount,
                            'venda_pag_descontado' => $transaction->netAmount];


                        $update = new Update();
                        $update->ExeUpdate(VENDAS, $data, "WHERE venda_registro = :registro", "registro={$transaction->reference}");

                        if (!$update->getResult()):
                            echo 'Erro ao atualizar';
                        else:
                            ?>
                            <script>
                                fbq('track', 'Purchase', {
                                    value: '<?= (!empty($data) ? $data['venda_taxa'] + $data['venda_pag_descontado'] : null); ?>',
                                    currency: 'BRL',
                                    content_type: 'product',
                                    content_ids: '<?= (!empty($SessionCart) ? json_encode($SessionCart) : null); ?>',
                                    referrer: document.referrer,
                                    userAgent: navigator.userAgent,
                                    language: navigator.language
                                });
                                < script >
                                <?php
                                echo 'Atualizado com sucesso';

                            endif;

                        else:
                            echo "Registro não encontrado";

                        endif;


                    endif;
                endif;
            endif;
        }

    }
    