<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->



<?php
require 'config.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="mit" content="2017-09-01T19:28:04-03:00+39915">
        <title><?= $SEO['title']; ?></title>
        <meta name="description" content="<?= $SEO['description']; ?>"/>
        <meta name="robots" content="index, follow"/>

        <!--[if lt IE 9]>
            <script src="<?= INCLUDE_PATH; ?>/scripts/html5shiv.js"></script>
        <![endif]-->

        <link rel="BASE" href="<?= INCLUDE_PATH; ?>"/>
        <link rel="canonical" href="<?= INCLUDE_PATH; ?>/"/>
        <link rel="stylesheet"  href="<?= INCLUDE_PATH; ?>/css/boot3.css" >
        <link rel="stylesheet"  href="<?= INCLUDE_PATH; ?>/css/style.css" >
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link href='https://fonts.googleapis.com/css?family=<?= GOOGLE_FONT; ?>' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="<?= INCLUDE_PATH; ?>/images/favicon.png"/>
    </head>




    <body>

            <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                    m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-102573735-1', 'auto');
        ga('send', 'pageview');

    </script>

     <!--Facebook Pixel Code--> 
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq)
                return;
            n = f.fbq = function () {
                n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq)
                f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window,
                document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '431655260533995'); // Insert your pixel ID here.
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
                   src="https://www.facebook.com/tr?id=431655260533995&ev=PageView&noscript=1"
                   /></noscript>
     <!--DO NOT MODIFY--> 
     <!--End Facebook Pixel Code--> 


    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.10&appId=111370669510353";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        
        <main>
            <?php
            //URL + LEAD GATE COOKIE
            $getUrl = filter_input(INPUT_GET, 'url');
            $setUrl = explode("/", $getUrl);
            $getCookie = filter_input(INPUT_COOKIE, "activemail", FILTER_DEFAULT);

            //TRACK SRC - HOTMART
            $GetSRC = filter_input(INPUT_GET, 'src', FILTER_DEFAULT);
            $GetHSRC = filter_input(INPUT_GET, 'hsrc', FILTER_DEFAULT);
            $VendorSRC = ($GetSRC ? "&src={$GetSRC}" : ($GetHSRC ? "&src=" . HOME64_decode(urldecode($GetHSRC)) : null));

            //TRACK AFF - HOTMART
            $VendorAFF = filter_input(INPUT_GET, 'ref', FILTER_DEFAULT);

            //TRAKING FACEBOOK PIXEL
            $GetFB = filter_input(INPUT_GET, 'fb', FILTER_VALIDATE_INT);
            if ($GetFB):
                $_SESSION['activefb'] = strip_tags(trim($GetFB));
            endif;

            //TRAKING GOOGLE PIXEL
            $GetGi = filter_input(INPUT_GET, 'gi', FILTER_VALIDATE_INT);
            $GetGl = filter_input(INPUT_GET, 'gl', FILTER_DEFAULT);
            if ($GetGi && $GetGl):
                $_SESSION['activegw'] = [strip_tags(trim($GetGi)), strip_tags(trim($GetGl))];
            endif;

            //REDIRECT BY PARAM
            if ($VendorSRC || $VendorAFF):
                $_SESSION['hotlink'] = "http://hotmart.net.br/show_html?a=" . ($VendorAFF ? $VendorAFF : PRODUTO) . "{$VendorSRC}";
                header("Location: " . HOME . "/{$getUrl}");
            elseif ($GetGi || $GetGl || $GetFB):
                header("Location: " . HOME . "/{$getUrl}");
            endif;

            //LEAD GATE
            if (GATE && !empty($setUrl[1]) && filter_var($setUrl[1], FILTER_VALIDATE_EMAIL)):
                $getCookie = true;
                setcookie("activemail", HOME64_encode($setUrl[1]), strtotime("+3months"), "/");
            endif;

            if (GATE && !empty($setUrl[0]) && in_array($setUrl[0], $gatePages) && empty($getCookie)):
                header("location: " . HOME);
            elseif (GATE && !empty($setUrl[1]) && filter_var($setUrl[1], FILTER_VALIDATE_EMAIL)):
                setcookie("activemail", HOME64_encode($setUrl[1]), strtotime("+3months"), "/");
                header("location: " . HOME . "/{$setUrl[0]}");
            endif;

//            if (!empty($setUrl[1])):
//                header("location: " . HOME . "/{$setUrl[0]}");
//            endif;

            //QUERY STRING
            if (empty($setUrl[0])):
                require 'pages/home_prevenda.php';
            elseif (in_array($setUrl[0], $HomePages)):
                require "pages/home_{$setUrl[0]}.php";
            elseif (file_exists("gates/{$setUrl[0]}.php") && !is_dir("gates/{$setUrl[0]}.php")):
                if (GATE && !$getCookie):
                    header("location: " . HOME);
//                    require "gates/{$setUrl[0]}.php";
                else:
                    require "gates/{$setUrl[0]}.php";
                endif;
            else:
                if (file_exists("pages/{$setUrl[0]}.php") && !is_dir("pages/{$setUrl[0]}.php")):
                    require "pages/{$setUrl[0]}.php";
                else:
                    require INDEX;
                endif;
            endif;

            if (!empty($_SESSION['hotlink'])):
                echo "<img src='{$_SESSION['hotlink']}' alt='' title='lp_top_aff' />";
            endif;
            ?>

        </main>

        <!--        <footer class="main_footer">
                    <div class="content">
                        <div class="footer_logo">
                            <img width="200" src="<?= HOME; ?>/images/logo_white.png" alt="<?= $OPTIIN['headline']; ?>" title="<?= $OPTIIN['headline']; ?>"/>
                        </div>
                        <nav class="footer_terms">
                            <ul>
                                <li><a target="_blank" href="<?= $LEGAL['termos']; ?>">Termos de Uso</a></li>
                                <li><a target="_blank" href="<?= $LEGAL['politicas']; ?>">Política de Privacidade</a></li>
                                <li><a target="_blank" href="<?= $LEGAL['aviso']; ?>">Aviso Legal</a></li>
                            </ul>
                        </nav>
                    </div>
                    <div class="footer_copy">&COPY; <?= date('Y'); ?> - <?= $SEO['copyright']; ?></div>
                </footer>-->

        <!--SCRIPTS-->
        <script src="<?= HOME; ?>/scripts/jquery.js"></script>
        <script src="<?= HOME; ?>/scripts/landing.js"></script>
        <script src="https://apis.google.com/js/platform.js"></script>

        <!-- GOOGLE PIXEL -->
        <?php // require 'scripts/tracking_gw.php';  ?>

        <!-- ACTIVE CAMPAIGN PIXEL -->
        <?php // require 'scripts/tracking_mail.php';  ?>


    </body>
</html>

<!--<script src="scripts/jquery.js"></script>-->
<!--<script src="scripts/landing.js"></script>-->