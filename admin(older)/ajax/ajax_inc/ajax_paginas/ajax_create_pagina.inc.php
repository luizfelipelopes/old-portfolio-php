<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

unset($Post['pagina_id']);
if (isset($_FILES['pagina_cover']) && $_FILES['pagina_cover']['tmp_name']):
    $Post['pagina_cover'] = $_FILES['pagina_cover'];
else:
    unset($Post['pagina_cover']);
endif;

if (empty($Post['pagina_name'])):
    unset($Post['pagina_name']);
endif;

$Post['pagina_content'] = $Conteudo;

$Count = substr_count($Conteudo, '<img');

if ($Count > 5):
    $jSon['error'] = ["<b>Opps!</b> Você só pode postar até <b>5 imagens</b> no corpo do seu texto!", WS_ERROR];
    $jSon['naolimpar'] = true;
else:

    unset($Post['pic']);

    $meuArray = array();

    foreach ($Post as $key => $value) :
        if (!is_numeric($key)):
            $meuArray += [$key => $value];
        endif;
    endforeach;

//    var_dump($meuArray);
//    die;

    $adminPagina = new adminPagina;
    $adminPagina->ExeCreate($meuArray);
//var_dump($adminPagina->getResult());

    if (!$adminPagina->getResult()):
        $jSon['naolimpar'] = true;
    endif;

    $jSon['error'] = $adminPagina->getError(); 
    
endif;



