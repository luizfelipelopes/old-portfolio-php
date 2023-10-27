<?php

/**
 * ajax_filter_comments.inc.php - <b>FILTRAR COMENTARIOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Comentários
 */
if (!empty($Post)):

    if (isset($Post['status'])):
        $SqlStatus = ($Post['status'] == 'todos' ? '' : 'comentario_status = ' . $Post['status']);
        $Sql = $SqlStatus . ($Post['status'] == 'todos' ? '' : ' AND');
    else:
        $Sql = '';
    endif;

//    $Pager = new Pager("?exe=comments/moderate&id=" . $Post['id'] . "&pag=");
    $Pager = new Pager("?exe=comments/moderate&pag=");
    $Pager->ExePager(1, 12);

    $readComments = new Read;
//    $readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE " . $Sql . " comentario_resposta IS NULL AND comentario_post = :post AND comentario_type = :type LIMIT :limit OFFSET :offset", "post={$Post['id']}&type=post&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    $readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE " . $Sql . " comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC LIMIT :limit OFFSET :offset", "type=recados&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");


    if ($readComments->getResult()):
        $jSon['comments'] = '';

        foreach ($readComments->getResult() as $post):

            extract($post);

            $jSon['comments'] .= '<article id="' . $comentario_id . '" attr-parent="true" class="comments_moderate_item js_item">';
            $jSon['comments'] .= '<span class="comments_moderate_item_avatar icon-user icon-notext"></span>';

            $jSon['comments'] .= '<div class="comments_moderate_item_info js_comment_info_parent">';
            $jSon['comments'] .= '<h3>' . $comentario_author . '</h3>';
            $jSon['comments'] .= '<p class="comments_moderate_item_info_date">Em ' . date('d/m/Y H\hi', strtotime($comentario_date)) . '</p>';
//            $jSon['comments'] .= '<p class="comments_moderate_item_info_post">Post: ' . BuscaRapida::buscarPost($comentario_post)['post_title'] . '</p>';
            $jSon['comments'] .= '<div class="comments_moderate_item_info_comment_link">';
            $jSon['comments'] .= '<p class="comments_moderate_item_info_comment js_comment_content">' . $comentario_content . '</p>';
            $jSon['comments'] .= '</div>';
            $jSon['comments'] .= '</div>';

            $jSon['comments'] .= '<div class="comments_moderate_item_buttons">';

            $jSon['comments'] .= '<div class="js_container_status">';

            if ($comentario_status == 1):

                $jSon['comments'] .= '<a id="' . $comentario_id . '" attr-status="' . $comentario_status . '" attr-action="change_status_comment" title="Aprovado" href="#" class="btn btn-green radius icon-check js_status">Aprovado</a>';
            else:
                $jSon['comments'] .= '<a id="' . $comentario_id . '" attr-status="' . $comentario_status . '" attr-action="change_status_comment" title="Pendente" href="#" class="btn btn-orange radius icon-check js_status">Pendente</a>';
            endif;

            $jSon['comments'] .= '</div>';

//            $jSon['comments'] .= '<a id="' . $comentario_id . '" attr-action="answer_comment" title="Responder" href="#" class="btn btn-gray radius icon-edit-square js_show_answers">Responder</a>';
            $jSon['comments'] .= '<a id="' . $comentario_id . '" attr-action="set_update_comment" title="Editar" href="#" class="btn btn-blue radius icon-edit js_btn_edit">Editar</a>';
            $jSon['comments'] .= '<a id="' . $comentario_id . '" attr-action="delete_comment" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>';

            $jSon['comments'] .= '</div>';

            $jSon['comments'] .= '<div class="comments_moderate_answers js_comments_answers">';

            $jSon['comments'] .= '<div class="js_comments_answers_itens"></div>';

            $jSon['comments'] .= '<form action="" method="post" enctype="multipart/form-data">';
            $jSon['comments'] .= '<input type="hidden" name="action" value="create_comment">';
            $jSon['comments'] .= '<input type="hidden" name="comentario_type" value="post">';
            $jSon['comments'] .= '<input type="hidden" name="comentario_status" value="1">';
            $jSon['comments'] .= '<input type="hidden" name="comentario_post" value="' . $comentario_post . '">';
            $jSon['comments'] .= '<input type="hidden" name="comentario_resposta" value="' . $comentario_id . '">';
            $jSon['comments'] .= '<input type="hidden" name="comentario_author" value="' . (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] : 'Luiz Felipe') . ' (Moderação)' . '">';
            $jSon['comments'] .= '<textarea rows="7" name="comentario_content" placeholder="Responda a um comentário"></textarea>';
            $jSon['comments'] .= '<div class="btn_container">';
            $jSon['comments'] .= '<button class="btn btn-small btn-blue icon-check-square radius">Responder</button>';
            $jSon['comments'] .= '</div>';
            $jSon['comments'] .= '</form>';

            $jSon['comments'] .= '<span title="Ocultar" class="js_hidden_answer comments_moderate_answers_hidden">^</span>';

            $jSon['comments'] .= '</div>';

            $jSon['comments'] .= '</article>';

        endforeach;

    endif;

//    $Pager->ExeFullPaginator("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE " . $Sql . " comentario_resposta IS NULL AND comentario_post = :post AND comentario_type = :type", "post={$Post['id']}&type=post");
    $Pager->ExeFullPaginator("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE " . $Sql . " comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC", "type=recados");
    $jSon['paginator'] = '<div class="js_paginator" attr-action="paginator_comments" attr-post="' . (!empty($Post['id']) ? $Post['id'] : '') . '">';
    $jSon['paginator'] .= (!empty($Pager->getPaginator()) ? '<div class="paginator_container">' . $Pager->getPaginator() . '</div>' : '');
    $jSon['paginator'] .= '</div>';

endif;
