<?php

/**
 * ajax_update_post.php - <b>UPDATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Update de Post
 */
$id = $Post['video_id'];
unset($Post['video_id']);
$jSon['naolimpar'] = true;


$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

$adminVideo = new adminVideo;
$adminVideo->ExeUpdate($id, $meuArray);

if (!$adminVideo->getResult()):
    $jSon['naolimpar'] = true;
endif;

$jSon['error'] = $adminVideo->getError();

