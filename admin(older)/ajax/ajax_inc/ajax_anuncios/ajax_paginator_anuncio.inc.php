<?php

/**
 * ajax_paginator_anuncio.php - <b>PAGINAÇÂO ANUNCIOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação dos Destaques em REAL-TIME
 */
$Pager = new Pager("dashboard.php?exe=anuncios/index&pag=");
$Pager->ExePager($Post['pagina'], 12);

$QueryPesquisa = (!empty($_SESSION['pesquisa']) ? "WHERE (anuncio_title LIKE '%' :like '%' OR anuncio_subtitle LIKE '%' :like '%') " : '');
$PlacesPesquisa = (!empty($_SESSION['pesquisa']) ? "like={$_SESSION['pesquisa']}&" : '');

$read = new Read;
$read->ExeRead(ANUNCIOS, $QueryPesquisa . "ORDER BY anuncio_date DESC LIMIT :limit OFFSET :offset", $PlacesPesquisa . "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):

    $jSon[' error'] = ["Nehum anuncio ainda", "infor"];

else:
    $j = 0;
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $View = new View;
    $tpl_anuncio = $View->Load('anuncio');
    foreach ($read->getResult() as $anuncio):
        extract($anuncio);

        $anuncio['imagem_anuncio'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $anuncio['HOME'] = HOME;
        $anuncio['botao_status'] = ($anuncio_status == '1' ? '<a title="Publicado" attr-status="mudar_status_anuncio" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_anuncio" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
        $anuncio['type_registro'] = ($anuncio_type ? "<p class=\"posts-item-categoria\"> >> {$anuncio_type}" : "") . " - " . date('d/m/Y - H:i', strtotime($anuncio_date)) . "</p>";
        $jSon['result'] += [$j => $View->returnView($anuncio, $tpl_anuncio)];
        $j++;
    endforeach;

    $Pager->ExePaginator(ANUNCIOS, $QueryPesquisa . "ORDER BY anuncio_date DESC", str_replace("&", "", $PlacesPesquisa));
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_anuncio">';
    $jSon['paginator'] = $Pager->getPaginator();
    
endif;