<!--POSTS MAIS VISTOS-->
<section class="container posts posts_maisvistos">
    <div class="content">

        <header>
            <h1 class="title fontsize1b">Sacadas Mais Vistas</h1>
            <div class="form-barra"></div>
        </header>
        <div class="separator m-bottom3"></div>

        <article class="post_item box principal">

            <?php
            $dateHoje = date("Y-m-d H:i:s");
            $readPost->ExeRead(POSTS, "WHERE post_status = 1 AND post_date <= :date ORDER BY post_date DESC, post_views DESC LIMIT :limit OFFSET :offset", "limit=1&offset=1&date={$dateHoje}");
            if (!$readPost->getResult()):
                WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);
            else:
                extract($readPost->getResult()[0]);
                ?>

                <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                    <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                    <meta itemprop="width" content="300" />
                    <meta itemprop="height" content="180" />
                </span>
                <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                    <h1 itemprop="name"><?= Check::Words($post_title, 6); ?></h1>
                    <span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                    <p class="al-justify" itemprop="description"><?= Check::Words($post_content, 50); ?></p>
                </a>
                <a class="mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">Ver mais...</a>


            <?php
            endif;
            ?>

        </article>


        <div class="posts_demais">

            <?php
            $readPost = new Read();
            $readPost->ExeRead(POSTS, "WHERE post_status = 1 AND post_date <= :date ORDER BY post_date DESC, post_views DESC LIMIT :limit OFFSET :offset", "limit=2&offset=2&date={$dateHoje}");
            if (!$readPost->getResult()):
//                WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);

            else:

                foreach ($readPost->getResult() as $post):
                    extract($post);
                    ?>


                    <article class="post_item box">
                        <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>
                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                            <h1 itemprop="name"><?= Check::Words($post_title, 6); ?></h1>
                            <span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                            <p itemprop="description"><?= Check::Words($post_content, 50); ?></p>
                        </a>
                        <a class="mais link" title="Ver Mais" href="<?= HOME . '/post' . '/&theme=' . THEME ?>">Ver mais...</a>
                    </article>


                    <?php
                endforeach;
            endif;
            ?>

        </div>   
        <div class="clear"></div>
    </div>
</section>