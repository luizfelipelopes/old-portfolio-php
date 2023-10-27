<?php

/**
 * ajax_create_categoria.php - <b>CREATE CATEGORIA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Categoria de um Post
 */
if (empty($Post['category_parent']) || $Post['category_parent'] == ''):
    $Post['category_parent'] = null;
endif;

unset($Post['category_id']);

$create = new adminCategoria();
$create->ExeCreate($Post);

$jSon['error'] = $create->getError();
