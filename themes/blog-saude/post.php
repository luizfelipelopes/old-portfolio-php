<?php
$readPost = new Read;
if (isset($_SESSION['userlogin']['user_id'])):
    $readPost->ExeRead(POSTS, "WHERE post_name = :name", "name={$Link->getLink()}");
else:
    $readPost->ExeRead(POSTS, "WHERE post_name = :name AND post_status = 1", "name={$Link->getLink()}");
endif;

if (!$readPost->getResult()):
    WSErro("Desculpe! Não existe nenhum post com este nome!", WS_INFOR);
else:
    extract($readPost->getResult()[0]);
    if (!isset($_SESSION['userlogin'])):
        $updateView = new Update;
        $updateView->ExeUpdate(POSTS, ['post_views' => ++$post_views], "WHERE post_id = :id", "id={$post_id}");
    endif;
    ?>
    <div itemscope itemtype="https://schema.org/Article">
        <div class="limitador_view">
            <section class="post_conteudo">
                <div class="content">
                    <header>
                        <span class="categoria"><?= BuscaRapida::buscarCategoria($post_category)['category_title']; ?></span>
                        <h1 itemprop="headline"><?= $post_title; ?></h1>
                        <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) ?>">
                        <meta itemprop="image" content="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                        <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                        <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">

                        <span class="ds-none">

                            <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                Por: <span itemprop="name">Luiz Felipe Lopes</span>
                                <meta itemprop="url" content="https://plus.google.com/109917751422031829028">
                            </span>

                            <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                                via <span itemprop="name"><?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?></span>
                                <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img itemprop="url" src="<?= (!empty(BuscaRapida::buscarUsuario($post_author)['user_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . BuscaRapida::buscarUsuario($post_author)['user_cover'] : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo.png'); ?>"></span>
                            </span>

                        </span>

                        <span class="visitas"><?= $post_views; ?> Visitas!</span>

                        <?php
                        if (!empty($post_video)):
                            ?>
                            <div class="container m-bottom1 pd-total video_post">
                                <div class="video no-margin">
                                    <div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/<?= $post_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                                    <!--<div class="ratio js_media js_video_dobra1"></div>-->
                                </div>
                                <div class="clear"></div>
                            </div>
                            <?php
                        else:
                            ?>
                            <div class="box_imagem">
                                <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                            </div>
                        <?php
                        endif;
                        ?>

                    </header>
                    <div class="icones_social">
                        <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_POST == '1'): ?>
                            <div class="btn_like">
                                <div class="fb-like" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="<?= (FACEBOOK_APP_POST_COMPARTILHAR == '1' ? 'true' : 'false'); ?>"></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <p class="post_autor">Escrito por <?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?> em <?= date('d/m/Y \à\s H:i'); ?></p>

                    <div class="subtitulo m-bottom3"><p><?= $post_subtitle; ?></p></div>
                    <span itemprop="articleBody"><?= $post_content; ?></span>

                    <div class="clear"></div>
                </div>
            </section>


            <div class="posts_sidebar m-bottom3">
                <div class="content">


                    <?php if (POSTS_APP_MAIS_VISTOS_POST == '1'): ?>
                        <div class="post_lateral">
                            <?php include '_cdn/app_posts/posts-mais-vistos2.inc.php'; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (POSTS_APP_MAIS_RECENTES_POST == '1'): ?>
                        <div class="post_lateral">
                            <?php include '_cdn/app_posts/posts-mais-recentes2.inc.php'; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (YOUTUBE_APP_POST == '1'): ?>

                        <div class="post_lateral">
                            <?php include './_cdn/app_sociais/plugin-youtube2.inc.php'; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_SEGUIDORES_PERSONALIZADO_POST == '1'): ?>

                        <div class="post_lateral">
                            <?php include './_cdn/app_sociais/plugin-facebook2.inc.php'; ?>
                        </div>

                    <?php endif; ?>

                    <?php if (LEADS_SIDEBAR_POST == '1'): ?>

                        <div class="post_lateral_app no-padding">
                            <?php include './_cdn/app_forms/form_vertical.inc.php'; ?>
                        </div>

                    <?php endif; ?>

                    <?php
                    if (PUBLICIDADE == '1' && PUBLICIDADE_SIDEBAR_POST == '1'):
                        ?>
                        <div class="post_lateral_app no-padding">
                            <?php
                            include './_cdn/app_publicidade/publicidade-sidebar.inc.php';
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if (PUBLICIDADE == '1' && PUBLICIDADE_AFILIADO_POST == '1'):
                        ?>
                        <div class="post_lateral_app no-padding">
                            <?php
                            include './_cdn/app_publicidade/publicidade-afiliado.inc.php';
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>

                    <?php
                    if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_SIDEBAR_POST == '1'):
                        ?>
                        <div class="post_lateral_app no-padding">
                            <?php
                            include './_cdn/app_sociais/plugin-instagram-vertical.inc.php';
                            ?>
                        </div>
                        <?php
                    endif;
                    ?>



                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <?php
        if (PUBLICIDADE == '1' && PUBLICIDADE_HORIZONTAL_POST == '1'):

            include './_cdn/app_publicidade/publicidade-full-body.inc.php';
            ?>

<!--            <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
            <script>
                (adsbygoogle = window.adsbygoogle || []).push({
                    google_ad_client: "ca-pub-1957511375295893",
                    enable_page_level_ads: true
                });
            </script>-->

            <?php
        endif;
        ?>


        <?php
        if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_HORIZONTAL_POST == '1'):
            ?>
            <section class="container m-bottom3">
                <?php
                include './_cdn/app_sociais/plugin-instagram-horizontal.inc.php';
                ?>
            </section>
            <?php
        endif;
        ?>

        <?php
        if (FACEBOOK_APP == '1' && FACEBOOK_APP_COMENTARIOS == '1'):

            include './_cdn/app_sociais/plugin-facebook-comentarios.php';

        endif;
        ?>

                                                                            <!--<div class="fb-comments" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100%" data-numposts="10"></div>-->
        <?php
        if (COMENTARIOS_APP == '1'):
            include '_cdn/app_comentarios/comentario-post2.inc.php';
        endif;
        ?>

    </div>

    <?php
    if (POSTS_APP == '1' && POSTS_APP_RELACIONADOS == '1'):
        include '_cdn/app_posts/posts-relacionados2.inc.php';
    endif;
    ?>

<?php
endif;
?>