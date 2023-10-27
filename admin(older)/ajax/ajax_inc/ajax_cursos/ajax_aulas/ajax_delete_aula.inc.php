<?php

/**
 * ajax_delete_aula.inc.php - <b>DELETE AULAS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Disciplinas do Módulo do Curso
 */
$deleteAula = new adminAula;

$deleteMaterial = new Delete;
$deleteMaterial->ExeDelete(MATERIAIS, "WHERE material_aula = :aula", "aula={$Post['id']
        }");
$deleteAula->ExeDelete($Post['id']);

//        var_dump($Post);
//        $jSon['error'] = [$deleteAula->getError()[0], $deleteAula->getError()[1]];
