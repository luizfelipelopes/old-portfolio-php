<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$jSon['naolimpar'] = true;
$id = $Post['destaque_id'];
unset($Post['destaque_id']);

//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['destaque_cover']) && $_FILES['destaque_cover']['tmp_name']):
    $Post['destaque_cover'] = $_FILES['destaque_cover'];
else:
    $read = new Read;
    $read->FullRead("SELECT destaque_cover FROM " . DESTAQUES . " WHERE destaque_id = :id", "id={$id}");
    if ($read->getResult()):
        $Post['destaque_cover'] = $read->getResult()[0]['destaque_cover'];
    else:
        $Post['destaque_cover'] = null;
    endif;
endif;

if (isset($Post['destaque_url']) && empty($Post['destaque_url'])):
    unset($Post['destaque_url']);
endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//var_dump($meuArray);
//die;


$adminDestaque = new adminDestaque;
$adminDestaque->ExeUpdate($id, $meuArray);
//var_dump($adminDestaque);

$jSon['error'] = $adminDestaque->getError();
