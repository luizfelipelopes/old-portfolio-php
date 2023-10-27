<?php

/**
 * ajax_mudar_status_testimonial.inc.php - <b>MUDAR STATUS DEPOIMENTO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Mudança de Status (Ativo ou Inativo) dos Depoimentos
 */
//var_dump($Testimonial);
//die;

$Status = [
    "depoimento_status" => ($Post['status'] == '1' ? '0' : '1')
];

$adminDepoimento = new adminDepoimento;
$adminDepoimento->ExeStatus($Post['id'], $Status);
$jSon['result'] = $adminDepoimento->getResult();
$jSon['error'] = [$adminDepoimento->getError()[0], $adminDepoimento->getError()[1]];

$readTestimonial = new Read;
$readTestimonial->FullRead('SELECT depoimento_status FROM ' . DEPOIMENTOS . " WHERE depoimento_id = :id", "id={$Post['id']}");
$jSon['status'] = $readTestimonial->getResult()[0]['depoimento_status'];
