<?php

/**
 * ajax_update_post.php - <b>UPDATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Update de Post
 */
$id = $Post['post_id'];
unset($Post['post_id']);
$jSon['naolimpar'] = true;

$Post['post_content'] = $Conteudo;

if (empty($Post['post_name'])):
    unset($Post['post_name']);
endif;


$Count = substr_count($Conteudo, '<img');

if ($Count > 5):
    $jSon['error'] = ["<b>Opps!</b> Você só pode postar até <b>5 imagens</b> no corpo do seu texto!", WS_ERROR];

else:

    if (isset($_FILES['post_cover']) && $_FILES['post_cover']['tmp_name']):
        $Post['post_cover'] = $_FILES['post_cover'];
    else:
        $read = new Read;
        $read->FullRead("SELECT post_cover FROM " . POSTS . " WHERE post_id = :id", "id={$id}");
        if ($read->getResult()):
            $Post['post_cover'] = $read->getResult()[0]['post_cover'];
        else:
            $Post['post_cover'] = null;
        endif;
    endif;

    $meuArray = array();

    foreach ($Post as $key => $value) :
        if (!is_numeric($key)):
            $meuArray += [$key => $value];
        endif;
    endforeach;

    unset($meuArray['pic']);
    
    
    $adminPost = new adminPost;
    $adminPost->ExeUpdate($id, $meuArray);

    $jSon['error'] = $adminPost->getError();

endif;
