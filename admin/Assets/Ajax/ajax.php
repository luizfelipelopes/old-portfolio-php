<?php

header("Access-Control-Allow-Origin: *");

date_default_timezone_set("America/Sao_Paulo");
require '../../../_app/Config.inc.php';
require '../../../_app/Config-Post.inc.php';
require '../../../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../../../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
spl_autoload_register('carregarClasses');

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);


// IMPEDE QUE O Tiny MCE SEJA FILTRADO
if (isset($getPost['post_content'])):
    $Conteudo = $getPost['post_content'];
    unset($getPost['post_content']);
endif;

// IMPEDE QUE O ARRAY DE ITENS ORDENADOS SEJA FILTRADO
if (isset($getPost['data'])):
    $Ordenacao = $getPost['data'];
    unset($getPost['data']);
endif;


$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);
$jSon = array();


if (!empty($_SESSION['theme'])):
    session_start();
endif;

if (isset($Post['action'])):
    $Action = $Post['action'];
    unset($Post['action']);
else:
    $Action = null;
endif;


switch ($Action):
    
    /**
     * ORDENAÇÃO DE ITENS
     */
    
    
    case 'order_itens':

        include '../Ajax/general/ajax_ordenar_itens.inc.php';

        break;
    

    /**
     * CREDENTIALS
     */
    case 'login':

        include '../Ajax/credentials/ajax_login.inc.php';

        break;

    case 'logout':

        include '../Ajax/credentials/ajax_logout.inc.php';

        break;

    case 'recover_password':

        include '../Ajax/credentials/ajax_recover_password.inc.php';

        break;


    /**
     * POSTS
     */
    case 'filter_posts':

        include '../Ajax/posts/ajax_filter_posts.inc.php';

        break;

    case 'paginator_posts':

        include '../Ajax/posts/ajax_paginator_posts.inc.php';

        break;

    case 'delete_post':

        include '../Ajax/posts/ajax_delete_post.inc.php';

        break;

    case 'change_status_post':

        include '../Ajax/posts/ajax_change_status_post.inc.php';

        break;

    case 'create_post':

        include '../Ajax/posts/ajax_create_post.inc.php';

        break;

    case 'update_post':

        include '../Ajax/posts/ajax_update_post.inc.php';

        break;

    /**
     * CATEGORIAS
     */
    case 'delete_category':

        include '../Ajax/posts/categories/ajax_delete_category.inc.php';

        break;

    case 'create_category':

        include '../Ajax/posts/categories/ajax_create_category.inc.php';

        break;

    case 'update_category':

        include '../Ajax/posts/categories/ajax_update_category.inc.php';

        break;

    /**
     * DEPOIMENTOS
     */
    case 'delete_testimonial':

        include '../Ajax/testimonials/ajax_delete_testimonial.inc.php';

        break;

    case 'change_status_testimonial':

        include '../Ajax/testimonials/ajax_change_status_testimonial.inc.php';

        break;

    case 'create_testimonial':

        include '../Ajax/testimonials/ajax_create_testimonial.inc.php';

        break;

    case 'update_testimonial':

        include '../Ajax/testimonials/ajax_update_testimonial.inc.php';

        break;

    /**
     * DESTAQUES
     */
    case 'delete_featured':

        include '../Ajax/highlights/ajax_delete_featured.inc.php';

        break;

    case 'change_status_featured':

        include '../Ajax/highlights/ajax_change_status_featured.inc.php';

        break;

    case 'create_featured':

        include '../Ajax/highlights/ajax_create_featured.inc.php';

        break;

    case 'update_featured':

        include '../Ajax/highlights/ajax_update_featured.inc.php';

        break;

    /**
     * POSTS DOS COMENTÁRIOS
     */
    case 'filter_posts_comments':

        include '../Ajax/comments/ajax_filter_posts_comments.inc.php';

        break;

    case 'paginator_posts_comments':

        include '../Ajax/comments/ajax_paginator_posts_comments.inc.php';

        break;


    /**
     * COMENTARIOS
     */
    case 'answer_comment':

        include '../Ajax/comments/ajax_answer_comment.inc.php';

        break;

    case 'change_status_comment':

        include '../Ajax/comments/ajax_change_status_comment.inc.php';

        break;

    case 'set_update_comment':

        include '../Ajax/comments/ajax_set_update_comment.inc.php';

        break;

    case 'update_comment':

        include '../Ajax/comments/ajax_update_comment.inc.php';

        break;

    case 'create_comment':

        include '../Ajax/comments/ajax_create_comment.inc.php';

        break;

    case 'delete_comment':

        include '../Ajax/comments/ajax_delete_comment.inc.php';

        break;

    case 'filter_comments':

        include '../Ajax/comments/ajax_filter_comments.inc.php';

        break;

    case 'paginator_comments':

        include '../Ajax/comments/ajax_paginator_comments.inc.php';

        break;


    /**
     *  LEADS
     */
    case 'delete_lead':

        include '../Ajax/emails/ajax_delete_lead.inc.php';

        break;

    case 'filter_leads':

        include '../Ajax/emails/ajax_filter_leads.inc.php';

        break;

    case 'paginator_leads':

        include '../Ajax/emails/ajax_paginator_leads.inc.php';

        break;

    case 'export_leads':

        include '../Ajax/emails/ajax_export_leads.inc.php';

        break;

    
    /**
     * VÍDEOS
     */
    case 'filter_videos':

        include '../Ajax/videos/ajax_filter_videos.inc.php';

        break;

    case 'paginator_videos':

        include '../Ajax/videos/ajax_paginator_videos.inc.php';

        break;

    case 'delete_video':

        include '../Ajax/videos/ajax_delete_video.inc.php';

        break;

    case 'change_status_video':

        include '../Ajax/videos/ajax_change_status_video.inc.php';

        break;

    case 'create_video':

        include '../Ajax/videos/ajax_create_video.inc.php';

        break;

    case 'update_video':

        include '../Ajax/videos/ajax_update_video.inc.php';

        break;

    

    /**
     * USUÁRIOS
     */
    case 'delete_user':

        include '../Ajax/users/ajax_delete_user.inc.php';

        break;

    case 'filter_users':

        include '../Ajax/users/ajax_filter_users.inc.php';

        break;

    case 'paginator_users':

        include '../Ajax/users/ajax_paginator_users.inc.php';

        break;

    case 'create_user':

        include '../Ajax/users/ajax_create_user.inc.php';

        break;

    case 'update_user':

        include '../Ajax/users/ajax_update_user.inc.php';

        break;


    /**
     * CONFIGURAÇÕES
     */
    case 'update_settings':

        include '../Ajax/settings/ajax_update_settings.inc.php';

        break;

    default:
        $jSon['error'] = 'Erro ao Escolher ação!';
        break;

endswitch;

echo json_encode($jSon);





