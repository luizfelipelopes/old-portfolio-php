<?php

/**
 * ajax_receber_sugestao.php - <b>Receber Sugestões de Artigos</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Recebimento de Sugestões
 */
if (!empty($Post)):
    $meuArray = Check::limparSubmit($Post);

//    var_dump($meuArray);
//    die;

    $adminLead = new adminLead;
    $adminLead->ExeCreate($meuArray);
//    var_dump($adminLead);
//    die;

    if (!$adminLead->getResult()):

        $jSon['naolimpar'] = 'id';
        $jSon['error'] = ['Desculpe, no momento não é possível enviar sugestões =/! Tente novamente mais tarde!', 'alert'];

    else:
        $jSon['error'] = ['Parabéns Sua Sugestão Foi Enviada com Sucesso! ;)', 'success'];
    endif;

endif;
