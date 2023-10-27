<?php

/**
 * ajax_delete_category.php - <b>Deletar Category</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Categoria
 */
$adminCategory = new adminCategoria;
$adminCategory->ExeDelete($Post['id']);
//var_dump($adminCategory);
//die;
$jSon['result'] = $adminCategory->getResult();
$jSon['error'] = $adminCategory->getError();
//$jSon['result'] = true;
//$jSon['error'] = ["Category Excluído com Sucesso!", "success"];
