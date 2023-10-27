<?php

/**
 * ajax_create_comment.php - <b>Criar Comentário</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Comentário
 */
unset($Post['comentario_id']);

$meuArray = Check::limparSubmit($Post);

//var_dump($meuArray);
//die;

$adminComment = new adminComentario;
$adminComment->ExeCreate($meuArray);
//var_dump($adminComment);
//die;

if (!$adminComment->getResult()):
    $jSon['noclear'] = true;
else:
    $readComment = new Read;
    $readComment->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_id = :id", "id={$adminComment->getResult()}");
    if ($readComment->getResult()):
        extract($readComment->getResult()[0]);

        $jSon['id'] = $Post['comentario_resposta'];

        $jSon['create_comment'] = '<article id="' . $comentario_id . '" class="comments_moderate_item comments_moderate_answers_item js_item">';
        $jSon['create_comment'] .= '<span class="comments_moderate_item_avatar icon-user icon-notext"></span>';
        $jSon['create_comment'] .= '<div class="comments_moderate_item_info">';
        $jSon['create_comment'] .= '<h3>' . $comentario_author . '</h3>';
        $jSon['create_comment'] .= '<p class="comments_moderate_item_info_date">Em ' . date('d/m/Y H\hi', strtotime($comentario_date)) . '</p>';
        $jSon['create_comment'] .= '<div class="comments_moderate_item_info_comment_link">';
        $jSon['create_comment'] .= '<p class="comments_moderate_item_info_comment js_comment_content">' . $comentario_content . '</p>';
        $jSon['create_comment'] .= '</div>';
        $jSon['create_comment'] .= '</div>';
        $jSon['create_comment'] .= '<div class="comments_moderate_item_buttons">';

        $jSon['create_comment'] .= '<div class="js_container_status">';

        if ($comentario_status == '1'):
            $jSon['create_comment'] .= '<a id="' . $comentario_id . '" attr-status="' . $comentario_status . '" attr-action="change_status_comment" title="Aprovado" href="#" class="btn btn-green radius icon-check js_status">Aprovado</a>';
        else:
            $jSon['create_comment'] .= '<a id="' . $comentario_id . '" attr-status="' . $comentario_status . '" attr-action="change_status_comment" title="Pendente" href="#" class="btn btn-orange radius icon-check js_status">Pendente</a>';
        endif;

        $jSon['create_comment'] .= '</div>';

        $jSon['create_comment'] .= '<a id="' . $comentario_id . '" attr-action="set_update_comment" title="Editar" href="#" class="btn btn-blue radius icon-edit js_btn_edit">Editar</a>';
        $jSon['create_comment'] .= '<a id="' . $comentario_id . '" attr-action="delete_comment" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>';
        $jSon['create_comment'] .= '</div>';
        $jSon['create_comment'] .= '</article>';

    endif;
endif;


$jSon['error'] = $adminComment->getError();
