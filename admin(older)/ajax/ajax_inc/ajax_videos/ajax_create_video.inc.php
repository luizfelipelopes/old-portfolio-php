<?php

/**
 * ajax_create_post.php - <b>CREATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Post
 */


unset($Post['video_id']);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//var_dump($meuArray);
//die;
$adminVideo = new adminVideo;
$adminVideo->ExeCreate($meuArray);

if (!$adminVideo->getResult()):
    $jSon['naolimpar'] = true;
endif;

$jSon['error'] = $adminVideo->getError();

//        var_dump($adminVideo);
