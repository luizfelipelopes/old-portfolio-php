<?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Curso</h1>
                    <p class="tagline"> >> <?= SOFTWARE; ?> / Cursos / <b>Novo Curso</b></p>
                </div>

                <a class="btn btn-blue radius m-bottom1" title="Novo Curso" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=cursos/index">Meus Cursos</a>
                <?php
                if ($id):
                    ?>
                    <a class="btn btn-blue btn-separador radius" title="Gerenciar Curso" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=cursos/gerenciar&id=<?= $id; ?>">Gerenciar Curso</a>
                <?php endif; ?>    


                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create">    

            <?php
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id):

                $read = new Read();
                $read->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$id}");
                if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($read->getResult()[0]);

                endif;

            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">

                <div class="container bg-body posts-novo">

                    <div class="content">



                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="curso_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_curso' : 'create_curso'); ?>"/>


                        <label class="form-field">
                            <span class="form-legend">Capa:</span>
                            <input type="file" name="curso_cover" title="Capa" class="j_imagem" value="<?= (!empty($curso_cover) ? $curso_cover : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Curso:</span>
                            <input type="text" title="Nome" name="curso_title" placeholder="Digite um Nome" value="<?= (!empty($curso_title) ? $curso_title : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Headline:</span>
                            <textarea rows="5" name="curso_subtitle" title="subtitulo" placeholder="Digite um Subtítulo" ><?= (!empty($curso_subtitle) ? $curso_subtitle : null ); ?></textarea>
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Descrição:</span>
                            <textarea rows="5" name="curso_descricao" title="descricao" placeholder="Digite uma Descrição" ><?= (!empty($curso_descricao) ? $curso_descricao : null ); ?></textarea>
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Tutor:</span>
                            <select name="curso_tutor">
                                <option>Selecione um Tutor</option>
                                <?php
                                $readUser = new Read;
                                $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                if ($readUser->getResult()):
                                    foreach ($readUser->getResult() as $user) :
                                        echo "<option " . (!empty($id) && $user['user_id'] == $curso_tutor ? 'selected' : '') . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                    endforeach;
                                endif;
                                ?>
                            </select>
                        </label>


                        <label class="form-field">
                            <span class="form-legend">Valor:</span>
                            <input class="input_fale j_valor" type="text" title="Valor do Curso" name="curso_valor" placeholder="Digite um Valor para o Curso" value="<?= (!empty($curso_valor) ? number_format($curso_valor, 2, ',', '.') : null ); ?>" />
                        </label>


                        <div class="clear"></div>  
                    </div>
                </div>



                <div class="posts-lateral">

                    <div class="container foto-categoria m-bottom3">


                        <img title="" src="<?= (!empty($curso_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso_cover : '' ); ?>" class="j_previa"/>

                        <div class="content">

                            <label class="form-field fl-left">
                                <span class="form-legend">Segmentação:</span>
                                <select name="curso_segment">

                                    <option value="">Selecione um Segmento</option>

                                    <?php
                                    $read = new Read;
                                    $read->ExeRead(SEGMENTOS, "ORDER BY segment_title");
                                    if ($read->getResult()):
//                                        $readCategoria = new Read;

                                        foreach ($read->getResult() as $segmento) :

//                                            $readCategoria->ExeRead("gabadi_categories", "WHERE category_parent = :id ORDER BY category_title", "id={$secao['category_id']}");
//                                            if ($readCategoria->getResult()):
//                                                echo "<option disabled class='bg-gray' value='" . $secao['category_id'] . "'> >>" . $secao['category_title'] . "</option>";
//                                                foreach ($readCategoria->getResult() as $categoria) :
                                            echo "<option " . (!empty($id) && $segmento['segment_id'] == $curso_segment ? 'selected' :($segmento['segment_id'] == $read->getResult()[0]['segment_id'] ? 'selected' : '')) . " value='" . $segmento['segment_id'] . "'>" . $segmento['segment_title'] . "</option>";
//                                                endforeach;
//                                            endif;


                                        endforeach;

                                    endif;
                                    ?>

                                </select>
                            </label>

                            <div class="clear"></div>
                        </div>    
                    </div>

                    <div class="container posts-publicar bg-body">

                        <div class="content">

                            <h1>Publicar:</h1>

                            <form method="post" action="" >

                                <label class="form-field">
                                    <span class="form-legend">Dia:</span>
                                    <input type="date" title="Nome" name="curso_date" placeholder="Digite uma data" value="<?= (!empty($curso_date) ? date('Y-m-d', strtotime($curso_date)) : date('Y-m-d')); ?>" />
                                </label>

                                <label class="form-field">
                                    <select name="curso_author">
                                        <option>Selecione um usuário</option>
                                        <?php
                                        $readUser = new Read;
                                        $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                        if ($readUser->getResult()):
                                            foreach ($readUser->getResult() as $user) :
                                                echo "<option " . (!empty($id) && $user['user_id'] == $curso_author ? 'selected' : ($user['user_id'] == $_SESSION['userlogin']['user_id'] ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </label>


                                <div class="form-check">
                                    <label><input type="checkbox" name="curso_status" <?= (!empty($id) && $curso_status == '1' ? 'checked' : '' ); ?> value="<?= (!empty($id) ? $curso_status : '1' ); ?>">Publicar Agora</label>
                                </div>

                                <button class="btn btn-green radius j_btn">Atualizar!</button>
                                <div title="Carregando" class="load fl-right"></div>
                                <!--</form>-->

                                <div class="clear"></div>
                        </div>

                    </div>

                </div>

            </form>

            <div class="clear"></div>
        </div>




