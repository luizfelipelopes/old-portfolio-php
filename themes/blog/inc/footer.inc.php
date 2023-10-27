</main>

<footer class="container main_footer">

    <section class="bg-green antirodape" itemscope itemtype="https://schema.org/Organization">

        <span class="ds-none">
            <meta itemprop="sameAs" content="<?= HOME; ?>"/>
            <span itemprop="description">A 1ª Igreja Batista em Diamantina já está a mais de 40 anos pregando o Evangelho em Diamantina e no Vale do Jequitinhonha. 
                Dentro desse ministério foi criado a <span itemprop="name">GABADI – Galera Batista de Diamantina </span> – esse grupo formado pela mocidade da igreja que 
                se organiza todos os sábados para poderem cultuar a Deus. A Gabadi também se organiza em eventos sociais e esportivos, através 
                de grupos de evangelismo, prática de esportes e ações de caráter solidário. Atualmente o presidente da Gabadi é o 
                Pr. Carlos Eduardo de Carvalho, que exerce a função desde janeiro de 2010. Com a criação do nosso site, temos a oportunidade de 
                divulgar os nossos trabalhos afim de levantar mais parceiros nessa jornada, também pregar o Evangelho através da nossa Web rádio 
                e estudos postados. Conheça também as nossas reuniões, todos os sábados em um dos templos da 1ª Igreja Batista em Diamantina. 
                Venha e traga seus amigos para ouvirem a Palavra de Deus, fazer novas amizades e fortalecer as antigas.</span>
        </span>


        <div class="content">

            <h1 class="fontzero">Mande-nos uma Mensagem e Nos Siga Nas Redes Sociais</h1> 

            <div class="redes_sociais">

                <!--                <div class="app_face">
                                    <div class="fb-like-box" data-href="https://www.facebook.com/gabadioficial" data-colorscheme="light" data-show-faces="true" data-header="false" data-stream="false" data-show-border="false"></div>
                                </div>-->


                <?php if (REDES_SOCIAIS == '1'): ?>
                    <nav class="main_footer_social" itemprop="sameAs" itemscope itemtype="https://schema.org/URL">
                        <header>
                            <span>Redes Sociais</span>
                            <div class="form-barra"></div>
                        </header>

                        <ul class="m-bottom3">
                            <?php if (REDE_SOCIAL_INSTA == '1'): ?>
                                <li><a itemprop="url" class="shorticon shorticon-instagram" target="_blank" rel="nofollow" title="<?= SITENAME ?> no Instagram" href="https://www.instagram.com/<?= URL_INSTAGRAM; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (REDE_SOCIAL_FB == '1'): ?>
                                <li><a itemprop="url" class="shorticon shorticon-facebook" target="_blank" rel="nofollow" title="<?= SITENAME ?> no Facebook" href="https://www.facebook.com/<?= URL_FACEBOOK; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (REDE_SOCIAL_YT == '1'): ?>
                                <li><a itemprop="url" class="shorticon shorticon-youtube" target="_blank" rel="nofollow" title="<?= SITENAME ?> no Youtube" href="https://www.youtube.com/channel/<?= URL_YOUTUBE; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (REDE_SOCIAL_TW == '1'): ?>
                                <li><a itemprop="url" class="shorticon shorticon-twitter" target="_blank" rel="nofollow" title="<?= SITENAME ?> no Twitter" href="https://twitter.com/<?= URL_TWITTER; ?>"></a></li>
                            <?php endif; ?>

                            <?php if (REDE_SOCIAL_LN == '1'): ?>
                                <li><a itemprop="url" class="shorticon shorticon-linkedin" target="_blank" rel="nofollow" title="<?= SITENAME ?> no Linkedin" href="https://www.linkedin.com/in/<?= URL_LINKEDIN; ?>"></a></li>
                            <?php endif; ?>
                        </ul>
                    </nav> 

                <?php endif; ?>


                <?php
                if (FACEBOOK_APP == '1' && FACEBOOK_APP_TIMELINE_FOOTER == '1'):
                    ?>
                    <section class="container">
                        <?php
                        include './_cdn/app_sociais/plugin-facebook-timeline.php';
                        ?>
                    </section>
                    <?php
                endif;
                ?>


                <?php
                if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_SIDEBAR_FOOTER == '1'):
                    ?>
                    <section class="fl-left no-padding">
                        <?php
                        include './_cdn/app_sociais/plugin-instagram-vertical.inc.php';
                        ?>
                    </section>
                    <?php
                endif;
                ?>

                <?php
                if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_HORIZONTAL_FOOTER == '1'):
                    ?>
                    <section class="container m-bottom3">
                        <?php
                        include './_cdn/app_sociais/plugin-instagram-horizontal.inc.php';
                        ?>
                    </section>
                    <?php
                endif;
                ?>



            </div>



            <?php include 'formulario-contato.inc.php'; ?>



            <div class="clear"></div>
        </div>


    </section>


    <div class="copy">
        <a title="Gabadi Online" href="<?= HOME . '/&theme=' . THEME; ?>" class="site">nutrilowcarb.com</a>
        <p class="assinatura">Desenvolvido por <a rel="nofollow" target="_blank" title="Desenvolvido por Luiz Felipe Lopes" href="https://www.linkedin.com/in/luizfelipelopes/">Luiz Felipe Lopes</a></p>
    </div>


</footer>

</body>
</html>
