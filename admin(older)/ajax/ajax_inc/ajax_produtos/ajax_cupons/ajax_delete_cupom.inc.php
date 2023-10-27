<?php

/**
 * ajax_delete_cumpom.inc.php - <b>DELETE CUPOM</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Cupons
 */


$delete = new adminCupom;
$delete->ExeDelete($Post['id']);

$read = new Read;
$read->ExeRead(CUPONS, "ORDER BY cupom_validade DESC");
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há cupons cadastrados", "WS_INFOR"];
endif;

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



//        var_dump($Post);
//        $jSon['error'] = $delete->getError();
