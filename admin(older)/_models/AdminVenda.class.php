<?php

/**
 * AdminVenda [ MODEL SITE ]
 * Classe responsável por tratar e modelar os dados de cadastro do CLiente 
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class AdminVenda {

    private $Cliente;
    private $Data;
    private $Error;
    private $Result;

    const Entity = VENDAS;

    public function ExeCreate(array $Data) {


        $this->Data = $Data;

        if (in_array("", $this->Data)):
            $this->Error = ["Por favor, preencha todos os campos", WS_ALERT];
            $this->Result = false;

        elseif (!Check::Email($this->Data['cliente_email'])):

            $this->Error = ["Imail inválido! Por favor utilize um email válido.", WS_ALERT];
            $this->Result = false;

        elseif ($this->verificarEmailExistente()):
            $this->Error = ["Este email já existe! Favor utilizar outro email.", WS_ALERT];
            $this->Result = false;
        else:

            $this->tratarDados();
            $this->Create();

        endif;
    }

    public function ExeUpdate(array $Data) {

        $this->Data = $Data;


        $this->Update();
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    // PRIVATES
    private function tratarDados() {

        $this->Data = array_map('strip_tags', $this->Data);
        $this->Data = array_map('trim', $this->Data);

        $this->Data['cliente_senha'] = md5($this->Data['cliente_senha']);
        $this->Data['cliente_registro'] = date('Y-m-d H:i:s');
    }

    private function verificarEmailExistente() {

        $Where = ($this->Cliente ? "cliente_id != {$this->Cliente} AND " : '');

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE {$Where} cliente_email = :email", "email={$this->Data['cliente_email']}");
        if ($read->getResult()):
            return true;
        endif;
        return false;
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


    private function Create() {

        $create = new Create();
        $create->ExeCreate(self::Entity, $this->Data);
        if (!$create->getResult()):
            $this->Error = ["Erro ao cadastrar. Por favor, tente novamente!", WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ["Cadastrado realizado com sucesso. Agora você pode entrar e comprar!", WS_ACCEPT];
            $this->Result = true;
        endif;
    }

    private function Update() {

        $update = new Update();
        $update->ExeUpdate("cetrhema_vendas", $this->Data, "WHERE venda_registro = :vendareg", "vendareg={$_SESSION['clientelogin']['venda_registro']}");
        if (!$update->getResult()):
            $this->Error = ['Oppss! Ocorreu um erro ao atualizar o carriho. Desculpe o incômodo! Por favor, tente mais tarde!', WS_ALERT];
            $this->Result = false;
        else:
            $this->Error = ['Sua compra foi atualizada com sucesso!!', WS_ACCEPT];
            $this->Result = true;
        endif;
    }

}
