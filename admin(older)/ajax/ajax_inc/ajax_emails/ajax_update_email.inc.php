<?php

/**
 * ajax_update_email.inc.php - <b>UPDATE EMAIL</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Email
 */
$Id = $Post['email_id'];
unset($Post['email_id']);

$Post['email_content'] = $Conteudo;
$Post['email_assinatura'] = $Assinatura;

$adminEmail = new AdminEmail;
$adminEmail->ExeUpdate($Id, $Post);

$jSon['error'] = $adminEmail->getError();

$jSon['id'] = 'id';
