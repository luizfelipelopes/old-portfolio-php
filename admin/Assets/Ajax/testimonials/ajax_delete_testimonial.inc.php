<?php

/**
 * ajax_delete_testimonial.php - <b>Deletar Depoimento</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Depoimento
 */

$adminDepoimento = new adminDepoimento;
$adminDepoimento->ExeDelete($Post['id']);
$jSon['result'] = $adminDepoimento->getResult();
$jSon['error'] = $adminDepoimento->getError();
