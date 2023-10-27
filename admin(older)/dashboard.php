<?php
ob_start();
if (!empty($_SESSION['theme'])):
    session_start();
endif;
?>
<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
require '../_app/Config.inc.php';
require '../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';

spl_autoload_register('carregarClasses');
date_default_timezone_set("America/Sao_Paulo");

$exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
$DownloadFile = filter_input(INPUT_GET, 'download_file', FILTER_VALIDATE_BOOLEAN);

if ($DownloadFile):
    $Export = new Export(LEADS, 'lead', 'csv', false);
endif;

if (!isset($_SESSION['userlogin']['user_id'])):
    header('Location: index.php?exe=restrito');
endif;

//var_dump($_SERVER['QUERY_STRING']);
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard | Painel Admin</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH; ?>/img/favicon.png"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link href="../_cdn/jquery-ui.css" rel="stylesheet">
        <link rel="stylesheet" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/css/boot.css">
        <link id="j_base_home" rel="j_base" href="<?= HOME; ?>">
        <link id="j_date_now" rel="j_date_now" href="<?= date('d/m/Y H:i'); ?>">
        <link id="j_id_cat" rel="j_id_cat" href="<?= filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>">
        <link id="j_is_secao" rel="j_is_secao" href="<?= filter_input(INPUT_GET, 'sec', FILTER_VALIDATE_BOOLEAN); ?>">
        <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

    </head>
    <body class="bg-light">

        <?php include './inc/modal-data-personalizado.inc.php'; ?>

        <!--CABEÇALHO-->
        <header>

            <div class="barra-topo bg-black container sidebar">

                <div class="content fundo">

                    <!--PERFIL-->
                    <a class="nome-usuario" href="?exe=usuarios/perfil">
                        <div class="barra-topo-perfil">
                            <img class="round" title="" alt="" src="<?= ((!empty($_SESSION['userlogin']) && !empty($_SESSION['userlogin']['user_foto'])) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $_SESSION['userlogin']['user_foto'] : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png'); ?>" />
                            <h1> <?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] : null ); ?></h1>
                        </div>
                    </a>    
                    <!--PERFIL-->

                    <!--MENU NAV-->
                    <nav class="main_nav">
                        <div class="j_close close_nav fl-right">X</div>
                        <ul class="menu">
                            <li class="menu-dashboard"><a class="shorticon shorticon-dashboard-menu link" title="Dashboard" href="dashboard.php" >Início</a></li>
                            <li id="submenu_posts"><a class="shorticon shorticon-posts" title="Posts" href="#" >Posts</a>
                                <ul class="submenu">
                                    <li><a class="link" title="Ver Posts" href="?exe=posts/index">>> Ver Posts</a></li>
                                    <li><a class="link" title="Novo Post" href="?exe=posts/create">>> Novo Post</a></li>
                                    <li><a class="link" title="Categorias" href="?exe=categorias/index&segment=blog">>> Categorias</a></li>
                                </ul>
                            </li>

                            <li id="submenu_produtos"><a class="shorticon shorticon-produtos" title="Produtos" href="#" >Produtos</a>
                                <ul class="submenu">
                                    <li><a class="link" title="Ver Produtos" href="?exe=produtos/index">>> Ver Produtos</a></li>
                                    <li><a class="link" title="Novo Produto" href="?exe=produtos/create">>> Novo Produto</a></li>
                                    <li><a class="link" title="Categorias" href="?exe=categorias/index&segment=ecommerce">>> Categorias</a></li>
                                    <li><a class="link" title="Cupons" href="?exe=produtos/cupons/index">>> Cupons</a></li>
                                </ul>
                            </li>

                            <li id="submenu_cursos"><a class="shorticon shorticon-posts" title="Cursos" href="#" >Cursos</a>
                                <ul class="submenu">
                                    <li><a class="link" title="Ver Cursos" href="?exe=cursos/index">>> Ver Cursos</a></li>
                                    <li><a class="link" title="Novo Curso" href="?exe=cursos/create">>> Novo Curso</a></li>
                                </ul>
                            </li>

                            <li id="submenu_paginas"><a class="shorticon shorticon-posts" title="Páginas" href="#" >Páginas</a>
                                <ul class="submenu">
                                    <li><a class="link" title="Ver Páginas" href="<?= HOME; ?>/admin/dashboard.php?exe=paginas/index">>> Ver Páginas</a></li>
                                    <li><a class="link" title="Novo Páginas" href="<?= HOME; ?>/admin/dashboard.php?exe=paginas/create">>> Novo Páginas</a></li>
                                </ul>
                            </li>

                            <?php if (SLIDES_APP == '1' && SLIDES_APP_BANNERS == '1'): ?>

                                <li id="submenu_destaques"><a class="shorticon shorticon-posts" title="Destaques" href="#" >Destaques</a>
                                    <ul class="submenu">
                                        <li><a class="link" title="Ver Destaques" href="<?= HOME; ?>/admin/dashboard.php?exe=destaques/index">>> Ver Destaques</a></li>
                                        <li><a class="link" title="Novo Destaque" href="<?= HOME; ?>/admin/dashboard.php?exe=destaques/create">>> Novo Destaque</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>

                            <?php if (SLIDES_APP == '1' && SLIDES_APP_VIDEOS == '1'): ?>

                                <li id="submenu_videos"><a class="shorticon shorticon-posts" title="Vídeos" href="#" >Vídeos</a>
                                    <ul class="submenu">
                                        <li><a class="link" title="Ver Vídeos" href="<?= HOME; ?>/admin/dashboard.php?exe=videos/index">>> Ver Vídeos</a></li>
                                        <li><a class="link" title="Novo Vídeos" href="<?= HOME; ?>/admin/dashboard.php?exe=videos/create">>> Novo Vídeos</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>

                            <?php if (SLIDES_APP == '1' && SLIDES_APP_ANUNCIANTES == '1'): ?>

                                <li id="submenu_destaques"><a class="shorticon shorticon-posts" title="Destaques" href="#" >Anunciantes</a>
                                    <ul class="submenu">
                                        <li><a class="link" title="Ver Anúncios" href="<?= HOME; ?>/admin/dashboard.php?exe=anuncios/index">>> Ver Anúncios</a></li>
                                        <li><a class="link" title="Novo Anúncio" href="<?= HOME; ?>/admin/dashboard.php?exe=anuncios/create">>> Novo Anúncio</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>



                            <li id="submenu_alunos"><a class="shorticon shorticon-usuarios-menu" title="Usuários" href="#" >Alunos</a>
                                <ul class="submenu">
                                    <li><a class="link" title="Ver Alunos" href="?exe=alunos/index">>> Ver Alunos</a></li>
                                </ul>
                            </li>


                            <?php if (ECOMMERCE_ADMIN == '1'): ?>

                                <li id="submenu_pedidos"><a class="shorticon shorticon-pedidos-menu link" title="Pedidos" href="?exe=pedidos" >Pedidos</a></li>

                            <?php endif; ?>



                            <li id="submenu_imoveis" class="ds-none"><a class="shorticon shorticon-imoveis" title="Imóveis" href="" >Imóveis</a>
                                <ul class="submenu">
                                    <li><a class="al-left fl-left link" title="Novo Post" href="#">>> Ver Imóveis</a></li>
                                    <li><a class="al-left fl-left link" title="Novo Post" href="#">>> Novo Imóvel</a></li>
                                </ul>
                            </li>

                            <?php if (COMENTARIOS_ADMIN == '1'): ?>

                                <li id="submenu_comentarios"><a class="shorticon shorticon-comentarios-menu" title="Comentários" href="" >Comentários</a>
                                    <ul class="submenu">
                                        <li><a class="al-left fl-left link" title="Posts" href="?exe=comentarios-segmentos&segment=post">>> Posts</a></li>
                                        <li><a class="al-left fl-left link" title="Reviews" href="?exe=comentarios-segmentos&segment=review-produto">>> Reviews</a></li>
                                        <li><a class="al-left fl-left link" title="Tickets" href="?exe=comentarios-segmentos&segment=tickets">>> Tickets</a></li>
                                    </ul>
                                </li>

                            <?php endif; ?>

                            <li id="submenu_destaque" class="ds-none"><a class="shorticon shorticon-destaque" title="Em Destaque" href="" >Em destaque</a></li>

                            <li id="submenu_paginas" class="ds-none"><a class="shorticon shorticon-paginas" title="Páginas" href="" >Páginas</a></li>

                            <?php if (EMAILS_ADMIN == '1'): ?>
                                <li id="submenu_emails"><a class="shorticon shorticon-usuarios-menu" title="Usuários" href="" >E-mails</a>
                                    <ul class="submenu">
                                        <li><a class="link" title="E-mails" href="?exe=emails/index">>> Ver E-mail</a></li>
                                        <li><a class="link" title="Novo E-mail" href="?exe=emails/create">>> Novo E-mail</a></li>
                                        <?php if (LEADS_ADMIN == '1'): ?>
                                            <li><a class="link" title="Leads" href="?exe=emails/leads" >>> Leads</a></li>
                                        <?php endif; ?>    
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <?php if (EMAILS_ADMIN == '1' && LEADS_ADMIN == '1'): ?>
                                <li id="submenu_emails"><a class="shorticon shorticon-usuarios-menu" title="Iscas" href="" >Opt-in's</a>
                                    <ul class="submenu">
                                        <li><a class="link" title="Opt-in's" href="?exe=optins/index" >>> Ver Opt-in's</a></li>
                                        <li><a class="link" title="E-mails" href="?exe=optins/iscas/index">>> Ver Iscas</a></li>
                                        <li><a class="link" title="Novo E-mail" href="?exe=optins/iscas/create">>> Nova Isca</a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>

                            <li id="submenu_usuarios"><a class="shorticon shorticon-usuarios-menu" title="Usuários" href="" >Usuários</a>
                                <ul class="submenu">
                                    <li><a class="link" title="Ver Usuários" href="?exe=usuarios/index">>> Ver Usuários</a></li>
                                    <li><a class="link" title="Novo Usuário" href="?exe=usuarios/create">>> Novo Usuário</a></li>
                                    <li><a class="link" title="Clientes" href="?exe=usuarios/clientes">>> Clientes</a></li>
                                    <li><a class="link" title="Meu Perfil" href="?exe=usuarios/perfil">>> Meu Perfil</a></li>
                                    <!--<li><a class="link" title="Novo Post" href="#">>> Equipe</a></li>-->

                                </ul>
                            </li>
                            <li id="submenu_configuracoes"><a class="shorticon shorticon-config link" title="Configurações" href="?exe=configuracoes/config&id=1" >Configurações</a></li>
                            <li><a class="shorticon shorticon-ver-site link" target="_blank" title="Ver Site" href="<?= HOME; ?>" >Ver Site</a></li>
                        </ul>
                    </nav>
                    <!--MENU NAV-->

                    <!--MENU MOBILE-->
                    <div class="barra-topo-menu-mobile j_menu_mobile">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                    <!--MENU MOBILE-->

                    <div class="clear"></div>
                </div>


            </div>

            <div class="container pre-titulo">
                <div class="content">
                    <!--BOAS VINDAS-->
                    <p class="bem-vindo">Bem-vindo(a) ao Flow State, Hoje <?= date('d/m/y H:i'); ?></p>
                    <!--BOAS VINDAS-->

                    <!--SAIR-->
                    <a class="sair shorticon shorticon-botao-sair btn btn-red radius j_logout" title="Sair" href="#" >Sair!</a>
                    <!--SAIR-->

                    <div class="clear"></div>
                </div>
            </div>




        </header>
        <!--CABEÇALHO-->


        <main>        
            <section class="container">






                <?php
                if (!empty($exe)):
                    $includepath = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . trim($exe) . '.php';
                else:
                    $includepath = __DIR__ . DIRECTORY_SEPARATOR . 'system' . DIRECTORY_SEPARATOR . trim($exe) . 'home.php';
                endif;

                if (file_exists($includepath)):
                    require $includepath;
                else:
                    echo 'Erro ao Incluir tela!';
                endif;
                ?>




                <!--        <div class="clear"></div>
                    </div>-->
            </section>    
        </main>

        <footer>
            <div class="fim_sidebar container"></div>


            <script src="//code.jquery.com/jquery-1.12.4.js"></script>
            <script src="../_cdn/jquery-ui.min.js"></script>
            <!--<script src="../_cdn/jquery.js" ></script>-->
            <script src="../_cdn/shadowbox/shadowbox.js"></script>
            <script src="../_cdn/jmask.js"></script>
            <script src="../_cdn/jquery.maskMoney.js"></script>
            <script src="../_cdn/scripts.js" ></script>
            <script src="../_cdn/jquery.form.js" ></script>
            <script src="<?= HOME ?>/<?= ADMIN; ?>/__jsc/admin_scripts.js"></script>
            <script src="<?= HOME ?>/<?= ADMIN; ?>/__jsc/tinymce/tinymce.min.js"></script>
            <script src="<?= HOME ?>/<?= ADMIN; ?>/__jsc/tinymce/jquery.tinymce.min.js"></script>
            <script src="<?= HOME ?>/<?= ADMIN; ?>/__jsc/admin.js"></script>
            <!--<script src="../_cdn/modernizr-custom.js"></script>-->

        </footer>

    </body>

</html>
<?php ob_end_flush(); ?>
