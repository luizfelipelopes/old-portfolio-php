<!--POSTS MAIS VISTOS-->
<section class="container posts">
    <div class="content">

        <!--        <header>
                    <h1 class="title fontsize1b">Posts Mais Vistos</h1>
                    <div class="form-barra"></div>
                </header>
                <div class="separator m-bottom3"></div>-->

        <div class="posts_demais container">

            <?php
            $readPost = new Read();
            $readPost->ExeRead(POSTS, "WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", 'limit=2&offset=4');
            if (!$readPost->getResult()):
                WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);
            else:

                foreach ($readPost->getResult() as $post):
                    extract($post);
                    ?>

                    <article class="post_item post_item_sobre">
                        <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>

                        <span class="post_item_content">
                            <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                                <h1 itemprop="name"><?= $post_title; ?></h1>
                                <?php $CategoriaNome = BuscaRapida::buscarCategoria($post_category); ?>
                                <span><span class="container m-bottom1 font-bold">>><?= $CategoriaNome['category_title']; ?></span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                                <p itemprop="description"><?= Check::Words($post_content, 50); ?></p>
                            </a>

                            <a class="mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">Ver mais...</a>



                        </span>

                        <div class="post_item_author">
                            <div class="image">
                                <img class="round" title="Nilma Nayara Neves" alt="[Nilma Nayara Neves]" src="<?= INCLUDE_PATH ?>/img/foto-novo-post.png"/>
                            </div>
                            <p class="fl-right">Nilma Nayara Neves</p>
                        </div>

                    </article>


                    <?php
                endforeach;
            endif;
            ?>

        </div>   
        <div class="clear"></div>
    </div>
</section>