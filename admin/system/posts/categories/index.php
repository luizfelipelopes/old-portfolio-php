<!DOCTYPE html>
<!--
Página: See Categories (Ver Categorias)
Author: Luiz Felipe C. Lopes
Date: 28/08/2018
-->


<div class="categories_options">
    <a title="" href="?exe=posts/categories/create" class="btn btn-blue icon-folder radius">Criar Categoria</a>
</div>

<?php
$readSections = new Read;
$readSections->FullRead('SELECT category_id, category_title, category_content FROM ' . CATEGORIAS . " WHERE category_name != :name AND category_parent IS NULL AND category_segment = :segment ORDER BY category_date DESC", "name=secao-padrao&segment=blog");
if (!$readSections->getResult()):
    echo 'Não há categorias cadastradas no momento!';
else:
    foreach ($readSections->getResult() as $section):
        extract($section);
        ?>

        <section id="<?= $category_id; ?>" class="categories_section js_item">
            <div class="section_block">
                <header>
                    <h2 class="icon-folder"><?= $category_title; ?>:</h2>
                    <p><?= $category_content; ?></p>
                </header>

                <div class="categories_section_buttons">
                    <a title="Ver Posts" href="?exe=posts/index&section=<?= $category_id; ?>" class="btn btn-green radius icon-eye-big">Ver Posts</a>
                    <a title="Editar" href="?exe=posts/categories/create&id=<?= $category_id; ?>" class="btn btn-blue radius icon-edit">Editar</a>
                    <a id="<?= $category_id; ?>" attr-action="delete_category" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>
                </div>
            </div>

            <div class="category_block">

                <?php
                $readCategory = new Read;
                $readCategory->FullRead('SELECT category_id, category_title, category_content FROM ' . CATEGORIAS . " WHERE category_parent IS NOT NULL AND category_parent = :id AND category_segment = :segment ORDER BY category_date", "id={$category_id}&segment=blog");
                if (!$readCategory->getResult()):
                    echo 'Ainda não há categorias nesta seção!';
                else:
                    foreach ($readCategory->getResult() as $category):
                        ?>

                        <article id="<?= $category['category_id']; ?>" class="categories_category js_item">
                            <h3 class="icon-tag"><?= $category['category_title']; ?>:</h3>
                            <p><?= $category['category_content']; ?></p>

                            <div class="categories_category_buttons">
                                <a title="Ver Posts" href="?exe=posts/index&category=<?= $category['category_id']; ?>" class="btn btn-green radius icon-eye-big">Ver Posts</a>
                                <a title="Editar" href="?exe=posts/categories/create&id=<?= $category['category_id']; ?>" class="btn btn-blue radius icon-edit">Editar</a>
                                <a id="<?= $category['category_id']; ?>" attr-action="delete_category" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>
                            </div>
                        </article>

                        <?php
                    endforeach;
                endif;
                ?>

            </div>
        </section>

        <?php
    endforeach;
endif;
?>

<?php include 'inc/confirmation_delete_message.inc.php'; ?>

