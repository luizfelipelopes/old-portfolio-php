<?php
//session_start();
$sessao = new Session(1);
$logout = filter_input(INPUT_GET, 'logout', FILTER_VALIDATE_BOOLEAN);

//unset($_SESSION['cupom']);
//var_dump($_SESSION['carrinho'], $_SESSION['cupom']);
if ($logout):
    unset($_SESSION['clientelogin'], $_SESSION['carrinho'], $_SESSION['preco_total'], $_SESSION['cupom']);
    header('Location: ' . HOME);
endif;
?>

<!-- CONTAINER -->

<!-- HEADER -->	
<header class="header container">
    <h1 class="titulo_principal">Cardi Tapetes - A Sua Loja Virtual de Tapetes</h1>

    <div class="mensagem_carrinho_ajax j_popup js_opt_cart">
        <div class="content bg-body bloco_mensagem_carrinho al-center">
            <img title="" alt="" src="<?= INCLUDE_PATH ?>/img/check-add-carrinho.png" />
            <h1>Olá! Seu Produto foi adicionado ao carrinho com sucesso!</h1>
            <p>O que deseja fazer?</p>

            <a href="<?= HOME . '/Carrinho/&theme=' . THEME; ?>#carrinho" class="btn btn-green btn_opcoes radius">Ir para o Carrinho</a>
            <a class="btn btn-green btn_opcoes radius j_continuar">Continuar Comprando</a>
            <div class="clear"></div>
        </div>
    </div>

    <!-- BARRA DE LOGIN E LOGOUT MOBILE -->
    <section class="acesso_mobile">
        <h1 class="fontzero">Barra de Entrada da Cooperativa Artesanal Regional de Diamantina</h1>
        <span class="bem_vindo_mob js_opt_cart">

            <?php
            if (!isset($_SESSION['clientelogin']) && empty($_SESSION['clientelogin'])):
                ?>
                <a href="<?= HOME; ?>/Entrar#entrar">Entrar</a>
                <?php
            else:
                echo "Olá {$_SESSION['clientelogin']['cliente_name']}";

            endif;
            ?>

        </span>


        <?php
        if (isset($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin'])):
            ?>

            <div class = "sair_mob">

                <img src = "<?= INCLUDE_PATH ?>/img/logout_mobile.png" title = "" alt = "" />
                <a href = "<?= HOME; ?>/?logout=true"><p>Sair</p></a>
            </div>

            <?php
        endif;
        ?>        
    </section><!-- BARRA DE LOGIN E LOGOUT MOBILE -->



    <div class="js_opt_cart">

        <?php
        if (isset($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin'])):
            ?>

            <article class = "sair">
                <h1 class="fontzero">Sair da Cooperativa Artesanal Regional de Diamantina</h1>
                <img src = "<?= INCLUDE_PATH ?>/img/logout.png" title = "" alt = "" />
                <a href = "<?= HOME; ?>?logout=true">Sair</a>
            </article>

            <?php
        endif;
        ?> 

    </div>

    <!-- HEADER_LOGO -->	
    <article class="header_logo">
        <div class="content">
            <h1 class="fontzero">Cooperativa Artesanal Regional de Diamantina</h1>
            <a title="Cooperativa Artesanal Regional de Diamantina Ltda" href="<?= HOME . '/&theme=' . THEME; ?>">
                <img alt="Cooperativa Artesanal Regional de Diamantina Ltda" title="Cooperativa Artesanal Regional de Diamantina Ltda" src="<?= INCLUDE_PATH; ?>/img/logo_nova3.png">
            </a>

            <div class="clear"></div>
        </div>
    </article><!-- HEADER_LOGO -->	




    <a title="Menu Mobile da Cooperativa Regional de Diamantina" class="mobmenu" href="#" title="Mobile Nav"><span>&#9776;</span></a>





    <!-- BARRA DE MENU E CARRINHO MOBILE -->
    <section class="menu_carrinho_mobile">

        <h1 class="fontzero">Barra de Menu e Carrinho de Compras da Cardi Tapetes Arraiolos e Smyrna</h1>

        <a class="mobmenu" href="#" title="Menu Mobile da Cooperativa Regional de Diamantina">
            <span></span>
            <span></span>
            <span></span>
        </a>

        <article class="carrinho js_opt_cart">
            <h1 class="fontzero">Carrinho de Compras da Cardi Tapetes Arraiolo e Smyrna</h1>
            <a title="Ir para Carrinho de Compras" href="<?= HOME; ?>/Carrinho#carrinho">
                <img title="Carrinho de compras" alt="Carrinho de compras de tapetes" src="<?= INCLUDE_PATH; ?>/img/icone_carrinho.png" />
                <p class="j_subtotal">R$
                    <?php
                    if (isset($_SESSION['preco_total']) && !empty($_SESSION['preco_total'])):

//                            $_SESSION['preco_total'] = number_format($_SESSION['preco_total'], 2, ',', '.');

                        $aux = $_SESSION['preco_total'];

                        echo number_format($aux, 2, ",", ".");
                    else:
                        echo '0,00';
                    endif;
                    ?>

                </p>
            </a>
        </article>
    </section><!-- BARRA DE MENU E CARRINHO MOBILE -->



    <div class="bloco_menu_social">
        <!-- HEADER_MENU -->
        <div class="header_menu">

            <div class="mobile_menu">
                <ul>

                    <li class="link"><a href="<?= HOME . '/&theme=' . THEME; ?>" title="Página inicial da Cooperativa Artesanal Regional de Diamantina Ltda (CARDI)">Início</a></li>
                    <li class="img"><img alt="Divisao do menu" title="[Divisao do menu]" src="<?= INCLUDE_PATH; ?>/img/divisao_menu.jpg"/></li>	
                    <li class="link"><a href="<?= HOME . '/QuemSomos/&theme=' . THEME; ?>#quemsomos" title="O que é a Cooperativa Artesanal Regional de Diamantina">Quem Somos</a></li>
                    <li class="img"><img alt="Divisao do menu" title="[Divisao do menu]" src="<?= INCLUDE_PATH; ?>/img/divisao_menu.jpg"/></li>
                    <li class="link no_mob"><a href="<?= HOME . '/&theme=' . THEME; ?>#tapetes" title="Tapetes dos tipos Smyrna e Arraiolo na Cooperativa Artesanal Regional de Diamantina">Tapetes</a>

                        <ul class="submenu">

                            <li><a class="no_mob" title="Tapetes Arraiolo da Cooperativa Artesanal Regional de Diamantina"  href="<?= HOME . '/tapetes/arraiolo/&theme=' . THEME; ?>#tapetes">Arraiolo</a></li>
                            <li><a class="no_mob" title="Tapetes Smyrna da Cooperativa Artesanal Regional de Diamantina"  href="<?= HOME . '/tapetes/smyrna/&theme=' . THEME; ?>#tapetes">Smyrna</a></li>

                        </ul>	


                    </li>
                    <li class="link mob"><a title="Tapetes Arraiolo da Cooperativa Artesanal Regional de Diamantina" href="<?= HOME . '/tapetes/arraiolo/&theme=' . THEME; ?>#tapetes">Arraiolo</a></li>
                    <li class="link mob"><a title="Tapetes Smyrna da Cooperativa Artesanal Regional de Diamantina"  href="<?= HOME . '/tapetes/smyrna/&theme=' . THEME; ?>#tapetes">Smyrna</a></li>

                    <li class="img"><img alt="[Divisao do menu da Cardi Tapetes]" title="Divisao do menu da Cardi Tapetes" src="<?= INCLUDE_PATH; ?>/img/divisao_menu.jpg"/></li>
                    <li class="link"><a href="<?= HOME . '/FaleConosco/&theme=' . THEME; ?>#fale" title="Fale Conosco da CARDI Tapetes para dúvidas, críticas, sugestões ou encomendas">Fale Conosco</a></li>

                </ul>

            </div>      

        </div><!-- HEADER_MENU -->


        <!-- HEADER_REDES SOCIAIS -->
        <div class="header_redes_sociais">

            <a target="_blank" rel="nofollow" title="Facebook da Cooperativa Atesanal Regional de Diamantina" href="https://www.facebook.com/<?= URL_FACEBOOK ?>/"><img class="facebook" alt="[Facebook da Cooperativa Atesanal Regional de Diamantina]" title="Facebook da Cooperativa Atesanal Regional de Diamantina" src="<?= INCLUDE_PATH; ?>/img/facebook.jpg"/></a>
            <a target="_blank" rel="nofollow" title="Instagram da Cooperativa Atesanal Regional de Diamantina" href="https://www.instagram.com/<?= URL_INSTAGRAM ?>/"><img class="instagram" alt="[Instagram da Cooperativa Atesanal Regional de Diamantina]" title="Instagram da Cooperativa Atesanal Regional de Diamantina" src="<?= INCLUDE_PATH; ?>/img/instagram.jpg"/></a>

        </div><!-- HEADER_REDES SOCIAIS -->

    </div>

    <!-- HEADER_SEARCH -->
    <header class="header_search">



        <?php
        $search = filter_input(INPUT_POST, 's', FILTER_DEFAULT);

        if (!empty($search)):

            $search = strip_tags(trim(urlencode($search)));
            header('Location: ' . HOME . '/pesquisa/' . $search . '#pesquisa');

        endif;
        ?>



        <form id="search" name="search" method="post" action="">

            <input name="s" type="text" placeholder="Encontre aqui o seu tapete"/>

            <button type="submit" name="s_enviar">				
                <img alt="Pesquisar tapetes" title="Pesquisar tapetes" src="<?= INCLUDE_PATH; ?>/img/lupa_search.jpg">
            </button>


        </form>


        <span style="display:none !important;" class="bem_vindo">

            <?php
            if (!isset($_SESSION['clientelogin']) && empty($_SESSION['clientelogin'])):
                ?>
                <a class="entrar js_opt_cart" href="<?= HOME; ?>/Entrar#entrar">Entrar</a>
                <?php
            else:
                echo "Olá {$_SESSION['clientelogin']['cliente_name']}";

            endif;
            ?>

        </span>



        <div style="display:none;" class="carrinho js_opt_cart">
            <a title="Ir para Carrinho de Compras" href="<?= HOME; ?>/Carrinho#carrinho">
                <img title="Carrinho de compras" alt="Carrinho de compras de tapetes" src="<?= INCLUDE_PATH; ?>/img/icone_carrinho.png" />
                <p class="j_subtotal">R$
                    <?php
                    if (isset($_SESSION['preco_total']) && !empty($_SESSION['preco_total'])):

//                            $_SESSION['preco_total'] = number_format($_SESSION['preco_total'], 2, ',', '.');

                        $aux = $_SESSION['preco_total'];

                        echo number_format($aux, 2, ",", ".");
                    else:
                        echo '0,00';
                    endif;
                    ?>

                </p>
            </a>
        </div>

    </header><!-- HEADER_SEARCH -->



    <!-- BANNER MOBILE -->


<!--    <section class="banner_mobile ds-none">
        <h1 class="fontzero">Os melhores tapetes Arraiolos e Smyrna de Diamantina e Região estão aqui na Cardi Tapetes!</h1>

        <article class="img_slide propaganda">

            <img alt="Os melhores tapetes da região" title="Os melhores tapetes da região" src="<?= INCLUDE_PATH; ?>/img/imagem_slide.png" />
            <h1 class="titulo_slide">Aqui você  encontra os melhores tapetes da Região</h1>
            <p class="tagline subtitulo_propaganda">Traga comodidade ao seu ambiente!</p>


        </article>		

    </section>-->



    <!-- BANNER MOBILE -->



    <!-- SLIDE -->
    <section class="slide">



        <header class="fontzero">
            <h1>Aqui é o lugar onde comprar os melhores tapetes Arraiolo e Smyrna de Diamantina e Região</h1>
            <p class="tagline">Compre Aqui! Temos ótimos Preços dos tapetes Arraiolo e Smyrna de Diamantina e Região</p>
        </header>



        <?php
        $readDetalhes = new Read();
        $readDetalhes->ExeRead(PRODUTOS, "WHERE produto_status = 1 AND produto_destaque = 1 AND produto_disponivel = 1");
        if ($readDetalhes->getResult()):
            ?>


            <div id="prev">
                <img alt="Tapete Anterior" title="Anterior" src="<?= INCLUDE_PATH; ?>/img/setaAnterior.png" />
            </div>

            <div id="next">
                <img alt="Próximo Tapete" title="Próximo" src="<?= INCLUDE_PATH; ?>/img/setaProximo.png" />
            </div>

            <nav>
                <h1 class="fontzero">Venda Online de Tapetes Arraiolos e Smyrna</h1>

                <ul>

                    <li>

                        <div class="dummy">
                            <img  alt="[Venda Online de Tapetes Arraiolos e Smyrna]" title="Venda Online de Tapetes Arraiolos e Smyrna" src="<?= INCLUDE_PATH; ?>/img/dummy.jpg"/>
                        </div>
                    </li>


                    <li>	


                        <article class="img_slide propaganda">

                            <span class="sombra"></span>

                            <h1 class="fontzero">Confira a Nossa Loja Virtual de Tapetes e Encontre os Melhores Tapetes Arraiolos e Smyrna de Diamantina e Região</h1>

                            <img title="Venda Online de tapetes arraiolo e smyrna da Cooperativa Artesanal Regional de Diamantina" alt="[Venda Online de tapetes arraiolo e smyrna da Cooperativa Artesanal Regional de Diamantina]" src="<?= HOME; ?>/uploads/home-reduzido.jpg" />

                            <h1 class="titulo_slide titulo_slide_propaganda">Na Nossa Loja Virtual Você Encontra os Melhores Tapetes da Região</h1>
                            <p class="tagline">Traga comodidade ao seu ambiente!</p>


                        </article>		
                    </li>


                    <?php
                    $readCat = new Read();

                    foreach ($readDetalhes->getResult() as $destaque):
                        extract($destaque);
                        $readCat->ExeRead(CATEGORIAS, "WHERE category_id = :cat", "cat={$produto_categoria}");
                        ?>
                        <li>	
                            <article class="img_slide" itemscope itemtype="https://schema.org/Event">

                                <span class="sombra"></span>

                                <header class="fontzero">
                                    <h1>Confira a Nossa Loja Virtual de Tapetes e Encontre os Melhores Tapetes Arraiolos e Smyrna de Diamantina e Região</h1>
                                    <p class="tagline">Confira os preços dos tapetes arraiolos e smyrna por metro quadrado</p>
                                </header>




                                <img class="img_destaque" alt="[Confira os preços dos tapetes arraiolos e smyrna por metro quadrado da Cooperativa Artesanal Regional de Diamantina]" title="Confira os preços dos tapetes arraiolos e smyrna por metro quadrado da Cooperativa Artesanal Regional de Diamantina" src="<?= HOME; ?>/uploads/<?= $produto_image; ?>" />
                                <!--<img class="img_destaque" alt="[Confira os preços dos tapetes arraiolos e smyrna por metro quadrado da Cooperativa Artesanal Regional de Diamantina]" title="Confira os preços dos tapetes arraiolos e smyrna por metro quadrado da Cooperativa Artesanal Regional de Diamantina" src="<?= HOME; ?>/tim.php?src=<?= HOME; ?>uploads/<?= $produto_image; ?>&w=1149&h=585" />-->
                                <h1 class="titulo_slide"><span itemprop="name"> <?= $produto_title; ?> </span> <span <?= (!empty($produto_desconto) ? 'class="ds-none"' : ''); ?>>por</span> <br> </h1>
        <!--                                        <span class="preco_slide font-bold">R$ <?= number_format($produto_valor, 2, ',', '.'); ?></span> o m<sup>2</sup>-->

                                <h1 class="titulo_slide_precos <?= (empty($produto_desconto) ? 'titulo_slide_precos_no_desconto' : ''); ?>"><?= (!empty($produto_desconto) ? '<small class="preco_slide valor_anterior m-top1"> De: <del>R$ ' . number_format($produto_valor, 2, ',', '.') . '</del> o m<sup>2</sup></small><span class="preco_slide valor_atual"><span class="valor_atual_digitos">Por: R$ ' . number_format($produto_valor_descontado, 2, ',', '.') . ' o m<sup>2</sup></span></span><p class="m-bottom1 fl-left js_opt_cart ate-12x">Até em 12x no cartão</p>' : '<span class="preco_slide preco_no_desconto font-bold">R$ ' . number_format($produto_valor, 2, ',', '.') . ' o m<sup>2</sup></span><div class="container"></div><p class="m-bottom1 fl-left js_opt_cart ate-12x-no-desconto">Até em 12x no cartão</p>'); ?></h1>


                                <span itemprop="offer" itemscope itemtype="https://schema.org/Offer">
                                    <meta itemprop="price" content="R$ <?= $produto_valor; ?>" />
                                    <meta itemprop="priceCurrency" content="BRL" />    
                                </span>                                        
                                <p class="tagline btn btn-green radius btn_comprar_destaque js_opt_cart <?= (!empty($produto_desconto) ? 'btn_comprar_destaque_desconto' : ''); ?>" ><a href="<?= HOME . '/Detalhes/' . $produto_name. '/&theme=' . THEME; ?>&produtoid=<?= $produto_id; ?>#detalhes">Compre já!</a></p>
                            </article>	
                        </li>

                        <?php
                    endforeach;

                endif;
                ?>

            </ul>

        </nav>

    </section><!-- SLIDE -->
</header><!-- HEADER -->
<main>

