<?php

/**
 * ajax_update_categoria_post.inc.php - <b>UPDATE CATEGORIA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Categoria de Posts
 */
if (empty($Post['category_parent']) || $Post['category_parent'] == ''):
    $Post['category_parent'] = null;
endif;

$id = $Post['category_id'];
unset($Post['category_id']);
$jSon['limpar'] = true;

$update = new adminCategoria();
$update->ExeUpdate($id, $Post);

$jSon['error'] = $update->getError();
