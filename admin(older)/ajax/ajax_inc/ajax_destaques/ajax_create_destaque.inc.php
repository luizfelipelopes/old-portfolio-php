<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

unset($Post['destaque_id']);
if (isset($_FILES['destaque_cover']) && $_FILES['destaque_cover']['tmp_name']):
    $Post['destaque_cover'] = $_FILES['destaque_cover'];
endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//var_dump($Post, $meuArray);
//die;

$adminDestaque = new adminDestaque;
$adminDestaque->ExeCreate($meuArray);
//var_dump($adminDestaque->getResult());

if (!$adminDestaque->getResult()):
    $jSon['naolimpar'] = true;
endif;


$jSon['error'] = $adminDestaque->getError();
