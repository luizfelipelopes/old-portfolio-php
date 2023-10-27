<?php

/**
 * ajax_update_modulo.inc.php - <b>UPDATE MÓDULOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Módulos do Curso
 */
$id = $Post['modulo_id'];
unset($Post['modulo_id']);
$jSon['id'] = $id;
//        $Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//        var_dump($meuArray);

$adminModulo = new adminModulo;
$adminModulo->ExeUpdate($id, $meuArray);
//        var_dump($adminModulo);


$jSon['error'] = $adminModulo->getError();

//        var_dump($meuArray);

