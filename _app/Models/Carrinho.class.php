<?php

/**
 * Carrinho.class [ MODEL SITE ]
 * Modela, trata e manipula os dados de um Carrinho de Compras
 * @copyright (c) 2016, Luiz Felipe C. Lopes UPINSIDE TECNOLOGIA 
 */
class Carrinho {

    private $Id;
    private $Error;
    private $Result;

    const Entity = PRODUTOS;

    public function getId() {
        return $this->Id;
    }

    public function setId($Id) {
        $this->Id = (int) $Id;
    }

    public function getError() {
        return $this->Error;
    }

    public function getResult() {
        return $this->Result;
    }

    public function getQuantidade() {
        return $_SESSION['carrinho'][$this->Id];
    }

    public function adicionar() {
        if (!isset($_SESSION['carrinho'])):
            $_SESSION['carrinho'] = array();
        endif;

        if (empty($_SESSION['carrinho'][$this->Id])):
            $_SESSION['carrinho'][$this->Id] = 1;
        else:
            $_SESSION['carrinho'][$this->Id] += 1;
        endif;
    }

    public function listarPedido() {

        $read = new Read;
        $read->ExeRead(self::Entity, "WHERE produto_id = :id", "id={$this->Id}");
        if (!$read->getResult()):
            $this->Error = ["Você não tem nenum produto adicionado!", WS_INFOR];
            $this->Result = false;
        else:
            $this->Error = ["Produto adicionado com sucesso!", WS_ACCEPT];
            $this->Result = $read->getResult();
        endif;
    }

    public function excluirPedido() {

        if (isset($_SESSION['carrinho'][$this->Id])):
            unset($_SESSION['carrinho'][$this->Id]);
            $this->Result = true;
        endif;
    }

    public static function esvaziarCarrinho() {

        if (isset($_SESSION['carrinho'])):
            unset($_SESSION['carrinho']);
            session_destroy();
        endif;
    }

    public function ExeSalvar(array $IDCarrinho) {

        foreach ($IDCarrinho as $Key => $Value):

            $ItensCarrinho = array();

            $this->Id = $Key;
            $this->listarPedido();
            if ($this->getResult()):

                $ItensCarrinho['venda_produto'] = $this->Id;
                $ItensCarrinho['venda_name'] = $this->getResult()[0]['produto_name'];
                $ItensCarrinho['venda_quantidade'] = $Value;
                $ItensCarrinho['venda_cliente'] = $_SESSION['clientelogin']['cliente_id'];
                $ItensCarrinho['venda_unidade'] = (!empty($this->getResult()[0]['produto_desconto']) && $this->getResult()[0]['produto_desconto'] > 0 ? $this->getResult()[0]['produto_valor_descontado'] : $this->getResult()[0]['produto_valor']);
                $ItensCarrinho['venda_total'] = $Value * $this->getResult()[0]['produto_valor'];
                $ItensCarrinho['venda_status'] = '1';
                $ItensCarrinho['venda_registro'] = $_SESSION['clientelogin']['venda_registro'];
                $ItensCarrinho['venda_date'] = date('Y-m-d H:i:s');

//                var_dump($ItensCarrinho);

                $this->salvarCarrinho($ItensCarrinho);

            endif;


        endforeach;
    }

    public function salvarCarrinho(array $ItensCarrinho) {

        $read = new Read();
        $read->ExeRead(VENDAS, "WHERE venda_registro = :vendareg AND venda_name = :name AND venda_quantidade != :quantidade", "vendareg={$_SESSION['clientelogin']['venda_registro']}&name={$ItensCarrinho['venda_name']}&quantidade={$ItensCarrinho['venda_quantidade']}");

        if ($read->getResult()):

            $update = new Update();
            $update->ExeUpdate(VENDAS, $ItensCarrinho, "WHERE venda_registro = :vendareg", "vendareg={$_SESSION['clientelogin']['venda_registro']}");
            if (!$update->getResult()):
                $this->Error = ['Oppss! Ocorreu um erro ao atualizar o carriho. Desculpe o incômodo! Por favor, tente mais tarde!', WS_ALERT];
                $this->Result = false;
            else:
                $this->Error = ['Sua compra foi atualizada com sucesso!!', WS_ACCEPT];
                $this->Result = true;
            endif;

        else:

            $readVenda = new Read;
            $readVenda->ExeRead(VENDAS, "WHERE venda_registro = :registro AND venda_name = :name", "registro={$_SESSION['clientelogin']['venda_registro']}&name={$ItensCarrinho['venda_name']}");
            if (!$readVenda->getResult()):
                $create = new Create();
                $create->ExeCreate(VENDAS, $ItensCarrinho);
                if (!$create->getResult()):
                    $this->Error = ['Oppss! Ocorreu um erro ao salvar o carriho. Desculpe o incômodo! Por favor, tente mais tarde!', WS_ALERT];
                    $this->Result = false;
                else:
                    $this->Error = ['Sua compra foi realizada com sucesso!!', WS_ACCEPT];
                    $this->Result = $create->getResult();
                endif;
            endif;

        endif;
    }

}
