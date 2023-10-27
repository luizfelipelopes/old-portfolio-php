<?php

/**
 * ajax_delete_comentario_post.inc.php - <b>DELETE COMENTARIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Comentário dos Posts
 */

$read = new Read;
$read->ExeRead(COMENTARIOS);
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há comentários", "infor"];
endif;

$delete = new adminComentario;

$readResposta = new Read;
$readResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :id", "id={$Post['id']
        }");
if ($readResposta->getResult()):
    foreach ($readResposta->getResult() as $resposta):
        $delete->ExeDelete($resposta['comentario_id']);
    endforeach;
endif;

$delete->ExeDelete($Post['id']);
//        var_dump($Post);
//        $jSon['error'] = [$delete->getError()[0], $delete->getError()[1]];
