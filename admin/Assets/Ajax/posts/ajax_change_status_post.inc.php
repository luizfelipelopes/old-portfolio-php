<?php

/**
 * ajax_change_status_post.php - <b>Mudar Status do Post</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status do Post
 */
//var_dump($Post);
//die;


if (!empty($Post['id'])):

    $adminPost = new adminPost;
    $Status = ['post_status' => ($Post['status'] == '0' ? '1' : '0')];
    $adminPost->ExeStatus($Post['id'], $Status);
    $jSon['result'] = $adminPost->getResult();
    $jSon['error'] = $adminPost->getError();

    $readPost = new Read;
    $readPost->FullRead('SELECT post_status FROM ' . POSTS . " WHERE post_id = :id", "id={$Post['id']}");
    $jSon['status'] = $readPost->getResult()[0]['post_status'];
    
endif;



//var_dump($adminPost);
//die;
//$jSon['result'] = $adminPost->getResult();
//$jSon['error'] = $adminPost->getError();
//$jSon['error'] = ["Post Excluído com Sucesso!", "success"];
