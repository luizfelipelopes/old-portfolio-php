<?php

/**
 * ajax_paginator_posts_comments.inc.php - <b>PAGINATOR POSTS COMENTARIOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação de Posts que possuem Comentários
 */
if (!empty($Post)):

    if (isset($Post['search'])):
        $SqlSearch = (empty($Post['search']) ? '' : "p.post_title LIKE '%" . $Post['search'] . "%'");
        $Sql = $SqlSearch . (empty($Post['search']) ? '' : ' AND');
    else:
        $Sql = '';
    endif;

//    $Own = (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_id'] : '1');
    $Pager = new Pager("?exe=comments/index&pag=");
    $Pager->ExePager($Post['paginator'], 12);
    $readPosts = new Read();
//    $readUsers->FullRead('SELECT user_id, user_foto, user_name, user_lastname, user_level, user_email, user_registration FROM ' . USUARIOS . ' WHERE ' . $Sql . ' user_id != :own ORDER BY user_registration DESC LIMIT :limit OFFSET :offset', "own={$Own}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    $readPosts->FullRead("SELECT p.post_id, p.post_cover, p.post_title, p.post_date, c.comentario_post FROM " . POSTS . " AS p, " . COMENTARIOS . " AS c WHERE " . $Sql . " p.post_id = c.comentario_post AND p.post_status = 1 GROUP BY p.post_id ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

    if ($readPosts->getResult()):
        $jSon['posts'] = '';

        $readComments = new Read;
        $readLastComments = new Read;
        $readCommentsActive = new Read;
        $readCommentsInactive = new Read;

        foreach ($readPosts->getResult() as $post):

            extract($post);

            $readComments->FullRead("SELECT COUNT(*) AS TOTAL FROM " . COMENTARIOS . " WHERE comentario_post = :id", "id={$post_id}");

            if ($readComments->getResult() && $readComments->getResult()[0]['TOTAL'] > 0):
                $readLastComments->FullRead("SELECT comentario_date FROM " . COMENTARIOS . " WHERE comentario_post = :id ORDER BY comentario_date DESC LIMIT 1", "id={$post_id}");
                $readCommentsActive->FullRead("SELECT COUNT(*) AS ACTIVE FROM " . COMENTARIOS . " WHERE comentario_post = :id AND comentario_status = 1", "id={$post_id}");
                $readCommentsInactive->FullRead("SELECT COUNT(*) AS INACTIVE FROM " . COMENTARIOS . " WHERE comentario_post = :id AND comentario_status = 0", "id={$post_id}");
                $Total = $readComments->getResult()[0]['TOTAL'];

                $LastCommentDate = $readLastComments->getResult()[0]['comentario_date'];
                $CommentsActive = $readCommentsActive->getResult()[0]['ACTIVE'];
                $CommentsInactive = $readCommentsInactive->getResult()[0]['INACTIVE'];


                $jSon['posts'] .= '<a id="' . $post_id . '" class="comments_link js_item" title="" href="?exe=comments/moderate&id=' . $post_id . '">';
                $jSon['posts'] .= '<article class="comments_item">';
                $jSon['posts'] .= '<div class="comments_item_image image_preview">';
                $jSon['posts'] .= '<img title="" alt="' . $post_title . '" src="' . HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover . '">';
                $jSon['posts'] .= '</div>';

                $jSon['posts'] .= '<div class="comments_item_info">';

                $jSon['posts'] .= '<h3>' . $post_title . '</h3>';
                $jSon['posts'] .= '<span class="comments_item_date icon-clock">Último comentário: ' . date('d/m/Y \à\s H:i \h', strtotime($LastCommentDate)) . '</span>';

                $jSon['posts'] .= '<div class="comments_item_analytics_group">';
                $jSon['posts'] .= '<span class="comments_item_analytics_group_total icon-comment"><strong>' . $Total . '</strong> comentários</span>';
                $jSon['posts'] .= '<span class="comments_item_analytics_group_pending icon-alert-triangle"><strong>' . $CommentsInactive . '</strong> pendentes</span>';
                $jSon['posts'] .= '<span class="comments_item_analytics_group_active icon-check"><strong>' . $CommentsActive . '</strong> ativos</span>';
                $jSon['posts'] .= '</div>';

                $jSon['posts'] .= '</div>';

                $jSon['posts'] .= '</article>';

                $jSon['posts'] .= '</a>';

            endif;

        endforeach;

    endif;

//    $Pager->ExeFullPaginator("SELECT user_id, user_foto, user_name, user_lastname, user_level, user_email, user_registration FROM " . USUARIOS . " WHERE " . $Sql . " user_id != :own ORDER BY user_registration DESC", "own={$Own}");
    $Pager->ExeFullPaginator("SELECT p.post_id, p.post_cover, p.post_title, p.post_date, c.comentario_post FROM " . POSTS . " AS p, " . COMENTARIOS . " AS c WHERE " . $Sql . " p.post_id = c.comentario_post AND p.post_status = 1 GROUP BY p.post_id ORDER BY post_date DESC");
    $jSon['paginator'] = '<div class="js_paginator" attr-action="paginator_posts_comments">';
    $jSon['paginator'] .= (!empty($Pager->getPaginator()) ? '<div class="paginator_container">' . $Pager->getPaginator() . '</div>' : '');
    $jSon['paginator'] .= '</div>';

endif;
