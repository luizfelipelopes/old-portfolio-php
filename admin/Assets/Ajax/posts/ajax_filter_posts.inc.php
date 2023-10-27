<?php

/**
 * ajax_filter_posts.inc.php - <b>FILTRAR POSTS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Post
 */
if (!empty($Post)):

    if (!empty($Post['category']) && isset($Post['status']) && isset($Post['search'])):
        $SqlSection = (empty($Post['section']) ? '' : 'post_cat_parent = ' . $Post['section']);
        $SqlCategory = ($Post['category'] == 'todos' ? '' : (empty($Post['section']) ? '' : " AND ") . 'post_category = ' . $Post['category']);
        $SqlSearch = ($Post['search'] == '' ? '' : (empty($Post['section']) && $Post['category'] == 'todos' ? '' : " AND ") . "post_title LIKE '%" . $Post['search'] . "%'");
        $SqlStatus = ($Post['status'] == 'todos' ? '' : (empty($Post['section']) && $Post['category'] == 'todos' && empty($Post['search']) ? '' : " AND ") . "post_status = " . $Post['status']);
        $Sql = (empty($Post['section']) && $Post['category'] == 'todos' && $Post['status'] == 'todos' && empty($Post['search']) ? "" : " WHERE ") . $SqlSection . $SqlCategory . $SqlSearch . $SqlStatus . (empty($Post['section']) && $Post['category'] == 'todos' && $Post['status'] == 'todos' && empty($Post['search']) ? '' : ' ');
    else:
        $Sql = '';
    endif;

//    var_dump($Sql);
//    die;

    $Pager = new Pager("?exe=posts/index&pag=");
    $Pager->ExePager(1, 12);
    $readPost = new Read;
    $readPost->FullRead("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . $Sql . " ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

    if ($readPost->getResult()):
        $jSon['posts'] = '';

        foreach ($readPost->getResult() as $post):

            extract($post);

            $jSon['posts'] .= '<article id="' . $post_id . '" class="posts_item js_item">';
            $jSon['posts'] .= '<span class = "icon-eye-big">' . sprintf('%06d', $post_views) . '</span>';

            $jSon['posts'] .= '<div class="js_container_status">';

            if ($post_status == 1):

                $jSon['posts'] .= '<a id="' . $post_id . '" attr-status="' . $post_status . '" attr-action="change_status_post" title="Publicado" href="#" class="icon-check btn_status btn_status_published btn btn-small btn-green radius js_status">Publicado</a>';
            else:
                $jSon['posts'] .= '<a id="' . $post_id . '" attr-status="' . $post_status . '" attr-action="change_status_post" title="Rascunho" href="#" class="icon-alert-triangle btn_status btn_status_draft btn btn-small btn-orange radius js_status">Rascunho</a>';

            endif;

            $jSon['posts'] .= '</div>';

            $jSon['posts'] .= '<div class="image_preview">';
            $jSon['posts'] .= '<img title="' . $post_title . '" alt="' . $post_title . '" src="' . HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover . '">';
            $jSon['posts'] .= '</div>';
            $jSon['posts'] .= '<div class="post_info">';
            $jSon['posts'] .= '<h3>' . Check::Words($post_title, 5) . '</h3>';
            $jSon['posts'] .= '<span class="post_info_category icon-tag">' . '<b>' . BuscaRapida::buscarCategoria($post_category)['category_title'] . (BuscaRapida::buscarCategoria($post_category)['category_name'] == 'secao-padrao' ? '</b>' : '</b> - ' . BuscaRapida::buscarCategoria($post_cat_parent)['category_title']) . '</span>';
            $jSon['posts'] .= '<span class="post_info_date icon-clock">' . date('d/m/Y à\s\ H:i \h', strtotime($post_date)) . '</span>';

            $jSon['posts'] .= '<div class="post_info_buttons">';
            $jSon['posts'] .= '<a title="Exibir Post" href="' . HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '" target="_blank" class="icon-goto btn btn-small btn-gray radius">Exibir</a> ';
            $jSon['posts'] .= '<a title="Editar Post" href="?exe=posts/create&id=' . $post_id . '" class="icon-edit btn btn-small btn-blue radius">Editar</a> ';
            $jSon['posts'] .= '<a id="' . $post_id . '" attr-action="delete_post" title="Excluir Post" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>';
            $jSon['posts'] .= '</div>';
            $jSon['posts'] .= '</div>';
            $jSon['posts'] .= '</article>';

        endforeach;

    endif;

    $Pager->ExeFullPaginator("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . $Sql . " ORDER BY post_date DESC");
    $jSon['paginator'] = '<div class="js_paginator" attr-action="paginator_posts">';
    $jSon['paginator'] .= (!empty($Pager->getPaginator()) ? '<div class="paginator_container">' . $Pager->getPaginator() . '</div>' : '');
    $jSon['paginator'] .= '</div>';

endif;
