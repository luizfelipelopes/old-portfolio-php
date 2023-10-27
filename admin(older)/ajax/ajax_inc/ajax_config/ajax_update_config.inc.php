<?php

/**
 * ajax_update_config.inc.php - <b>UPDATE CONFIG</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Configurações do Sistema
 */
$Id = $Post['config_id'];
unset($Post['config_id']);


$adminConfig = new AdminConfig;
$adminConfig->ExeUpdate($Id, $Post);

$jSon['error'] = $adminConfig->getError();

$jSon['naolimpar'] = 'id';
