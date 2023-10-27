<?php

/**
 * ajax_create_curso.inc.php - <b>CREATE CURSO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Cursos
 */
unset($Post['curso_id']);
$Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

$adminCurso = new adminCurso;
$adminCurso->ExeCreate($meuArray);

$jSon['error'] = $adminCurso->getError();

//        var_dump($meuArray);
