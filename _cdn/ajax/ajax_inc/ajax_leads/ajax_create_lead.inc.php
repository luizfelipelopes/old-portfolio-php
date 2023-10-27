<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$meuArray = Check::limparSubmit($Post);

if (!empty($meuArray['EMAIL']) && !empty($meuArray['FNAME'])):
    if (BuscaRapida::buscarLead($meuArray['EMAIL'])):
        $jSon['caminho'] = HOME . '/obrigado';
    else:
        $jSon['caminho'] = '//' . $OPTIIN['ac_host'] . '.us18.list-manage.com/subscribe/post?u=22aea4a2323aecbaac26f2978&amp;id=' . $OPTIIN['ac_form'] . '&FNAME=' . $meuArray['FNAME'] . '&EMAIL=' . $meuArray['EMAIL'];
    endif;
endif;

if (!empty($meuArray['EMAIL']) && !BuscaRapida::buscarLead($meuArray['EMAIL']) || !isset($meuArray['EMAIL'])):
    $adminLead = new adminLead;
    $adminLead->ExeCreate($meuArray);
//var_dump($adminLead->getResult());
    if (!$adminLead->getResult()):
        $jSon['naolimpar'] = true;
    endif;

    $jSon['error'] = $adminLead->getError();
endif;
