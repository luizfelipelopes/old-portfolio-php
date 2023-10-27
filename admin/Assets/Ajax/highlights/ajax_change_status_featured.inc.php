<?php

/**
 * ajax_change_status_featured.php - <b>Mudar Status Destaque</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Status de Destaque
 */

$Data = ['destaque_status' => ($Post['status'] == '1' ? '0' : '1')];

$adminFeatured = new adminDestaque;
$adminFeatured->ExeStatus($Post['id'], $Data);
$jSon['result'] = $adminFeatured->getResult();
$jSon['error'] = [$adminFeatured->getError()[0], $adminFeatured->getError()[1]];

$readHighlights = new Read;
$readHighlights->FullRead("SELECT destaque_status FROM " . DESTAQUES . " WHERE destaque_id = :id", "id={$Post['id']}");
$jSon['status'] = $readHighlights->getResult()[0]['destaque_status'];
