<?php
if (!empty($Link->getData())):
    extract($Link->getData());
endif;
?>

<!--POSTS MAIS VISTOS-->
<section class="container posts_box" id="j_content">


    <header class="bg-blue_marinho al-center header_page">
        <div class="content">
            <h1 class="caps-lock m-bottom1 fontsize1b"><?= (!empty($category_title) ? $category_title : 'Posts') ?></h1>
            <p class="tagline fontsize1 font-light"><?= (!empty($category_content) ? $category_content : 'Confira Os Nossos Posts') ?></p>
            <div class="clear"></div>
        </div>
    </header>
    <div class="separator m-bottom3"></div>


    <div class="content content_category posts_demais">

        <div class="corpo-blog">

            <?php
            $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
            $Pager = new Pager(HOME . '/posts' . (!empty($category_name) ? '/' . $category_name : '') . '/&pag=');
            $Pager->ExePager($getPage, 12);

            $Categoria = (!empty($category_id) ? " AND post_category = " . $category_id . " OR post_cat_parent = " . $category_id : "");
            $read = new Read();
            $read->FullRead("SELECT post_title, post_category, post_name, post_content, post_date, post_cover FROM " . POSTS . " WHERE post_status = 1 " . $Categoria . " ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if (!$read->getResult()):
                WSErro("Desculpe! Ainda não Existem Posts Publicados!", WS_INFOR);

            else:

                foreach ($read->getResult() as $post):
                    extract($post);
                    ?>


                    <article class="post_item post_item_posts">
                        <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>

                        <span class="post_item_content">
                            <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                                <h1 itemprop="name"><?= Check::Words($post_title, 10); ?></h1>
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

                $Pager->ExeFullPaginator("SELECT post_title, post_category, post_name, post_content, post_date, post_cover FROM " . POSTS . " WHERE post_status = 1 " . $Categoria . " ORDER BY post_date DESC");
                ?>
                <div class="j_paginator" attr-action="paginator_post">
                    <?php
                    echo $Pager->getPaginator();
                endif;
                ?>

            </div>

            <div class="clear"></div>
        </div>   
</section>
