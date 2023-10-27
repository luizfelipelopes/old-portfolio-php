<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box m-bottom3" id="j_content">
    <?php
    $readPag = new Read();
    $readPag->ExeRead("gabadi_paginas", "WHERE pagina_name = :name", "name={$Link->getLocal()[0]}");
    if (!$readPag->getResult()):
        WSErro("Ainda Não Existe Conteúdo Para Esta Página", WS_INFOR);
    else:
        extract($readPag->getResult()[0]);
        ?>


        <header class="bg-blue_marinho al-center no-margin header_page">
            <div class="content">
                <h1 class="caps-lock m-bottom1 fontsize1b"><?= $pagina_title ?></h1>
                <p class="tagline"><?= $pagina_desc; ?></p>
                <div class="clear"></div>
            </div>
        </header>


        <div class="banner container bg-gray ds-none">
            <a title="" href="">
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
            </a>
        </div>    

        <div class="separator fl-left m-bottom3"></div>


        <div class="content content_category content_equipe" itemscope itemtype="https://schema.org/Person">

            <article class="box equipe_box boxshadow">
                <img itemprop="image" class="round fl-left" title="Nilma Nayara Neves" alt="[Nilma Nayara Neves]" src="<?=INCLUDE_PATH?>/img/foto-autora.jpg" />
                <div class="equipe_descricao fl-right">
                    <h1 itemprop="name">Nilma Nayara Neves</h1>
                    <p itemprop="description"><span itemprop="jobtitle">Nutricionista</span> Carlos Eduardo exerce o ministério da pregação da Santa Palavra de Deus na <span itemprop="affiliation">1ª Igreja Batista em Diamantina</span>. Bacharel em Teologia e radialista.</p>
                    <a class="shorticon shorticon-facebook" target="_blank" title="Facebook do Nilma Nayara Neves" href="https://www.facebook.com/nutricionistalowcarb">/nutricionistalowcarb</a>
                    <a class="shorticon shorticon-mail" target="_blank" title="Email da Nilma Nayara Neves" href="<mailto:nilma.nayara@yahoo.com.br>">nilma.nayara@yahoo.com.br</a>
                </div>
            </article>

<!--            <article class="box equipe_box boxshadow">
                <img itemprop="image" class="round fl-left" title="Pr. Kadu Carvalho" alt="[Pr. Kadu Carvalho]" src="<?= INCLUDE_PATH; ?>/img/perfilKadu.jpg" />
                <div class="equipe_descricao fl-right">
                    <h1 itemprop="name">Pr. Kadu Carvalho</h1>
                    <p itemprop="description"><span itemprop="jobtitle">Pastor</span> Carlos Eduardo exerce o ministério da pregação da Santa Palavra de Deus na <span itemprop="affiliation">1ª Igreja Batista em Diamantina</span>. Bacharel em Teologia e radialista.</p>
                    <a class="shorticon shorticon-facebook" target="_blank" title="Facebook do Pr. Kadu Carvalho" href="https://www.facebook.com/kaducarvalho">/kaducarvalho</a>
                    <a class="shorticon shorticon-mail" target="_blank" title="Email do Pr. Kadu Carvalho" href="<mailto:batistadiamantina@hotmail.com>">batistadiamantina@hotmail.com</a>
                </div>
            </article>

            <article class="box equipe_box boxshadow">
                <img itemprop="image" class="round fl-left" title="Pr. Kadu Carvalho" alt="[Pr. Kadu Carvalho]" src="<?= INCLUDE_PATH; ?>/img/perfilKadu.jpg" />
                <div class="equipe_descricao fl-right">
                    <h1 itemprop="name">Pr. Kadu Carvalho</h1>
                    <p itemprop="description"><span itemprop="jobtitle">Pastor</span> Carlos Eduardo exerce o ministério da pregação da Santa Palavra de Deus na <span itemprop="affiliation">1ª Igreja Batista em Diamantina</span>. Bacharel em Teologia e radialista.</p>
                    <a class="shorticon shorticon-facebook" target="_blank" title="Facebook do Pr. Kadu Carvalho" href="https://www.facebook.com/kaducarvalho">/kaducarvalho</a>
                    <a class="shorticon shorticon-mail" target="_blank" title="Email do Pr. Kadu Carvalho" href="<mailto:batistadiamantina@hotmail.com>">batistadiamantina@hotmail.com</a>
                </div>
            </article>

            <article class="box equipe_box boxshadow">
                <img itemprop="image" class="round fl-left" title="Pr. Kadu Carvalho" alt="[Pr. Kadu Carvalho]" src="<?= INCLUDE_PATH; ?>/img/perfilKadu.jpg" />
                <div class="equipe_descricao fl-right">
                    <h1 itemprop="name">Pr. Kadu Carvalho</h1>
                    <p itemprop="description"><span itemprop="jobtitle">Pastor</span> Carlos Eduardo exerce o ministério da pregação da Santa Palavra de Deus na <span itemprop="affiliation">1ª Igreja Batista em Diamantina</span>. Bacharel em Teologia e radialista.</p>
                    <a class="shorticon shorticon-facebook" target="_blank" title="Facebook do Pr. Kadu Carvalho" href="https://www.facebook.com/kaducarvalho">/kaducarvalho</a>
                    <a class="shorticon shorticon-mail" target="_blank" title="Email do Pr. Kadu Carvalho" href="<mailto:batistadiamantina@hotmail.com>">batistadiamantina@hotmail.com</a>
                </div>
            </article>

            <article class="box equipe_box boxshadow">
                <img itemprop="image" class="round fl-left" title="Pr. Kadu Carvalho" alt="[Pr. Kadu Carvalho]" src="<?= INCLUDE_PATH; ?>/img/perfilKadu.jpg" />
                <div class="equipe_descricao fl-right">
                    <h1 itemprop="name">Pr. Kadu Carvalho</h1>
                    <p itemprop="description"><span itemprop="jobtitle">Pastor</span> Carlos Eduardo exerce o ministério da pregação da Santa Palavra de Deus na <span itemprop="affiliation">1ª Igreja Batista em Diamantina</span>. Bacharel em Teologia e radialista.</p>
                    <a class="shorticon shorticon-facebook" target="_blank" title="Facebook do Pr. Kadu Carvalho" href="https://www.facebook.com/kaducarvalho">/kaducarvalho</a>
                    <a class="shorticon shorticon-mail" target="_blank" title="Email do Pr. Kadu Carvalho" href="<mailto:batistadiamantina@hotmail.com>">batistadiamantina@hotmail.com</a>
                </div>
            </article>

            <article class="box equipe_box boxshadow">
                <img itemprop="image" class="round fl-left" title="Pr. Kadu Carvalho" alt="[Pr. Kadu Carvalho]" src="<?= INCLUDE_PATH; ?>/img/perfilKadu.jpg" />
                <div class="equipe_descricao fl-right">
                    <h1 itemprop="name">Pr. Kadu Carvalho</h1>
                    <p itemprop="description"><span itemprop="jobtitle">Pastor</span> Carlos Eduardo exerce o ministério da pregação da Santa Palavra de Deus na <span itemprop="affiliation">1ª Igreja Batista em Diamantina</span>. Bacharel em Teologia e radialista.</p>
                    <a class="shorticon shorticon-facebook" target="_blank" title="Facebook do Pr. Kadu Carvalho" href="https://www.facebook.com/kaducarvalho">/kaducarvalho</a>
                    <a class="shorticon shorticon-mail" target="_blank" title="Email do Pr. Kadu Carvalho" href="<mailto:batistadiamantina@hotmail.com>">batistadiamantina@hotmail.com</a>
                </div>
            </article>-->


        <?php
        endif;
        ?>

        <div class="clear"></div>
    </div>   
</section>
