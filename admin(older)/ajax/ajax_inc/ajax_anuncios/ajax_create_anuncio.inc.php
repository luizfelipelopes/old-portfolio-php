<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

unset($Post['anuncio_id']);
if (isset($_FILES['anuncio_cover']) && $_FILES['anuncio_cover']['tmp_name']):
    $Post['anuncio_cover'] = $_FILES['anuncio_cover'];
endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//var_dump($Post, $meuArray);
//die;

$adminAnuncio = new adminAnuncio;
$adminAnuncio->ExeCreate($meuArray);
//var_dump($adminAnuncio->getResult());

if (!$adminAnuncio->getResult()):
    $jSon['naolimpar'] = true;
endif;


$jSon['error'] = $adminAnuncio->getError();
