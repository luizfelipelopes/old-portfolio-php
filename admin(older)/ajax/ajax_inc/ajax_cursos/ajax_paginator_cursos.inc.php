<?php

/**
 * ajax_paginator_curso.inc.php - <b>PAGINATOR CURSO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação de Cursos em REAL_TIME
 */

$read = new Read;
        $Pager = new Pager("dashboard.php?exe=cursos/index&pag=");
        $Pager->ExePager($Post['pagina'], 8);

        $read->ExeRead(CURSOS, "ORDER BY curso_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
        if (!$read->getResult()):
            $Pager->ReturnPage();
            $jSon['error'] = ["Nehum curso foi encontrado com esta pesquisa", "infor"];
        else:
            $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
            $jSon['total'] = $read->getRowCount();
            $jSon['result'] = array();
            $i = 0;

            $View = new View();
            $tpl_curso = $View->Load('curso');

            foreach ($read->getResult() as $curso):
//                $posCss++;
                extract($curso);

                $curso['imagem_curso'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $curso['HOME'] = HOME;
                $curso['ADMIN'] = HOME . DIRECTORY_SEPARATOR . ADMIN;
                $curso['botao_status'] = ($curso_status == '1' ? '<a title="Publicado" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');

                $readSegmento = new Read;
                $readSegmento->ExeRead(SEGMENTOS, "WHERE segment_id = :id", "id={$curso_segment}");

                $curso['segmento_data'] = ($readSegmento->getResult() ? "<p class=\"posts-item-categoria\"> >> {$readSegmento->getResult()[0]['segment_title']}" : "") . " - " . date('d/m/Y - H:i', strtotime($curso_date)) . "</p>";
                $jSon['result'] += [$i => $View->returnView($curso, $tpl_curso)];

                $i++;
            endforeach;

            $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_curso"></div>';
            $Pager->ExePaginator(CURSOS);
            $jSon['paginator'] = $Pager->getPaginator();

            $jSon['id'] = 'id';

        endif;