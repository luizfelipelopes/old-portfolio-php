<?php

/**
 * ajax_paginator_destaque.php - <b>PAGINAÇÂO DESTAQUES</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação dos Destaques em REAL-TIME
 */
$Pager = new Pager("dashboard.php?exe=destaques/index&pag=");
$Pager->ExePager($Post['pagina'], 12);

$QueryPesquisa = (!empty($_SESSION['pesquisa']) ? "WHERE (destaque_title LIKE '%' :like '%' OR destaque_subtitle LIKE '%' :like '%') " : '');
$PlacesPesquisa = (!empty($_SESSION['pesquisa']) ? "like={$_SESSION['pesquisa']}&" : '');

$read = new Read;
$read->ExeRead(DESTAQUES, $QueryPesquisa . "ORDER BY destaque_date DESC LIMIT :limit OFFSET :offset", $PlacesPesquisa . "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):

    $jSon[' error'] = ["Nehum destaque ainda", "infor"];

else:
    $j = 0;
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $View = new View;
    $tpl_destaque = $View->Load('destaque');
    foreach ($read->getResult() as $destaque):
        extract($destaque);

        $destaque['imagem_destaque'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $destaque['HOME'] = HOME;
        $destaque['botao_status'] = ($destaque_status == '1' ? '<a title="Publicado" attr-status="mudar_status_destaque" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_destaque" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
        $destaque['type_registro'] = ($destaque_type ? "<p class=\"posts-item-categoria\"> >> {$destaque_type}" : "") . " - " . date('d/m/Y - H:i', strtotime($destaque_date)) . "</p>";
        $jSon['result'] += [$j => $View->returnView($destaque, $tpl_destaque)];
        $j++;
    endforeach;

    $Pager->ExePaginator(DESTAQUES, $QueryPesquisa . "ORDER BY destaque_date DESC", str_replace("&", "", $PlacesPesquisa));
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_destaque">';
    $jSon['paginator'] = $Pager->getPaginator();
    
endif;