<?php

/**
 * ajax_mudar_status_produto.php - <b>MUDAR STATUS PRODUTO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status (Ativo ou Inativo) do Produto em REAL-TIME
 */


$read = new Read;
        $read->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$Post['id']
                }");
        if ($read->getResult()):

            $Data = $read->getResult()[0];
            unset($Data['produto_id'], $Data['produto_last_views'], $Data['produto_views']);
//            $Data['produto_status'] = ($Data['produto_status'] == '1' ? '0' : '1');

            $update_status = ["produto_status" => ($Data['produto_status'] == '1' ? '0' : '1')];
//            var_dump($update_status);

            $adminProduto = new adminProduto;
            $adminProduto->ExeStatus($Post['id'], $update_status);
//            var_dump($adminProduto);
            $jSon['error'] = [$adminProduto->getError()[0], $adminProduto->getError()[1]];

        endif;
