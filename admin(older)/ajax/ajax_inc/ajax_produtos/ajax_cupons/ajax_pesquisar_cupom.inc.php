<?php

/**
 * ajax_pesquisar_cumpom.inc.php - <b>PESQUISAR CUPOM</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa de Cupons em REAL-TIME
 */

$read = new Read;
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager("dashboard.php?exe=produtos/cupons/index&pag=");
$Pager->ExePager($getPage, 12);

//            $read->ExeRead(PRODUTOS, "ORDER BY produto_data DESC LIMIt :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//        $read->ExeRead(PRODUTOS, "WHERE (produto_title LIKE '%' :like '%' OR produto_descricao LIKE '%' :like '%') ORDER BY produto_data DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
$read->ExeRead(CUPONS, "WHERE (cupom_codigo LIKE '%' :like '%') ORDER BY cupom_validade DESC LIMIT :limit OFFSET :offset", "like={$Post['s']
        }&limit={$Pager->getLimit()
        }&offset={$Pager->getOffset()
        }");
if (!$read->getResult()):
    $Pager->ReturnPage();
    $jSon['error'] = ["Nehum cupom foi encontrado com esta pesquisa", "infor"];
else:
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()
        } resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

    $View = new View();
    $tpl_cupom = $View->Load('cupom');

    foreach ($read->getResult() as $cupom):
//                $posCss++;
        extract($cupom);

        $cupom['cupom_codigo_img'] = Check::Words($cupom['cupom_codigo'], 1);
        $cupom['cupom_desconto'] = (!empty($cupom['cupom_desconto']) ? '<div class="bg-red posts-item-off">' . $cupom['cupom_desconto'] * 100 . ' % OFF</div>' : '');
        $cupom['HOME'] = HOME;
        $cupom['botao_status'] = ($cupom_status == '1' ? '<a title="Publicado" attr-status="mudar_status_cupom" class="btn btn-green radius cupons-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_cupom" class="btn btn-yellow radius cupons-item-status j_pendente shorticon shorticon-pendente"></a>');

        $cupom['cupom_validade'] = date('d/m/Y', strtotime($cupom_validade)) . "</p>";
        $jSon['result'] += [$i => $View->returnView($cupom, $tpl_cupom)];

        $i++;
    endforeach;

    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_cupom"></div>';
    $Pager->ExePaginator(CUPONS);
    $jSon['paginator'] = $Pager->getPaginator();

    $jSon['id'] = 'id';

        endif;