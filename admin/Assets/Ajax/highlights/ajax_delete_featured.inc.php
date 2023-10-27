<?php

/**
 * ajax_delete_featured.php - <b>Deletar Destaque</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Destaque
 */

$adminFeatured = new adminDestaque;
$adminFeatured->ExeDelete($Post['id']);
$jSon['result'] = $adminFeatured->getResult();
$jSon['error'] = $adminFeatured->getError();


