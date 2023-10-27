<?php
$readPostMaisVistos = new Read;
$readPostMaisVistos->FullRead("SELECT post_title, post_name, post_content, post_date, post_cover, post_category FROM " . POSTS . " WHERE post_id != :id AND post_status = 1 ORDER BY post_views DESC, post_views DESC LIMIT 3", "id={$readPost->getResult()[0]['post_id']}");
//
if ($readPostMaisVistos->getResult()):
    ?>

    <section class="container post_sidebar">

        <header class="container">
            <h1>Mais Vistos</h1>
        </header>

        <?php
        $j = 0;
        foreach ($readPostMaisVistos->getResult() as $post):
            extract($post);
            ?>

            <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                <article class="posts_mais_vistos_item" itemscope itemtype="https://schema.org/Article">

                    <span class="box_imagem">
                        <img itemprop="image" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                        <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                        <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                        <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">
                    </span>

                    <div class="info">
                        <h1 class="m-bottom1" itemprop="headline"><?= Check::Words($post_title, 8); ?></h1>
                        <p><?= BuscaRapida::buscarCategoria($post_category)['category_title']; ?></p>

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
                    </div>

                </article>
            </a>

            <?php
            $j++;
        endforeach;
        ?>

        <div class="clear"></div>
    </section>
    <?php
endif;
?>