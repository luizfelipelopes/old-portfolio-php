<?php

/**
 * ajax_delete_user.inc.php - <b>DELETE USUÁRIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exxclusão de Usuários
 */
$adminUser = new adminUser;
$adminUser->ExeDelete($Post['id']);
//        var_dump($Post);
$jSon['result'] = $adminUser->getResult();
$jSon['error'] = [$adminUser->getError()[0], $adminUser->getError()[1]];
