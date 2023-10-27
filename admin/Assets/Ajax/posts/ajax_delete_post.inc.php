<?php

/**
 * ajax_delete_post.php - <b>Deletar Post</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Post
 */

$adminPost = new adminPost;
$adminPost->ExeDelete($Post['id']);
//var_dump($adminPost);
//die;
$jSon['result'] = $adminPost->getResult();
$jSon['error'] = $adminPost->getError();
//$jSon['error'] = ["Post Excluído com Sucesso!", "success"];
