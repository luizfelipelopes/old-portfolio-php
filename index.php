<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

ob_start();
date_default_timezone_set("America/Sao_Paulo");

require './_app/Config.inc.php';
require './_app/Config-Mail.inc.php';
require './_app/Config-Empresa.inc.php';
require './_app/Config-Ecommerce.inc.php';
require './_app/Config-Post.inc.php';
require './_app/Library/PagSeguroLibrary/Config.inc.php';
require './_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';

spl_autoload_register('carregarClasses');


if(!empty($_SESSION['theme']) && $_SESSION['theme'] == 'blog-saude'){

    if ($Url[0] == 'venda-servico'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'venda-servico.php';
        die;
    elseif ($Url[0] == 'sessao-gratuita'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'sessao-gratuita.php';
        die;
    elseif ($Url[0] == 'treinamentoreal'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'treinamentoreal.php';
        die;
    elseif ($Url[0] == 'termos'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'termos.php';
        die;
    elseif ($Url[0] == 'politicas'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'politicas.php';
        die;
    elseif ($Url[0] == 'aviso'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'aviso.php';
        die;
    elseif ($Url[0] == 'termos-servico'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'termos-servico.php';
        die;
    endif;
}

if(!empty($_SESSION['theme']) && $_SESSION['theme'] == 'pizzaria'):
    if ($Url[0] == 'cardapio'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'cardapio.php';
        die;
    endif;    
endif;

if(!empty($_SESSION['theme']) && $_SESSION['theme'] == 'ingresso'):
        require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'index.php';
        die;
endif;

if(!empty($_SESSION['theme']) && $_SESSION['theme'] == 'afiliado'):
    require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'index.php';
    die;
endif;


if ($Url[0] == 'flowstate-blog' && empty($_SESSION['theme'])):
    require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'flowstate-blog.php';
    die;
elseif ($Url[0] == 'portfolio' && empty($_SESSION['theme'])):
    // var_dump('passou aqui'); die;
    require REQUIRE_PATH . DIRECTORY_SEPARATOR . 'portfolio.php';
    die;
elseif ($Url[0] != 'obrigado' && empty($_SESSION['theme']) && $Url[0] != 'themes'):
    // header('Location: ' . HOME . '/flowstate-blog');
    header('Location: ' . HOME . '/portfolio');
endif;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">

        <!--[if lt IE 9]>
            <script src="../../_cdn/html5.js"></script>
         <![endif]-->        

        <?php
        $Link = new Link();
        $Link->getTags();
        ?>


        <!--<link href="//fonts.googleapis.com/css?family=ABeeZee|Allan|Bree+Serif|Cookie|Dancing+Script|Domine|Droid+Sans|Grand+Hotel|Josefin+Slab|Lobster|Lora|Molengo|Monda|Mouse+Memoirs|Offside|Playfair+Display|Raleway|Roboto|Scope+One|Ubuntu|Vollkorn" rel="stylesheet">-->
        <!--<link href='//fonts.googleapis.com/css?family=Baumans' rel='stylesheet' type='text/css'>-->
        <!--<script src="//ssl.google-analytics.com/ga.js" async></script>-->
        <link rel="shortcut icon" href="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/favicon.png' ?>" />
        <script src="_cdn/modernizr-custom.js"></script>
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/Assets/Styles/Icons.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/Assets/Styles/Boot.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/Assets/Styles/Style.css">
        <link rel="stylesheet" href="<?= HOME; ?>/_cdn/shadowbox/shadowbox.css">
        <?php if ($Link->getFile() == 'confirma' || $Link->getFile() == 'obrigado' || $Link->getFile() == ARQUIVO_INDEX): ?>
            <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">    
            <link rel="stylesheet" href="<?= HOME; ?>/_cdn/app_campaign/opt-in.css">
        <?php endif; ?>
        
        <?php if(!empty(FONTS)): ?>
            <link href="https://fonts.googleapis.com/css?family=<?= FONTS; ?>" rel="stylesheet">
        <?php endif; ?>
        <link id="j_base" rel="j_base" href="<?= HOME; ?>">
        <link id="j_theme" rel="j_theme" href="<?= THEME; ?>">
        <link id="j_carrinho" rel="j_carrinho" href="<?= CARRINHO; ?>">
    </head>
    <body>

        <?php
        if (!isset($_SERVER['HTTP_USER_AGENT']) || stripos($_SERVER['HTTP_USER_AGENT'], 'Speed Insights') === false):
//            require REQUIRE_PATH . '/inc/analyticstracking.php';
        endif;

        if ($Link->getFile() != 'confirma' && $Link->getFile() != 'obrigado' && $Link->getFile() != ARQUIVO_INDEX):
            require(REQUIRE_PATH . '/inc/header.inc.php');
        endif;


//require (REQUIRE_PATH . '/inc/sidebar.inc.php');


        if (!require ($Link->getPath())):
            WSErro("Erro ao incluir arquivo de navegação", WS_ERROR, TRUE);
        endif;

        if ($Link->getFile() != 'confirma' && $Link->getFile() != 'obrigado' && $Link->getFile() != ARQUIVO_INDEX):
            require(REQUIRE_PATH . '/inc/footer.inc.php');
        else:
            ?>

            <footer class="main_footer">
                <div class="content" style="display: none;">
                    <div class="footer_logo">
                        <img width="200" src="<?= HOME; ?>/_cdn/app_campaign/images/logo_white.png" alt="<?= $OPTIIN['headline']; ?>" title="<?= $OPTIIN['headline']; ?>"/>
                    </div>
                    <nav class="footer_terms">
                        <ul>
                            <li><a target="_blank" href="<?= $LEGAL['termos']; ?>">Termos de Uso</a></li>
                            <li><a target="_blank" href="<?= $LEGAL['politicas']; ?>">Política de Privacidade</a></li>
                            <li><a target="_blank" href="<?= $LEGAL['aviso']; ?>">Aviso Legal</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="footer_copy" style="background: #0D70A5; color: #fff;">&COPY; <?= date('Y'); ?> - <?= $SEO['copyright']; ?></div>
            </footer>


        <?php
        endif;


        $userActiveCampaign = (!empty($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin']['cliente_email']) ? $_SESSION['clientelogin']['cliente_email'] : '');
        ?>

        <!-- <script type="text/javascript">
            var trackcmp_email = <?= $userActiveCampaign; ?>;
            var trackcmp = document.createElement("script");
            trackcmp.async = true;
            trackcmp.type = 'text/javascript';
            trackcmp.src = '//trackcmp.net/visit?actid=251875139&e=' + encodeURIComponent(trackcmp_email) + '&r=' + encodeURIComponent(document.referrer) + '&u=' + encodeURIComponent(window.location.href);
            var trackcmp_s = document.getElementsByTagName("script");
            if (trackcmp_s.length) {
                trackcmp_s[0].parentNode.appendChild(trackcmp);
            } else {
                var trackcmp_h = document.getElementsByTagName("head");
                trackcmp_h.length && trackcmp_h[0].appendChild(trackcmp);
            }
        </script> -->

    </body>

    <script src="<?= HOME ?>/_cdn/jquery.js"></script>
    <script src="<?= HOME ?>/_cdn/jquery.form.js"></script>
    <script src="<?= HOME ?>/_cdn/shadowbox/shadowbox.js"></script>
    <script src="<?= HOME ?>/_cdn/jcycle.js"></script>
    <script src="<?= HOME ?>/_cdn/jmask.js"></script>
    <script src="<?= HOME ?>/_cdn/scripts.js"></script>
    <script src="<?= INCLUDE_PATH; ?>/Assets/Scripts/scripts.inc.js"></script>
    
    <?php if (MENU_APP == '1'): ?>
        <script src="<?= HOME ?>/_cdn/app_menus/menu.inc.js"></script>
    <?php endif; ?>
    <?php if (SLIDES_APP == '1'): ?>
        <script src="<?= HOME ?>/_cdn/app_slides/slides.inc.js"></script>
    <?php endif; ?>
    <?php if (THEME == 'ecommerce'): ?>
        <script src="<?= HOME ?>/_cdn/_plugins.conf.js"></script>
        <script src="<?= HOME ?>/_scripts/cycle_function.js"></script>
    <?php endif; ?>
    <?php if (COMENTARIOS_APP == '1'): ?>
        <script src="<?= HOME ?>/_cdn/app_comentarios/comentarios.inc.js"></script>
    <?php endif; ?>
    <?php if ($Link->getFile() == 'confirma' || $Link->getFile() == 'obrigado' || $Link->getFile() == ARQUIVO_INDEX): ?>
        <script src="<?= HOME; ?>/_cdn/app_campaign/scripts/landing.js"></script>
    <?php endif; ?> 
    <!-- <script src="<?= HOME ?>/themes/<?= THEME; ?>/js/quantidade.js"></script> -->
    <script src="<?= HOME ?>/_app/Library/NumeralJs/min/numeral.min.js"></script>


    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122807631-2"></script>

    <!-- Global site tag (gtag.js) - Google Ads: 792201948 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-792201948"></script>
    <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());
            gtag('config', 'AW-792201948');
            gtag('config', 'UA-122807631-2');

<?php if ($Link->getFile() == 'obrigado'): ?>
    <!-- Event snippet for Lead conversion page -->
                gtag('event', 'conversion', {'send_to': 'AW-792201948/LcPyCKKqi4gBENyV4PkC'});
<?php endif; ?>

    </script>

<?php if (FACEBOOK_APP == '1'): ?>

<div id="fb-root"></div>
<script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v3.0&appId=467593886964781&autoLogAppEvents=1';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

<?php endif; ?>


<!--<script>gtag('event', 'conversion', {'send_to': 'AW-792201948/LcPyCKKqi4gBENyV4PkC'});</script>-->



</html>
<?php ob_end_flush(); ?>