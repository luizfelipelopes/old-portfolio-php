<?php

/**
 * ajax_create_modulos.inc.php - <b>CREATE MÓDULOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Módulos do Curso
 */
unset($Post['modulo_id']);
//        $Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//        var_dump($meuArray);

$adminModulo = new adminModulo;
$adminModulo->ExeCreate($meuArray);
//        var_dump($adminModulo);


$jSon['error'] = $adminModulo->getError();

//        var_dump($meuArray);