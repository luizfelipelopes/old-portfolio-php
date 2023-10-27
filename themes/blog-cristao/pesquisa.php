<!DOCTYPE html>
<!--
<b>Pesquisa:</b> Exibe o Resultado das Pesquisas Feitas
Desenvolvido por Luiz Felipe Lopes - 28/12/2018 às 18:13hrs
-->

<?php
$s = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);
$search = (!empty($s) ? $s : $Link->getLink());
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager(HOME . '/pesquisa&search=' . $search . '&pag=');
$Pager->ExePager((!empty($getPage) ? $getPage : 1), 6);

$readPost = new Read;
$readCountPost = new Read;
$readPost->ExeRead(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%' OR post_content LIKE '%' :like '%') AND post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "like={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
$readCountPost->ExeRead(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%' OR post_content LIKE '%' :like '%') AND post_status = 1 ORDER BY post_date DESC", "like={$search}");
//                var_dump($readDicas->getResult());
?>

<!--CORPO DO SITE--> 
<main>

    <section class="pesquisa flex">
        <header>
            <h1 class="icon-search">"<?= (!empty($readCountPost->getResult()) && $readCountPost->getRowCount() > 0 ? $search : 'Oppss..'); ?>"</h1>

            <?php if (!empty($readCountPost->getResult()) && $readCountPost->getRowCount() > 0): ?>
                <?php if ($readCountPost->getRowCount() == 1): ?>
                    <p>Foi encontrado <span class="search_result_count"><?= $readCountPost->getRowCount(); ?></span> resultado com o termo "<?= $search; ?>".</p>
                <?php else: ?>
                    <p>Foram encontrados <span class="search_result_count"><?= $readCountPost->getRowCount(); ?></span> resultados com o termo "<?= $search; ?>".</p>
                <?php endif; ?>
            <?php else: ?>
                <p><strong>Opps.. nenhum resultado foi encontrado com o termo <span class="search_result_count">"<?= $search; ?>"</span>. Mas calma! Nem tudo esta perdido! :)</strong></p>
            <?php endif; ?>


                    <!--<p>Foram encontrados <span class="search_result_count">6</span> resultados com o termo <span class="search_result_term">“jejum”</span></p>-->
        </header>


        <?php
        if ($readPost->getResult()):

            foreach ($readPost->getResult() as $post):
                extract($post);
                ?>

                <article class="pesquisa_item flex-3">
                    <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><div class="box_image"><img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>"><div class="box_image_background"></div></div></a>
                    <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><h1><?= $post_title; ?></h1></a>
                </article>

                <?php
            endforeach;
            ?>

            <nav>
                <?php
                $Pager->ExePaginator(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%' OR post_content LIKE '%' :like '%') AND post_status = 1 ORDER BY post_date DESC", "like={$search}");
                echo $Pager->getPaginator();
//            var_dump($Pager->getPaginator());
                ?>
            </nav>

            <?php
        else:

            include './_cdn/app_forms/form_sugestao.inc.php';
            include './_cdn/app_posts/posts-relacionados.inc.php';

        endif;
        ?>

    </section>

</main>

