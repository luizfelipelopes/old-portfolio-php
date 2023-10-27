<?php

/**
 * ajax_detalhes_pedido_produto.php - <b>DETALHES DO PEDIDO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Detalhes do Pedido de um Produto
 */
//        var_dump($Post);

$readPedidos = new Read;
$readCarrinho = new Read;
$adminVenda = new AdminVenda;
$readPedidos->ExeRead(VENDAS, "WHERE venda_id = :id", "id={$Post['id']}");

if ($readPedidos->getResult()):
    $readCliente = new Read;
    $jSon['total'] = $readPedidos->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    foreach ($readPedidos->getResult() as $pedido):

        extract($pedido);


        $readCliente->ExeRead(CLIENTES, "WHERE cliente_id = :id", "id={$venda_cliente}");
        extract($readCliente->getResult()[0]);

        $pedido['cliente_name'] = $cliente_name;
        $pedido['cliente_lastname'] = $cliente_lastname;
        $pedido['cliente_email'] = $cliente_email;
        $pedido['cliente_cpf'] = $cliente_cpf;
        $pedido['cliente_ddd'] = $cliente_ddd;
        $pedido['cliente_telefone'] = $cliente_telefone;
        $pedido['cliente_endereco'] = $cliente_endereco;
        $pedido['cliente_numero'] = $cliente_numero;
        $pedido['cliente_complemento'] = $cliente_complemento;
        $pedido['cliente_bairro'] = $cliente_bairro;

        $readCidade = new Read;
        $readCidade->ExeRead(CIDADES, "WHERE cidade_id = :id", "id={$cliente_cidade
                }");

        $pedido['cliente_cidade'] = $readCidade->getResult()[0]['cidade_nome'];
        $pedido['cliente_uf'] = $readCidade->getResult()[0]['cidade_uf'];
        $pedido['cliente_cep'] = $cliente_cep;
        $pedido['venda_frete'] = CUSTO_FRETE;
        $pedido['venda_taxa'] = number_format($pedido['venda_taxa'], 2, ',', '.');
        $pedido['venda_pag_descontado'] = number_format($pedido['venda_pag_descontado'], 2, ',', '.');
        $pedido['venda_status'] = $adminVenda->getStatusTransacao($venda_status);
        $pedido['venda_forma_pagamento'] = $adminVenda->getFormaDePagamento($venda_pagamento);


        $jSon['venda_carrinho'] = array();
        $jSon['venda_total'] = 0;

        $readCarrinho->ExeRead(VENDAS, "WHERE venda_transacao = :transacao", "transacao={$venda_transacao
                }");
        if ($readCarrinho->getResult()):
            $j = 0;
            foreach ($readCarrinho->getResult() as $carrinho):
                extract($carrinho);

                $jSon['venda_carrinho'] += [$j => '<div class="container linha">
                        <div class="content">
                            <div class="col-15"><span>#' . $venda_produto . '</span></div>
                            <div class="col-24"><span>' . $venda_name . '</span></div>
                            <div class="col-20"><span>' . $venda_quantidade . '</span></div>
                            <div class="col-20"><span>R$ ' . number_format($venda_unidade, 2, ',', '.') . '</span></div>
                            <div class="col-20"><span>R$ ' . number_format($venda_total, 2, ',', '.') . '</span></div>
                            <div class="clear"></div>
                        </div>
                    </div>'];


                $j++;

                $jSon['venda_total'] += $venda_total;
            endforeach;

            $jSon['venda_total_frete'] = number_format($jSon['venda_total'] + $pedido['venda_frete'], 2, ',', '.');
//                    $pedido['venda_frete'] = number_format($pedido['venda_frete'], 2, ',', '.');


        endif;



        $View = new View;
        $tpl_pedido = $View->Load('detalhe_pedido');

        $jSon['result'] += [$i => $View->returnView($pedido, $tpl_pedido)];
        $jSon['venda_total'] = number_format($jSon['venda_total'], 2, ',', '.');


        $i++;

    endforeach;

        endif;
