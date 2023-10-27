<?php

/**
 * ajax_pesquisar_video.php - <b>PESQUISAR VIDEO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa do VIDEO em REAL-TIME
 */
$read = new Read;
$Pager = new Pager("dashboard.php?exe=videos/index&pag=");
$Pager->ExePager(1, 12);

$_SESSION['pesquisa'] = $Post['s'];


$read->ExeRead(VIDEOS, "WHERE (video_title LIKE '%' :like '%' OR video_desc LIKE '%' :like '%') ORDER BY video_status ASC, video_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):
    $jSon['error'] = ["Nehum post foi encontrado com esta pesquisa", "infor"];
else:
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    $View = new View();
    $tpl_video = $View->Load('video');

    foreach ($read->getResult() as $video):
        extract($video);

        $video['video'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $video['HOME'] = HOME;
        $video['video_desc'] = Check::Words($video['video_desc'], 10);
        $video['botao_status'] = ($video_status == '1' ? '<a title="Publicado" attr-action="mudar_status_videos" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-action="mudar_status_videos" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');

        $video['data_formatada'] = date('d/m/Y - H:i', strtotime($video_date)) . "</p>";

        $jSon['result'] += [$i => $View->returnView($video, $tpl_video)];

        $i++;
    endforeach;

    $Pager->ExePaginator(VIDEOS, "WHERE (video_title LIKE '%' :like '%' OR video_desc LIKE '%' :like '%') ORDER BY video_date DESC", "like={$Post['s']}");

    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_video"></div>';
    $jSon['paginator'] = $Pager->getPaginator();

        endif;
