<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Destaque</h1>
                    <p class="tagline"> >> Flow State / Destaques / <b>Novo Destaque</b></p>
                </div>

                <a class="btn btn-blue radius" title="Meus Posts" href="<?= HOME; ?>/admin/dashboard.php?exe=destaques/index">Ver Destaques</a>    
                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Novo Destaque" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=destaques/create">Novo Destaque</a>    
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
                    $read->ExeRead(DESTAQUES, "WHERE destaque_id = :id", "id={$id}");
                    if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                        extract($read->getResult()[0]);

                    endif;

                endif;
                ?>



                <form action="" method="post" enctype="multipart/form-data">

                    <div class="trigger-box-suspenso"></div>
                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="destaque_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                    <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_destaque' : 'create_destaque'); ?>"/>



                    <div class="destaques-foto">

                        <div class="container bg-body">


                            <img title="" src="<?= (!empty($destaque_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover : '' ); ?>" class="j_previa hg-9"/>

                            <div class="content">

                                <label class="form-field">
                                    <span class="form-legend">Capa:</span>
                                    <input type="file" name="destaque_cover" title="Capa" class="j_imagem" value="<?= (!empty($destaque_cover) ? $destaque_cover : null ); ?>" />
                                </label>

                                <label class="form-field fl-left">
                                    <span class="form-legend">Categoria (Tipo de Destaque):</span>
                                    <select name="destaque_type">
                                        <option disabled value="">Selecione uma categoria</option>
                                        <option selected <?= (isset($id) && $destaque_type == 'Banner' ? 'selected' : ''); ?> value="Banner">Banner</option>
                                        <option <?= (isset($id) && $destaque_type == 'Video' ? 'selected' : ''); ?> value="Video">Video</option>

                                    </select>
                                </label>

                                <div class="clear"></div>
                            </div>    
                        </div>

                    </div>


                    <div class="container bg-body destaques-novo">

                        <div class="content">


                            <label class="form-field">
                                <span class="form-legend">Título:</span>
                                <input type="text" title="Nome" name="destaque_title" placeholder="Digite um Nome" value="<?= (!empty($destaque_title) ? $destaque_title : null ); ?>" />
                            </label>

                            <label class="form-field">
                                <span class="form-legend">Subtítulo:</span>
                                <textarea rows="5" name="destaque_subtitle" title="subtitulo" placeholder="Digite um Subtítulo" ><?= (!empty($destaque_subtitle) ? $destaque_subtitle : null ); ?></textarea>
                            </label>

                            <label class="form-field">
                                <span class="form-legend">Link do Destaque (Opcional):</span>
                                <input type="text" title="Nome" name="destaque_url" placeholder="Digite uma Url" value="<?= (!empty($destaque_url) ? $destaque_url : null ); ?>" />
                            </label>


                            <div class="container posts-publicar bg-body">

                                <!--<div class="content">-->

                                <h1>Agendar Para:</h1>

                                <form method="post" action="" >

                                    <label class="form-field">
                                        <span class="form-legend">Dia:</span>
                                        <input id="calendar" type="text" title="Nome" name="destaque_date" placeholder="Digite uma data" value="<?= (!empty($destaque_date) ? date('d/m/Y H:i', strtotime($destaque_date)) : date('d/m/Y H:i')); ?>" />
                                    </label>

                                    <label class="form-field">
                                        <select name="destaque_author">
                                            <option disabled selected value="">Selecione um usuário</option>
                                            <?php
                                            $readUser = new Read;
                                            $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                            if ($readUser->getResult()):
                                                foreach ($readUser->getResult() as $user) :
                                                    echo "<option " . (!empty($id) && $user['user_id'] == $destaque_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </label>


                                    <div class="form-check">
                                        <label><input type="checkbox" name="destaque_status" <?= (!empty($id) && $destaque_status == '1' ? 'checked' : '' ); ?> value="1">Publicar Agora</label>
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




