<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//var_dump('Entrou');

$readLead = new Read;
$readLead->FullRead("SELECT lead_id, Lead_name, lead_email, lead_type, lead_date FROM " . LEADS . " ORDER BY lead_date DESC");
if ($readLead->getResult()):

    $jSon['result'] = $readLead->getResult();
    
endif;


//        var_dump($Post);
//        $jSon['error'] = $delete->getError();


