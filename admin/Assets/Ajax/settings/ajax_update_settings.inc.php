<?php

/**
 * ajax_update_settings.php - <b>Atualizar Configurações</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Configurações do Sistema
 */
$jSon['noclear'] = true;

$meuArray = Check::limparSubmit($Post);

//var_dump($meuArray);
//die;

$updateSettings = new Update;

foreach ($meuArray as $Key => $Value):
    $Data = ['setting_value' => $Value];
    $updateSettings->ExeUpdate(SETTINGS, $Data, "WHERE setting_name = :setting", "setting={$Key}");
endforeach;

$jSon['error'] = (!$updateSettings->getResult() ? ["Erro ao atualizar configurações!", "error"] : ["Configurações atualizadas com sucesso!", "success"]);
