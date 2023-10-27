<?php

/**
 * ajax_change_status_comment.php - <b>Mudar Status do Comentário</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status do Comentário
 */
//var_dump($Post);
if (!empty($Post['id'])):

    $adminComment = new adminComentario;
    $Status = ['comentario_status' => ($Post['status'] == '0' ? '1' : '0')];
    $adminComment->ExeStatus($Post['id'], $Status);
    $jSon['result'] = $adminComment->getResult();
    $jSon['error'] = $adminComment->getError();

    $readComment = new Read;
    $readComment->FullRead('SELECT comentario_status FROM ' . COMENTARIOS . " WHERE comentario_id = :id", "id={$Post['id']}");
    $jSon['status'] = $readComment->getResult()[0]['comentario_status'];
    $jSon['legend'] = ($readComment->getResult()[0]['comentario_status'] == '1' ? 'APROVADO' : 'PENDENTE');
    
endif;



//var_dump($adminComment);
//die;
//$jSon['result'] = $adminComment->getResult();
//$jSon['error'] = $adminComment->getError();
//$jSon['error'] = ["Post Excluído com Sucesso!", "success"];
