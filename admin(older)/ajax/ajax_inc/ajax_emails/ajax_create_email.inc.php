<?php

/**
 * ajax_create_email.inc.php - <b>CREATE EMAIL</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Email
 */
unset($Post['email_id']);
$Post['email_content'] = $Conteudo;
$Post['email_assinatura'] = $Assinatura;

//        var_dump($Post['email_content']);

$adminEmail = new AdminEmail;
$adminEmail->ExeCreate($Post);

$jSon['error'] = $adminEmail->getError();
