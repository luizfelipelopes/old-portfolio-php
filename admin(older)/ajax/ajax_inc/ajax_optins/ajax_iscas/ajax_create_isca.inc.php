<?php

/**
 * ajax_create_isca.php - <b>CREATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Post
 */
unset($Post['isca_id']);


if (!empty($_FILES['isca_cover']['tmp_name'])):
    $Post['isca_cover'] = $_FILES['isca_cover'];
else:
    unset($Post['isca_cover']);
endif;

if (!empty($_FILES['isca_file']['tmp_name'])):
    $Post['isca_file'] = $_FILES['isca_file'];
else:
    $Post['isca_file'] = null;
endif;

if ($Post['isca_arquivo_url'] == '1'):
    unset($Post['isca_file']);
else:
    unset($Post['isca_url']);
endif;

//$Post['isca_content'] = $Conteudo;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//var_dump($meuArray);
//die;


$adminIsca = new adminIsca;
$adminIsca->ExeCreate($meuArray);

if (!$adminIsca->getResult()):
    $jSon['naolimpar'] = true;
endif;

$jSon['error'] = $adminIsca->getError();

//var_dump($adminIsca);
//die;

