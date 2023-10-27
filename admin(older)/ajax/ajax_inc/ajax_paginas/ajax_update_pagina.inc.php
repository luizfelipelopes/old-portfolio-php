<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$jSon['naolimpar'] = true;
$id = $Post['pagina_id'];
unset($Post['pagina_id']);

//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['pagina_cover']) && $_FILES['pagina_cover']['tmp_name']):
    $Post['pagina_cover'] = $_FILES['pagina_cover'];
elseif ($Post['limpar_cover'] == '1'):
    unset($Post['pagina_cover']);
else:
    $read = new Read;
    $read->FullRead("SELECT pagina_cover FROM " . PAGINAS . " WHERE pagina_id = :id", "id={$id}");
    if ($read->getResult() && !empty($read->getResult()[0]['pagina_cover'])):
        $Post['pagina_cover'] = $read->getResult()[0]['pagina_cover'];
    else:
//        unset($Post['pagina_cover']);
    endif;
endif;

unset($Post['limpar_cover']);

if (isset($Post['pagina_name']) && empty($Post['pagina_name'])):
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
    $adminPagina->ExeUpdate($id, $meuArray);
//    var_dump($adminPagina);

    $jSon['error'] = $adminPagina->getError();
endif;