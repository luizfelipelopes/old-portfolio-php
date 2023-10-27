<?php

/**
 * ajax_update_usuario.inc.php - <b>UPDATE USUÁRIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Usuários
 */

$Perfil = null;

$id = $Post['user_id'];
unset($Post['user_id']);
$jSon['id'] = $id;

if (isset($Post['perfil'])):
    $Perfil = $Post['perfil'];
    unset($Post['perfil']);
endif;

//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['user_foto']) && $_FILES['user_foto']['tmp_name']):
    $Post['user_foto'] = $_FILES['user_foto'];
else:
    $read = new Read;
    $read->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$id
            }");
    if ($read->getResult()):
        $Post['user_foto'] = $read->getResult()[0]['user_foto'];
    else:
        $Post['user_foto'] = null;
    endif;
endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;




$adminUser = new adminUser;
$adminUser->ExeUpdate($id, $meuArray);


if (isset($_SESSION['userlogin']) && $Perfil):

    $_SESSION['userlogin']['user_name'] = $meuArray['user_name'];
    $_SESSION['userlogin']['user_lastname'] = $meuArray['user_lastname'];
    $_SESSION['userlogin']['user_email'] = $meuArray['user_email'];
    $_SESSION['userlogin']['user_password'] = $meuArray['user_password'];
    $_SESSION['userlogin']['user_level'] = $meuArray['user_level'];

    $readFoto = new Read;
    $readFoto->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$id
            }");
    if ($readFoto->getResult()):
        $_SESSION['userlogin']['user_foto'] = $readFoto->getResult()[0]['user_foto'];
    endif;

endif;


$jSon['error'] = $adminUser->getError();

//        var_dump($adminPost);
