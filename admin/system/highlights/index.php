<!DOCTYPE html>
<!--
Página: See Text Testimonials (Ver Depoimentos em Texto)
Author: Luiz Felipe C. Lopes
Date: 29/08/2018
-->

<?php
$readHighlights = new Read();
$readHighlights->FullRead('SELECT destaque_id, destaque_title, destaque_cover, destaque_status, destaque_type, destaque_date FROM ' . DESTAQUES . ' WHERE destaque_type = :type ORDER BY destaque_order ASC', 'type=foto');
if (!$readHighlights->getResult()):
    echo 'Nenhum destaque ainda!';
    echo '<a style="margin-left: 10px;" title="Novo Destaque" href="?exe=highlights/create" class="btn btn-blue icon-file radius">Novo Destaque</a>';
else:
    ?>


    <div class="featured_options">
        <!--        <form action="" method="post">
                    <select name="filter_featured_category" class="col-50">
                        <option value="">Filtrar destaque</option>
                        <option value="1">Publicado</option>
                        <option value="0">Rascunho</option>
                    </select>
                    <input type="text" name="search_featured" placeholder="Pesquisar destaque" class="col-50">
                    <span class="icon_search icon-search"></span>
                </form>-->

        <div class="btn_container">
            <a title="Novo Destaque" href="?exe=highlights/create" class="btn btn-blue icon-file radius">Novo Destaque</a>
        </div>
    </div>

    <section class="highlights">
        <h2>Meus Destaques</h2>

        <?php
        foreach ($readHighlights->getResult() as $featured):
            extract($featured);
            ?>

            <article attr-item="destaque" attr-type="foto" draggable="true" id="<?= $destaque_id; ?>" class="js_item highlights_item j_drag_active">

                <div class="js_container_status">
                    <?php if ($destaque_status == '1'): ?>

                        <a id="<?= $destaque_id; ?>" attr-status="<?= $destaque_status; ?>" attr-action="change_status_featured" title="Publicado" href="#" class="icon-check btn_status btn_status_published btn btn-small btn-green radius js_status">Publicado</a>
                    <?php else: ?>
                        <a id="<?= $destaque_id; ?>" attr-status="<?= $destaque_status; ?>" attr-action="change_status_featured" title="Rascunho" href="#" class="icon-alert-triangle btn_status btn_status_draft btn btn-small btn-orange radius js_status">Rascunho</a>

                    <?php endif; ?>
                </div>

                <div class="image_preview">
                    <img title="<?= $destaque_title; ?>" alt="<?= $destaque_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>">
                </div>
                <div class="featured_info">
                    <span class="featured_info_category icon-tag"><?= ucwords($destaque_type); ?></span>
                    <span class="featured_info_date icon-clock"><?= date('d/m/Y à\s\ H:i \h', strtotime($destaque_date)); ?></span>

                    <div class="featured_info_buttons">
                        <a title="Exibir Destaque" href="<?= HOME; ?>" target="_blank" class="icon-check-square btn btn-small btn-gray radius">Exibir</a>
                        <a title="Editar Destaque" href="?exe=highlights/create&id=<?= $destaque_id; ?>" class="icon-edit btn btn-small btn-blue radius">Editar</a>
                        <a id="<?= $destaque_id; ?>" attr-action="delete_featured" title="Excluir Destaque" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>
                    </div>
                </div>
            </article>

        <?php endforeach; ?>

        <?php include 'inc/confirmation_delete_message.inc.php'; ?>

    </section>

<?php endif; ?>
