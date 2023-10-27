<?php

/**
 * ajax_delete_categoria.inc.php - <b>DELETE GALERIA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Fotos da Galeria do Produto
 */
$Post['id'] = substr($Post['id'], 4, 3);

$adminProduto = new AdminProduto;
$adminProduto->gbRemove($Post['id']);
$json['error'] = $adminProduto->getError();

//        var_dump($adminProduto);