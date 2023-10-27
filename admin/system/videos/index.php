<!DOCTYPE html>
<!--
Página: See Videos (Ver Videos)
Author: Luiz Felipe C. Lopes
Date: 15/01/2019
-->


<?php
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager("?exe=videos/index&pag=");
$Pager->ExePager($getPage, 6);
$readVideos = new Read;
$readVideos->FullRead("SELECT video_id, video_title, video_name, video_status, video_date, video_url FROM " . VIDEOS . " ORDER BY video_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$readVideos->getResult()):
    echo 'Nenhum vídeo ainda!';
    echo '<a style="margin-left: 10px;" title="Novo Video" href="?exe=videos/texts/create" class="btn btn-blue icon-file radius">Novo Vídeo</a>';
else:
    ?>

    <div class="videos_options">       
        <form action="" method="post">
            <input type="hidden" name="action" value="filter_videos">
            <select id="js_filter_status" name="filter_video_status" class="js_filter_videos">
                <option value="todos">Todos os Status</option>
                <option value="1">Publicado</option>
                <option value="0">Rascunho</option>
            </select>
            <input id="js_filter_search" type="text" name="search_video" placeholder="Pesquisar video" class="js_search_video">
            <span class="icon_search icon-search"></span>
        </form>

        <div class="btn_container">
            <a title="Novo Vídeo" href="?exe=videos/create" class="btn btn-blue icon-file radius">Novo Vídeo</a>
        </div>
    </div>

    <section class="videos js_videos">
        <h2>Meus Vídeos</h2>

        <?php
        foreach ($readVideos->getResult() as $video):
            extract($video);
            ?>

            <article attr-item="video" attr-type="video" id="<?= $video_id; ?>" class="js_item videos_item">

                <div class="js_container_status">
                    <?php if ($video_status == '1'): ?>
                        <a id="<?= $video_id; ?>" attr-status="<?= $video_status; ?>" attr-action="change_status_video" title="Publicado" href="#" class="icon-check btn_status btn_status_published btn btn-small btn-green radius js_status">Publicado</a>
                    <?php else: ?>
                        <a id="<?= $video_id; ?>" attr-status="<?= $video_status; ?>" attr-action="change_status_video" title="Rascunho" href="#" class="icon-alert-triangle btn_status btn_status_draft btn btn-small btn-orange radius js_status">Rascunho</a>
                    <?php endif; ?>
                </div>

                <div class="embed-container video_frame">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= $video_url; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
                <div class="video_info">
                    <h3><?= $video_title; ?></h3>
                    <span class="video_info_date icon-clock"><?= date('d/m/Y à\s\ H:i \h', strtotime($video_date)); ?></span>

                    <div class="video_info_buttons">
                        <a title="Editar Video" href="?exe=videos/create&id=<?= $video_id; ?>" class="icon-edit btn btn-small btn-blue radius">Editar</a>
                        <a id="<?= $video_id; ?>" attr-action="delete_video" title="Excluir Video" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>
                    </div>
                </div>
            </article>

        <?php endforeach; ?>


        <div class="js_paginator" attr-action="paginator_videos">
            <?php
            $Pager->ExeFullPaginator("SELECT video_id, video_title, video_name, video_status, video_date, video_url FROM " . VIDEOS . " ORDER BY video_date DESC");
            $Paginator = $Pager->getPaginator();

            if (!empty($Paginator)):
                ?>
                <div class="paginator_container">
                    <?php echo $Paginator; ?>
                </div>
            <?php endif; ?>
        </div>

    <?php endif; ?>

</section>

<?php include 'inc/confirmation_delete_message.inc.php'; ?>
