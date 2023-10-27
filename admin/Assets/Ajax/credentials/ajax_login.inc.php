<?php

/**
 * ajax_login.php - <b>Login do Sistema</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de login no sistema
 */
$meuArray = Check::limparSubmit($Post);
//var_dump($meuArray);
//die;

$Login = new Login(1);

$Login->ExeLogin($meuArray);
//var_dump($Login);
//die;

if (!$Login->getResult()):
    $jSon['error'] = [$Login->getError()[0], 'alert'];
else:
    $jSon['path'] = HOME . DIRECTORY_SEPARATOR . ADMIN;
endif;
