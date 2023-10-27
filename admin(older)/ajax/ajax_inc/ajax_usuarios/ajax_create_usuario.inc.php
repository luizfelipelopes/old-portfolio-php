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

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;


$adminUser = new adminUser;
$adminUser->ExeCreate($meuArray);



$jSon['error'] = $adminUser->getError();

//        var_dump($adminPost);
