<!--SLIDES-->
<section class="main_slides container fl-left" itemscope itemtype="https://schema.org/Event">

    <div class="slide_controll">
        <div class="slide_nav back bg-light round"><</div>
        <div class="slide_nav go bg-light round">></div>
    </div>

    <!--        <article class="slide_item first">
                <a class="link" title="GabaNight da Virada" href="<?= HOME . DIRECTORY_SEPARATOR . 'gabanight-da-virada'; ?>">
                    <picture alt="Gabadi">
                                    <source media="(min-width:1600px)" srcset="tim.php?src=img/pc.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/pc.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/pc.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/pc.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/pc.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/pc.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/pc.jpg&w=480&h=300" />
                        <img title="GabaNight da Virada!" alt="[GabaNight da Virada!]" src="<?= INCLUDE_PATH; ?>/img/gabanight.jpeg" />
                    </picture>
                </a>
    
    
                <div class="slide_item_desc">
                    <h1><a title="GabaNight da Virada!" href="<?= HOME . DIRECTORY_SEPARATOR . 'gabanight-da-virada'; ?>" itemprop="name">GabaNight da Virada!</a></h1>
                    <p class="tagline" itemprop="description">Compre Aqui o Seu Ingresso!</p>
                </div>
    
            </article>    -->

    <?php
    $readPost = new Read();
    $readPost->ExeRead("gabadi_posts", "WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit", "limit=1");
    if (!$readPost->getResult()):
        WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);
    else:
        foreach ($readPost->getResult() as $post):

            extract($post);
            ?>

            <article class="slide_item first">
                <a class="link" title="<?= $post_title; ?>" href="#">
                    <picture alt="Gabadi">
        <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover ?>" />
                    </picture>
                </a>


                <div class="slide_item_desc">
                    <h1><a title="<?= $post_title; ?>" href="#" itemprop="name"><?= $post_title; ?></a></h1>
                    <p class="tagline" itemprop="description"><?= $post_subtitle; ?></p>
                </div>

            </article>    


            <?php
        endforeach;
    endif;
    ?>


    <?php
    $readPost->ExeRead("gabadi_posts", "WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit=3&offset=1");
    if (!$readPost->getResult()):
        WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);
    else:
        foreach ($readPost->getResult() as $post):

            extract($post);
            ?>

            <article class="slide_item">
                <a class="link" title="Sem Fé é Impossível Agradar a Deus!" href="#">
                    <picture alt="Gabadi">
        <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover ?>" />
                    </picture>
                </a>


                <div class="slide_item_desc">
                    <h1><a title="<?= $post_title; ?>" href="#" itemprop="name"><?= $post_title; ?></a></h1>
                    <p class="tagline" itemprop="description"><?= $post_subtitle; ?></p>
                </div>

            </article>    


            <?php
        endforeach;
    endif;
    ?>

    <!--        <article class="slide_item">
                <a class="link" title="" href="">
                    <picture alt="Gabadi">
                                    <source media="(min-width:1600px)" srcset="tim.php?src=img/karaoke.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/karaoke.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/karaoke.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/karaoke.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/karaoke.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/karaoke.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/karaoke.jpg&w=480&h=300" />
                        <img title="Gabadi Cantina!" alt="[Gabadi Cantina!]" src="<?= INCLUDE_PATH; ?>/img/karaoke.jpg" />
                    </picture>
                </a>
    
    
                <div class="slide_item_desc">
                    <h1><a title="Gabadi Cantina!" href="#" itemprop="name">Gabadi Cantina!</a></h1>
                    <p class="tagline" itemprop="description">Salgados e Karaokê Na Cantina!</p>
                </div>
    
            </article>-->



    <!--        <article class="slide_item">
                <a class="link" title="O Cristão Vive de Relacionamentos!" href="#">
                    <picture alt="Gabadi">
                                    <source media="(min-width:1600px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/temaGabadi2.jpg&w=480&h=300" />
                        <img title="O Cristão Vive de Relacionamentos!" alt="[O Cristão Vive de Relacionamentos!]" src="<?= INCLUDE_PATH; ?>/img/temaGabadi2.jpg" />
                    </picture>
                </a>
    
    
                <div class="slide_item_desc">
                    <h1><a title="O Cristão Vive de Relacionamentos!" href="#" itemprop="name">O Cristão Vive de Relacionamentos!</a></h1>
                    <p class="tagline" itemprop="description">Oh Quão Bom Que Os Irmãos Vivam em União!</p>
                </div>
    
            </article>    -->




</section>