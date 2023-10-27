<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$read = new Read;
$read->FullRead("SELECT pagina_status FROM " . PAGINAS . " WHERE pagina_id = :id", "id={$Post['id']}");
if ($read->getResult()):


    $Data = ['pagina_status' => ($read->getResult()[0]['pagina_status'] == '1' ? '0' : '1')];

//    var_dump($Data, $Post);
    

    $adminPagina = new adminPagina;
    $adminPagina->ExeUpdate($Post['id'], $Data);
//            var_dump($adminPagina);
//            die;
    $jSon['error'] = [$adminPagina->getError()[0], $adminPagina->getError()[1]];

endif;
