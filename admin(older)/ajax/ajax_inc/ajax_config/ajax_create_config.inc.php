<?php

/**
 * ajax_create_config.inc.php - <b>CREATE CONFIG</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Configurações do Sistema
 */
unset($Post['config_id']);


$adminConfig = new AdminConfig;
$adminConfig->ExeCreate($Post);

$jSon['error'] = $adminConfig->getError();
