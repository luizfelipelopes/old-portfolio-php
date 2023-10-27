<?php

/**
 * ajax_filter_videos.inc.php - <b>FILTRAR POSTS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Post
 */
if (!empty($Post)):

    if (isset($Post['status']) && isset($Post['search'])):
        $SqlSearch = ($Post['search'] == '' ? '' : "video_title LIKE '%" . $Post['search'] . "%'");
        $SqlStatus = ($Post['status'] == 'todos' ? '' : (empty($Post['search']) ? '' : " AND ") . "video_status = " . $Post['status']);
        $Sql = ($Post['status'] == 'todos' && empty($Post['search']) ? "" : " WHERE ") . $SqlSearch . $SqlStatus . ($Post['status'] == 'todos' && empty($Post['search']) ? '' : ' ');
    else:
        $Sql = '';
    endif;

//    var_dump($Sql);
//    die;

    $Pager = new Pager("?exe=videos/index&pag=");
    $Pager->ExePager(1, 6);
    $readVideos = new Read;
    $readVideos->FullRead("SELECT video_id, video_title, video_name, video_status, video_date, video_url FROM " . VIDEOS . $Sql . " ORDER BY video_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

    if ($readVideos->getResult()):
        $jSon['videos'] = '';

        foreach ($readVideos->getResult() as $video):

            extract($video);

            $jSon['videos'] .= '<article id="' . $video_id . '" class="videos_item js_item">';

            $jSon['videos'] .= '<div class="js_container_status">';

            if ($video_status == 1):

                $jSon['videos'] .= '<a id="' . $video_id . '" attr-status="' . $video_status . '" attr-action="change_status_video" title="Publicado" href="#" class="icon-check btn_status btn_status_published btn btn-small btn-green radius js_status">Publicado</a>';
            else:
                $jSon['videos'] .= '<a id="' . $video_id . '" attr-status="' . $video_status . '" attr-action="change_status_video" title="Rascunho" href="#" class="icon-alert-triangle btn_status btn_status_draft btn btn-small btn-orange radius js_status">Rascunho</a>';

            endif;

            $jSon['videos'] .= '</div>';

            $jSon['videos'] .= '<div class="embed-container video_frame">';
            $jSon['videos'] .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_url . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
            $jSon['videos'] .= '</div>';
            $jSon['videos'] .= '<div class="video_info">';
            $jSon['videos'] .= '<h3>' . Check::Words($video_title, 5) . '</h3>';
            $jSon['videos'] .= '<span class="video_info_date icon-clock">' . date('d/m/Y à\s\ H:i \h', strtotime($video_date)) . '</span>';

            $jSon['videos'] .= '<div class="video_info_buttons">';
            $jSon['videos'] .= '<a title="Editar Vídeo" href="?exe=videos/create&id=' . $video_id . '" class="icon-edit btn btn-small btn-blue radius">Editar</a> ';
            $jSon['videos'] .= '<a id="' . $video_id . '" attr-action="delete_video" title="Excluir Vídeo" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>';
            $jSon['videos'] .= '</div>';
            $jSon['videos'] .= '</div>';
            $jSon['videos'] .= '</article>';

        endforeach;

    endif;

    $Pager->ExeFullPaginator("SELECT video_id, video_title, video_name, video_status, video_date, video_url FROM " . VIDEOS . $Sql . " ORDER BY video_date DESC");
    $jSon['paginator'] = '<div class="js_paginator" attr-action="paginator_videos">';
    $jSon['paginator'] .= (!empty($Pager->getPaginator()) ? '<div class="paginator_container">' . $Pager->getPaginator() . '</div>' : '');
    $jSon['paginator'] .= '</div>';
endif;
