<?php

/**
 * ajax_update_video.php - <b>Atualizar Vídeo</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Vídeo
 */
if (!empty($Post)):

    $jSon['noclear'] = true;
    $id = $Post['video_id'];
    unset($Post['video_id']);

//    unset($Post['video_id']);
    $meuArray = Check::limparSubmit($Post);

//    var_dump($meuArray);
//    die;

    $adminVideo = new adminVideo;
    $adminVideo->ExeUpdate($id, $meuArray);
//    var_dump($adminVideo);
//    die;

    $jSon['error'] = $adminVideo->getError();
    
//    var_dump($adminVideo);
    
endif;


