<?php

/**
 * ajax_create_video.php - <b>Criar Video</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Video
 */
if (!empty($Post)):


    unset($Post['video_id']);
    $meuArray = Check::limparSubmit($Post);

//    var_dump($meuArray);
//    die;

    $adminVideo = new adminVideo;
    $adminVideo->ExeCreate($meuArray);
    if (!$adminVideo->getResult()):
        $jSon['noclear'] = true;
    endif;

//    var_dump($adminVideo);
//    die;

    $jSon['error'] = $adminVideo->getError();
    
endif;


