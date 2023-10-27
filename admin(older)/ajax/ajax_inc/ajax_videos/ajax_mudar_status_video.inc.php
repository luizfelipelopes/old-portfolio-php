<?php

/**
 * ajax_mudar_status_post.inc.php - <b>MUDAR STATUS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status (Ativo ou Inativo) dos Posts
 */
$read = new Read;
$read->FullRead("SELECT video_status, video_destaque FROM " . VIDEOS . " WHERE video_id = :id", "id={$Post['id']}");
if ($read->getResult()):

    $Data = $read->getResult()[0];
    $Status = [
        "video_destaque" => $Data['video_destaque'],
        "video_status" => ($Data['video_status'] == '1' ? '0' : '1')
    ];

//    var_dump($Status);
    $adminVideo = new adminVideo;
    $adminVideo->ExeUpdate($Post['id'], $Status);
//    var_dump($adminVideo);
    $jSon['error'] = [$adminVideo->getError()[0], $adminVideo->getError()[1]];
    
endif;
