<!DOCTYPE html>
<!--
Página: New Featured (Novo Destaque)
Author: Luiz Felipe C. Lopes
Date: 29/08/2018
-->
<link href="../_cdn/jquery-ui.css" rel="stylesheet">

<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>

<div class="featured_options featured_options_create">
    <?php if (!empty($id)): ?>
        <a title="" href="?exe=highlights/create" class="btn btn-orange icon-file radius">Novo Destaque</a>
    <?php endif; ?>
    <a title="" href="?exe=highlights/index" class="btn btn-blue icon-eye-big radius">Ver Destaques</a>
</div>

<?php
if ($id):
    $readHighlights = new Read();
    $readHighlights->FullRead("SELECT destaque_id, destaque_cover, destaque_type, destaque_date, destaque_author, destaque_status FROM " . DESTAQUES . " WHERE destaque_id = :id", "id={$id}");
    if ($readHighlights->getResult()):
        extract($readHighlights->getResult()[0]);
    else:
        echo 'Não existe nenhum destaque com este id!';
    endif;
endif;
?>

<?php if ((!empty($id) && $readHighlights->getResult()) || !isset($id)): ?>
    <div class="form_featured form_background">
        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="<?= (!empty($id) ? 'update_featured' : 'create_featured') ?>">
            <input type="hidden" name="destaque_id" value="<?= (!empty($id) ? $id : ''); ?>">

            <span class="image_preview">
                <img class="js_preview_image" title="" alt="" src="<?= (!empty($id) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover : ''); ?>">
            </span>

            <span class="form-control capa_featured">
                <label>Capa: <?= (!empty($id) ? '<small>' . $destaque_cover . '</small>' : ''); ?></label>
                <input class="js_change_image_preview" type="file" name="destaque_cover">
            </span>

            <span class="form-control">
                <label>Categoria (Tipo de Destaque):</label>
                <select name="destaque_type" readonly>
                    <!--<option selected value="">Selecione uma categoria</option>-->
                    <!--<option value="banner">Banner</option>-->
                    <option selected value="foto">Foto</option>
                </select>
            </span>

            <legend>Agendar Para:</legend>

            <span class="form-control">
                <label>Dia:</label>
                <input id="calendar" type="text" name="destaque_date" value="<?= (!empty($id) ? date('d/m/Y H:i', strtotime($destaque_date)) : date('d/m/Y H:i')); ?>" required>
            </span>

            <span class="form-control">
                <label>Autor:</label>
                <select name="destaque_author" required>
                    <option selected value="">Selecione um autor</option>
                    <?php
                    $readAuthor = new Read;
                    $readAuthor->FullRead('SELECT user_id, user_name, user_lastname FROM ' . USUARIOS);
                    if ($readAuthor->getResult()):
                        foreach ($readAuthor->getResult() as $author):
                            extract($author);
                            ?>
                            <option <?= ((!empty($id) && $destaque_author == $user_id ? 'selected' : !empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_id'] == $user_id ? 'selected' : '')); ?> value="<?= $user_id; ?>"><?= $user_name . ' ' . $user_lastname; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>
                </select>
            </span>

            <span class="form-control">
                <span class="form-control-checkbox"><input <?= (!empty($id) && $destaque_status == '1' ? ' checked ' : ''); ?> type="checkbox" name="destaque_status" value="1"><span>Publicar Agora</span></span>
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>

        </form>
    <?php endif; ?>
    <?php include 'inc/loading_message.inc.php'; ?>
</div>
