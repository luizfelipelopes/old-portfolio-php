<?php

/**
 * ajax_pesquisar_anuncio.php - <b>PESQUISAR DESTAQUE</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa do Post em REAL-TIME
 */
$read = new Read;
$Pager = new Pager("dashboard.php?exe=anuncios/index&pag=");
$Pager->ExePager(1, 12);

$_SESSION['pesquisa'] = $Post['s'];

$read->ExeRead(ANUNCIOS, "WHERE (anuncio_title LIKE '%' :like '%' OR anuncio_subtitle LIKE '%' :like '%') ORDER BY anuncio_status ASC, anuncio_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):
    $jSon['error'] = ["Nehum post foi encontrado com esta pesquisa", "infor"];
else:
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    $View = new View();
    $tpl_anuncio = $View->Load('anuncio');

    foreach ($read->getResult() as $anuncio):
        extract($anuncio);

        $anuncio['imagem_anuncio'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $anuncio['HOME'] = HOME;
        $anuncio['botao_status'] = ($anuncio_status == '1' ? '<a title="Publicado" attr-status="mudar_status_anuncio" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_anuncio" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
        $anuncio['type_registro'] = ($anuncio_type ? "<p class=\"posts-item-categoria\"> >> {$anuncio_type}" : "") . " - " . date('d/m/Y - H:i', strtotime($anuncio_date)) . "</p>";
        $jSon['result'] += [$i => $View->returnView($anuncio, $tpl_anuncio)];
        $i++;

    endforeach;

    $Pager->ExePaginator(ANUNCIOS, "WHERE (anuncio_title LIKE '%' :like '%' OR anuncio_subtitle LIKE '%' :like '%') ORDER BY anuncio_status ASC, anuncio_date DESC", "like={$Post['s']}");
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_anuncio"></div>';
    $jSon['paginator'] = $Pager->getPaginator();

endif;
