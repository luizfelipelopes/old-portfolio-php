<?php

/**
 * ajax_delete_usuario.inc.php - <b>DELETE USUÁRIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exxclusão de Usuários
 */
$read = new Read;
$read->ExeRead(USUARIOS);
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há usuários", "infor"];
endif;

$delete = new adminUser;
$delete->ExeDelete($Post['id']);
//        var_dump($Post);
$jSon['error'] = [$delete->getError()[0], $delete->getError()[1]];
