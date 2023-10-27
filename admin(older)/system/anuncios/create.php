<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Anuncio</h1>
                    <p class="tagline"> >> Flow State / Anuncios / <b>Novo Anuncio</b></p>
                </div>

                <a class="btn btn-blue radius" title="Meus Posts" href="<?= HOME; ?>/admin/dashboard.php?exe=anuncios/index">Ver Anuncios</a>    
                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Novo Anuncio" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=anuncios/create">Novo Anuncio</a>    
                    <?php
                endif;
                ?>
                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create js_content_form">    
            <div class="content">

                <?php
                if ($id):

                    $read = new Read();
                    $read->ExeRead(ANUNCIOS, "WHERE anuncio_id = :id", "id={$id}");
                    if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                        extract($read->getResult()[0]);

                    endif;

                endif;
                ?>



                <form action="" method="post" enctype="multipart/form-data">

                    <div class="trigger-box-suspenso"></div>
                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="anuncio_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                    <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_anuncio' : 'create_anuncio'); ?>"/>



                    <div class="anuncios-foto">

                        <div class="container bg-body">


                            <img title="" src="<?= (!empty($anuncio_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $anuncio_cover : '' ); ?>" class="j_previa hg-9"/>

                            <div class="content">

                                <label class="form-field">
                                    <span class="form-legend">Capa:</span>
                                    <input type="file" name="anuncio_cover" title="Capa" class="j_imagem" value="<?= (!empty($anuncio_cover) ? $anuncio_cover : null ); ?>" />
                                </label>

                                <label class="form-field fl-left">
                                    <span class="form-legend">Categoria (Tipo de Anuncio):</span>
                                    <select name="anuncio_type">
                                        <option disabled value="">Selecione uma categoria</option>
                                        <option selected <?= (isset($id) && $anuncio_type == 'Anuncio' ? 'selected' : ''); ?> value="Anuncio">Anúncio</option>
                                        <!--<option <?= (isset($id) && $anuncio_type == 'Video' ? 'selected' : ''); ?> value="Video">Video</option>-->
                                    </select>
                                </label>

                                <div class="clear"></div>
                            </div>    
                        </div>

                    </div>


                    <div class="container bg-body anuncios-novo">

                        <div class="content">


                            <label class="form-field">
                                <span class="form-legend">Título:</span>
                                <input type="text" title="Nome" name="anuncio_title" placeholder="Digite um Nome" value="<?= (!empty($anuncio_title) ? $anuncio_title : null ); ?>" />
                            </label>

                            <label class="form-field">
                                <span class="form-legend">Subtítulo:</span>
                                <textarea rows="5" name="anuncio_subtitle" title="subtitulo" placeholder="Digite um Subtítulo" ><?= (!empty($anuncio_subtitle) ? $anuncio_subtitle : null ); ?></textarea>
                            </label>

                            <label class="form-field">
                                <span class="form-legend">Link do Anuncio (Opcional):</span>
                                <input type="text" title="Nome" name="anuncio_url" placeholder="Digite uma Url" value="<?= (!empty($anuncio_url) ? $anuncio_url : null ); ?>" />
                            </label>


                            <div class="container posts-publicar bg-body">

                                <!--<div class="content">-->

                                <h1>Agendar Para:</h1>

                                <form method="post" action="" >

                                    <label class="form-field">
                                        <span class="form-legend">Dia:</span>
                                        <input id="calendar" type="text" title="Nome" name="anuncio_date" placeholder="Digite uma data" value="<?= (!empty($anuncio_date) ? date('d/m/Y H:i', strtotime($anuncio_date)) : date('d/m/Y H:i')); ?>" />
                                    </label>

                                    <label class="form-field">
                                        <select name="anuncio_author">
                                            <option disabled selected value="">Selecione um usuário</option>
                                            <?php
                                            $readUser = new Read;
                                            $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                            if ($readUser->getResult()):
                                                foreach ($readUser->getResult() as $user) :
                                                    echo "<option " . (!empty($id) && $user['user_id'] == $anuncio_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </label>


                                    <div class="form-check">
                                        <label><input type="checkbox" name="anuncio_status" <?= (!empty($id) && $anuncio_status == '1' ? 'checked' : '' ); ?> value="1">Publicar Agora</label>
                                    </div>

                                    <button class="btn btn-green radius j_btn">Atualizar!</button>
                                    <div title="Carregando" class="load fl-right"></div>
                                    <!--</form>-->

                                    <!--<div class="clear"></div>-->
                                    <!--</div>-->

                            </div>

                            <div class="clear"></div>  
                        </div>
                    </div>


                </form>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>




