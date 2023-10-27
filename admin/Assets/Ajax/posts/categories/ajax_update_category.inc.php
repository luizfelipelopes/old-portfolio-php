<?php

/**
 * ajax_update_category.inc.php - <b>UPDATE CATEGORIA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Categoria
 */

if ($Post['category_parent'] == '0'):
    $Post['category_parent'] = null;
endif;

$id = $Post['category_id'];
unset($Post['category_id']);
$jSon['noclear'] = true;

$meuArray = Check::limparSubmit($Post);

$updateCategory = new adminCategoria();
$updateCategory->ExeUpdate($id, $meuArray);

$jSon['error'] = $updateCategory->getError();
