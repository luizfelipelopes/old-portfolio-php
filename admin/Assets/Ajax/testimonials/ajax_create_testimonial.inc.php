<?php

/**
 * ajax_create_testimonial.php - <b>Criar Depoimento</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Depoimento
 */
if (!empty($Post)):


    if ($Post['depoimento_type'] == 'video'):
        unset($Post['depoimento_cover']);
    else:
        $Post['depoimento_cover'] = (!empty($_FILES['depoimento_cover']['tmp_name']) ? $_FILES['depoimento_cover'] : null);
    endif;

    unset($Post['depoimento_id']);
    $meuArray = Check::limparSubmit($Post);

//    var_dump($meuArray);
//    die;

    $adminTestimonial = new adminDepoimento;
    $adminTestimonial->ExeCreate($meuArray);
    if (!$adminTestimonial->getResult()):
        $jSon['noclear'] = true;
    endif;

//    var_dump($adminTestimonial);
//    die;

    $jSon['error'] = $adminTestimonial->getError();
    
endif;


