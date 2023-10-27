<?php

/**
 * ajax_create_depoimento.php - <b>Criar Depoimento</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Depoimento
 */
if (!empty($Post)):

    $jSon['noclear'] = true;
    $id = $Post['depoimento_id'];
    unset($Post['depoimento_id']);

    if (isset($_FILES['depoimento_cover']) && $_FILES['depoimento_cover']['tmp_name']):
        $Post['depoimento_cover'] = $_FILES['depoimento_cover'];
    else:

        $read = new Read;
        $read->FullRead("SELECT depoimento_cover FROM " . DEPOIMENTOS . " WHERE depoimento_id = :id", "id={$id}");
        if ($read->getResult() && !empty($read->getResult()[0]['depoimento_cover'])):
            $Post['depoimento_cover'] = $read->getResult()[0]['depoimento_cover'];
        else:
            if ($Post['depoimento_type'] == 'texto'):
                $Post['depoimento_cover'] = null;
            else:
                unset($Post['depoimento_cover']);
            endif;

        endif;
    endif;

//    unset($Post['depoimento_id']);
    $meuArray = Check::limparSubmit($Post);

//    var_dump($meuArray);
//    die;

    $adminDepoimento = new adminDepoimento;
    $adminDepoimento->ExeUpdate($id, $meuArray);
//    var_dump($adminDepoimento);
//    die;

    $jSon['error'] = $adminDepoimento->getError();
    
//    var_dump($adminDepoimento);
    
endif;


