<!DOCTYPE html>
<!--
<b>Posts:</b> Exibe os Posts Disponíveis
Desenvolvido por Luiz Felipe Lopes - 28/12/2018 às 16:00hrs
-->

<?php $CatUrl = $Link->getLink(); ?>
<main>

    <section class="posts flex">
        <header>
            <h1 class="icon-post">Posts <?= (!empty($CatUrl) ? '/ ' . BuscaRapida::buscarCategoriaName($CatUrl)['category_title'] : ''); ?></h1>
            <p> <?= (!empty($CatUrl) ? BuscaRapida::buscarCategoriaName($CatUrl)['category_content'] : 'É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto legível de uma página quando estiver examinando sua diagramação.') ?></p>
        </header>

        <?php
        $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);

//        var_dump($CatUrl);
//        die;

        $readPosts = new Read;

        if (!empty($CatUrl)):

            $Pager = new Pager(HOME . '/posts/' . $CatUrl . '&pag=');
            $Pager->ExePager((!empty($getPage) ? $getPage : 1), 6);

            $readCategory = new Read;
            $readCategory->ExeRead(CATEGORIAS, "WHERE category_name = :categoria AND category_parent IS NULL", "categoria={$CatUrl}");
            if (!$readCategory->getResult()):

                WSErro('Nenhum post para esta categoria ainda!', 'info');

            else:

                $IdCategoria = $readCategory->getResult()[0]['category_id'];

                $readPosts->ExeRead(POSTS, "WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "categoria={$IdCategoria}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//                var_dump($readPosts->getResult());
                if ($readPosts->getResult()):
                    foreach ($readPosts->getResult() as $post):
                        extract($post);
                        ?>

                        <article class="posts_item flex-3">
                            <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><div class="box_image image-background"><img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>"><div class="box_image_background"></div></div></a>
                                <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><h1><?= $post_title; ?></h1></a>
                                <meta itemprop="width" content="300" />
                                <meta itemprop="height" content="180" />
                            </span>
                        </article>

                        <?php
                    endforeach;
                    ?>

                    <nav>
                        <?php
                        $Pager->ExePaginator(POSTS, "WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC", "categoria={$IdCategoria}");
                        echo $Pager->getPaginator();
                        ?>
                    </nav>

                    <?php
                endif;

            endif;

        else:

            $Pager = new Pager(HOME . '/posts/&theme=' . THEME . '&pag=');
            $Pager->ExePager((!empty($getPage) ? $getPage : 1), 6);

            $readPosts->ExeRead(POSTS, "WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//                var_dump($readPosts->getResult());
            if (!$readPosts->getResult()):
                WSErro('Nenhum post ainda!', 'info');
            else:
                foreach ($readPosts->getResult() as $post):
                    extract($post);
                    ?>

                    <article class="posts_item flex-3">
                        <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><div class="box_image image-background"><img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>"><div class="box_image_background"></div></div></a>
                            <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><h1><?= $post_title; ?></h1></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>
                    </article>

                    <?php
                endforeach;
                ?>

                <nav>
                    <?php
                    $Pager->ExePaginator(POSTS, "WHERE post_status = 1 ORDER BY post_date DESC");
                    echo $Pager->getPaginator();
                    ?>
                </nav>

            <?php
            endif;

        endif;
        ?>


        <!--        <nav class="paginator">
                    <ul>
                        <li><a title="" href="#">Primeira</a></li>
                        <li><a title="" href="#">1</a></li>
                        <li><a title="" href="#">2</a></li>
                        <li><a title="" href="#">3</a></li>
                        <li><a title="" href="#">4</a></li>
                        <li><a title="" href="#">Última</a></li>
                    </ul>
                </nav>-->

    </section>

</main>
