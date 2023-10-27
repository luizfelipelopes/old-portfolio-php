<?php
ob_start();
date_default_timezone_set("America/Sao_Paulo");
//header("Access-Control-Allow-Origin: *");
require '../_app/Config.inc.php';
require '../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
header("access-control-allow-origin: https://" . (PAGSEGURO_ENV == 'sandbox' ? 'sandbox.' : '') . "pagseguro.uol.com.br");

spl_autoload_register('carregarClasses');

$transacao = new TransacoesPagSeguro();
$transacao->ExeNotificacoes();

$DownloadFile = filter_input(INPUT_GET, 'download_file', FILTER_VALIDATE_BOOLEAN);
if ($DownloadFile):
    $Export = new Export(LEADS, 'lead', 'csv', true);
endif;

if (!isset($_SESSION['userlogin']['user_id'])):
    header('Location: ' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'login.php');
endif;
//unset($_SESSION['userlogin']);
?>
<!DOCTYPE html>
<!--
Página: Dashboard (Front-Controller do Painel de Controle)
Author: Luiz Felipe C. Lopes
Date: 13/08/2018
-->

<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH_ADMIN . DIRECTORY_SEPARATOR . 'Assets/images/favicon.png' ?>" />
        <title>Flowstate Admin | Dashboard</title>
        <!--<link href="../_cdn/jquery-ui.css" rel="stylesheet">-->
        <link rel="stylesheet" href="Assets/Styles/Boot.css">
        <link rel="stylesheet" href="Assets/Styles/Icons.css">
        <link rel="stylesheet" href="Assets/Styles/Style.css">
        <link id="j_base_home" rel="js_home" href="<?= HOME_ADMIN . DIRECTORY_SEPARATOR . ADMIN; ?>">
        <link id="js_date_now" rel="date" href="<?= date('d/m/Y H:i'); ?>">
    </head>
    <body>

        <!--HEADER-->
        <header class="main_header">
            <div class="main_header_top">
                <div class="main_header_top_menu_logo">
                    <span class="main_header_top_menu_link icon-bars icon-notext js_click_menu"></span>
                    <h1><a title="Flowstate" href="<?= HOME_ADMIN . DIRECTORY_SEPARATOR . ADMIN; ?>">Flowstate</a></h1>
                </div>
                <div class="main_header_top_info">
                    <p>Bem-vindo(a) ao Flow State, Hoje <?= date('d/m/y H:i'); ?></p>
                    <span title="Ajuda" class="main_header_top_info_help icon-help icon-notext radius js_click_help"></span>
                    <?php include 'inc/modal_tutorial.inc.php'; ?>

                    <div class="drop_menu menu_tutorial radius js_menu_help">
                        <span class="menu_tutorial_title">Tutoriais Painel de Controle</span>

                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-globe">Geral</span>
                            <ol>
                                <li attr-video="R6BpocBQI1c">Login e Logout</li>
                                <li attr-video="E5Vgg5WPwI4">Recuperar Senha</li>
                                <li attr-video="cXKyz_U_EJI">Visão Geral do Sistema</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-post">Posts</span>
                            <ol>
                                <li attr-video="SiSmhVO204o">Gerenciar Categorias</li>
                                <li attr-video="YOXISx8F6vM">Criar Post</li>
                                <li attr-video="F8S0waWaOME">Editar Post</li>
                                <li attr-video="Gyfqdhcopgk">Habilitar/Desabilitar Post</li>
                                <li attr-video="9raIqYLmfb8">Excluir Post</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-featured">Destaques</span>
                            <ol>
                                <li attr-video="Hongxn5hYJo">Criar Destaque</li>
                                <li attr-video="O-nl5U2Kzpc">Editar Destaque</li>
                                <li attr-video="1T43qAliwQI">Habilitar/Desabilitar Destaque</li>
                                <li attr-video="j44gG3h1x5M">Ordenar Destaque</li>
                                <li attr-video="Ztg8n56z_zc">Excluir Destaque</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-testimonial">Vídeos</span>
                            <ol>
                                <li attr-video="t4nRaFNeGwA">Criar Vídeo</li>
                                <li attr-video="otxeZmj_k9k">Editar Vídeo</li>
                                <li attr-video="EjUiTDVg8hM">Habilitar/Desabilitar Vídeo</li>
                                <li attr-video="0txEubQMv_k">Excluir Vídeo</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-comment">Comentários</span>
                            <ol>
                                <li attr-video="NI2m-OtlNOE">Moderação Comentários</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-mail">Leads</span>
                            <ol>
                                <li attr-video="HM5vrxeKlsE">Gerenciar Leads</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-users">Usuarios</span>
                            <ol>
                                <li attr-video="pqdFCefnNKo">Criar Usuários</li>
                                <li attr-video="TnC5EovWkt0">Editar Usuários</li>
                                <li attr-video="_U4HqUP6xbM">Excluir Usuários</li>
                            </ol>
                        </div>
                        <div class="menu_tutorial_section">
                            <span class="menu_tutorial_section_title icon-user">Perfil</span>
                            <ol>
                                <li attr-video="g5N6N1C6EOI">Editar Perfil</li>
                            </ol>
                        </div>

                    </div>

                    <div class="main_header_group_user">
                        <span class="main_header_top_info_avatar icon-user icon-notext radius js_click_user"></span>
                        <span class="main_header_top_info_name js_click_user"><?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] : ''); ?></span>
                        <span class="main_header_top_info_menu_user icon-arrow-down icon-notext radius js_click_user"></span>

                        <div class="drop_menu menu_users radius js_menu_user">
                            <span class="menu_users_title icon-user"><?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] : ''); ?></span>

                            <ul>
                                <li><a title="Meu Perfil" href="?exe=users/profile">Meu Perfil</a></li>
                            </ul>

                        </div>

                    </div>

                    <div class="main_header_group_logoff">
                        <span title="Sair" class="main_header_top_info_logoff_icon icon-exit icon-notext radius js_logout"></span>
                        <span title="Sair" class="main_header_top_info_logoff js_logout">Sair</span>
                    </div>
                </div>
            </div>

        </header>

        <div class="flex">

            <!--MENU-->
            <nav class="nav js_menu_sidebar">

                <ul>
                    <li class="icon-home"><span class="menu_bar"></span><a title="Início" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>">Início</a></li>
                    <li class="icon-post js_submenu"><span class="menu_bar"></span><a title="Posts" href="#">Posts</a> <span class="menu_arrow icon-arrow-right"></span>
                        <ul>
                            <li title="Voltar" class="icon-turn-menu js_voltar">Voltar</li>
                            <li><a title="Ver Categorias" href="?exe=posts/categories/index">Ver Categorias</a></li>
                            <li><a title="Nova Categoria" href="?exe=posts/categories/create">Nova Categoria</a></li>
                            <li><a title="Novo Post" href="?exe=posts/index">Ver Posts</a></li>
                            <li><a title="Novo Post" href="?exe=posts/create">Novo Post</a></li>
                        </ul>
                    </li>

                    <?php if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] > '1'): ?>
                        <li class="icon-featured js_submenu"><span class="menu_bar"></span><a title="Destaques" href="#">Destaques</a> <span class="menu_arrow icon-arrow-right"></span>
                            <ul class="ds-none">
                                <li title="Voltar" class="icon-turn-menu js_voltar">Voltar</li>
                                <li><a title="Ver Destaques" href="?exe=highlights/index">Ver Destaques</a></li>
                                <li><a title="Novo Destaque" href="?exe=highlights/create">Novo Destaque</a></li>
                            </ul>
                        </li>

                        <?php if (DEPOIMENTOS_ADMIN == '1'): ?>
                            <li class="icon-testimonial js_submenu"><span class="menu_bar"></span><a title="Depoimentos" href="#">Depoimentos</a> <span class="menu_arrow icon-arrow-right"></span>
                                <ul class="ds-none">
                                    <li title="Voltar" class="icon-turn-menu js_voltar">Voltar</li>
                                    <li><a title="Ver Depoimentos Texto" href="?exe=testimonials/texts/index">Ver Depoimentos Texto</a></li>
                                    <li><a title="Ver Depoimentos Video" href="?exe=testimonials/videos/index">Ver Depoimentos Video</a></li>
                                    <li><a title="Novo Depoimento Texto" href="?exe=testimonials/texts/create">Novo Depoimento Texto</a></li>
                                    <li><a title="Novo Depoimento Video" href="?exe=testimonials/videos/create">Novo Depoimento Video</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>
                        
                            <?php if (VIDEOS_ADMIN == '1'): ?>
                            <li class="icon-testimonial js_submenu"><span class="menu_bar"></span><a title="Vídeos" href="#">Vídeos</a> <span class="menu_arrow icon-arrow-right"></span>
                                <ul class="ds-none">
                                    <li title="Voltar" class="icon-turn-menu js_voltar">Voltar</li>
                                    <li><a title="Ver Videos" href="?exe=videos/index">Ver Vídeos</a></li>
                                    <li><a title="Novo Video" href="?exe=videos/create">Novo Video</a></li>
                                </ul>
                            </li>
                        <?php endif; ?>

                        <?php if (COMENTARIOS_ADMIN == '1'): ?>
                            <!--<li class="icon-comment"><span class="menu_bar"></span><a title="Comentários" href="?exe=comments/index">Comentários</a></li>-->
                            <li class="icon-comment"><span class="menu_bar"></span><a title="Comentários" href="?exe=comments/moderate">Comentários</a></li>
                        <?php endif; ?>

                        <li class="icon-mail js_submenu"><span class="menu_bar"></span><a title="E-mails" href="#">E-mails</a><span class="menu_arrow icon-arrow-right"></span>
                            <ul class="ds-none">
                                <li title="Voltar" class="icon-turn-menu js_voltar">Voltar</li>
                                <li><a title="Leads" href="?exe=emails/index">Leads</a></li>
                            </ul>
                        </li>
                        <li class="icon-users js_submenu"><span class="menu_bar"></span><a title="Usuários" href="#">Usuários</a> <span class="menu_arrow icon-arrow-right"></span>
                            <ul class="ds-none">
                                <li title="Voltar" class="icon-turn-menu js_voltar">Voltar</li>
                                <li><a title="Ver usuários" href="?exe=users/index">Ver Usuários</a></li>
                                <li><a title="Novo usuário" href="?exe=users/create">Novo Usuário</a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] >= '3'): ?>
                        <li class="icon-config"><span class="menu_bar"></span><a title="Configurações" href="?exe=settings/settings"> Configurações</a></li>
                    <?php endif; ?>
                    <li class="icon-goto"><span class="menu_bar"></span><a title="Ver site" href="<?= HOME; ?>" target="_blank"> Ver Site</a></li>
                </ul>

            </nav>

            <main>

                <!--NAVEGAÇÂO-->
                <div class="navigation">


                    <?php
                    $exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

                    switch ($exe):

                        case 'posts/index':
                            echo '<span>/</span><span class="navigation_name icon-post">Meus Posts</span>';
                            break;

                        case 'posts/create':
                            echo '<span>/</span><span class="navigation_name icon-post">Novo Post</span>';
                            break;

                        case 'posts/categories/index':
                            echo '<span>/</span><span class="navigation_name icon-tag">Categorias</span>';
                            break;

                        case 'posts/categories/create':
                            echo '<span>/</span><span class="navigation_name icon-tag">Nova Seção / Categoria</span>';
                            break;

                        case 'testimonials/texts/index':
                            echo '<span>/</span><span class="navigation_name icon-testimonial">Meus Depoimentos / Textos</span>';
                            break;

                        case 'testimonials/texts/create':
                            echo '<span>/</span><span class="navigation_name icon-testimonial">Criar Depoimento / Texto</span>';
                            break;

                        case 'testimonials/videos/index':
                            echo '<span>/</span><span class="navigation_name icon-testimonial">Meus Depoimentos / Videos</span>';
                            break;

                        case 'testimonials/videos/create':
                            echo '<span>/</span><span class="navigation_name icon-testimonial">Criar Depoimento / Video</span>';
                            break;
                        
                        case 'videos/index':
                            echo '<span>/</span><span class="navigation_name icon-testimonial">Meus Vídeos</span>';
                            break;

                        case 'videos/create':
                            echo '<span>/</span><span class="navigation_name icon-testimonial">Criar Video</span>';
                            break;

                        case 'highlights/index':
                            echo '<span>/</span><span class="navigation_name icon-featured">Meus Destaques</span>';
                            break;

                        case 'highlights/create':
                            echo '<span>/</span><span class="navigation_name icon-featured">Novo Destaque</span>';
                            break;

                        case 'comments/index':
                            echo '<span>/</span><span class="navigation_name icon-comment">Comentários / Posts</span>';
                            break;

                        case 'comments/moderate':
                            echo '<span>/</span><span class="navigation_name icon-comment">Moderar Comentários</span>';
                            break;

                        case 'emails/index':
                            echo '<span>/</span><span class="navigation_name icon-mail">Leads</span>';
                            break;

                        case 'users/index':
                            echo '<span>/</span><span class="navigation_name icon-users">Usuários</span>';
                            break;

                        case 'users/create':
                            echo '<span>/</span><span class="navigation_name icon-user">Novo Usuário</span>';
                            break;

                        case 'users/profile':
                            echo '<span>/</span><span class="navigation_name icon-user">Meu Perfil</span>';
                            break;

                        case 'settings/settings':
                            echo '<span>/</span><span class="navigation_name icon-config">Configurações do Sistema</span>';
                            break;

                        default :
                            echo '<span>/</span><span class="navigation_name icon-home">Início</span>';
                            break;

                    endswitch;
                    ?>

                </div>

                <!--CONTEÚDO-->
                <div class="container content_variable">

                    <div class="trigger-absolute js_trigger_absolute"></div>

                    <?php
                    if (!empty($exe)):

                        $includepath = './system' . DIRECTORY_SEPARATOR . strip_tags(trim($exe)) . '.php';

                    else:

                        $includepath = './system' . DIRECTORY_SEPARATOR . 'home.php';

                    endif;

                    if (file_exists($includepath)):
                        require $includepath;
                    else:
                        echo 'Erro ao incluir tela';
                    endif;
                    ?>

                </div>

            </main>
        </div>

        <!--FOOTER-->
        <footer>

            <!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->
            <script src="../_cdn/jquery.js"></script>
            <script src="../_cdn/jquery.form.js"></script>
            <!--<script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
            <script src="../_cdn/jquery-ui.min.js"></script>
            <script src="../_cdn/combo.js" ></script>
            <script src="Assets/Scripts/scripts.js"></script>
            <script src="Assets/Scripts/scripts_inc/posts.inc.js"></script>
            <script src="Assets/Scripts/scripts_inc/videos.inc.js"></script>
            <script src="Assets/Scripts/scripts_inc/users.inc.js"></script>
            <script src="Assets/Scripts/scripts_inc/posts_comments.inc.js"></script>
            <script src="Assets/Scripts/scripts_inc/comments.inc.js"></script>
            <script src="Assets/Scripts/scripts_inc/emails.inc.js"></script>
            <script src="Assets/Scripts/scripts_inc/ordenacao_itens.inc.js"></script>
            <?php if (!empty($exe) && $exe == 'posts/create'): ?>
                <script src="Assets/Scripts/tinymce/tinymce.min.js"></script>
                <script src="Assets/Scripts/tinymce/jquery.tinymce.min.js"></script>
                <script src="Assets/Scripts/admin.js"></script>
            <?php endif; ?>
            <script>
                $(function () {
                    var Myheight = $('footer').position().top + <?= (!empty($exe) && strpos($exe, 'create') !== false ? '400' : '200'); ?>;
                    $('.js_menu_sidebar').css('cssText', 'height: ' + Myheight + 'px !important;');
                });
            </script>



        </footer>

    </body>
</html>
<?php ob_end_flush(); ?>