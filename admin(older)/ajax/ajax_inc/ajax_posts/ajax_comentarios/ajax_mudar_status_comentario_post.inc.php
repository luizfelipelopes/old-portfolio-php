<?php

/**
 * ajax_mudar_status_comentario_post.inc.php - <b>MUDAR STATUS COMENTARIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status (Ativo ou Inativo) de Comentário dos Posts
 */
$read = new Read;
$read->ExeRead(COMENTARIOS, "WHERE comentario_id = :id", "id={$Post['id']}");
if ($read->getResult()):

//    unset($read->getResult()[0]['comentario_id']);
    $Data = $read->getResult()[0];
    $comentario_status = ['comentario_status' => $Data['comentario_status'] == '1' ? '0' : '1'];

    $adminComentario = new adminComentario;
    $adminComentario->ExeUpdate($Post['id'], $comentario_status);

//            var_dump($adminComentario);
//            $jSon['error'] = [$adminComentario->getError()[0], $adminComentario->getError()[1]];

        endif;
