<!DOCTYPE html>
<!--
Página: See Text Testimonials (Ver Depoimentos em Texto)
Author: Luiz Felipe C. Lopes
Date: 29/08/2018
-->

<?php
$readTestimonials = new Read;
$readTestimonials->FullRead("SELECT depoimento_id, depoimento_cover, depoimento_name, depoimento_status, depoimento_date FROM " . DEPOIMENTOS . " WHERE depoimento_type = :type ORDER BY depoimento_order ASC", "type=texto");

if (!$readTestimonials->getResult()):
    echo 'Nenhum depoimento ainda!';
    echo '<a style="margin-left: 10px;" title="Novo Depoimento" href="?exe=testimonials/texts/create" class="btn btn-blue icon-file radius">Novo Depoimento</a>';
else:
    ?>

    <div class = "testimonial_options">
<!--        <form action = "" method = "post">
            <input type = "text" name = "search_testimonial" placeholder = "Pesquisar depoimento">
            <span class = "icon_search icon-search"></span>
        </form>-->

        <div class = "btn_container">
            <a title = "Novo Depoimento" href = "?exe=testimonials/texts/create" class = "btn btn-blue icon-file radius">Novo Depoimento</a>
        </div>
    </div>

    <section class = "testimonials">
        <h2>Meus Depoimentos</h2>

        <?php
        foreach ($readTestimonials->getResult() as $testimonial):
            extract($testimonial);
            ?>
                
        <article attr-item="depoimento" attr-type="texto" draggable="true" id="<?= $depoimento_id; ?>" class="js_item testimonials_item j_drag_active">

                    <div class="js_container_status">
                        <?php if ($depoimento_status == '1'): ?>
                            <a id="<?= $depoimento_id; ?>" attr-status="<?= $depoimento_status; ?>" attr-action="change_status_testimonial" title="Publicado" href="#" class="icon-check btn_status btn_status_published btn btn-small btn-green radius js_status">Publicado</a>
                        <?php else: ?>
                            <a id="<?= $depoimento_id; ?>" attr-status="<?= $depoimento_status; ?>" attr-action="change_status_testimonial" title="Rascunho" href="#" class="icon-alert-triangle btn_status btn_status_draft btn btn-small btn-orange radius js_status">Rascunho</a>
                        <?php endif; ?>
                    </div>

                    <div class="image_preview">
                        <img title="<?= $depoimento_name; ?>" alt="<?= $depoimento_name; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $depoimento_cover; ?>">
                    </div>
                    <div class="testimonial_info">
                        <h3><?= $depoimento_name; ?></h3>
                        <span class="testimonial_info_date icon-clock"><?= date('d/m/Y à\s\ H:i \h', strtotime($depoimento_date)); ?> </span>

                        <div class="testimonial_info_buttons">
                            <a title="Editar Post" href="?exe=testimonials/texts/create&id=<?= $depoimento_id; ?>" class="icon-edit btn btn-small btn-blue radius">Editar</a>
                            <a id="<?= $depoimento_id; ?>" attr-action="delete_testimonial" title="Excluir Post" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>
                        </div>
                    </div>
                </article>

        <?php endforeach; ?>
    <?php endif; ?>


    <?php include 'inc/confirmation_delete_message.inc.php'; ?>


</section>
