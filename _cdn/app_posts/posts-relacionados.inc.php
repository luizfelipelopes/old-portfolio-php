<section class="posts-relacionados">

    <!--<div class="content">-->

    <header class="container">
        <div class="content">
            <h1>Confira Outros Artigos!</h1>
            <p>Veja abaixo alguns posts que possa ser do seu interesse!</p>
            <div class="clear"></div>
        </div>
    </header>    


    <div class="posts flex">
        <!--<div class="limitador_view">-->
        <!--<div class="content flex">-->

        <?php
        $read = new Read();

        if (!empty($post_id)):
            $read->ExeRead(POSTS, "WHERE post_status = 1 AND post_id != :postid ORDER BY rand() LIMIT 9", "postid={$post_id}");
        else:
            $read->ExeRead(POSTS, "WHERE post_status = 1 ORDER BY rand() LIMIT 9");
        endif;

        if (!$read->getResult()):

            WSErro("Desculpe! Ainda não Posts Que foram Publicados Além deste Acima!", WS_INFOR);

        else:
            foreach ($read->getResult() as $posts):
                extract($posts);
                ?>

                <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" class="posts_item flex-3">
                    <article itemscope itemtype="https://schema.org/Article">

                        <div class="box_image">
                            <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                            <div class="box_image_background"></div>
                        </div>
                        <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                        <meta itemprop="image" content="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                        <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                        <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">

                        <span class="content">
                            <h1 itemprop="headline"><?= $post_title; ?></h1>

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

                                            <!--<p>Em <time datetime="<?= $post_date; ?>"><?= date('d/m/Y', strtotime($post_date)); ?></time></p>-->
                                                                    <!--<a class="mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>">Ver mais...</a>-->
                            <div class="clear"></div>
                        </span>

                        <!--                                <div class="post_item_author">
                                                            <div class="image">
                                                                <img class="round" title="Nilma Nayara Neves" alt="[Nilma Nayara Neves]" src="<?= INCLUDE_PATH ?>/img/foto-novo-post.png"/>
                                                            </div>
                                                            <p class="fl-right">Nilma Nayara Neves</p>
                                                        </div>-->
                    </article>
                </a>



                <?php
            endforeach;
//
        endif;
        ?>
    </div>
    <!--</div>-->
    <!--</div>-->

    <div class="clear"></div>
    <!--</div>-->
</section>