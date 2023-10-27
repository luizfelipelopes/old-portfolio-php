<?php

/**
 * ajax_update_cumpom.inc.php - <b>CREATE CUPOM</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Cupons
 */

$id = $Post['cupom_id'];
unset($Post['cupom_id']);

$jSon['id'] = 'id';

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//        var_dump($meuArray);

$adminCupom = new AdminCupom;
$adminCupom->ExeUpdate($id, $meuArray);

$jSon['error'] = $adminCupom->getError();

//        var_dump($adminCupom);

