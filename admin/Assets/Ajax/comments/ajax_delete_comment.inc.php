<?php

/**
 * ajax_delete_comment.php - <b>Deletar Comentário</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Comentário
 */
if (!empty($Post)):

    $adminComment = new adminComentario;

    if (!empty($Post['parent'])):
        $readComments = new Read;
        $readComments->FullRead("SELECT comentario_id FROM " . COMENTARIOS . " WHERE comentario_resposta = :resposta", "resposta={$Post['id']}");
        if ($readComments->getResult()):
            foreach ($readComments->getResult() as $comment):
                extract($comment);
                $adminComment->ExeDelete($comentario_id);
            endforeach;
        endif;
    endif;

endif;

$adminComment->ExeDelete($Post['id']);
//var_dump($adminComment);
//die;
$jSon['result'] = $adminComment->getResult();
$jSon['error'] = $adminComment->getError();


