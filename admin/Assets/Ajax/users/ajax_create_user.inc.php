<?php

/**
 * ajax_create_usuario.inc.php - <b>CREATE USUÁRIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Usuários
 */
unset($Post['user_id']);

//        if(isset($Post['user_foto']) && !empty($Post['user_foto'])):
//        $Post['user_foto'] = ($_FILES['user_foto']['tmp_name'] ? $_FILES['user_foto'] : 'vazio');

if (isset($_FILES['user_foto']['tmp_name'])):
    $Post['user_foto'] = $_FILES['user_foto'];
endif;


//        endif;

$meuArray = Check::limparSubmit($Post);
//var_dump($meuArray);
//die;

$adminUser = new adminUser;
$adminUser->ExeCreate($meuArray);
//var_dump($adminUser);
//die;
if (!$adminUser->getResult()):
    $jSon['noclear'] = true;
else:
    $jSon['result'] = $adminUser->getResult();
endif;

$jSon['error'] = $adminUser->getError();

//        var_dump($adminPost);
