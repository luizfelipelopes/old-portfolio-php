<!DOCTYPE html>
<!--
<b>Post:</b> Lê os Posts do Site
Desenvolvido por Luiz Felipe Lopes - 28/12/2018 às 07:46hrs
-->

<?php
//var_dump($Link->getLink());
//if ($Link->getLink()):
//
//// Corrige Bug de Contagem de Views duplicado em post (Corrigir esse bug)
//    $today = date('Y-m-d');
//    $viewsFix = BuscaRapida::searchViews($today)['siteviews_pages'];
//    var_dump($viewsFix);
//    if (!empty($viewsFix)):
//        Check::fixViewsPage($viewsFix, $today);
//    endif;
//endif;

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

    <!--CORPO DO SITE--> 

    <main>

        <div class="post_container">

            <section class="post" itemscope itemtype="https://schema.org/Article">

                <header>
                    <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . BuscaRapida::buscarCategoria($post_cat_parent)['category_name']; ?>"><span class="category"><?= BuscaRapida::buscarCategoria($post_cat_parent)['category_title']; ?></span></a>
                    <h1 itemprop="headline"><?= $post_title; ?></h1>
                    <p class="subtitle"><?= $post_subtitle; ?></p>
                    <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT))) ?>">
                    <meta itemprop="image" content="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                    <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                    <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">
                    <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                        <meta itemprop="name" content="<?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?>">
                        <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
                            <meta itemprop="url" content="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets' . DIRECTORY_SEPARATOR . 'Images' . DIRECTORY_SEPARATOR . 'logo-2.fw.png'; ?>">
                        </span>
                    </span>
                    <div class="author_views" itemprop="author" itemscope itemtype="https://schema.org/Person">
                        <p>por<span class="author" itemprop="name"> <?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?> </span> - <?= date('d/m/Y', strtotime($post_date)); ?></p>
                        <span class="icon-eye"><?= $post_views; ?></span>
                    </div>

                    <?php
                    if (!empty($post_video)):
                        ?>
                        <div class="video">
                            <div class="embed-container"><iframe src="https://www.youtube.com/embed/<?= $post_video; ?>" frameborder="0" allowfullscreen></iframe></div>
                        </div>
                        <?php
                    else:
                        ?>
                        <span class="image-background"><img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>"></span>
                    <?php
                    endif;
                    ?>

                </header>
                <div class="social_buttons">
                    <?php if (FACEBOOK_APP == '1' && FACEBOOK_APP_POST == '1'): ?>
                        <div class="btn_like">
                            <div class="fb-like" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100" data-layout="button_count" data-action="like" data-size="large" data-show-faces="true" data-share="<?= (FACEBOOK_APP_POST_COMPARTILHAR == '1' ? 'true' : 'false'); ?>"></div>
                        </div>
                    <?php endif; ?>
                </div>

                <?= $post_content; ?>

                <div class="social_comments">
                    <?php
                    if (FACEBOOK_APP == '1' && FACEBOOK_APP_COMENTARIOS == '1'):

                        include './_cdn/app_sociais/plugin-facebook-comentarios.php';

                    endif;
                    ?>
                </div>
            </section>

            <aside>

                <?php if (YOUTUBE_APP_POST == '1'): ?>

                    <div class="box_youtube">
                        <?php include './_cdn/app_sociais/plugin-youtube.inc.php'; ?>
                    </div>

                <?php endif; ?>

                <h1 class="icon-post">Últimos Posts</h1>

                <?php include '_cdn/app_posts/posts-mais-recentes.inc.php'; ?>

            </aside>
        </div>

    </main>

<?php
endif;
?>