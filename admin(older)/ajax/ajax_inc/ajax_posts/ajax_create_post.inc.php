<?php

/**
 * ajax_create_post.php - <b>CREATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Post
 */
unset($Post['post_id']);
$Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null);
$Post['post_content'] = $Conteudo;

if(empty($Post['post_name'])):
    unset($Post['post_name']);
endif;

$Count = substr_count($Conteudo, '<img');

if ($Count > 5):
    $jSon['error'] = ["<b>Opps!</b> Você só pode postar até <b>5 imagens</b> no corpo do seu texto!", WS_ERROR];
    $jSon['naolimpar'] = true;
else:
    
    unset($Post['pic']);

//    var_dump($Post['post_date']);

    $meuArray = array();
    
    foreach ($Post as $key => $value) :
        if (!is_numeric($key)):
            $meuArray += [$key => $value];
        endif;
    endforeach;

//        var_dump($meuArray);
    $adminPost = new adminPost;
    $adminPost->ExeCreate($meuArray);
//    var_dump($adminPost);

    if(!$adminPost->getResult()):
        $jSon['naolimpar'] = true;
    endif;

    $jSon['error'] = $adminPost->getError();

//        var_dump($adminPost);

endif;