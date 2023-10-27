<?php

/**
 * ajax_filtrar_pedido_status_produto.php - <b>FILTRAR PEDIDOS POR STATUS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Pedidos de Produtos por Status
 */

//        var_dump($Post['status']);


        $readPedidos = new Read;


        if ($Post['status'] == 'todos'):
            $readPedidos->ExeRead(VENDAS, "ORDER BY venda_date DESC");
        else:
            $readPedidos->ExeRead(VENDAS, "WHERE venda_status = :status ORDER BY venda_date DESC", "status={$Post['status']
                    }");
        endif;



        if ($readPedidos->getResult()):


            $jSon['result'] = array();
            $jSon['venda_carrinho'] = array();
            $jSon['venda_carrinho_total'] = array();
            $i = 0;
            $transacoes = array();
            $transacoesFinais = array();

//        CRIA UM ARRAY SÓ COM OS VALORES DE TRANSACAO
            foreach ($readPedidos->getResult() as $pedido):
                $transacoes += [$i => $pedido['venda_transacao']];
                $i++;
            endforeach;

//        LOOP PARA TORNAR NULL TODOS OS TIPO DE TRANSACAO QUE SE REPETEM
            for ($i = 0; $i < count($transacoes); $i++):
                for ($j = $i + 1; $j <= count($transacoes); $j++):

//                SE FOR O ULTIMO CICLO DO LOOP, ARRAY FINAL RECEBE O ULTIMO VALOR E SAI DO LACO PARA Q NAO DE ERRO
                    if ($j == count($transacoes)):
                        $transacoesFinais[$i] = $transacoes[$i];
                        break;
                    endif;

//                SE EXISTIR VALORES REPETIDOS, RECEBERA NULL È ADICIONADO NO ARRAY FINAL
//                CASO CONTRARIO, APENAS É ADICIONADO NO ARRAY FINAL;
                    if ($transacoes[$i] == $transacoes[$j]):
                        $transacoes[$i] = null;
                        $transacoesFinais[$i] = $transacoes[$i];
                    else:
                        $transacoesFinais[$i] = $transacoes[$i];
                    endif;

                endfor;

            endfor;

            $j = 0;
            $indice = 0;
            $jSon['total'] = 0;
            foreach ($readPedidos->getResult() as $pedido):
                if ($transacoesFinais[$j] == $pedido['venda_transacao']):
                    extract($pedido);

                    $jSon['venda_carrinho'] += [$indice => '<div class="container linha pointer j_venda" id="' . $venda_id . '" attr-status="' . $venda_status . '">
                        <div class="content b-bottom">
                            <div class="col-20 coluna-codigo"><span>#' . sprintf("%05d", $indice + 1) . '</span></div>
                            <div class="col-25"><span>' . date('d/m/Y', strtotime($venda_date)) . '</span></div>
                            <div class="col-24"><span class="al-center"> R$ ' . number_format($venda_total, 2, ',', '.') . '</span></div>
                            <div class="col-30" style="' . ($venda_status == '1' ? 'color:#E8A10F' : ($venda_status == '2' ? 'color:#E8A10F' : ($venda_status == '3' ? 'color:#046E5D' : ($venda_status == '7' ? 'color:#C94F3B' : '')))) . '"><span class="font-bold">' . strtoupper($venda_status == '1' ? 'Processando' : ($venda_status == '2' ? 'Em Análise' : ($venda_status == '3' ? 'Pago' : ($venda_status == '7' ? 'Cancelado' : 'Desconhecido')))) . '</span></div>
                            <div class="clear"></div>
                        </div>
                    </div>'];

                    $indice++;

                endif;

                if (!empty($venda_id)):


                    $jSon['venda_carrinho_total'] += [$indice => '<div class="container linha pointer j_venda" id="' . $venda_id . '" attr-status="' . $venda_status . '">
                        <div class="content b-bottom">
                            <div class="col-20 coluna-codigo"><span>#' . sprintf("%05d", $indice + 1) . '</span></div>
                            <div class="col-25"><span>' . date('d/m/Y', strtotime($venda_date)) . '</span></div>
                            <div class="col-24"><span class="al-center"> R$ ' . number_format($venda_total, 2, ',', '.') . '</span></div>
                            <div class="col-30" style="' . ($venda_status == '1' ? 'color:#E8A10F' : ($venda_status == '2' ? 'color:#E8A10F' : ($venda_status == '3' ? 'color:#046E5D' : ($venda_status == '7' ? 'color:#C94F3B' : '')))) . '"><span class="font-bold">' . strtoupper($venda_status == '1' ? 'Processando' : ($venda_status == '2' ? 'Em Análise' : ($venda_status == '3' ? 'Pago' : ($venda_status == '7' ? 'Cancelado' : 'Desconhecido')))) . '</span></div>
                            <div class="clear"></div>
                        </div>
                    </div>'];

                endif;

                $j++;
            endforeach;

            $jSon['total'] = $indice;
        endif;
