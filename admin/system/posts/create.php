<!DOCTYPE html>
<!--
Página: New Post (Novo Post)
Author: Luiz Felipe C. Lopes
Date: 28/08/2018
-->
<link href="../_cdn/jquery-ui.css" rel="stylesheet">

<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>

<div class="post_options post_options_create">
    <?php if (!empty($id)): ?>
        <a title="" href="?exe=posts/create" class="btn btn-orange icon-folder radius">Novo Post</a>
    <?php endif; ?>
    <a title="" href="?exe=posts/index" class="btn btn-blue icon-eye-big radius">Ver Posts</a>
</div>

<?php
if (!empty($id)):
    $readPost = new Read;
    $readPost->ExeRead(POSTS, "WHERE post_id = :id", "id={$id}");
    if ($readPost->getResult()):
        extract($readPost->getResult()[0]);
    else:
        echo 'Não existe nenhum post com este id!';
    endif;
endif;
?>

<?php if ((!empty($id) && $readPost->getResult()) || !isset($id)): ?>

    <form class="form_post" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="action" value="<?= (!empty($id) ? 'update_post' : 'create_post') ?>">
        <input type="hidden" name="post_id" value="<?= (!empty($id) ? $id : ''); ?>">

        <div class="form_background">

            <span class="form-control">
                <span class="video_preview js_video_preview js_video_left_preview" <?= (!empty($id) && !empty($post_video) ? ' style="display:block;"' : ''); ?>>
                    <div class="embed-container">
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= (!empty($id) && !empty($post_video) ? $post_video : ''); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </span>
            </span>

            <span class="form-control">
                <label>Capa: <?= (!empty($id) ? '<small>' . $post_cover . '</small>' : ''); ?></label>
                <input class="js_change_image_preview" type="file" name="post_cover">
            </span>
            <span class="form-control">
                <label>Link de Video (Opcional):</label>
                <input class="js_keyup_preview_left" type="text" name="post_video" placeholder="Copie e cole o código que aparece depois da expressão ‘v=’ na url do Youtube" value="<?= (!empty($id) && !empty($post_video) ? $post_video : ''); ?>">
            </span>
            <span class="form-control">
                <label>Título:</label>
                <input type="text" name="post_title" placeholder="Digite um título" value="<?= (!empty($id) ? $post_title : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Subtítulo:</label>
                <textarea class="js_paginator" rows="5" name="post_subtitle" placeholder="Digite um subtítulo"><?= (!empty($id) ? $post_subtitle : ''); ?></textarea>
            </span>
            <span class="form-control">
                <label>Conteúdo:</label>
                <textarea id="js_post" class="js_editor" rows="8" name="post_content" placeholder="Digite um conteúdo"><?= (!empty($id) ? $post_content : ''); ?></textarea>
            </span>

        </div>


        <div class="form_background">

            <span class="image_preview">
                <img class="js_preview_image" title="" alt="" src="<?= (!empty($id) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover : ''); ?>">
            </span>

            <span class="form-control form_select_categoria">
                <label>Seção:</label>
                <select name="post_category">
                    <option selected disabled value="">Selecione uma categoria</option>
                    <option <?= (!empty($id) && $post_cat_parent == BuscaRapida::buscarCategoriaName('secao-padrao')['category_id'] ? ' selected ' : ''); ?> value="<?= BuscaRapida::buscarCategoriaName('secao-padrao')['category_id']; ?>">Padrão</option>
                    <?php
                    $readSection = new Read;
                    $readSection->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_segment = :segment AND category_name != :name", "segment=blog&name=secao-padrao");

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
                                        <option <?= (!empty($id) && $post_category == $category['category_id'] ? ' selected ' : ''); ?> value="<?= $category['category_id']; ?>"><?= $category['category_title']; ?></option>
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
            </span>

            <legend>Publicar:</legend>

            <span class="form-control">
                <label>Agendar Para:</label>
                <input id="calendar" type="text" name="post_date" value="<?= (!empty($id) ? date('d/m/Y H:i', strtotime($post_date)) : date('d/m/Y H:i')); ?>">
            </span>

            <span class="form-control">
                <select name="post_author">
                    <option selected value="">Selecione um autor</option>
                    <?php
                    $readUsers = new Read;
                    $readUsers->FullRead('SELECT user_id, user_name, user_lastname FROM ' . USUARIOS);
                    if ($readUsers->getResult()):
                        foreach ($readUsers->getResult() as $user):
                            extract($user);
                            ?>
                            <option <?= (!empty($id) && $post_author == $user_id ? ' selected ' : (!empty($_SESSION['userlogin']['user_id']) && $_SESSION['userlogin']['user_id'] == $user_id ? ' selected ' : '')); ?> value="<?= $user_id; ?>"><?= $user_name . ' ' . $user_lastname; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </select>
            </span>

            <span class="form-control">
                <span class="form-control-checkbox"><input <?= (!empty($id) && $post_status == '1' ? 'checked ' : (!isset($id) ? 'checked ' : '')); ?> type="checkbox" name="post_status" value="1"><span>Publicar Agora</span></span>
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>

        </div>

    </form>
<?php endif; ?>

<?php include 'inc/loading_message.inc.php'; ?>
