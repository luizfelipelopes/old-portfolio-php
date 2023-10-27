<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$read = new Read;
//$read->ExeRead("SELECT destaque_id FROM " . DESTAQUES);
//if ($read->getRowCount() == 1):
//    $jSon['error'] = ["Não há destaques cadastrados", "WS_INFOR"];
//endif;

$delete = new adminDestaque;
$delete->ExeDelete($Post['id']);
//        var_dump($Post);
//        $jSon['error'] = $delete->getError();


