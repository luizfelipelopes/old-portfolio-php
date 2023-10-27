<?php

/**
 * ajax_mudar_status_cumpom.inc.php - <b>MUDAR STATUS CUPOM</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Status (Ativo ou Intativo) de Cupons
 */
$read = new Read;
$read->ExeRead(CUPONS, "WHERE cupom_id = :id", "id={$Post['id']
        }");
if ($read->getResult()):

    $Data = $read->getResult()[0];
    unset($Data['cupom_id']);
//            $Data['produto_status'] = ($Data['produto_status'] == '1' ? '0' : '1');

    $update_status = ["cupom_status" => ($Data['cupom_status'] == '1' ? '0' : '1')];
//            var_dump($update_status);

    $adminCupom = new adminCupom;
    $adminCupom->ExeStatus($Post['id'], $update_status);
//            var_dump($adminProduto);
    $jSon['error'] = [$adminCupom->getError()[0], $adminCupom->getError()[1]];

        endif;