<?php

/**
 * ajax_delete_lead.php - <b>Deletar Lead</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Leads
 */

$adminLead = new adminLead;
$adminLead->ExeDelete($Post['id']);
$jSon['result'] = $adminLead->getResult();
$jSon['error'] = $adminLead->getError();


