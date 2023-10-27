<?php

/**
 * ajax_delete_post.php - <b>DELETE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão o Post
 */
$read = new Read;
$read->FullRead("SELECT post_id FROM " . POSTS);
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há posts cadastrados", "WS_INFOR"];
endif;

$delete = new adminPost();
$delete->ExeDelete($Post['id']);
//        var_dump($Post);
//        $jSon['error'] = $delete->getError();
