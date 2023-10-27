<?php
$readPost = new Read;
$readPost->FullRead("SELECT post_title, post_name, post_content, post_date, post_cover, post_category FROM " . POSTS . " WHERE post_status = 1 ORDER BY post_date DESC LIMIT 3");

if ($readPost->getResult()):
    ?>

    <section class="container posts_mais_vistos">


        <div class="content">

            <header class="m-bottom3">
                <h1 class="title fontsize1">Mais Recentes</h1>
                <div class="form-barra"></div>
            </header>

            <?php
            $j = 0;
            foreach ($readPost->getResult() as $post):
                extract($post);
                ?>

                <article class="posts_mais_vistos_item">

                    <span class="bloco_imagem" itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                        <meta itemprop="width" content="300" />
                        <meta itemprop="height" content="180" />
                    </span>

                    <div class="bloco_info">
                        <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><h1 class="m-bottom1" itemprop="name"><?= Check::Words($post_title, 7); ?></h1></a>

                        <?php $Categoria = BuscaRapida::buscarCategoria($post_category); ?>

                        <span class="container m-bottom1"><a class="categoria_link" title="" href="<?= HOME . '/posts/' . $Categoria['category_name'] . '/&theme=' . THEME; ?>"> <span class="container fontsize1 m-bottom1 font-bold">>><?= $Categoria['category_title']; ?></span></a><time class="ds-none" datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>

                    </div>

                </article>

                <?php
                $j++;
            endforeach;
            ?>

            <div class="clear"></div>
        </div>

    </section>
    <?php
endif;
?>