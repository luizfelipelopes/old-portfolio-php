<!--[if lt IE 9]>
            <script src="_cdn/html5shiv.js"></script>
        <![endif]-->

<?php
$sessao = new Session(1);
//var_dump($Link->getFile());

if (!isset($_SESSION['carrinho']) && empty($_SESSION['carrinho'])):
//    session_start();
endif;

if (!isset($_SESSION['clientelogin']) || empty($_SESSION['clientelogin'])):
    unset($_SESSION['carrinho']);
endif;

//unset($_SESSION['clientelogin'], $_SESSION['carrinho'], $_SESSION['preco_total']);
//var_dump($_SESSION['clientelogin'], $_SESSION['carrinho'], $_SESSION['preco_total']);
?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
<link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style.css" />
<link rel="stylesheet" href="_cdn/shadowbox/shadowbox.css" />

</head>

<?php if (FACEBOOK_APP == '1'): ?>

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=467593886964781";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

<?php endif; ?>

<body class="bg-body">

    <h1 class="fontzero"><?= SITENAME; ?></h1>

    <div class="j_back backtop">TOPO</div>


    <header class="container main_header">

        <?php
        if (MENU_APP == '1'):
            include './_cdn/app_menus/main_nav.inc.php';
        endif;
        ?>

        <div class="logo_radio boxshadow">
            <div class="content">

                <span class="fontzero main_logo main_logo_mobile fl-left"><a title="" href="<?= HOME . '/&theme=' . THEME; ?>"><?= SITENAME; ?></a></span>


                <?php if (MENU_APP == '1'): ?>
                    <div class="j_menu_mobile main_mob_nav bg-green fl-right">

                        <div class="listras">

                            <div class="linhas"></div>
                            <div class="linhas"></div>
                            <div class="linhas"></div>

                        </div>

                    </div>
                <?php endif; ?>

                <div class="clear"></div>
            </div>

            <!--            <div class="container main_noar bg-light">
                            <div class="content">
            
                                <div class="noar_radio_group">
                                    <span class="fl-left">No Ar:</span>
                                    <div class="main_radio fl-right">
                                        <div class="radio fl-right"><iframe class="media" src ="http://www.audiobras.com.br/flash/indexwz5.php?canal=gabadi&canal2=gabadi" marginwidth="0" marginheight="0" scrolling="no"  frameborder="0"></iframe> </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="clear"></div>
                        </div>-->

            <div class="clear"></div>
        </div>

    </header>

    <main class="carregar">


