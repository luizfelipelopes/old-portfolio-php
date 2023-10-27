<?php
//$search = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);
$search = $Link->getLink();
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager(HOME . '/pesquisa&search=' . $search . '&pag=');
$Pager->ExePager((!empty($getPage) ? $getPage : 1), 6);

$readPost = new Read;
$readCountPost = new Read;
$readPost->ExeRead(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%' OR post_content LIKE '%' :like '%') AND post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "like={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
$readCountPost->ExeRead(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%' OR post_content LIKE '%' :like '%') AND post_status = 1 ORDER BY post_date DESC", "like={$search}");
//                var_dump($readDicas->getResult());
?>



<section class="container dobra_artigos">

    <header class="container">
        <div class="content">
            <h1 class="m-top1">"<?= (!empty($readCountPost->getResult()) && $readCountPost->getRowCount() > 0 ? $search : 'Oppss..'); ?>"</h1>
            <?php if (!empty($readCountPost->getResult()) && $readCountPost->getRowCount() > 0): ?>
                <?php if ($readCountPost->getRowCount() == 1): ?>
                    <p>Foi encontrado <strong><?= $readCountPost->getRowCount(); ?></strong> resultado com o termo "<?= $search; ?>".</p>
                <?php else: ?>
                    <p>Foram encontrados <strong><?= $readCountPost->getRowCount(); ?></strong> resultados com o termo "<?= $search; ?>".</p>
                <?php endif; ?>
            <?php else: ?>
                <p><strong>Opps.. nenhum resultado foi encontrado com o termo "<?= $search; ?>". Mas calma! Nem tudo esta perdido! :)</strong></p>
            <?php endif; ?>
            <div class="clear"></div>
        </div>
    </header>

    <?php
    if ($readPost->getResult()):
        ?>

        <div class="content">

            <div class="artigos container">
                <div class="content flex">

                    <?php
                    foreach ($readPost->getResult() as $post):
                        extract($post);
                        ?>

                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" class="flex-3">
                            <article class="artigo" itemscope itemtype="https://schema.org/Article">
                                <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                                <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                                <meta itemprop="image" content="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                                <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                                <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">
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
                                <div class="content">
                                    <h1 itemprop="headline"><?= $post_title; ?></h1>
                                    <p>Em <?= date('d/m/Y', strtotime($post_date)); ?></p>
                                    <div class="clear"></div>
                                </div>
                            </article>
                        </a>

                        <?php
                    endforeach;
                    ?>
                    <div class="container"></div>


                    <div class = "bloco_paginator">

                        <?php
                        $Pager->ExePaginator(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%' OR post_content LIKE '%' :like '%') AND post_status = 1 ORDER BY post_date DESC", "like={$search}");
                        echo $Pager->getPaginator();
                        ?>

                    </div>




                    <div class="clear"></div>
                </div>
            </div>


            <div class="clear"></div>
        </div>

        <?php
    else:

        include '_cdn/app_forms/form_sugestao.inc.php';
        include '_cdn/app_posts/posts-relacionados.inc.php';

    endif;
    ?>
</section>
