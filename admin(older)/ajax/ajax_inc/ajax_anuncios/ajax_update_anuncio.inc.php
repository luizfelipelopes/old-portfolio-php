<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$jSon['naolimpar'] = true;
$id = $Post['anuncio_id'];
unset($Post['anuncio_id']);

//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['anuncio_cover']) && $_FILES['anuncio_cover']['tmp_name']):
    $Post['anuncio_cover'] = $_FILES['anuncio_cover'];
else:
    $read = new Read;
    $read->FullRead("SELECT anuncio_cover FROM " . ANUNCIOS . " WHERE anuncio_id = :id", "id={$id}");
    if ($read->getResult()):
        $Post['anuncio_cover'] = $read->getResult()[0]['anuncio_cover'];
    else:
        $Post['anuncio_cover'] = null;
    endif;
endif;

if (isset($Post['anuncio_url']) && empty($Post['anuncio_url'])):
    unset($Post['anuncio_url']);
endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//var_dump($meuArray);
//die;


$adminAnuncio = new adminAnuncio;
$adminAnuncio->ExeUpdate($id, $meuArray);
//var_dump($adminAnuncio);

$jSon['error'] = $adminAnuncio->getError();
