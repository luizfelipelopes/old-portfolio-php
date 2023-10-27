<?php

/**
 * ajax_delete_video.php - <b>Deletar Vídeo</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Vídeo
 */

$adminVideo = new adminVideo;
$adminVideo->ExeDelete($Post['id']);
$jSon['result'] = $adminVideo->getResult();
$jSon['error'] = $adminVideo->getError();
