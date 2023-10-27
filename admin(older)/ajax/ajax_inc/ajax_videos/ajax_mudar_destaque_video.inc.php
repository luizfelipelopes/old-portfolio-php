<?php

/**
 * ajax_mudar_destaque_video.inc.php - <b>MUDAR DESTAQUE</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de destaque (Em destaque ou Sem destaque) dos Videos
 */
$read = new Read;
$read->FullRead("SELECT video_status, video_destaque FROM " . VIDEOS . " WHERE video_id = :id", "id={$Post['id']}");
if ($read->getResult()):

    $Data = $read->getResult()[0];
    $Destaque = [
        "video_status" => $Data['video_status'],
        "video_destaque" => ($Data['video_destaque'] == '1' ? '0' : '1'),
    ];

//    var_dump($Destaque);
//    die;
    $adminVideo = new adminVideo;
    $adminVideo->ExeUpdate($Post['id'], $Destaque);
//    var_dump($adminVideo);
    $jSon['error'] = [$adminVideo->getError()[0], $adminVideo->getError()[1]];
    
endif;
