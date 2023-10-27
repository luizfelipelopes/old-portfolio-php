<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Vídeo</h1>
                    <p class="tagline"> >> Flow State / Vídeos / <b>Novo Vídeo</b></p>
                </div>

                <a class="btn btn-blue radius" title="Meus Videos" href="<?= HOME; ?>/admin/dashboard.php?exe=videos/index">Ver Vídeos</a>    

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create">    

            <div class="content js_content_form">

                <?php
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                if ($id):

                    $read = new Read();
                    $read->ExeRead(VIDEOS, "WHERE video_id = :id", "id={$id}");
                    if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                        extract($read->getResult()[0]);

                    endif;

                endif;
                ?>



                <form action="" method="post" enctype="multipart/form-data">

                    <div class="trigger-box-suspenso"></div>
                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="video_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                    <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_video' : 'create_video'); ?>"/>



                    <div class="destaques-foto">

                        <div class="container foto-categoria m-bottom3">


                        <!--<img title="" src="<?= (!empty($video_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $video_cover : '' ); ?>" class="j_previa"/>-->


                            <article class="video_item video_destaque">
                                <div class="video">
                                    <div class="ratio j_previa_video"><iframe class="media" src="https://www.youtube.com/embed/<?= (!empty($video_url) ? $video_url : '' ); ?>" frameborder="0" allowfullscreen></iframe></div>
                                </div>
                            </article>

                            <div class="content">

                                <label class="form-field">
                                    <span class="form-legend">Link do Vídeo (Últimos Caracteres Após o sinal '=', na url do vídeo no Youtube):</span>
                                    <input class="j_url" type="text" title="Nome" name="video_url" placeholder="Digite uma Url" value="<?= (!empty($video_url) ? $video_url : null ); ?>" />
                                </label>

                                <div class="clear"></div>
                            </div>    
                        </div>



                    </div>


                    <div class="container bg-body destaques-novo">

                        <div class="content">


                            <label class="form-field">
                                <span class="form-legend">Título:</span>
                                <input type="text" title="Nome" name="video_title" placeholder="Digite um Nome" value="<?= (!empty($video_title) ? $video_title : null ); ?>" />
                            </label>

                            <label class="form-field">
                                <span class="form-legend">Descrição:</span>
                                <textarea rows="5" name="video_desc" title="descrição" placeholder="Digite uma Descricao" ><?= (!empty($video_desc) ? $video_desc : null ); ?></textarea>
                            </label>


                            <div class="container posts-publicar bg-body">

                                <!--<div class="content">-->

                                <h1>Publicar:</h1>

                                <form method="post" action="" >

                                    <label class="form-field">
                                        <span class="form-legend">Dia:</span>
                                        <input id="calendar" type="text" title="Nome" name="video_date" placeholder="Digite uma data" value="<?= (!empty($video_date) ? date('d/m/Y H:i', strtotime($video_date)) : date('d/m/Y H:i')); ?>" />
                                    </label>

                                    <label class="form-field">
                                        <select name="video_author">
                                            <option disabled selected value="">Selecione um usuário</option>
                                            <?php
                                            $readUser = new Read;
                                            $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                            if ($readUser->getResult()):
                                                foreach ($readUser->getResult() as $user) :
                                                    echo "<option " . (!empty($id) && $user['user_id'] == $video_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                                endforeach;
                                            endif;
                                            ?>
                                        </select>
                                    </label>


                                    <div class="form-check">
                                        <label><input type="checkbox" name="video_status" <?= (!empty($id) && $video_status == '1' ? 'checked' : '' ); ?> value="1">Publicar Agora</label>
                                        <label><input type="checkbox" name="video_destaque" <?= (!empty($id) && $video_destaque == '1' ? 'checked' : '' ); ?> value="1">Colocar em Destaque</label>
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




