<?php
//$_SESSION['clientelogin'] = [
//    "cliente_cover" => '/comentarios/2017/11/fire-2016.jpg',
//    "cliente_name" => "Fulano",
//    "cliente_lastname" => "Cicranildes",
//    "cliente_email" => "lfelipelopesti@gmail.com",
//    "cliente_cidade" => "1",
//    "cliente_uf" => "2"
//];
//$_SESSION['userlogin'] = [
//    "user_foto" => '/comentarios/2017/11/fire-2016.jpg',
//    "user_name" => "Fulano",
//    "user_lastname" => "Cicranildes",
//    "user_email" => "lfelipelopesti@gmail.com",
//    "user_cidade" => "1",
//    "user_uf" => "2"
//];
//unset($_SESSION['clientelogin']);
//unset($_SESSION['userlogin']);

if (COMENTARIOS_APP == '1'):
    unset($_SESSION['usercomentario']);
endif;
?>

<!--POSTS MAIS VISTOS-->
<section class="container posts_box m-bottom3 single no-margin" id="j_content">


    <?php
    $read = new Read();

    if (isset($_SESSION['userlogin']['user_id'])):
        $read->ExeRead(POSTS, "WHERE post_name = :name", "name={$Url[0]}");
    else:
        $read->ExeRead(POSTS, "WHERE post_status = 1 and post_name = :name", "name={$Url[0]}");
    endif;

    if (!$read->getResult()):
        WSErro("Desculpe! Não existe nenhum post com este nome!", WS_INFOR);
    else:
        extract($read->getResult()[0]);
        $readAuthor = new Read();
        $readAuthor->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$post_author}");
        ?>

        <div class="m-bottom3 container">
            <header class = "bg-blue_marinho al-center no-margin container header_page">
                <div class = "content">
                    <h1 class = "caps-lock m-bottom1 fontsize1b font-normal"><?= $post_title; ?></h1>
                    <span class = "autor">
                        <img class="round" title = "<?= $readAuthor->getResult()[0]['user_name']; ?>" alt="[<?= $readAuthor->getResult()[0]['user_name']; ?>]" src= "<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $readAuthor->getResult()[0]['user_foto']; ?>" />
                        <p><?= $readAuthor->getResult()[0]['user_name']; ?></p>
                    </span>
                    <span class="data_publicacao"><time datetime = "<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                    <?php
                    $readCategoria = new Read();
                    $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :category", "category={$post_category}");
                    if ($readCategoria->getResult()):
                        ?>
                        <span class="caminho">Nutricionista Low Carb >> <?= $readCategoria->getResult()[0]['category_title']; ?></span>
                    <?php endif; ?>
                    <span class="visitas"><?= $post_views; ?> Visitas!</span>
                    <span class="comentarios ds-none">25 Comentários!</span>
                    <div class="clear"></div>
                </div>
            </header>


            <div style="<?= (SIDEBAR_POST_LEFT == '1' ? 'float:right; margin-right:7%!important; margin-left:0 !important;' : (SIDEBAR_POST_RIGHT == '1' ? 'float:left' : '')); ?>;" class="post_conteudo boxshadow">
                <div class="banner_post container bg-gray">

                    <a title="" href="">
                        <picture alt="Gabadi">
                <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                            <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                            <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                            <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                            <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                            <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                            <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                            <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                        </picture>
                    </a>

                    <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_POST == '1'): ?>
                        <div class="btn_like">
                            <div class="fb-like" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="<?= (FACEBOOK_APP_POST_COMPARTILHAR == '1' ? 'true' : 'false'); ?>"></div>
                        </div>
                    <?php endif; ?>
                </div>    
                <div class="separator m-bottom2"></div>


                <div class="content">

                    <div class="content_single">
                        <p class="subtitle fl-left fontsize2 container"><?= $post_subtitle; ?></p>
                        <div class="fl-left container htmlchars"><?= $post_content; ?></div>
                    </div>

                    <div class="clear"></div>
                </div>

            </div>


            <div style="float: <?= (SIDEBAR_POST_LEFT == '1' ? 'left' : (SIDEBAR_POST_RIGHT == '1' ? 'right' : '')); ?>;" class="posts_laterais">

                <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_SEGUIDORES_PERSONALIZADO_POST == '1'): ?>

                    <aside class="post_lateral">
                        <?php
                        include './_cdn/app_sociais/plugin-facebook.inc.php';
                        ?>
                    </aside>

                <?php endif; ?>

                <?php if (YOUTUBE_APP_POST == '1'): ?>

                    <aside class="post_lateral">
                        <?php
                        include './_cdn/app_sociais/plugin-youtube.inc.php';
                        ?>
                    </aside>

                <?php endif; ?>

                <?php
                if (POSTS_APP == '1' && POSTS_APP_MAIS_VISTOS_POST == '1'):
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
                if (POSTS_APP == '1' && POSTS_APP_MAIS_RECENTES_POST == '1'):
                    ?>
                    <aside class="post_lateral_app no-padding">
                        <?php
                        include './_cdn/app_posts/posts-mais-recentes.inc.php';
                        ?>
                    </aside>
                    <?php
                endif;
                ?>

                <?php if (LEADS_SIDEBAR_POST == '1'): ?>

                    <aside class="post_lateral_app no-padding">
                        <?php
                        include './_cdn/app_forms/form_vertical.inc.php';
                        ?>
                    </aside>

                <?php endif; ?>

                <?php
                if (FACEBOOK_APP == '1' && FACEBOOK_APP_TIMELINE_POST == '1'):
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
                if (PUBLICIDADE == '1' && PUBLICIDADE_SIDEBAR_POST == '1'):
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
                if (PUBLICIDADE == '1' && PUBLICIDADE_AFILIADO_POST == '1'):
                    ?>
                    <aside class="post_lateral_app no-padding">
                        <?php
                        include './_cdn/app_publicidade/publicidade-afiliado.inc.php';
                        ?>
                    </aside>
                    <?php
                endif;
                ?>

                <?php
                if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_SIDEBAR_POST == '1'):
                    ?>
                    <aside class="post_lateral_app no-padding">
                        <?php
                        include './_cdn/app_sociais/plugin-instagram-vertical.inc.php';
                        ?>
                    </aside>
                    <?php
                endif;
                ?>


            </div>

        </div>

        <?php
        if (PUBLICIDADE == '1' && PUBLICIDADE_HORIZONTAL_POST == '1'):

            include './_cdn/app_publicidade/publicidade-full-body.inc.php';

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


        <?php if (COMENTARIOS_APP == '1' || FACEBOOK_APP_COMENTARIOS == '1'): ?>

            <!--RECADOS-->
            <section class="container recados comments_post">


                <header class="bg-light al-center">
                    <div class="content">
                        <h1>Olá, Deixe seu Comentário Para</h1>
                        <p class="tagline font-normal"><?= $post_title; ?>!</p>

                        <div class="numero_comentarios bg-body al-center">
                            <p class="font-light no-margin">Veja O(s) Comentário(s) Logo Abaixo!</p>
                            <p class="junte_se">Junte-se à Eles! ;)</p>
                        </div>

                        <div class="clear"></div>
                    </div>
                </header>

                <div class="content">

                    <div class="separator m-bottom3"></div>


                    <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_COMENTARIOS == '1'): ?>

                        <div class="fb-comments" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100%" data-numposts="10"></div>

                    <?php endif; ?>

                    <?php
                    if (COMENTARIOS_APP == '1'):

                        include '_cdn/app_comentarios/comentario-post.inc.php';

                    endif;
                    ?>

                </div>
            </section>

        <?php endif; ?>

        <?php
        if (POSTS_APP == '1' && POSTS_APP_RELACIONADOS == '1'):

            include './_cdn/app_posts/posts-relacionados.inc.php';

        endif;
        ?>    

    </section>
<?php endif; ?>
