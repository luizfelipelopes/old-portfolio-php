<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box m-bottom3" id="j_content">
<script src="_cdn/jquery.js"></script>
<script src="_cdn/shadowbox/shadowbox.js"></script>
<script src="_cdn/scripts.js"></script>

    <?php
    $readPag = new Read();
    $readPag->ExeRead(PAGINAS, "WHERE pagina_name = :name", "name={$Link->getLocal()[0]}");
    if (!$readPag->getResult()):
        WSErro("Ainda Não Existe Conteúdo Para Esta Página", WS_INFOR);
    else:
        extract($readPag->getResult()[0]);
        ?>

        <header class="bg-blue_marinho al-center no-margin">
            <div class="content">
                <h1 class="caps-lock m-bottom1 fontsize1b"><?= $pagina_title ?></h1>
                <p class="tagline"><?= $pagina_desc; ?></p>
                <div class="clear"></div>
            </div>
        </header>


        <div class="banner container bg-gray ds-none">
                <picture alt="Gabadi">
        <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                    <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                    <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                    <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                    <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                    <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                    <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                    <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/temaGabadi2.jpg" />
                </picture>
        </div>    

        <div class="separator fl-left m-bottom3"></div>


        <div class="content content_category">

            <article class="box foto_box">
                <h1 class="fontzero">Foto 1</h1>
                    <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <a title="" href="<?= INCLUDE_PATH; ?>/img/galeria01.jpg" rel="shadowbox[gb]"><img title="Galeria 01" alt="[Galeria 01]" src="<?= INCLUDE_PATH; ?>/img/galeria01.jpg" /></a>
                    </picture>
            </article>

            <article class="box foto_box">
                <h1 class="fontzero">Foto 2</h1>
                    <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <a title="" href="<?= INCLUDE_PATH; ?>/img/galeria02.jpg" rel="shadowbox[gb]"><img title="Galeria 02" alt="[Galeria 02]" src="<?= INCLUDE_PATH; ?>/img/galeria02.jpg" /></a>
                    </picture>
            </article>

            <article class="box foto_box">
                <h1 class="fontzero">Foto 3</h1>
                    <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <a title="" href="<?= INCLUDE_PATH; ?>/img/galeria03.jpg" rel="shadowbox[gb]"><img title="Galeria 03" alt="[Galeria 03]" src="<?= INCLUDE_PATH; ?>/img/galeria03.jpg" /></a>
                    </picture>
            </article>

            <article class="box foto_box">
                <h1 class="fontzero">Foto 4</h1>
                    <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <a title="" href="<?= INCLUDE_PATH; ?>/img/galeria04.jpg" rel="shadowbox[gb]"><img title="Galeria 04" alt="[Galeria 04]" src="<?= INCLUDE_PATH; ?>/img/galeria04.jpg" /></a>
                    </picture>
            </article>


            <article class="box foto_box">
                <h1 class="fontzero">Foto 4</h1>
                    <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <a title="" href="<?= INCLUDE_PATH; ?>/img/galeria05.jpg" rel="shadowbox[gb]"><img title="Galeria 05" alt="[Galeria 05]" src="<?= INCLUDE_PATH; ?>/img/galeria05.jpg" /></a>
                    </picture>
            </article>


            <article class="box foto_box last">
                <h1 class="fontzero">Foto 4</h1>
                    <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <a title="" href="<?= INCLUDE_PATH; ?>/img/galeria06.jpg" rel="shadowbox[gb]"><img title="Galeria 06" alt="[Galeria 06]" src="<?= INCLUDE_PATH; ?>/img/galeria06.jpg" /></a>
                    </picture>
            </article>


        <?php
        endif;
        ?>

        <div class="clear"></div>
    </div>   
        
</section>

