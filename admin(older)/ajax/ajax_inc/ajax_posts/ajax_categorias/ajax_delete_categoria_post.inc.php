<?php

/**
 * ajax_delete_categoria.php - <b>DELETE CATEGORIA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Categoria de um Post
 */

$delete = new adminCategoria();
$read = new Read;

//$read->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$Post['id']}");
$read->FullRead("SELECT category_id, category_parent FROM " . CATEGORIAS . " WHERE category_id = :id", "id={$Post['id']}");

if ($read->getResult()):
    if ($read->getResult()[0]['category_parent'] == null):
//        $read->ExeRead(CATEGORIAS, "WHERE category_parent = :parent", "parent={$Post['id']}");
        $read->FullRead("SELECT category_id FROM " . CATEGORIAS . " WHERE category_parent = :parent", "parent={$Post['id']}");
        if ($read->getResult()):
            foreach ($read->getResult() as $cat) :
                $delete->ExeDelete($cat['category_id']);
            endforeach;
        endif;
    endif;
endif;

$delete->ExeDelete($Post['id']);

$jSon['error'] = $delete->getError();
