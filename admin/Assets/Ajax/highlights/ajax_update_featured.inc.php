<?php

/**
 * ajax_update_featured.php - <b>Atualizar Destaque</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Destaque
 */

$jSon['noclear'] = true;
$id = $Post['destaque_id'];
unset($Post['destaque_id']);


//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['destaque_cover']) && $_FILES['destaque_cover']['tmp_name']):
    $Post['destaque_cover'] = $_FILES['destaque_cover'];
else:
    $read = new Read;
    $read->FullRead("SELECT destaque_cover FROM " . DESTAQUES . " WHERE destaque_id = :id", "id={$id}");
    if ($read->getResult()):
        $Post['destaque_cover'] = $read->getResult()[0]['destaque_cover'];
    else:
        $Post['destaque_cover'] = null;
    endif;
endif;

if (isset($Post['destaque_url']) && empty($Post['destaque_url'])):
    unset($Post['destaque_url']);
endif;

$meuArray = Check::limparSubmit($Post);

//var_dump($meuArray);
//die;


//var_dump($meuArray);
//die;


$adminFeatured = new adminDestaque;
$adminFeatured->ExeUpdate($id, $meuArray);
//var_dump($adminFeatured);

$jSon['error'] = $adminFeatured->getError();
