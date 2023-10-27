<?php

/**
 * ajax_receber_email_contato.php - <b>Receber Email de Contato</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Recebimento de E-mail de Contato
 */
if (!empty($Post)):
    
    
    
    
    $meuArray = Check::limparSubmit($Post);

//    var_dump($meuArray);
//    die;
    
    $Lead = [
        'lead_name' => $meuArray['comentario_nome'],
        'lead_email' => $meuArray['comentario_email'],
        'lead_type' => 'form-contato'
    ];
    
    $Recado = [
        'comentario_author' => $meuArray['comentario_nome'],
        'comentario_email' => $meuArray['comentario_email'],
        'comentario_content' => $meuArray['comentario_mensagem'],
        'comentario_status' => '0',
        'comentario_type' => 'recados',
        'comentario_category' => 'Recados',
    ];
    
//    var_dump($Recado);
//    die;
    
    
    $adminComment = new adminComentario;
    $adminComment->ExeCreate($Recado);
//    var_dump($adminComment->getResult());
//    die;
    
    
//
    $adminLead = new adminLead;
    $adminLead->ExeCreate($Lead);
//    var_dump($adminLead);
//    die;
//
    if (!$adminLead->getResult()):
        
        $jSon['naolimpar'] = 'id';
        $jSon['error'] = ['Desculpe, no momento não é possível enviar mensagens =/! Tente novamente mais tarde!', 'alert'];

    else:
        
        $Email = EmailMensseger::EmailMensagemContato($meuArray['comentario_nome'], $meuArray['comentario_email'], $meuArray['comentario_mensagem']);
        
        if ($Email):
            $jSon['error'] = ['Parabéns Mensagem Enviada com Sucesso! Em breve entraremos em contato ;)', 'success'];
        else:
            $jSon['naolimpar'] = 'id';
            $jSon['error'] = ['Desculpe, no momento não é possível enviar mensagens =/! Tente novamente mais tarde!', 'alert'];
        endif;

    endif;
endif;
