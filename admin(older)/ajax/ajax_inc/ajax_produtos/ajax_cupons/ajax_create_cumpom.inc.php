<?php

/**
 * ajax_create_cumpom.inc.php - <b>CREATE CUPOM</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Cupons
 */
unset($Post['cupom_id']);


$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;


$adminCupom = new AdminCupom;
$adminCupom->ExeCreate($meuArray);

if (!$adminCupom->getResult()):
    $jSon['id'] = 'id';
endif;

$jSon['error'] = $adminCupom->getError();

//        var_dump($adminCupom);

