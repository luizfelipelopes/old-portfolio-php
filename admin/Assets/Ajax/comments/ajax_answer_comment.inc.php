<?php

/**
 * ajax_answer_comment.php - <b>Responder Comentários</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Resposta de Comentários
 */
if (!empty($Post['id'])):

    $readComments = new Read;
    $readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_resposta IS NOT NULL AND comentario_resposta = :resposta AND comentario_type = :type", "resposta={$Post['id']}&type=post");
    if ($readComments->getResult()):
        $jSon['result'] = '';
        foreach ($readComments->getResult() as $comment):
            extract($comment);

            $jSon['result'] .= '<article id="' . $comentario_id . '" class="comments_moderate_item comments_moderate_answers_item js_item">';
            $jSon['result'] .= '<span class="comments_moderate_item_avatar icon-user icon-notext"></span>';
            $jSon['result'] .= '<div class="comments_moderate_item_info js_comment_info_child">';
            $jSon['result'] .= '<h3>' . $comentario_author . '</h3>';
            $jSon['result'] .= '<p class="comments_moderate_item_info_date">Em ' . date('d/m/Y H\hi', strtotime($comentario_date)) . '</p>';
//            $jSon['result'] .= '<p class="comments_moderate_item_info_post">Post: ' . BuscaRapida::buscarPost($comentario_post)['post_title'] . '</p>';
            $jSon['result'] .= '<div class="comments_moderate_item_info_comment_link">';
            $jSon['result'] .= '<p class="comments_moderate_item_info_comment js_comment_content">' . $comentario_content . '</p>';
            $jSon['result'] .= '</div>';
            $jSon['result'] .= '</div>';
            $jSon['result'] .= '<div class="comments_moderate_item_buttons">';
            
            $jSon['result'] .= '<div class="js_container_status">';

            if ($comentario_status == '1'):
                $jSon['result'] .= '<a id="' . $comentario_id . '" attr-status="' . $comentario_status . '" attr-action="change_status_comment" title="Aprovado" href="#" class="btn btn-green radius icon-check js_status">Aprovado</a>';
            else:
                $jSon['result'] .= '<a id="' . $comentario_id . '" attr-status="' . $comentario_status . '" attr-action="change_status_comment" title="Pendente" href="#" class="btn btn-orange radius icon-check js_status">Pendente</a>';
            endif;
            
            $jSon['result'] .= '</div>';

            $jSon['result'] .= '<a id="' . $comentario_id . '" attr-action="set_update_comment" title="Editar" href="#" class="btn btn-blue radius icon-edit js_btn_edit">Editar</a>';
            $jSon['result'] .= '<a id="' . $comentario_id . '" attr-action="delete_comment" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>';
            $jSon['result'] .= '</div>';
            $jSon['result'] .= '</article>';


        endforeach;
    endif;
    
    
endif;



