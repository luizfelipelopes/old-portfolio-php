<?php

/**
 * ajax_paginator_pagina.php - <b>PAGINAÇÂO PAGINAS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de paginação dos paginas em REAL-TIME
 */
$Pager = new Pager("dashboard.php?exe=paginas/index&pag=");
$Pager->ExePager($Post['pagina'], 12);

$QueryPesquisa = (!empty($_SESSION['pesquisa']) ? "WHERE (pagina_title LIKE '%' :like '%' OR pagina_subtitle LIKE '%' :like '%') " : '');
$PlacesPesquisa = (!empty($_SESSION['pesquisa']) ? "like={$_SESSION['pesquisa']}&" : '');

$read = new Read;
$read->ExeRead(PAGINAS, $QueryPesquisa . "ORDER BY pagina_date DESC LIMIT :limit OFFSET :offset", $PlacesPesquisa . "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):

    $jSon[' error'] = ["Nehum pagina ainda", "infor"];

else:
    $j = 0;
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $View = new View;
    $tpl_pagina = $View->Load('pagina');
    foreach ($read->getResult() as $pagina):
        extract($pagina);

        $pagina['imagem_pagina'] = (!empty($pagina_cover) ?  HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'foto-novo-post.png');
        $pagina['HOME'] = HOME;
        $pagina['botao_status'] = ($pagina_status == '1' ? '<a title="Publicado" attr-status="mudar_status_pagina" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_pagina" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
        $pagina['segment_registro'] = ($pagina_segment ? "<p class=\"posts-item-categoria\"> >> {$pagina_segment}" : "") . " - " . date('d/m/Y - H:i', strtotime($pagina_date)) . "</p>";
        $jSon['result'] += [$j => $View->returnView($pagina, $tpl_pagina)];
        $j++;
    endforeach;

    $Pager->Exepaginator(PAGINAS, $QueryPesquisa . "ORDER BY pagina_date DESC", str_replace("&", "", $PlacesPesquisa));
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_pagina">';
    $jSon['paginator'] = $Pager->getpaginator();
    
endif;