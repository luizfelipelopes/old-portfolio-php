<?php

/**
 * ajax_delete_material.inc.php - <b>DELETE MATERIAL</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Materiais de Disciplinas do Módulo do Curso
 */

$read = new Read;
$read->ExeRead(MATERIAIS);
if ($read->getRowCount() == 1):
    $json['show_field'] = true;
    $jSon['error'] = ["Não há materiais", "infor"];
endif;

$delete = new adminMaterial;
$delete->ExeDelete($Post['id']);
//        var_dump($Post);
$jSon['error'] = [$delete->getError()[0], $delete->getError()[1]];

