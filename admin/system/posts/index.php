<!DOCTYPE html>
<!--
Página: See Posts (Ver Posts)
Author: Luiz Felipe C. Lopes
Date: 23/08/2018
-->

<?php
$FilterSection = filter_input(INPUT_GET, 'section', FILTER_VALIDATE_INT);
$FilterCategory = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);

$readPost = new Read;
if (!empty($FilterSection)):
    $Pager = new Pager("?exe=posts/index&section={$FilterSection}&pag=");
    $Pager->ExePager($getPage, 12);
    $readPost->FullRead("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . " WHERE post_cat_parent = :section ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "section={$FilterSection}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
elseif (!empty($FilterCategory)):
    $Pager = new Pager("?exe=posts/index&category={$FilterCategory}&pag=");
    $Pager->ExePager($getPage, 12);
    $readPost->FullRead("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . " WHERE post_category = :category ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "category={$FilterCategory}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
else:
    $Pager = new Pager("?exe=posts/index&pag=");
    $Pager->ExePager($getPage, 12);
    $readPost->FullRead("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . " ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
endif;


if (!$readPost->getResult()):
    echo 'Nenhum post ainda!';
    echo'<a style="margin-left: 10px;" title="Novo Post" href="?exe=posts/create" class="btn btn-blue icon-file radius">Novo Post</a>';
else:
    ?>

    <div class="post_options">
        <form action="" method="post">
            <input type="hidden" name="action" value="filter_posts">
            <select id="js_filter_status" name="filter_post_status" class="js_filter_posts" attr-section="<?= (!empty($FilterSection) ? $FilterSection : ''); ?>">
                <option value="todos">Todos os Status</option>
                <option value="1">Publicado</option>
                <option value="0">Rascunho</option>
            </select>
            <select id="js_filter_category" name="filter_post_category" class="js_filter_posts" attr-section="<?= (!empty($FilterSection) ? $FilterSection : ''); ?>" <?= (!empty($FilterCategory) ? ' disabled ' : ''); ?>>
                <option value="todos">Todas as Categorias</option>
                <option value="<?= BuscaRapida::buscarCategoriaName('secao-padrao')['category_id']; ?>">Padrão</option>

                <?php
                $readSection = new Read;

                if (!empty($FilterSection)):
                    $readSection->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_name != :name AND category_id = :id AND category_segment = :segment", "name=secao-padrao&id={$FilterSection}&segment=blog");
                else:
                    $readSection->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_name != :name AND category_segment = :segment", "name=secao-padrao&segment=blog");
                endif;


                if ($readSection->getResult()):
                    $readCategory = new Read;
                    foreach ($readSection->getResult() as $section):
                        extract($section);
                        ?>
                        <optgroup label="<?= $category_title; ?>">
                            <?php
                            $readCategory->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_parent = :parent", "parent={$category_id}");

                            if ($readCategory->getResult()):

                                foreach ($readCategory->getResult() as $category):
                                    ?>
                                    <option <?= (!empty($FilterCategory) && $FilterCategory == $category['category_id'] ? 'selected' : ''); ?> value="<?= $category['category_id']; ?>"><?= $category['category_title']; ?></option>
                                    <?php
                                endforeach;

                            endif;
                            ?>

                        </optgroup>
                        <?php
                    endforeach;

                endif;
                ?>

            </select>

            <input id="js_filter_search" type="text" name="search_post" placeholder="Pesquisar post" class="js_search_post" attr-section="<?= (!empty($FilterSection) ? $FilterSection : ''); ?>">
            <span class="icon_search icon-search"></span>
        </form>

        <div class="btn_container">
            <a title="Novo Post" href="?exe=posts/create" class="btn btn-blue icon-file radius">Novo Post</a>
        </div>
    </div>

    <section class="posts js_posts">
        <h2>Meus Posts</h2>

        <?php
        foreach ($readPost->getResult() as $post):
            extract($post);
            ?>

            <article id="<?= $post_id; ?>" class="posts_item js_item">
                <span class="icon-eye-big"><?= sprintf('%06d', $post_views); ?></span>

                <div class="js_container_status">
                    <?php if ($post_status == 1): ?>

                        <a id="<?= $post_id; ?>" attr-status="<?= $post_status; ?>" attr-action="change_status_post" title="Publicado" href="#" class="icon-check btn_status btn_status_published btn btn-small btn-green radius js_status">Publicado</a>
                    <?php else: ?>
                        <a id="<?= $post_id; ?>" attr-status="<?= $post_status; ?>" attr-action="change_status_post" title="Rascunho" href="#" class="icon-alert-triangle btn_status btn_status_draft btn btn-small btn-orange radius js_status">Rascunho</a>

                    <?php endif; ?>
                </div>
                <div class="image_preview">
                    <img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                </div>
                <div class="post_info">
                    <h3><?= Check::Words($post_title, 5); ?></h3>
                    <span class="post_info_category icon-tag"><?= '<b>' . BuscaRapida::buscarCategoria($post_category)['category_title'] . (BuscaRapida::buscarCategoria($post_category)['category_name'] == 'secao-padrao' ? '</b>' : '</b> - ' . BuscaRapida::buscarCategoria($post_cat_parent)['category_title']); ?></span>
                    <span class="post_info_date icon-clock"><?= date('d/m/Y à\s\ H:i \h', strtotime($post_date)) ?></span>

                    <div class="post_info_buttons">
                        <a title="Exibir Post" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>" target="_blank" class="icon-goto btn btn-small btn-gray radius">Exibir</a>
                        <a title="Editar Post" href="?exe=posts/create&id=<?= $post_id; ?>" class="icon-edit btn btn-small btn-blue radius">Editar</a>
                        <a id="<?= $post_id; ?>" attr-action="delete_post" title="Excluir Post" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>
                    </div>
                </div>
            </article>

        <?php endforeach; ?>



        <div class="js_paginator" attr-action="paginator_posts" attr-section="<?= (!empty($FilterSection) ? $FilterSection : ''); ?>" <?= (!empty($FilterCategory) ? ' disabled ' : ''); ?>>
            <?php
            if (!empty($FilterSection)):
                $Pager->ExeFullPaginator("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . " WHERE post_cat_parent = :section ORDER BY post_date DESC", "section={$FilterSection}");
            elseif (!empty($FilterCategory)):
                $Pager->ExeFullPaginator("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . " WHERE post_category = :category ORDER BY post_date DESC", "category={$FilterCategory}");
            else:
                $Pager->ExeFullPaginator("SELECT post_id, post_name, post_title, post_cover, post_date, post_category, post_cat_parent, post_views, post_status, post_author FROM " . POSTS . " ORDER BY post_date DESC");
            endif;
            ?>
            <?php
            $Paginator = $Pager->getPaginator();

            if (!empty($Paginator)):
                ?>
                <div class="paginator_container">
                    <?php echo $Paginator; ?>
                </div>
            <?php endif; ?>
        </div>

        <!--<div class="js_paginator" attr-action="paginator_post"></div>-->


        <!--        <div class="paginator_container">
                    <ul>
                        <li class="first"><a title="" href="#">Primeira</a></li>
                        <li><a title="" href="#">1</a></li>
                        <li><a title="" href="#">2</a></li>
                        <li><a title="" href="#">3</a></li>
                        <li><a title="" href="#">4</a></li>
                        <li><a title="" href="#">5</a></li>
                        <li><a title="" href="#">6</a></li>
                        <li class="last"><a title="" href="#">Última</a></li>
                    </ul>
                </div>-->

    </section>
    <?php include 'inc/confirmation_delete_message.inc.php'; ?>
<?php
endif;
?>


