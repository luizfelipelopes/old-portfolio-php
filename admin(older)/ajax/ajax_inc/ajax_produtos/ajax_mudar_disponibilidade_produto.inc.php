<?php

/**
 * ajax_mudar_disponibilidade_produto.php - <b>MUDAR DISPONIBILIDADE PRODUTO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Disponibilidade (Disponível ou Indisponível) do Produto em REAL-TIME
 */

$read = new Read;
$read->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$Post['id']}");
if ($read->getResult()):

    $Data = $read->getResult()[0];
    unset($Data['produto_id'], $Data['produto_last_views'], $Data['produto_views']);
//            $Data['produto_status'] = ($Data['produto_status'] == '1' ? '0' : '1');

    $update_disponibilidade = ["produto_disponivel" => ($Data['produto_disponivel'] == '1' ? '0' : '1')];
//            var_dump($update_status);

    $adminProduto = new adminProduto;
    $adminProduto->ExeEstoque($Post['id'], $update_disponibilidade);
//            var_dump($adminProduto);
    $jSon['error'] = [$adminProduto->getError()[0], $adminProduto->getError()[1]];

        endif;
