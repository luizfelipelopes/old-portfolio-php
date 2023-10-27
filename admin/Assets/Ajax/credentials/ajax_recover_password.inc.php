<?php

/**
 * ajax_recover_password.php - <b>Recuperar Senha</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Extintor
 */
//$jSon['id'] = 'id';

$meuArray = Check::limparSubmit($Post);
//var_dump($meuArray);
//die;

$read = new Read;
$read->ExeRead(USUARIOS, "WHERE user_email = :email", "email={$meuArray['user_email']}");
if (!$read->getResult()):
    $jSon['error'] = ['Não existe este e-mail no sistema! Favor colocar um e-mail existente.', 'info'];
else:

    extract($read->getResult()[0]);

    $senha = rand(1000, 10000);

    $Arr = ["user_password" => substr(md5($senha), 0, 16)];

    $update = new Update;
    $update->ExeUpdate(USUARIOS, $Arr, "WHERE user_id = :id", "id={$user_id}");
    if ($update->getResult()):

        $meuArray['Assunto'] = SITENAME . " - Suas Credenciais de Acesso";
        $meuArray['DestinoNome'] = $user_name;
        $meuArray['DestinoEmail'] = $user_email;
        $meuArray['Mensagem'] = "Olá {$user_name}! <br> Suas credenciais estão logo abaixo:<br><br> e-mail: {$user_email} <br> nova senha: {$senha}<br><br>Você pode alterar a senha novamente no seu perfil!<br><br>Deus Abençõe!,<br>" . SITENAME;

        $email = new Email();
        $email->Enviar($meuArray);

        $jSon['path'] = HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'login.php?exe=recover';

    endif;
        endif;
