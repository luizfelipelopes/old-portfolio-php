<?php

/**
 * ajax_paginator_comentario_segment.php - <b>PAGINAÇÂO COMENTÁRIO SEGMENTOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação do Post em REAL-TIME
 */
$tabela_join_title = $Post['title'];
$tabela_grupo_type = $Post['grupo_type'];
$tabela_join_cover = $Post['cover'];
$tabela_join = $Post['tabela_join'];
$tabela_join_id = $Post['join_id'];
$sql_segment = $Post['sql_segment'];
$tabela_coluna_type = $Post['coluna_type'];

$Pager = new Pager("dashboard.php?exe=comentarios-segmentos&segment=" . $Post['segment'] . "&pag=");
$Pager->ExePager($Post['pagina'], 12);

$i = 0;
$readComentarios = new Read;
$readComentarios->FullRead("SELECT COUNT(comentario_id) AS TOTAL, comentario_status, " . $tabela_join_title . " , " . $tabela_grupo_type . $tabela_join_cover . " FROM " . COMENTARIOS . " a LEFT JOIN " . $tabela_join . " b ON a." . $tabela_grupo_type . " = b." . $tabela_join_id . " WHERE " . $sql_segment . ' ' . $tabela_grupo_type . " IS NOT NULL GROUP BY " . $tabela_grupo_type . " ORDER BY comentario_date DESC " . $tabela_coluna_type . " LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&segment={$Post['segment']}");
if (!$readComentarios->getResult()):

    $jSon[' error'] = ["Nehum comentária ainda", "infor"];

else:

    $jSon['success '] = ["Foi encontrado {$readComentarios->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $readComentarios->getResult()[0]['TOTAL'];
    $jSon['result'] = array();

    $ArrayComentario = array();
    $readPendentes = new Read;
    $readMedia = new Read;
    $readUltimoComentario = new Read;

    $View = new View;
    $tpl_comentario_segment = $View->Load('comentarios-segmentos');

    foreach ($readComentarios->getResult() as $comentario):

        $readPendentes->FullRead("SELECT COUNT(comentario_id) AS PENDENTES FROM " . COMENTARIOS . " WHERE " . $tabela_grupo_type . " = :id AND comentario_status = 0", "id={$comentario[$tabela_grupo_type]}");
        $readMedia->FullRead("SELECT COUNT(comentario_id) AS TOTAL, SUM(comentario_avaluation) AS SOMA FROM " . COMENTARIOS . " WHERE " . $tabela_grupo_type . " = :id AND comentario_status = 1", "id={$comentario[$tabela_grupo_type]}");
        $readUltimoComentario->FullRead("SELECT comentario_date FROM " . COMENTARIOS . " WHERE " . $tabela_grupo_type . " = :id", "id={$comentario[$tabela_grupo_type]}");
        $comentario['total_pendentes'] = $readPendentes->getResult()[0]['PENDENTES'];
        $comentario['total_ativos'] = $comentario['TOTAL'] - $readPendentes->getResult()[0]['PENDENTES'];
        $Media = $readMedia->getResult()[0]['SOMA'] / $readMedia->getResult()[0]['TOTAL'];
        $comentario['media_avaliacao'] = ($Post['segment'] == 'post' || $Post['segment'] == 'review-produto' ? '<div class="comentarios-avaliacao"><span class="ds-block font-bold">Avaliação média:</span> ' . number_format($Media, 1, ',', '.')  . '</div>' : '');
        $comentario['media_estrelas'] = ($Post['segment'] == 'post' || $Post['segment'] == 'review-produto' ? ($Media < 2 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/1-estrela.png" />' : ($Media >= 2 && $Media < 3 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/2-estrelas.png" />' : ($Media >= 3 && $Media < 4 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/3-estrelas.png" />' : $Media >= 4 && $Media < 5 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/4-estrelas.png" />' : ($Media >= 5 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/5-estrelas.png" />' : '')))) : '');
        $comentario['ultimo_comentario'] = $readUltimoComentario->getResult()[$readUltimoComentario->getRowCount() - 1]['comentario_date'];
        $ArrayComentario[] = $comentario;
        $ArrayComentario[$i]['segment'] = $Post['segment'];
        $ArrayComentario[$i]['titulo_segment'] = $comentario[$tabela_join_title];
        $ArrayComentario[$i]['grupo_segment'] = $comentario[$tabela_grupo_type];
        $ArrayComentario[$i]['imagem_segment'] = (!empty($ArrayComentario[$i][str_replace([', ', ' '], '', $tabela_join_cover)]) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $ArrayComentario[$i][str_replace([', ', ' '], '', $tabela_join_cover)] : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png');
        $ArrayComentario[$i]['ultima_data_segment'] = ($Post['segment'] == 'post' ? 'Comentário' : ($Post['segment'] == 'review-produto' ? 'Review' : ($Post['segment'] == 'tickets' ? 'Ticket' : '')));
        $ArrayComentario[$i]['data_segment'] = date('d/m/Y \à\s H:i', strtotime($ArrayComentario[$i]['ultimo_comentario']));
        $ArrayComentario[$i]['comentario_segment'] = ($Post['segment'] == 'post' ? 'Comentários' : ($Post['segment'] == 'review-produto' ? 'Reviews' : ($Post['segment'] == 'tickets' ? 'Tickets' : '')));

        $jSon['result'] += [$i => $View->returnView($ArrayComentario[$i], $tpl_comentario_segment)];

        $i++;
    endforeach;

    $Pager->ExeFullPaginator("SELECT COUNT(comentario_id) AS TOTAL, comentario_status, " . $tabela_join_title . " , " . $tabela_grupo_type . $tabela_join_cover . " FROM " . COMENTARIOS . " a LEFT JOIN " . $tabela_join . " b ON a." . $tabela_grupo_type . " = b." . $tabela_join_id . " WHERE " . $sql_segment . ' ' . $tabela_grupo_type . " IS NOT NULL GROUP BY " . $tabela_grupo_type . " ORDER BY comentario_date DESC " . $tabela_coluna_type, "segment={$Post['segment']}");

    $jSon['action_paginator'] = '<div class="clear"></div><div class="j_paginator" attr-title="' . $tabela_join_title . '" attr-grupo-type="' . $tabela_grupo_type . '" attr-cover="' . $tabela_join_cover . '" attr-join-id="' . $tabela_join_id . '" attr-tabela-join="' . $tabela_join . '" attr-segment="' . $Post['segment'] . '" attr-sql-segment="' . $sql_segment . '" attr-coluna-type="' . $tabela_coluna_type . '" attr-action="paginator_comentario_segment"></div>';
    $jSon['paginator'] = $Pager->getPaginator();
    
    
    endif;