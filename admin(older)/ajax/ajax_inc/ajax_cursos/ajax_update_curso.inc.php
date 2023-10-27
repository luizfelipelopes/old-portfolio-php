<?php

/**
 * ajax_update_curso.inc.php - <b>UPDATE CURSO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Cursos
 */
$id = $Post['curso_id'];
unset($Post['curso_id']);
$jSon['id'] = $id;

//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['curso_cover']) && $_FILES['curso_cover']['tmp_name']):
    $Post['curso_cover'] = $_FILES['curso_cover'];
else:
    $read = new Read;
    $read->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$id
            }");
    if ($read->getResult()):
        $Post['curso_cover'] = $read->getResult()[0]['curso_cover'];
    else:
        $Post['curso_cover'] = null;
    endif;
endif;




$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;


$adminCurso = new adminCurso;
$adminCurso->ExeUpdate($id, $meuArray);
//
$jSon['error'] = $adminCurso->getError();

//        var_dump($adminCurso);