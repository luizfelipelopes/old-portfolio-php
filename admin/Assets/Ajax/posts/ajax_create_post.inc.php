<?php

/**
 * ajax_create_post.php - <b>CREATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Post
 */
unset($Post['post_id']);
$Post['post_cover'] = (!empty($_FILES['post_cover']['tmp_name']) ? $_FILES['post_cover'] : null);

$Post['post_content'] = $Conteudo;

//if (empty($Post['post_cover'])):
//    unset($Post['post_cover']);
//endif;

if (empty($Post['post_name'])):
    unset($Post['post_name']);
endif;

$Count = substr_count($Conteudo, '<img');

if ($Count > 5):
    $jSon['error'] = ["<b>Opps!</b> Você só pode postar até <b>5 imagens</b> no corpo do seu texto!", 'error'];
    $jSon['noclear'] = true;
else:

    unset($Post['pic']);

    if (empty($Post['post_video'])):
        unset($Post['post_video']);
    endif;

    if (empty($Post['post_subtitle'])):
        unset($Post['post_subtitle']);
    endif;

    $meuArray = Check::limparSubmit($Post);
//    var_dump($meuArray);
//    die;

    $adminPost = new adminPost;
    $adminPost->ExeCreate($meuArray);

    if (!$adminPost->getResult()):
        $jSon['noclear'] = true;
    else:
        //    ATUALIZAR SITEMAP E EXECUTAR PING AOS MECANISMOS DE BUSCA
        $Sitemap = new Sitemap();
        $Sitemap->ExeSitemap($SiteMapEstatico, SITEMAP_TYPES);
        $jSon['conditional_video'] = true;
    endif;

    $jSon['error'] = $adminPost->getError();

    $adminPost->ExeDeleteThumbs();
    $jSon['deleteImages'] = $adminPost->getError();

endif;