<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$read = new Read;
$read->FullRead("SELECT destaque_status FROM " . DESTAQUES . " WHERE destaque_id = :id", "id={$Post['id']}");
if ($read->getResult()):


    $Data = ['destaque_status' => ($read->getResult()[0]['destaque_status'] == '1' ? '0' : '1')];

//    var_dump($Data, $Post);
    

    $adminDestaque = new adminDestaque;
    $adminDestaque->ExeUpdate($Post['id'], $Data);
//            var_dump($adminDestaque);
//            die;
    $jSon['error'] = [$adminDestaque->getError()[0], $adminDestaque->getError()[1]];

endif;
