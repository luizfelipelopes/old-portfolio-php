<?php

/**
 * ajax_mudar_status_curso.inc.php - <b>STATUS CURSO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Status (Ativo ou Inativo) de Cursos
 */
$read = new Read;
$read->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$Post['id']}");
if ($read->getResult()):

    $Data = $read->getResult()[0];
    unset($Data['curso_id'], $Data['curso_last_views'], $Data['curso_views']);
//            $Data['produto_status'] = ($Data['produto_status'] == '1' ? '0' : '1');

    $update_status = ["curso_status" => ($Data['curso_status'] == '1' ? '0' : '1')];
//            var_dump($update_status);

    $adminCurso = new adminCurso;
    $adminCurso->ExeStatus($Post['id'], $update_status);
//            var_dump($adminProduto);
    $jSon['error'] = [$adminCurso->getError()[0], $adminCurso->getError()[1]];

        endif;
