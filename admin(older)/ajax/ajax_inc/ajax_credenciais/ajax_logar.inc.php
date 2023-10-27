<?php

/**
 * ajax_logar.php - <b>Login do Sistema</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de login no sistema
 */
$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

$Login = new Login(1);

$Login->ExeLogin($meuArray);
//        var_dump($Login);

if (!$Login->getResult()):

    $jSon['error'] = [$Login->getError()[0], $Login->getError()[1]];

else:

    $jSon['caminho'] = 'dashboard.php';
        endif;
