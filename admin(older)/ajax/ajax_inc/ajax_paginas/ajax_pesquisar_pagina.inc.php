<?php

/**
 * ajax_pesquisar_pagina.php - <b>PESQUISAR DESTAQUE</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa do Post em REAL-TIME
 */
$read = new Read;
$Pager = new Pager("dashboard.php?exe=paginas/index&pag=");
$Pager->ExePager(1, 12);

$_SESSION['pesquisa'] = $Post['s'];

$read->ExeRead(PAGINAS, "WHERE (pagina_title LIKE '%' :like '%' OR pagina_content LIKE '%' :like '%') ORDER BY pagina_status ASC, pagina_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):
    $jSon['error'] = ["Nehum post foi encontrado com esta pesquisa", "infor"];
else:
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    $View = new View();
    $tpl_pagina = $View->Load('pagina');

    foreach ($read->getResult() as $pagina):
        extract($pagina);

        $pagina['imagem_pagina'] = (!empty($pagina_cover) ?  HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'foto-novo-post.png');
        $pagina['HOME'] = HOME;
        $pagina['botao_status'] = ($pagina_status == '1' ? '<a title="Publicado" attr-status="mudar_status_pagina" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_pagina" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
        $pagina['segment_registro'] = ($pagina_segment ? "<p class=\"posts-item-categoria\"> >> {$pagina_segment}" : "") . " - " . date('d/m/Y - H:i', strtotime($pagina_date)) . "</p>";
        $jSon['result'] += [$i => $View->returnView($pagina, $tpl_pagina)];
        $i++;

    endforeach;

    $Pager->ExePaginator(PAGINAS, "WHERE (pagina_title LIKE '%' :like '%' OR pagina_content LIKE '%' :like '%') ORDER BY pagina_status ASC, pagina_date DESC", "like={$Post['s']}");
    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_pagina"></div>';
    $jSon['paginator'] = $Pager->getPaginator();

endif;
