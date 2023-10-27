<?php

/**
 * ajax_create_featured.php - <b>Criar Destaque</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Destaque
 */

unset($Post['destaque_id']);
if (isset($_FILES['destaque_cover']) && $_FILES['destaque_cover']['tmp_name']):
    $Post['destaque_cover'] = $_FILES['destaque_cover'];
endif;

$meuArray = Check::limparSubmit($Post);

//var_dump($meuArray);
//die;

$adminDestaque = new adminDestaque;
$adminDestaque->ExeCreate($meuArray);
//var_dump($adminDestaque);
//die;

if (!$adminDestaque->getResult()):
    $jSon['noclear'] = true;
endif;


$jSon['error'] = $adminDestaque->getError();
