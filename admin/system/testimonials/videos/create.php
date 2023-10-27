<!DOCTYPE html>
<!--
Página: New Videos Testimonials (Novo Depoimento em Video)
Author: Luiz Felipe C. Lopes
Date: 29/08/2018
-->

<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>

<div class="testimonial_options testimonial_options_create">
    <?php if (!empty($id)): ?>
        <a title="" href="?exe=testimonials/videos/create" class="btn btn-orange icon-folder radius">Novo Depoimento</a>
    <?php endif; ?>
    <a title="" href="?exe=testimonials/videos/index" class="btn btn-blue icon-eye-big radius">Ver Depoimento</a>
</div>


<?php
if ($id):
    $readTestimonial = new Read();
    $readTestimonial->FullRead("SELECT depoimento_id, depoimento_name, depoimento_video, depoimento_content, depoimento_cover, depoimento_author, depoimento_uf, depoimento_cidade, depoimento_status FROM " . DEPOIMENTOS . " WHERE depoimento_id = :id", "id={$id}");
    if ($readTestimonial->getResult()):
        extract($readTestimonial->getResult()[0]);
    endif;
endif;
?>

<?php if ((!empty($id) && $readTestimonial->getResult()) || !isset($id)): ?>
    <form class="form_testimonial" action="" method="post" enctype="multipart/form-data">

        <input type="hidden" name="action" value="<?= (!empty($id) ? 'update_testimonial' : 'create_testimonial'); ?>">
        <input type="hidden" name="depoimento_id" value="<?= (!empty($id) ? $id : ''); ?>">
        <input type="hidden" name="depoimento_type" value="video">

        <div class="form_background">

            <span class="form-control">
                <label>Link do Video (Últimos caracteres após o sinal '=', na URL do video do Youtube):</label>
                <input class="js_keyup_preview_right" type="text" name="depoimento_video" placeholder="Digite uma URL" value="<?= (!empty($id) ? $depoimento_video : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>Nome:</label>
                <input type="text" name="depoimento_name" placeholder="Digite um nome" value="<?= (!empty($id) ? $depoimento_name : ''); ?>" required>
            </span>
            <span class="form-control">
                <label>UF:</label>
                <select id="js_uf" name="depoimento_uf" class="j_loadstate" required>
                    <option selected value="0">Selecione o estado</option>
                    <?php
                    $readUf = new Read;
                    $readUf->FullRead("SELECT estado_id, estado_nome, estado_uf FROM " . ESTADOS . " ORDER BY estado_nome ASC");
                    if ($readUf->getResult()):
                        foreach ($readUf->getResult() as $uf):
                            extract($uf);
                            ?>
                            <option <?= (!empty($id) && $depoimento_uf == $estado_id ? 'selected' : ''); ?> value="<?= $estado_id; ?>"><?= $estado_nome; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </select>
            </span>
            <span class="form-control">
                <label>Cidade:</label>
                <select id="js_city" name="depoimento_cidade" class="j_loadcity" <?= (!empty($id) && !empty($depoimento_cidade) ? '' : 'disabled'); ?> required>
                    <option selected value="0">Selecione a cidade</option>
                    <?php
                    if (!empty($id)):
                        $readCity = new Read;
                        $readCity->FullRead("SELECT cidade_id, cidade_nome, cidade_uf FROM " . CIDADES . " WHERE estado_id = :uf ORDER BY cidade_nome ASC", "uf={$depoimento_uf}");
                        if ($readCity->getResult()):
                            foreach ($readCity->getResult() as $city):
                                extract($city);
                                ?>
                                <option <?= ($cidade_id == $depoimento_cidade ? 'selected' : ''); ?> value="<?= $cidade_id; ?>"><?= $cidade_nome; ?></option>
                                <?php
                            endforeach;
                        endif;
                    endif;
                    ?>

                </select>
            </span>

        </div>


        <div class="form_background">

            <div class="testimonial_video_form js_video_preview">
                <div class="embed-container testimonial_video">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?= (!empty($id) ? $depoimento_video : ''); ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <span class="form-control">
                <span class="form-control-checkbox"><input <?= (!empty($id) && $depoimento_status == '1' ? 'checked ' : (!isset($id) ? 'checked ' : '')); ?> type="checkbox" name="depoimento_status" value="1"><span>Publicar Agora</span></span>
            </span>

            <div class="button_block">
                <button class="btn btn-green radius icon-check-square">Salvar</button>
            </div>

        </div>

        <span id="j_ajaxident" class="<?= "../_cdn/ajax" ?>"></span>
    </form>
<?php endif; ?>
<?php include 'inc/loading_message.inc.php'; ?>
