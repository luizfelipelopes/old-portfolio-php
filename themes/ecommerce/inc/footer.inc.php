<div class="clear"></div><!-- CLEAR -->
</main>
<!-- FOOTER -->
<footer class="footer">

    <!-- ANTIRODAPE -->
    <section class="antirodape">

        <h1 class="fontzero">Confira aqui as formas de pagamento e os contatos da Cardi Tapetes</h1>

        <article class="formas_pagamento">
            <div class="cabecalho_pagamento">
                <!--<img class="icone_cartao" alt="[Pague os seus tapetes com cartão de crédito ou boleto bancário]" title="Pague os seus tapetes com cartão de crédito ou boleto bancário" src="<?= INCLUDE_PATH; ?>/img/icone_pagamento.jpg" />-->
                <h1>Formas de Pagamento</h1>
            </div>
            <!--<img class="divisao" src="<?= INCLUDE_PATH; ?>/img/divisao_antirodape.png" />-->
            <div class="divisao"></div>

            <img class="banner_pagseguro" alt="[Pagamento dos tapetes de forma simpes e segura através do Pagseguro]" title="Pagamento dos tapetes de forma simpes e segura através do Pagseguro" src="<?= INCLUDE_PATH; ?>/img/banner_pagseguro.gif" />

        </article>

        <article class="menu_rodape">

            <h1 class="fontzero">Menu de Rodapé da Cooperativa Artesanal Regional de Dimantina-MG</h1>

            <nav>
                <h1 class="fontzero">Aqui é o Lugar Onde Comprar! - Cooperativa Artesanal Regional de Dimantina-MG</h1>
                <ul>

                    <li><a href="<?= HOME . '/&theme=' . THEME; ?>" title="Página inicial da Cooperativa Artesanal Regional de Diamantina Ltda (CARDI)">Início</a></li>
                    <li><a href="<?= HOME . '/QuemSomos/&theme=' . THEME; ?>#quemsomos" title="O que é a Cooperativa Artesanal Regional de Diamantina">Quem Somos</a></li>
                    <li><a href="<?= HOME . '/&theme=' . THEME; ?>#tapetes" title="Tapetes dos tipos Smyrna e Arraiolo na Cooperativa Artesanal Regional de Diamantina">Tapetes</a></li>
                    <li><a href="<?= HOME . '/FaleConosco/&theme=' . THEME; ?>#fale" title="Fale Conosco da CARDI para dúvidas, críticas, sugestões ou encomendas">Fale Conosco</a></li>

                </ul>

            </nav>

        </article>

        <article class="contatos" itemscope itemtype="https://schema.org/Organization">

            <div class="cabecalho_contatos">
                <!--<img class="icone_balao" alt="Entre em contato conosco para dúvidas, críticas, sugestão ou encomendas de tapetes" title="Entre em contato conosco para dúvidas, críticas, sugestão ou encomendas de tapetes" src="<?= INCLUDE_PATH; ?>/img/icone_contatos.jpg" />-->
                <h1>Contatos</h1>
            </div>

            <!--<img class="divisao" src="<?= INCLUDE_PATH; ?>/img/divisao_antirodape.png" />-->
            <div class="divisao"></div>

            <p class="email"><span class="titulo">Email:</span> <span itemprop="email"><?= EMAIL_EMPRESA; ?></span></p>


            <div class="bloco_telefone">	
                <!--<img class="icone_telefone" alt="[Ligue para a CARDI!]" title="Ligue para a CARDI!" src="<?= INCLUDE_PATH; ?>/img/icone_telefone.jpg" />-->	
                <p class="telefone"><span class="titulo">Telefones:</span> <span itemprop="telephone"><?= TELEFONES_EMPRESA; ?></span></p>
            </div>

            <div class="bloco_endereco" itemscope itemtype="https://schema.org/PostalAddress">	
                <!--<img class="icone_endereco" alt="[Faça-nos uma visita!]" title="Faça-nos uma visita!" src="<?= INCLUDE_PATH; ?>/img/icone_envelope.jpg" />-->	
                <p class="endereco"><span class="titulo">Endereço:</span> <span itemprop="streetAddress"> <?= ENDERECO_EMPRESA; ?></span>  
                    <span itemprop="addressLocality"> <?= CIDADE_EMPRESA; ?> </span> - <span itemprop="addressRegion"><?= UF_EMPRESA; ?></span> <span style="display:none;" itemprop="addressCountry">Brasil</span></p>

                <span itemscope itemtype="https://schema.org/GeoCoordinates">
                    <meta itemprop="latitude" content="-18.241716" />
                    <meta itemprop="longitude" content="-43.603162" />
                </span>

            </div>

        </article>	

    </section><!-- ANTIRODAPE -->

    <!-- RODAPE -->
    <section class="rodape">
        <h1 class="fontzero">O Lugar Perfeito Onde Comprar Seus Tapetes Arraiolo e Smyrna</h1>
        <article class="rodape_txt">
            <h1 class="fontzero">Todos os Direitos do Site Reservados a Cooperativa Artesanal Regional de Diamantina Ltda.</h1>
            <p>© 1977 - <?= date("Y"); ?>: COOPERATIVA ARTESANAL REGIONAL DE DIAMANTINA LTDA. - TODOS OS DIREITOS RESERVADOS</p>
        </article>	

        <article class="rodape_logo">
            <h1 class="fontzero">Cardi Tapetes - Cooperativa Artesanal Regional de Diamantina</h1>
            <a href="<?= HOME . '/&theme=' . THEME; ?>" >
                <img alt="[Cardi Tapetes - Cooperativa Artesanal Regional de Diamantina]" title="Cardi Tapetes - Cooperativa Artesanal Regional de Diamantina" src="<?= INCLUDE_PATH; ?>/img/logo_embaixo.png" />
            </a>
        </article>


    </section><!-- RODAPE -->

    <!-- CLEAR -->


</footer><!-- FOOTER -->

<?php require 'fs_track.php'; ?>
</body>
</html>