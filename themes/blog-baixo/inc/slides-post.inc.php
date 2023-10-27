<!--SLIDES-->
<section class="main_slides bg-blue container fl-left" itemscope itemtype="https://schema.org/Event">

    <div class="fundo"></div>
    <div class="slide_controll">
        <div class="slide_nav back round"><</div>
        <div class="slide_nav go round">></div>
    </div>


    <?php
    $dateHoje = date("Y-m-d H:i:s");
    $readPost = new Read();
    $readPost->ExeRead(POSTS, "WHERE post_status = 1 AND post_date <= :date ORDER BY post_date DESC LIMIT :limit", "limit=1&date={$dateHoje}");
    if (!$readPost->getResult()):
        WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);
    else:
        foreach ($readPost->getResult() as $post):

            extract($post);
            ?>

            <article class="slide_item slide_post first">
                <a class="link" title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                    <picture alt="Gabadi">
        <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                        <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                        <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                        <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                        <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                        <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                        <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                        <img class="m-bottom1" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover ?>" />
                    </picture>
                </a>


                <div class="slide_post_desc m-bottom5">
                    <h1 class="m-bottom1"><a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" itemprop="name"><?= Check::Words($post_title, 15); ?></a></h1>
                    <small class="desc_date fl-left m-bottom1" itemprop="description"><?= date('d/m/Y \à\s H:i', strtotime($post_date)); ?></small>
                    <p class="tagline" itemprop="description"><?= Check::Words($post_content, 45); ?></p>
                </div>

            </article>    


            <?php
        endforeach;
    endif;
    ?>


    <?php
    
    $readPost->ExeRead(POSTS, "WHERE post_status = 1 AND post_date <= :date ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit=3&offset=1&date={$dateHoje}");
    if (!$readPost->getResult()):
//            WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);

    else:

        if ($readPost->getRowCount() > 1):

            foreach ($readPost->getResult() as $post):

                extract($post);
                ?>

                <article class="slide_item slide_post">
                    <a class="link" title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                        <picture alt="Gabadi">
            <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                            <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                            <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                            <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                            <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                            <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                            <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                            <img class="m-bottom1" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover ?>" />
                        </picture>
                    </a>


                    <div class="slide_post_desc m-bottom5">
                        <h1 class="m-bottom1"><a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" itemprop="name"><?= Check::Words($post_title, 15); ?></a></h1>
                        <small class="desc_date fl-left m-bottom1" itemprop="description"><?= date('d/m/Y \à\s H:i', strtotime($post_date)); ?></small>
                        <p class="tagline" itemprop="description"><?= Check::Words($post_content, 45); ?></p>
                    </div>

                </article>    


            <?php
        endforeach;
    endif;

endif;
?>

</section>