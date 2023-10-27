<?php

/**
 * ajax_change_status_video.php - <b>Mudar Status do Vídeo</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status do Vídeo
 */
//var_dump($Post);
//die;


if (!empty($Post['id'])):

    $adminVideo = new adminVideo;
    $Status = ['video_status' => ($Post['status'] == '0' ? '1' : '0')];
    $adminVideo->ExeStatus($Post['id'], $Status);
    $jSon['result'] = $adminVideo->getResult();
    $jSon['error'] = $adminVideo->getError();

    $readVideo = new Read;
    $readVideo->FullRead('SELECT video_status FROM ' . VIDEOS . " WHERE video_id = :id", "id={$Post['id']}");
    $jSon['status'] = $readVideo->getResult()[0]['video_status'];
    
endif;



//var_dump($adminVideo);
//die;
//$jSon['result'] = $adminVideo->getResult();
//$jSon['error'] = $adminVideo->getError();
//$jSon['error'] = ["Post Excluído com Sucesso!", "success"];
