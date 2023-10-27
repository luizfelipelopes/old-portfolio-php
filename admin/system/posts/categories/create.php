<!DOCTYPE html>
<!--
Página: New Category (Nova Categoria)
Author: Luiz Felipe C. Lopes
Date: 28/08/2018
-->

<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>

<div class="categories_options">
    <?php if (!empty($id)): ?>
        <a title="" href="?exe=posts/categories/create" class="btn btn-orange icon-folder radius">Nova Categoria</a>
    <?php endif; ?>
    <a title="" href="?exe=posts/categories/index" class="btn btn-blue icon-eye-big radius">Ver Categorias</a>
</div>

<?php
if (!empty($id)):
    $readCategory = new Read;
    $readCategory->FullRead("SELECT category_id, category_parent, category_title, category_content FROM " . CATEGORIAS . " WHERE category_id = :id", "id={$id}");
    if ($readCategory->getResult()):
        extract($readCategory->getResult()[0]);
    else:
        echo 'Não existe nenhuma categoria com este id!';
    endif;
endif;
?>

<?php if ((!empty($id) && $readCategory->getResult()) || !isset($id)): ?>
    <div class="form_background category_form">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?= (!empty($id) ? 'update_category' : 'create_category') ?>">
            <input type="hidden" name="category_segment" value="blog">
            <input type="hidden" name="category_id" value="<?= (!empty($id) ? $id : '') ?>">

            <span class="form-control">
                <label>Nome:</label>
                <input type="text" name="category_title" placeholder="Digite um nome" value="<?= (!empty($id) ? $category_title : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Descrição:</label>
                <textarea rows="5" name="category_content" placeholder="Descreva sobre a categoria"><?= (!empty($id) && !empty($category_content) ? $category_content : ''); ?></textarea>
            </span>
            <span class="form-control">
                <label>Seção:</label>
                <select class="js_sections" name="category_parent" required>
                    <option selected value="0">Esta é uma seção</option>

                    <?php
                    $readSection = new Read;
                    if(!empty($id)):
                        $readSection->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_id != :id AND category_name != :name AND category_segment = :segment ORDER BY category_date DESC", "id={$id}&name=secao-padrao&segment=blog");
                        else:
                        $readSection->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_name != :name AND category_segment = :segment ORDER BY category_date DESC", "name=secao-padrao&segment=blog");
                    endif;
                    
                    if ($readSection->getResult()):
                        foreach ($readSection->getResult() as $section):
                            extract($section);
                            ?>
                            <option <?= (!empty($id) && $category_parent == $section['category_id'] ? ' selected ' : ''); ?> value="<?= $category_id; ?>"><?= $category_title; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>

        </form>
    <?php endif; ?>

    <?php include 'inc/loading_message.inc.php'; ?>

</div>
