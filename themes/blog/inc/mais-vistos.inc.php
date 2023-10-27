<!--POSTS MAIS VISTOS-->
<section class="container posts">
    <div class="content">

        <header>
            <h1 class="title fontsize1b">Posts Mais Vistos</h1>
            <div class="form-barra"></div>
        </header>
        <div class="separator m-bottom3"></div>

        <article class="post_item box principal">

            <?php
            $readPost->ExeRead("nutrilowcarb_posts", "WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit=1&offset=4");
            if (!$readPost->getResult()):
                WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);
            else:
                extract($readPost->getResult()[0]);
                ?>

                <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                    <meta itemprop="width" content="300" />
                    <meta itemprop="height" content="180" />
                </span>
                <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                    <h1 itemprop="name"><?= $post_title; ?></h1>
                    <span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                    <p itemprop="description"><?= Check::Words($post_content, 50); ?></p>
                </a>
                <a class="mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">Ver mais...</a>


            <?php
            endif;
            ?>

        </article>


        <div class="posts_demais">

            <?php
            $readPost = new Read();
            $readPost->ExeRead("nutrilowcarb_posts", "WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", 'limit=2&offset=5');
            if (!$readPost->getResult()):
                WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);

            else:

                foreach ($readPost->getResult() as $post):
                    extract($post);
                    ?>


                    <article class="post_item box">
                        <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>
                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                            <h1 itemprop="name"><?= $post_title; ?></h1>
                            <span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                            <p itemprop="description"><?= Check::Words($post_content, 50); ?></p>
                        </a>
                        <a class="mais link" title="Ver Mais" href="<?= HOME . '/post' ?>">Ver mais...</a>
                    </article>


                    <?php
                endforeach;
            endif;
            ?>

        </div>   
        <div class="clear"></div>
    </div>
</section>