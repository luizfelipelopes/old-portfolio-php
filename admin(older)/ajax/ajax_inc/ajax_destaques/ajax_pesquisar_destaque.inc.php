<?php

/**
 * ajax_pesquisar_destaque.php - <b>PESQUISAR DESTAQUE</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa do Post em REAL-TIME
 */
$read = new Read;
$Pager = new Pager("dashboard.php?exe=destaques/index&pag=");
$Pager->ExePager(1, 12);

$_SESSION['pesquisa'] = $Post['s'];

$read->ExeRead(DESTAQUES, "WHERE (destaque_title LIKE '%' :like '%' OR destaque_subtitle LIKE '%' :like '%') ORDER BY destaque_status ASC, destaque_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):
    $jSon['error'] = ["Nehum post foi encontrado com esta pesquisa", "infor"];
else:
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    $View = new View();
    $tpl_destaque = $View->Load('destaque');

    foreach ($read->getResult() as $destaque):
        extract($destaque);

        $destaque['imagem_destaque'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
        $destaque['HOME'] = HOME;
        $destaque['botao_status'] = ($destaque_status == '1' ? '<a title="Publicado" attr-status="mudar_status_destaque" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_destaque" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
        $destaque['type_registro'] = ($destaque_type ? "<p class=\"posts-item-categoria\"> >> {$destaque_type}" : "") . " - " . date('d/m/Y - H:i', strtotime($destaque_date)) . "</p>";
        $jSon['result'] += [$i => $View->returnView($destaque, $tpl_destaque)];
        $i++;

    endforeach;

    $Pager->ExePaginator(DESTAQUES, "WHERE (destaque_title LIKE '%' :like '%' OR destaque_subtitle LIKE '%' :like '%') ORDER BY destaque_status ASC, destaque_date DESC", "like={$Post['s']}");
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_destaque"></div>';
    $jSon['paginator'] = $Pager->getPaginator();

endif;
