<?php

/**
 * ajax_delete_post.php - <b>DELETE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão o Post
 */
$read = new Read;
$read->FullRead("SELECT video_id FROM " . VIDEOS);
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há vídeos cadastrados", "WS_INFOR"];
endif;

$delete = new adminVideo();
$delete->ExeDelete($Post['id']);
