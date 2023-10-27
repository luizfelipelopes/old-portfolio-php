<!DOCTYPE html>
<!--
Página: New Video (Novo Video)
Author: Luiz Felipe C. Lopes
Date: 29/08/2018
-->

<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>

<div class="videos_options videos_options_create">
    <?php if (!empty($id)): ?>
        <a title="" href="?exe=videos/create" class="btn btn-orange icon-folder radius">Novo Video</a>
    <?php endif; ?>
    <a title="" href="?exe=videos/index" class="btn btn-blue icon-eye-big radius">Ver Videos</a>
</div>


<?php
if ($id):
    $readVideo = new Read();
    $readVideo->FullRead("SELECT video_id, video_title, video_url, video_author, video_status FROM " . VIDEOS . " WHERE video_id = :id", "id={$id}");
    if ($readVideo->getResult()):
        extract($readVideo->getResult()[0]);
    endif;
endif;
?>

<?php if ((!empty($id) && $readVideo->getResult()) || !isset($id)): ?>
    <form class="form_video" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="action" value="<?= (!empty($id) ? 'update_video' : 'create_video'); ?>">
        <input type="hidden" name="video_id" value="<?= (!empty($id) ? $id : ''); ?>">

        <div class="form_background">

            <span class="form-control">
                <label>Link do Video (Últimos caracteres após o sinal '=', na URL do video do Youtube):</label>
                <input class="js_keyup_preview_right" type="text" name="video_url" placeholder="Digite uma URL" value="<?= (!empty($id) ? $video_url : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Nome:</label>
                <input type="text" name="video_title" placeholder="Digite um nome" value="<?= (!empty($id) ? $video_title : ''); ?>" required>
            </span>
        </div>


        <div class="form_background">

            <div class="video_form js_video_preview">
                <div class="embed-container video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= (!empty($id) ? $video_url : ''); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <span class="form-control">
                <span class="form-control-checkbox"><input <?= (!empty($id) && $video_status == '1' ? 'checked ' : (!isset($id) ? 'checked ' : '')); ?> type="checkbox" name="video_status" value="1"><span>Publicar Agora</span></span>
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>

        </div>

        <span id="j_ajaxident" class="<?= "../_cdn/ajax" ?>"></span>
    </form>
<?php endif; ?>
<?php include 'inc/loading_message.inc.php'; ?>
