<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Nova Pagina</h1>
                    <p class="tagline"> >> Flow State / Paginas / <b>Nova Pagina</b></p>
                </div>

                <a class="btn btn-blue radius" title="Meus Posts" href="<?= HOME; ?>/admin/dashboard.php?exe=paginas/index">Ver Paginas</a>    
                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Nova Pagina" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=paginas/create">Nova Pagina</a>    
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
                    $read->ExeRead(PAGINAS, "WHERE pagina_id = :id", "id={$id}");
                    if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                        extract($read->getResult()[0]);

                    endif;

                endif;
                ?>



                <form action="" method="post" enctype="multipart/form-data">

                    <div class="trigger-box-suspenso"></div>
                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="pagina_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                    <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_pagina' : 'create_pagina'); ?>"/>
                    <input readonly type="hidden" name="limpar_cover" value="0"/>



                    <div class="destaques-foto">

                        <div class="container bg-body">

                            <div class="bg-red js_excluir_cover pointer" style="width: 120px; position: absolute; right: 0; padding: 10px;">Excluir Capa</div>
                            <img title="" src="<?= (!empty($pagina_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $pagina_cover : '' ); ?>" class="j_previa hg-9"/>

                            <div class="content">

                                <label class="form-field">
                                    <span class="form-legend">Capa (Opcional):</span>
                                    <input type="file" name="pagina_cover" title="Capa" class="j_imagem" value="<?= (!empty($pagina_cover) ? $pagina_cover : null ); ?>" />
                                </label>

                                <label class="form-field fl-left">
                                    <span class="form-legend">Segmento:</span>
                                    <select name="pagina_segment">
                                        <option disabled value="">Selecione um segmento</option>
                                        <option selected <?= (isset($id) && $pagina_segment == 'blog' ? 'selected' : ''); ?> value="blog">Blog</option>
                                        <option <?= (isset($id) && $pagina_segment == 'ecommerce' ? 'selected' : ''); ?> value="ecommerce">E-commerce</option>
                                        <option <?= (isset($id) && $pagina_segment == 'ead' ? 'selected' : ''); ?> value="rad">EAD</option>

                                    </select>
                                </label>

                                <div class="clear"></div>
                                <!--                            </div>    -->





                                <!--<div class="container bg-body paginas-novo">-->

                                <!--<div class="content">-->


                                <label class="form-field m-top0">
                                    <span class="form-legend">Título:</span>
                                    <input type="text" title="Nome" name="pagina_title" placeholder="Digite um Nome" value="<?= (!empty($pagina_title) ? $pagina_title : null ); ?>" />
                                </label>

                                <label class="form-field">
                                    <span class="form-legend">Url Personalizada (Opcional):</span>
                                    <input type="text" title="Nome" name="pagina_name" placeholder="Url Personalizada" value="<?= (!empty($pagina_name) ? $pagina_name : null ); ?>" />
                                </label>

                                <label class="form-field">
                                    <span class="form-legend">Conteúdo:</span>
                                    <textarea id="j_post" class="js_editor" rows="5" name="pagina_content" title="Conteúdo" placeholder="Digite um Conteúdo" ><?= (!empty($pagina_content) ? htmlentities($pagina_content) : null ); ?></textarea>
                                </label>


                                <div class="container posts-publicar bg-body">

                                    <!--<div class="content">-->

                                    <h1>Agendar Para:</h1>

                                    <!--<form method="post" action="" >-->

                                    <label class="form-field">
                                        <span class="form-legend">Dia:</span>
                                        <input id="calendar" type="text" title="Nome" name="pagina_date" placeholder="Digite uma data" value="<?= (!empty($pagina_date) ? date('d/m/Y H:i', strtotime($pagina_date)) : date('d/m/Y H:i')); ?>" />
                                    </label>

                                    <label class="form-field">
                                        <select name="pagina_author">
                                            <option disabled selected value="">Selecione um usuário</option>
                                            <?php
                                            $readUser = new Read;
                                            $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                            if ($readUser->getResult()):
                                                foreach ($readUser->getResult() as $user) :
                                                    echo "<option " . (!empty($id) && $user['user_id'] == $pagina_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </label>


                                    <div class="form-check">
                                        <label><input type="checkbox" name="pagina_status" <?= (!empty($id) && $pagina_status == '1' ? 'checked' : '' ); ?> value="1">Publicar Agora</label>
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
                    </div>

                </form>
                <div class="clear"></div>
            </div>

            <div class="clear"></div>
        </div>




