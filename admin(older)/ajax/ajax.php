<?php


date_default_timezone_set("America/Sao_Paulo");
$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// IMPEDE QUE O Tiny MCE SEJA FILTRADO
if (isset($getPost['post_content'])):
    $Conteudo = $getPost['post_content'];
    unset($getPost['post_content']);
endif;

if (isset($getPost['pagina_content'])):
    $Conteudo = $getPost['pagina_content'];
    unset($getPost['pagina_content']);
endif;

// IMPEDE QUE O Tiny MCE SEJA FILTRADO
if (isset($getPost['email_content'])):
    $Conteudo = $getPost['email_content'];
    unset($getPost['email_content']);
endif;

// IMPEDE QUE O Tiny MCE SEJA FILTRADO
if (isset($getPost['email_assinatura'])):
    $Assinatura = $getPost['email_assinatura'];
    unset($getPost['email_assinatura']);
endif;

// IMPEDE QUE O Tiny MCE SEJA FILTRADO
if (isset($getPost['produto_descricao'])):
    $Conteudo = $getPost['produto_descricao'];
    unset($getPost['produto_descricao']);
endif;

// CASO EXISTA MATERIAL DO ID ELE É RETIRADO POIS ELE VEM COMO ARRAY E strip_tags SÒ ACEITA STRINGS
if (isset($getPost['material_id'])):
    $material_id = $getPost['material_id'];
    unset($getPost['material_id']);
endif;

//ELIMINA INPUT DE ARQUIVOS PARA PODER PASSAR PELO STRIP TAGS(O $_FILES VAI ESTAR COM OS ARQUIVOS)
unset($getPost['material_aula'], $getPost['gallery_covers']);

$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);

$Action = $Post['action'];
unset($Post['action']);

$jSon = array();

if (!empty($_SESSION['theme'])):
    session_start();
endif;


//sleep(1);

if ($Action):
    require '../../_app/Config.inc.php';
    require '../../_app/Library/PagSeguroLibrary/Config.inc.php';
    spl_autoload_register('carregarClasses');
    require '../_models/adminCategoria.class.php';
    require '../_models/adminPost.class.php';
    require '../_models/adminCurso.class.php';
    require '../_models/adminModulo.class.php';
    require '../_models/adminAula.class.php';
    require '../_models/adminMaterial.class.php';
    require '../_models/AdminProduto.class.php';
    require '../_models/AdminCupom.class.php';
    require '../_models/AdminVenda.class.php';
    require '../_models/AdminConfig.class.php';
    require '../_models/AdminEmail.class.php';
    require '../_models/adminComentario.class.php';
    require '../_models/adminUser.class.php';
endif;

switch ($Action) {

//    CREDENCIAIS

    case 'logar':

        include './ajax_inc/ajax_credenciais/ajax_logar.inc.php';

        break;



    case 'logoff':

        include './ajax_inc/ajax_credenciais/ajax_logout.inc.php';

        break;


    // TINYMCE
    case 'image_tinymce':

        include './ajax_inc/ajax_image_tinymce.inc.php';

        break;


    //  LEADS

    case 'create_lead':

        include './ajax_inc/ajax_leads/ajax_create_lead.inc.php';

        break;

    case 'delete_lead':

        include './ajax_inc/ajax_leads/ajax_delete_lead.inc.php';

        break;

    case 'pesquisar_lead':

        include './ajax_inc/ajax_leads/ajax_pesquisar_lead.inc.php';

        break;

    case 'filtrar_type_lead':

        include './ajax_inc/ajax_leads/ajax_filtrar_type_lead.inc.php';

        break;

    case 'filtrar_data_lead':

        include './ajax_inc/ajax_leads/ajax_filtrar_data_lead.inc.php';

        break;


    case "paginator_lead":

        include './ajax_inc/ajax_leads/ajax_paginator_lead.inc.php';

        break;

    case "exportar_lead":

        include './ajax_inc/ajax_leads/ajax_exportar_leads.inc.php';

        break;
    
    
    //    OPT-IN E ISCAS

    case 'create_isca':

        include './ajax_inc/ajax_optins/ajax_iscas/ajax_create_isca.inc.php';

        break;

    case 'update_isca':

        include './ajax_inc/ajax_optins/ajax_iscas/ajax_update_isca.inc.php';

        break;

    case 'delete_isca':

        include './ajax_inc/ajax_optins/ajax_iscas/ajax_delete_isca.inc.php';

        break;

    case 'pesquisar_isca':

        include './ajax_inc/ajax_optins/ajax_iscas/ajax_pesquisar_isca.inc.php';

        break;


    case "paginator_isca":

        include './ajax_inc/ajax_optins/ajax_iscas/ajax_paginator_isca.inc.php';

        break;


//    SLIDES - DEESTAQUE

    case 'create_destaque':

        include './ajax_inc/ajax_destaques/ajax_create_destaque.inc.php';

        break;

    case 'update_destaque':

        include './ajax_inc/ajax_destaques/ajax_update_destaque.inc.php';

        break;

    case 'delete_destaque':

        include './ajax_inc/ajax_destaques/ajax_delete_destaque.inc.php';

        break;

    case 'mudar_status_destaque':

        include './ajax_inc/ajax_destaques/ajax_mudar_status_destaque.inc.php';

        break;

    case 'pesquisar_destaque':

        include './ajax_inc/ajax_destaques/ajax_pesquisar_destaque.inc.php';

        break;


    case "paginator_destaque":

        include './ajax_inc/ajax_destaques/ajax_paginator_destaque.inc.php';

        break;

//    SLIDES - VIDEOS

    case 'create_video':

        include './ajax_inc/ajax_videos/ajax_create_video.inc.php';

        break;

    case 'update_video':

        include './ajax_inc/ajax_videos/ajax_update_video.inc.php';

        break;

    case 'delete_video':

        include './ajax_inc/ajax_videos/ajax_delete_video.inc.php';

        break;

    case 'mudar_status_video':

        include './ajax_inc/ajax_videos/ajax_mudar_status_video.inc.php';

        break;

    case 'mudar_destaque_video':

        include './ajax_inc/ajax_videos/ajax_mudar_destaque_video.inc.php';

        break;

    case 'pesquisar_video':

        include './ajax_inc/ajax_videos/ajax_pesquisar_video.inc.php';

        break;


    case "paginator_video":

        include './ajax_inc/ajax_videos/ajax_paginator_video.inc.php';

        break;

//    SLIDES - ANUNCIANTES

    case 'create_anuncio':

        include './ajax_inc/ajax_anuncios/ajax_create_anuncio.inc.php';

        break;

    case 'update_anuncio':

        include './ajax_inc/ajax_anuncios/ajax_update_anuncio.inc.php';

        break;

    case 'delete_anuncio':

        include './ajax_inc/ajax_anuncios/ajax_delete_anuncio.inc.php';

        break;

    case 'mudar_status_anuncio':

        include './ajax_inc/ajax_anuncios/ajax_mudar_status_anuncio.inc.php';

        break;

    case 'mudar_destaque_anuncio':

        include './ajax_inc/ajax_anuncios/ajax_mudar_destaque_anuncio.inc.php';

        break;

    case 'pesquisar_anuncio':

        include './ajax_inc/ajax_anuncios/ajax_pesquisar_anuncio.inc.php';

        break;

    case "paginator_anuncio":

        include './ajax_inc/ajax_anuncios/ajax_paginator_anuncio.inc.php';

        break;


//    POSTS

    case 'create_categoria':

        include './ajax_inc/ajax_posts/ajax_categorias/ajax_create_categoria_post.inc.php';

        break;

    case 'update_categoria':

        include './ajax_inc/ajax_posts/ajax_categorias/ajax_update_categoria_post.inc.php';

        break;

    case 'delete_categoria':

        include './ajax_inc/ajax_posts/ajax_categorias/ajax_delete_categoria_post.inc.php';

        break;


    case 'create_post':

        include './ajax_inc/ajax_posts/ajax_create_post.inc.php';

        break;



    case 'update_post':

        include './ajax_inc/ajax_posts/ajax_update_post.inc.php';

        break;


    case 'delete_post':

        include './ajax_inc/ajax_posts/ajax_delete_post.inc.php';

        break;


    case "mudar_status":

        include './ajax_inc/ajax_posts/ajax_mudar_status_post.inc.php';

        break;

    //COMENTARIO

    case 'create_comentario':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_create_comentario_post.inc.php';

        break;

    case 'update_comentario':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_update_comentario_post.inc.php';

        break;

    case 'delete_comentario':


        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_delete_comentario_post.inc.php';

        break;

    case "mudar_status_comentario":

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_mudar_status_comentario_post.inc.php';

        break;

    case 'filtrar_comentario_tipo':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_filtrar_comentario_tipo_post.inc.php';

        break;

    case 'filtrar_comentario_segment':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_filtrar_comentario_segment.inc.php';

        break;

    case 'paginator_comentario_segment':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_paginator_comentario_segment.inc.php';

        break;

    case 'paginator_comentario':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_paginator_comentario.inc.php';

        break;

    case 'create_resposta':

        include './ajax_inc/ajax_posts/ajax_comentarios/ajax_create_resposta_post.inc.php';

        break;


    case 'pesquisar_post':

        include './ajax_inc/ajax_posts/ajax_pesquisar_post.inc.php';

        break;


    case "paginator_post":

        include './ajax_inc/ajax_posts/ajax_paginator_post.inc.php';

        break;


    //    PÁGINAS

    case 'create_pagina':

        include './ajax_inc/ajax_paginas/ajax_create_pagina.inc.php';

        break;

    case 'update_pagina':

        include './ajax_inc/ajax_paginas/ajax_update_pagina.inc.php';

        break;

    case 'delete_pagina':

        include './ajax_inc/ajax_paginas/ajax_delete_pagina.inc.php';

        break;

    case 'mudar_status_pagina':

        include './ajax_inc/ajax_paginas/ajax_mudar_status_pagina.inc.php';

        break;

    case 'pesquisar_pagina':

        include './ajax_inc/ajax_paginas/ajax_pesquisar_pagina.inc.php';

        break;


    case "paginator_pagina":

        include './ajax_inc/ajax_paginas/ajax_paginator_pagina.inc.php';

        break;



//    PRODUTOS

    case 'create_produto':

        include './ajax_inc/ajax_produtos/ajax_create_produto.inc.php';

        break;


    case 'update_produto':

        include './ajax_inc/ajax_produtos/ajax_update_produto.inc.php';

        break;


    case 'delete_produto':

        include './ajax_inc/ajax_produtos/ajax_delete_produto.inc.php';

        break;

    case 'pesquisar_produto':

        include './ajax_inc/ajax_produtos/ajax_pesquisar_produto.inc.php';

        break;


    case "paginator_produto":

        include './ajax_inc/ajax_produtos/ajax_paginator_produto.inc.php';

        break;


    case "mudar_status_produto":

        include './ajax_inc/ajax_produtos/ajax_mudar_status_produto.inc.php';

        break;



    case "mudar_disponibilidade_produto":

        include './ajax_inc/ajax_produtos/ajax_mudar_disponibilidade_produto.inc.php';

        break;

    case 'realizar_desconto_produto':

        include './ajax_inc/ajax_produtos/ajax_realizar_desconto_produto.inc.php';

        break;


    case 'filtrar_comentario_produto':

        include './ajax_inc/ajax_produtos/ajax_filtrar_comentario_produto.inc.php';

        break;


    case 'delete_galeria':

        include './ajax_inc/ajax_produtos/ajax_delete_galeria.inc.php';

        break;


    // CUPONS

    case 'create_cupom':

        include './ajax_inc/ajax_produtos/ajax_cupons/ajax_create_cumpom.inc.php';

        break;


    case 'update_cupom':

        include './ajax_inc/ajax_produtos/ajax_cupons/ajax_update_cupom.inc.php';

        break;

    case 'delete_cupom':

        include './ajax_inc/ajax_produtos/ajax_cupons/ajax_delete_cupom.inc.php';

        break;

    case 'pesquisar_cupom':

        include './ajax_inc/ajax_produtos/ajax_cupons/ajax_pesquisar_cupom.inc.php';

        break;


    case "paginator_cupom":

        include './ajax_inc/ajax_produtos/ajax_cupons/ajax_paginator_cupom.inc.php';

        break;


    case "mudar_status_cupom":

        include './ajax_inc/ajax_produtos/ajax_cupons/ajax_mudar_status_cupom.inc.php';

        break;

//    PEDIDOS

    case 'detalhes_pedido':

        include './ajax_inc/ajax_produtos/ajax_pedidos/ajax_detalhes_pedido_produto.inc.php';

        break;


    case 'filtrar_pedido_status':

        include './ajax_inc/ajax_produtos/ajax_pedidos/ajax_filtrar_pedido_status_produto.inc.php';

        break;

    case 'filtrar_pedido_data':

        include './ajax_inc/ajax_produtos/ajax_pedidos/ajax_filtrar_pedido_data_produto.inc.php';

        break;


//    CURSOS


    case 'create_curso':

        include './ajax_inc/ajax_cursos/ajax_create_curso.inc.php';

        break;

    case 'update_curso':

        include './ajax_inc/ajax_cursos/ajax_update_curso.inc.php';

        break;

    case 'delete_curso':

        include './ajax_inc/ajax_cursos/ajax_delete_curso.inc.php';

        break;


    case 'pesquisar_curso':

        include './ajax_inc/ajax_cursos/ajax_pesquisar_curso.inc.php';

        break;


    case 'paginator_curso':

        include './ajax_inc/ajax_cursos/ajax_paginator_cursos.inc.php';

        break;

    case "mudar_status_curso":

        include './ajax_inc/ajax_cursos/ajax_mudar_status_curso.inc.php';

        break;


//    MODULOS

    case 'create_modulo':

        include './ajax_inc/ajax_cursos/ajax_modulos/ajax_create_modulos.inc.php';

        break;

    case 'update_modulo':

        include './ajax_inc/ajax_cursos/ajax_modulos/ajax_update_modulo.inc.php';

        break;


    case 'delete_modulo':

        include './ajax_inc/ajax_cursos/ajax_modulos/ajax_delete_modulos.inc.php';

        break;

//    AULAS

    case 'create_aula':

        include './ajax_inc/ajax_cursos/ajax_aulas/ajax_create_aula.inc.php';

        break;

    case 'update_aula':

        include './ajax_inc/ajax_cursos/ajax_aulas/ajax_update_aula.inc.php';

        break;


    case 'delete_aula':

        include './ajax_inc/ajax_cursos/ajax_aulas/ajax_delete_aula.inc.php';

        break;


//    MATERIAIS

    case 'delete_material':

        include './ajax_inc/ajax_cursos/ajax_aulas/ajax_delete_materiais.inc.php';

        break;


//    ALUNOS

    case 'update_nota':

        include './ajax_inc/ajax_cursos/ajax_alunos/ajax_update_nota.inc.php';

        break;

// USUÁRIOS

    case 'create_user':

        include './ajax_inc/ajax_usuarios/ajax_create_usuario.inc.php';

        break;

    case 'update_user':

        include './ajax_inc/ajax_usuarios/ajax_update_usuarios.inc.php';

        break;


    case 'delete_user':


        include './ajax_inc/ajax_usuarios/ajax_delete_user.inc.php';

        break;


//EMAILS

    case 'create_email':

        include './ajax_inc/ajax_emails/ajax_create_email.inc.php';

        break;

    case 'update_email':

        include './ajax_inc/ajax_emails/ajax_update_email.inc.php';

        break;

//    CONFIGURAÇÔES

    case 'create_config':

        include './ajax_inc/ajax_config/ajax_create_config.inc.php';

        break;

    case 'update_config':

        include './ajax_inc/ajax_config/ajax_update_config.inc.php';

        break;























































    default:
        $jSon['error'] = "Erro ao Executar Ação!";
        break;
}

echo json_encode($jSon);





