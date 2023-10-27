<?php
//echo 'Fora do Ar Temporariamente!';
//die;
//require '_app/Config.inc.php';
define('NAME', 'Casa DiPizzas');
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= SITENAME; ?></title>

        <!--CONTROLE DE CACHE DO NAVEGADOR-->
        <meta http-equiv="cache-control" content="max-age=0" />
        <meta http-equiv="cache-control" content="no-cache" />
        <meta http-equiv="expires" content="0" />
        <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
        <meta http-equiv="pragma" content="no-cache" />

        <meta name="description" content="<?= SITEDESC; ?>"/>
        <meta name="robots" content="index, follow" />
        <link rel="shortcut icon" href="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>icon-casadipizzas.png" type="image/x-icon" />	
        <link rel="base" href="<?= HOME; ?>"/>
        <link rel="canonical" href="<?= HOME; ?>">
        <link rel="alternate" type="application/rss+xml" href="<?= HOME; ?>/rss.php"/>
        <link rel="sitemap" type="application/xml" href="<?= HOME; ?>/sitemap.xml" />

        <!--GOOGLE-->
        <meta itemprop="author" content="109917751422031829028" />
    <span itemprop="publisher" itemscope itemtype="http://schema.org/Organization"> 
        <meta itemprop="name" content="109917751422031829028" />
        <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
            <meta itemprop="url" content="<?= HOME; ?>/<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>sitekit/index.png" />
        </span>
        <meta itemprop="url" content="<?= HOME; ?>" />
    </span>
    <meta itemprop="mainEntityOfPage" content="<?= HOME; ?>" />
    <meta itemprop="dateModified" content="<?= date('Y-m-d'); ?>" />
    <meta itemprop="datePublished" content="<?= date('Y-m-d'); ?>" />
    <meta itemprop="headline" content="<?= SITEDESC ?>" />
    <link rel="author" href="https://plus.google.com/109917751422031829028" />
    <link rel="publisher" href="https://plus.google.com/109917751422031829028" />
    <meta itemprop="name" content="<?= NAME; ?>" />
    <meta itemprop="description" content="<?= SITEDESC; ?>" />
    <meta itemprop="url" content="<?= HOME; ?>" />
    <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
        <meta itemprop="url" content="<?= HOME; ?>/<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>sitekit/index.png" />
        <meta itemprop="width" content="100" />
        <meta itemprop="height" content="60" />
    </span>

    <!--FACEBOOK-->
    <meta property="og:app_id" content="467593886964781" />
    <meta property="article:author" content="https://www.facebook.com/LuizFelipeC.Lopes" />
    <meta property="article:publisher" content="https://www.facebook.com/nutricionistalowcarb" />
    <meta property="og:site_name" content="<?= NAME; ?>" />
    <meta property="og:locale" content="pt_BR" />
    <meta property="og:title" content="<?= SITENAME; ?>" />
    <meta property="og:description" content="<?= SITEDESC; ?>" />
    <meta property="og:image" content="<?= HOME; ?>/<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>sitekit/index.png" />
    <meta property="og:url" content="<?= HOME; ?>" />
    <meta property="og:type" content="article" />

    <!--TWITTER-->
    <meta property="twitter:card" content="summary_large_image"/>
    <meta property="twitter:site" content="@FelepBass"/>
    <meta property="twitter:domain" content="<?= DOMAIN; ?>"/>
    <meta property="twitter:title" content="<?= SITENAME; ?>"/>
    <meta property="twitter:description" content="<?= SITEDESC; ?>"/>
    <meta property="twitter:image:src" content="<?= HOME; ?>/<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>sitekit/index.png"/>
    <meta property="twitter:url" content="<?= HOME; ?>"/>

    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Buda:300|Dancing+Script|Felipa|Lobster|Oregano|Pompiere|Tangerine:400,700" rel="stylesheet">
    <link rel="stylesheet" href="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Styles/'; ?>Boot.css" />
    <link rel="stylesheet" href="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Styles/'; ?>Style.css" />

    <!--[if lt IE 9]>
               <script src="<?= HOME; ?>/_cdn/html5shiv.js"></script>
           <![endif]-->

</head>
<body>


    <section class="bloco_cardapio_topo container bg-black">
        <div class="content al-center">

            <div class="container" style="margin-bottom: 150px;"></div>


            <a href="<?= HOME . DIRECTORY_SEPARATOR . 'cardapio/&theme=' . THEME; ?>" title="<?= SITENAME; ?>"><div class="logo_cardapio"></div></a>

            <div class="icone-menu js_menu">
                <div class="barra radius"></div>
                <div class="barra radius"></div>
                <div class="barra radius"></div>
            </div>

            <nav class="js_slide_page menu_principal_topo">
                <ul>
                    <li><a title="Tradicionais" href="#tradicionais">- Tradicionais</a></li>
                    <li><a title="Especiais" href="#especiais">- Especiais</a></li>
                    <li><a title="Pizzas Nobres" href="#nobres">- Pizzas Nobres</a></li>
                    <li><a title="Pizzas Doces" href="#doces">- Pizzas Doces</a></li>
                    <li><a title="Refrigerantes" href="#refrigerantes">- Refrigerantes</a></li>
                </ul>
            </nav>

            <nav class="js_slide_page menu_principal radius">
                <ul class="container">
                    <li><a title="Tradicionais" href="#tradicionais">- Tradicionais</a></li>
                    <li><a title="Especiais" href="#especiais">- Especiais</a></li>
                    <li><a title="Pizzas Nobres" href="#nobres">- Pizzas Nobres</a></li>
                    <li><a title="Pizzas Doces" href="#doces">- Pizzas Doces</a></li>
                    <li><a title="Refrigerantes" href="#refrigerantes">- Refrigerantes</a></li>
                </ul>
            </nav>

            <div class="mensagem js_slide_page">
                <div class="pd-total2 texto_central">
                    <p>Estamos preparando o melhor site de pedidos de pizza do Nordeste!</p>
                    <p>Em breve, você poderá fazer o seu pedido por aqui!</p>
                    <p>Enquanto isso...</p>
                    <h1 class="caps-lock m-top3">Confira Nosso Cardápio</h1>
                </div>
                <a title="" href="#tradicionais"><div class="seta_cardapio"> V</div></a>

                <div class="telefones_cardapio al-left radius">
                    <p class="font-bold title">Faça o seu pedido pelos telefones:</p>
                    <p>(86) 9823-4448 (WhatsApp)</p>
                    <p>(86) 3084-3461</p>
                    <p>(86) 3233-9224</p>
                </div>
            </div>


            <div class="js_subir_topo slide_topo radius"><span>^</span></div>

            <div class="clear"></div>
        </div>
        <div class="sombra_topo"></div>
    </section>


    <section id="tradicionais" class="cardapio_pizzas pizza_tradicionais container">

        <header class="cabecalho_cardapio container al-center pd-total2">
            <div class="cabecalho_info">
                <h1 class="m-bottom1 font-bold">Pizzas Tradicionais</h1>
                <p>Média: <span>R$ 40,00</span></p>
                <p>Grande: <span>R$ 46,00</span></p>
                <p class="espessura">Escolha a espessura de sua massa: <span>Fina, Média ou Grossa</span></p>
            </div>
            <div class="sombra_header_cardapio"></div>
        </header>


        <div class="cor_cardapio container">

            <div class="content">

                <div class="cardapio_left">

                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>4 Queijos</h1>
                            <p>Massa, molho, mussarela, provolone, parmesão, catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Bacon</h1>
                            <p>Massa, molho, mussarela, bacon e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Bambina</h1>
                            <p>Massa, molho, mussarela, Presunto, frango desfiado, milho, ervilhas e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Balacubana</h1>
                            <p>Massa, molho, mussarela, presunto, frango desfiado, mussarela, bacon, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Caipira</h1>
                            <p>Massa, molho, mussarela, frango desfiado, milho verde e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Calabresa</h1>
                            <p>Massa, molho, mussarela, calabresa e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Frango ao Catupiry</h1>
                            <p>Massa, molho, mussarela, frango desfiado, coberto com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Frango ao Cheddar</h1>
                            <p>Massa, molho, mussarela, frango desfiado, coberto com cheddar e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Frango ao Creme</h1>
                            <p>Massa, molho, mussarela, frango desfiado, creme de leite, milho e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Margherita</h1>
                            <p>Massa, molho, mussarela, tomate, manjericão, parmesão ralado e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Mexicana</h1>
                            <p>Massa, molho, mussarela, presunto, bacon, cebola, azeitonas, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Mussarela</h1>
                            <p>Massa, molho, mussarela, azeitona e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Portuguesa</h1>
                            <p>Massa, molho, mussarela, presunto, calabresa, ovo cozido, pimentão, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Siciliana</h1>
                            <p>Massa, molho, mussarela, presunto, calabresa, bacon e orégano.</p>
                        </div>
                    </article>
                </div>

                <div class="cardapio_right">

                    <article class="complementos container bordas">
                        <header class="container al-center">
                            <h1>Bordas</h1>
                            <p>Acrescente bordas na sua pizza. É uma delícia. Experimente!</p>
                        </header>

                        <div class="content">

                            <article class="container bordas_tradicionais m-bottom3">
                                <h1>Bordas Tradicionais:</h1>
                                <p>Catupiry e Cheddar</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 5,00</span></p>
                                    <p>Grande <span>R$ 6,00</span></p>
                                </div>
                            </article>
                            <article class="container bordas_especiais">
                                <h1>Bordas Especiais:</h1>
                                <p>4 Queijos, Calabresa, Carne de Sol, Cream Cheese, Frango e Chocolate.</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 7,00</span></p>
                                    <p>Grande <span>R$ 8,00</span></p>
                                </div>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class=" complementos container adicionais">
                        <header class="container al-center">
                            <h1>Adicionais</h1>
                        </header>

                        <div class="content">

                            <article class="container acrescimo_itens">
                                <p>Catupiry: <span>R$ 6,00</span></p>
                                <p>Cheddar: <span>R$ 6,00</span></p>
                                <p>Cream Cheese: <span>R$ 8,00</span></p>
                                <p>Barbecue: <span>R$ 6,00</span></p>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>


                </div>

                <div class="clear"></div>
            </div>

        </div>


    </section>

    <section id="especiais" class="cardapio_pizzas pizza_especiais container">

        <header class="cabecalho_cardapio container al-center pd-total2">
            <div class="cabecalho_info">
                <h1 class="m-bottom1 font-bold">Pizzas Especiais</h1>
                <p>Média: <span>R$ 43,00</span></p>
                <p>Grande: <span>R$ 48,00</span></p>
                <p class="espessura">Escolha a espessura de sua massa: <span>Fina, Média ou Grossa</span></p>
            </div>
            <div class="sombra_header_cardapio"></div>
        </header>


        <div class="cor_cardapio container">

            <div class="content">


                <div class="cardapio_left">

                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>4 Queijos</h1>
                            <p>Massa, molho, mussarela, provolone, parmesão, catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>A Bolonhesa</h1>
                            <p>Massa, molho, mussarela, carne moída ao molho bolonhesa, azeitonas e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>5 Queijos</h1>
                            <p>Massa, molho, mussarela, provolone, parmesão, catupiry, gorgonzola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>A Moda da Casa</h1>
                            <p>Massa, molho, mussarela, calabresa, frango desfiado, presunto, bacon, azeitonas, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Baiana</h1>
                            <p>Massa, molho, mussarela, calabresa moída, pimenta calabresa, ovos ralados, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Brasiliana</h1>
                            <p>Massa, molho, mussarela, lombo canadense, presunto, bacon, cebola, ovo cozido, azeitonas e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Califórnia</h1>
                            <p>Massa, molho, mussarela, abacaxi, cereja, figo, pêssego.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Catuperu</h1>
                            <p>Massa, molho, mussarela, peito de peru, milho, azeitonas, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Carne de Sol</h1>
                            <p>Massa, molho, mussarela, carne de sol, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Carne de Sol com Cheddar</h1>
                            <p>Massa, molho, mussarela, carne de sol, cebola, cobertos com cheddar e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Carne de Sol ao Barbecue</h1>
                            <p>Massa, molho, mussarela, carne de sol, molho barbecue, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Carne de Sol Especial</h1>
                            <p>Massa, molho, mussarela, carne de sol, calabresa, bacon, milho, parmesão, tomate, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Frango com Bacon ao Catupiry</h1>
                            <p>Massa, molho, mussarela, frango desfiado, bacon, azeitonas, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Lombo</h1>
                            <p>Massa, molho, mussarela, lombo canadense, azeitonas e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Lombo Especial</h1>
                            <p>Massa, molho, mussarela, lombo canadense, bacon, palmito, cebola, tomate, cobertos com cheddar e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Maria Bonita</h1>
                            <p>Massa, molho, mussarela, carne de sol, banana, cobertos catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Mista Especial</h1>
                            <p>Massa, molho, mussarela, presunto, calabresa, palmito, champignon, cebola, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Nordestina</h1>
                            <p>Massa, molho, mussarela, presunto, carne de sol, bacon, cheiro verde, pimenta de cheiro, azeitonas, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Paulista</h1>
                            <p>Massa, molho, mussarela, alho e óleo, provolone, parmesão, tomates, manjericão e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Peito de Peru</h1>
                            <p>Massa, molho, mussarela, peito de peru, milho, azeitonas e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Vegetariana</h1>
                            <p>Massa, molho, mussarela, pimentão, milho, palmito, tomate, azeitonas.</p>
                        </div>
                    </article>

                </div>


                <div class="cardapio_right">

                    <article class="complementos container bordas">
                        <header class="container al-center">
                            <h1>Bordas</h1>
                            <p>Acrescente bordas na sua pizza. É uma delícia. Experimente!</p>
                        </header>

                        <div class="content">

                            <article class="container bordas_tradicionais m-bottom3">
                                <h1>Bordas Tradicionais:</h1>
                                <p>Catupiry e Cheddar</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 5,00</span></p>
                                    <p>Grande <span>R$ 6,00</span></p>
                                </div>
                            </article>
                            <article class="container bordas_especiais">
                                <h1>Bordas Especiais:</h1>
                                <p>4 Queijos, Calabresa, Carne de Sol, Cream Cheese, Frango e Chocolate.</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 7,00</span></p>
                                    <p>Grande <span>R$ 8,00</span></p>
                                </div>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class=" complementos container adicionais">
                        <header class="container al-center">
                            <h1>Adicionais</h1>
                        </header>

                        <div class="content">

                            <article class="container acrescimo_itens">
                                <p>Catupiry: <span>R$ 6,00</span></p>
                                <p>Cheddar: <span>R$ 6,00</span></p>
                                <p>Cream Cheese: <span>R$ 8,00</span></p>
                                <p>Barbecue: <span>R$ 6,00</span></p>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>


                </div>


                <div class="clear"></div>
            </div>

        </div>


    </section>

    <section id="nobres" class="cardapio_pizzas pizza_nobres container">

        <header class="cabecalho_cardapio container al-center pd-total2">
            <div class="cabecalho_info">
                <h1 class="m-bottom1 font-bold"><span class="primeira_palavra">Pizzas</span> Nobres</h1>
                <p>Média: <span>R$ 45,00</span></p>
                <p>Grande: <span>R$ 50,00</span></p>
                <p class="espessura">Escolha a espessura de sua massa: <span>Fina, Média ou Grossa</span></p>
            </div>
            <div class="sombra_header_cardapio"></div>
        </header>


        <div class="cor_cardapio container">

            <div class="content">

                <div class="cardapio_left">

                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>4 Camarão</h1>
                            <p>Massa, molho, mussarela, camarão, tomate, cebola e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Camarão Cremoso</h1>
                            <p>Massa, molho, mussarela, camarão, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Filé com Catupiry</h1>
                            <p>Massa, molho, mussarela, filé fatiado, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Filé com Cheddar</h1>
                            <p>Massa, molho, mussarela, filé fatiado, cobertos com cheddar e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Filé Medalhão</h1>
                            <p>Massa, molho, mussarela, filé fatiado, bacon e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Mexicana Especial</h1>
                            <p>Massa, molho, mussarela, pepperoni, bacon, cebola, azeitonas, cobertos com catupiry e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Palermo</h1>
                            <p>Massa, molho, mussarela, filé ao alho e óleo, presunto e orégano.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Pepperoni</h1>
                            <p>Massa, molho, mussarela, pepperoni, azeitonas.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Pepperoni Especial</h1>
                            <p>Massa, molho, mussarela, pepperoni, presunto, pimentão, cebola e orégano.</p>
                        </div>
                    </article>

                </div>

                <div class="cardapio_right">

                    <article class="complementos container bordas">
                        <header class="container al-center">
                            <h1>Bordas</h1>
                            <p>Acrescente bordas na sua pizza. É uma delícia. Experimente!</p>
                        </header>

                        <div class="content">

                            <article class="container bordas_tradicionais m-bottom3">
                                <h1>Bordas Tradicionais:</h1>
                                <p>Catupiry e Cheddar</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 5,00</span></p>
                                    <p>Grande <span>R$ 6,00</span></p>
                                </div>
                            </article>
                            <article class="container bordas_especiais">
                                <h1>Bordas Especiais:</h1>
                                <p>4 Queijos, Calabresa, Carne de Sol, Cream Cheese, Frango e Chocolate.</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 7,00</span></p>
                                    <p>Grande <span>R$ 8,00</span></p>
                                </div>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class=" complementos container adicionais">
                        <header class="container al-center">
                            <h1>Adicionais</h1>
                        </header>

                        <div class="content">

                            <article class="container acrescimo_itens">
                                <p>Catupiry: <span>R$ 6,00</span></p>
                                <p>Cheddar: <span>R$ 6,00</span></p>
                                <p>Cream Cheese: <span>R$ 8,00</span></p>
                                <p>Barbecue: <span>R$ 6,00</span></p>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>


                </div>

                <div class="clear"></div>
            </div>

        </div>


    </section>

    <section id="doces" class="cardapio_pizzas pizza_doces container">

        <header class="cabecalho_cardapio container al-center pd-total2">
            <div class="cabecalho_info">
                <h1 class="m-bottom1 font-bold"><span class="primeira_palavra">Pizzas</span> Doces</h1>
                <p>Média: <span>R$ 40,00</span></p>
                <p>Grande: <span>R$ 46,00</span></p>
                <p class="espessura">Escolha a espessura de sua massa: <span>Fina, Média ou Grossa</span></p>
            </div>
            <div class="sombra_header_cardapio"></div>
        </header>

        <div class="cor_cardapio container">

            <div class="content">

                <div class="cardapio_left">

                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Banana</h1>
                            <p>Massa, molho, mussarela, banana, açúcar e canela.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Chocolate com Morango</h1>
                            <p>Massa, molho, mussarela, chocolate, morango.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>M&M</h1>
                            <p>Massa, molho, mussarela, chocolate e M&M.</p>
                        </div>
                    </article>
                    <article class="item_cardapio">
                        <div class="contorno_cardapio">
                            <h1>Romeu e Julieta</h1>
                            <p>Massa, molho, mussarela, goiabada e queijo coalho.</p>
                        </div>
                    </article>

                </div>

                <div class="cardapio_right">

                    <article class="complementos container bordas">
                        <header class="container al-center">
                            <h1>Bordas</h1>
                            <p>Acrescente bordas na sua pizza. É uma delícia. Experimente!</p>
                        </header>

                        <div class="content">

                            <article class="container bordas_tradicionais m-bottom3">
                                <h1>Bordas Tradicionais:</h1>
                                <p>Catupiry e Cheddar</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 5,00</span></p>
                                    <p>Grande <span>R$ 6,00</span></p>
                                </div>
                            </article>
                            <article class="container bordas_especiais">
                                <h1>Bordas Especiais:</h1>
                                <p>4 Queijos, Calabresa, Carne de Sol, Cream Cheese, Frango e Chocolate.</p>
                                <div class="container m-top1">
                                    <p>Média <span>R$ 7,00</span></p>
                                    <p>Grande <span>R$ 8,00</span></p>
                                </div>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>

                    <article class=" complementos container adicionais">
                        <header class="container al-center">
                            <h1>Adicionais</h1>
                        </header>

                        <div class="content">

                            <article class="container acrescimo_itens">
                                <p>Catupiry: <span>R$ 6,00</span></p>
                                <p>Cheddar: <span>R$ 6,00</span></p>
                                <p>Cream Cheese: <span>R$ 8,00</span></p>
                                <p>Barbecue: <span>R$ 6,00</span></p>
                            </article>

                            <div class="clear"></div>
                        </div>
                    </article>


                </div>

                <div class="clear"></div>
            </div>

        </div>


    </section>


    <section id="refrigerantes" class="cardapio_pizzas refrigerantes container">

        <header class="cabecalho_cardapio container al-center pd-total2" style="height: 200px;">
            <div class="cabecalho_info">
                <h1 class="m-bottom1 font-bold">Refrigerantes</h1>
<!--                <p>Média: <span>R$ 40,00</span></p>
                <p>Grande: <span>R$ 46,00</span></p>
                <p class="espessura">Escolha a espessura de sua massa: <span>Fina, Média ou Grossa</span></p>-->
            </div>
            <div class="sombra_header_cardapio"></div>
        </header>

        <div class="cor_cardapio container">

            <div class="content">

                <article class="item_cardapio">
                    <div class="contorno_cardapio">
                        <h1>1 Litro</h1>
                        <p>R$ 6,00</p>
                    </div>
                </article>
                <article class="item_cardapio">
                    <div class="contorno_cardapio">
                        <h1>2 Litros</h1>
                        <p>R$ 8,00</p>
                    </div>
                </article>

                <div class="clear"></div>
            </div>

        </div>

        <footer class="cardapio_footer">

            <div class="antirodape">

                <div class="grupo_bloco_cardapio_footer">

                    <div class="bloco_cadapio_footer formas-pagamento m-bottom3 box box-medium">
                        <h1>Formas de Pagamento</h1>
                        <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/formas-pagamento/image_pagamento_dinheiro.png" title="Pague em Dinheiro no PizzaFacil" alt="[Pague em Dinheiro no PizzaFacil]" >
                        <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/formas-pagamento/image_pagamento_cartao_visa.png" title="Pague em Dinheiro no PizzaFacil" alt="[Pague em Dinheiro no PizzaFacil]" >
                        <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/formas-pagamento/image_pagamento_cartao_mastercard.png" title="Pague com Mastercard no PizzaFacil" alt="[Pague com Mastercard no PizzaFacil]" >
                        <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/formas-pagamento/image_pagamento_cartao_amex.png" title="Pague com American Express no PizzaFacil" alt="[Pague com American Express no PizzaFacil]" >
                        <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/formas-pagamento/image_pagamento_cartao_elo.png" title="Pague com Elo no PizzaFacil" alt="[Pague com Elo no PizzaFacil]" >
                    </div>

                    <div class="bloco_cadapio_footer cardapio_menu_footer redes-sociais m-bottom3 box box-medium">
                        <h1>Confira nosso Cardápio:</h1>
                        <div class="plugins-sociais">
                            <nav class="js_slide_page">
                                <ul class="container">
                                    <li><a title="Tradicionais" href="#tradicionais">- Tradicionais</a></li>
                                    <li><a title="Especiais" href="#especiais">- Especiais</a></li>
                                    <li><a title="Pizzas Nobres" href="#nobres">- Pizzas Nobres</a></li>
                                    <li><a title="Pizzas Doces" href="#doces">- Pizzas Doces</a></li>
                                    <li><a title="Refrigerantes" href="#refrigerantes">- Refrigerantes</a></li>
                                </ul>
                            </nav>

                        </div>
                    </div>


                    <div class="bloco_cadapio_footer redes-sociais m-bottom3 box box-medium">
                        <h1>Nossas Redes Sociais</h1>
                        <div class="plugins-sociais">

                            <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/midias-socias/icon-facebook.png" title="Curta a Nossa Página PizzaFácil" alt="[Curta a Nossa Página PizzaFácil]" >
                            <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/midias-socias/icon-twitter.png" title="Siga-nos no Twitter PizzaFácil" alt="[Siga-nos no Twitter PizzaFácil]" >
                            <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/midias-socias/icon-linkedin.png" title="Siga-nos no Linkedin PizzaFácil" alt="[Siga-nos no Linkedin PizzaFácil]" >


                        </div>
                    </div>



                    <div class="bloco_cadapio_footer aviso-televendas radius m-bottom3">

                        <div class="aviso fl-left al-justify font-light m-top1 m-bottom1">
                            <p>Estamos preparando o melhor site de pedidos de pizza do Nordeste! Em breve, você poderá fazer o seu pedido por aqui! Confira nosso Cardápio e faça seu pedido pelo telefone enquanto isso...</p>
                        </div>
                        <div class="fone">
                            <div class="icon-telefone bg-yellow radius-bottom-left radius-top-left">
                                <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/'; ?>boot/icons/icon-phone.png" title="Ligue para o PizzaFácil" alt="[Ligue para o PizzaFácil]">
                            </div>
                            <div class="info-telefone bg-orange radius-bottom-right radius-top-right">
                                <h1>Pedidos</h1>
                                <span>(86)9823-4448 (WhatsApp)</span>
                                <span>(86)3084-3461</span>
                                <span>(86)3233-9224</span>
                            </div>

                        </div>
                    </div>


                </div>

                <div class="sombra_antirodape"></div>
                <div class="clear"></div>
            </div>
            <div class="rodape">
                <div class="copy">© <?= date('Y'); ?>. <?= NAME; ?>. </div>
                <div class="assinatura">Desenvolvido por <a target="_blank" href="https://www.linkedin.com/in/luizfelipelopes/">Luiz Felipe Lopes</a></div>
                <div class="clear"></div>
            </div>
        </footer>


    </section>

    <script src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Scripts/'; ?>html5shiv.js"></script>
    <script src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Scripts/'; ?>jquery.js"></script>
    <script src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Scripts/'; ?>jquery.form.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Scripts/'; ?>scripts.inc.js"></script>

</body>
</html>
