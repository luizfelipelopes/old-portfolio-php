<div id="j_content">

    <span class="pagina_principal fontzero">Nutricionista Low Carb</span>

    <?php
    if (SLIDES_APP == '1'):
        include './_cdn/app_slides/slides-post.inc.php';
    endif;

    if (LEADS_HORIZONTAL_HOME == '1'):

        include './_cdn/app_forms/form_horizontal.inc.php';

    endif;
    ?>

    <div class="corpo-blog">

        <?php
        if (POSTS_APP == '1' && POSTS_APP_LISTA == '1'):
            include './_cdn/app_posts/posts-lista.inc.php';
        endif;

        if (POSTS_APP == '1' && POSTS_APP_LISTA_MENOR == '1'):
            include './_cdn/app_posts/posts-lista-menor.inc.php';
        endif;

        if (POSTS_APP == '1' && POSTS_APP_BLOCOS == '1'):
            ?>

            <div class="container">

                <?php include './_cdn/app_posts/ultimos-posts.inc.php'; ?>   

            </div>

            <!--<div class="posts_sobre">-->
            <div style="float: <?= (SIDEBAR_HOME_LEFT == '1' ? 'right' : (SIDEBAR_HOME_RIGHT == '1' ? 'left' : '')); ?>;" class="posts-embaixo">
                <?php include './_cdn/app_posts/posts-embaixo.inc.php'; ?>   
            </div>

            <?php
        endif;
        ?>

        <div class="bloco-sobre <?= (SIDEBAR_HOME_LEFT == '1' ? 'fl-left' : (SIDEBAR_HOME_RIGHT == '1' ? 'fl-right' : '')); ?> m-top3">
            <?php
            include 'inc/sobre.inc.php';
            ?>

            <div class="container m-bottom3"></div>

            <?php if (LEADS_SIDEBAR_HOME == '1'): ?>

                <aside class="post_lateral">
                    <?php
                    include './_cdn/app_forms/form_vertical.inc.php';
                    ?>
                </aside>

            <?php endif; ?>

            <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_SEGUIDORES_PERSONALIZADO_HOME == '1'): ?>

                <aside class="post_lateral">
                    <?php
                    include './_cdn/app_sociais/plugin-facebook.inc.php';
                    ?>
                </aside>

            <?php endif; ?>

            <?php if (YOUTUBE_APP_HOME == '1'): ?>

                <aside class="post_lateral">
                    <?php
                    include './_cdn/app_sociais/plugin-youtube.inc.php';
                    ?>
                </aside>

            <?php endif; ?>


            <?php
            if (POSTS_APP == '1' && POSTS_APP_MAIS_VISTOS_HOME == '1'):
                ?>
                <aside class="post_lateral_app no-padding m-top3">
                    <?php
                    include './_cdn/app_posts/posts-mais-vistos.inc.php';
                    ?>
                </aside>
                <?php
            endif;
            ?>

            <?php
            if (POSTS_APP == '1' && POSTS_APP_MAIS_RECENTES_HOME == '1'):
                ?>
                <aside class="post_lateral_app no-padding">
                    <?php
                    include './_cdn/app_posts/posts-mais-recentes.inc.php';
                    ?>
                </aside>
                <?php
            endif;
            ?>

            <?php
            if (FACEBOOK_APP == '1' && FACEBOOK_APP_TIMELINE_HOME == '1'):
                ?>
                <section class="post_lateral_app">
                    <?php
                    include './_cdn/app_sociais/plugin-facebook-timeline.php';
                    ?>
                </section>
                <?php
            endif;
            ?>

            <?php
            if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_SIDEBAR_HOME == '1'):
                ?>
                <section class="container m-bottom3 m-top3">
                    <?php
                    include './_cdn/app_sociais/plugin-instagram-vertical.inc.php';
                    ?>
                </section>
                <?php
            endif;
            ?>

            <?php
            if (PUBLICIDADE == '1' && PUBLICIDADE_SIDEBAR_HOME == '1'):
                ?>
                <aside class="post_lateral_app no-padding">
                    <?php
                    include './_cdn/app_publicidade/publicidade-sidebar.inc.php';
                    ?>
                </aside>
                <?php
            endif;
            ?>

            <?php
            if (PUBLICIDADE == '1' && PUBLICIDADE_AFILIADO_HOME == '1'):
                ?>
                <aside class="post_lateral_app no-padding">
                    <?php
                    include './_cdn/app_publicidade/publicidade-afiliado.inc.php';
                    ?>
                </aside>
                <?php
            endif;
            ?>



        </div>
        <!--</div>-->


        <div class="box-line"></div>


        <?php if (POSTS_APP == '1' && POSTS_APP_BLOCOS == '1'): ?>

            <div class="container divisao_mais_vistos fl-left">

                <?php
                include './_cdn/app_posts/ultimos-posts-baixo.inc.php';


                $readCountPost = new Read;
                $readCountPost->FullRead("SELECT post_id FROM " . POSTS . " WHERE post_status = 1");
                if ($readCountPost->getRowCount() > 8):
                    ?>

                    <div class="caps-lock mais-posts">
                        <div class="content">
                            <a class="fl-left" href="<?= HOME . DIRECTORY_SEPARATOR . 'posts'; ?>">>>Ver Mais</a>
                        </div>
                    </div>
                    <?php
                endif;
                ?>

            </div>
        <?php endif; ?>



        <?php
        if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_HORIZONTAL_HOME == '1'):
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
        if (PUBLICIDADE == '1' && PUBLICIDADE_HORIZONTAL_HOME == '1'):

            include './_cdn/app_publicidade/publicidade-full-body.inc.php';

        endif;
        ?>


        <?php
        if (POSTS_APP == '1' && POSTS_APP_CATEGORIAS == '1'):
            ?>
            <div class="posts_sobre">
                <?php include './_cdn/app_posts/posts-por-categoria.inc.php'; ?>
            </div>
            <?php
        endif;
        ?>

        <?php // require 'inc/galeria-fotos.inc.php';           ?>
        <?php // require 'inc/galeria-videos.inc.php';          ?>


        <?php if (SLIDES_APP == '1' && SLIDES_APP_ANUNCIANTES == '1'): ?>

            <div class="recados_anunciantes">

                <?php include './_cdn/app_slides/slides-anuncios.inc.php'; ?>

            </div>

        <?php endif; ?>

        <div class="clear"></div>
    </div>
</div>