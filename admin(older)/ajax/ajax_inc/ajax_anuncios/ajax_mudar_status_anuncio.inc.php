<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$read = new Read;
$read->FullRead("SELECT anuncio_status FROM " . ANUNCIOS . " WHERE anuncio_id = :id", "id={$Post['id']}");
if ($read->getResult()):


    $Data = ['anuncio_status' => ($read->getResult()[0]['anuncio_status'] == '1' ? '0' : '1')];

//    var_dump($Data, $Post);


    $adminAnuncio = new adminAnuncio;
    $adminAnuncio->ExeUpdate($Post['id'], $Data);
//            var_dump($adminAnuncio);
//            die;
    $jSon['error'] = [$adminAnuncio->getError()[0], $adminAnuncio->getError()[1]];

endif;
