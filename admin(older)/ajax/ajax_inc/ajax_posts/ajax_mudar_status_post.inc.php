<?php

/**
 * ajax_mudar_status_post.inc.php - <b>MUDAR STATUS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status (Ativo ou Inativo) dos Posts
 */
$read = new Read;
$read->FullRead("SELECT post_status FROM " . POSTS . " WHERE post_id = :id", "id={$Post['id']}");
if ($read->getResult()):

    $Data = $read->getResult()[0];
    $Status = ["post_status" => ($Data['post_status'] == '1' ? '0' : '1')];

    $adminPost = new adminPost;
    $adminPost->ExeStatus($Post['id'], $Status);
    $jSon['error'] = [$adminPost->getError()[0], $adminPost->getError()[1]];
    
endif;
