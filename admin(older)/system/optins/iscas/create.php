<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = $_SERVER['REQUEST_URI'];



$Segment = null;
if (strpos($url, 'iscas') !== false):
    $Segment = 'blog';
elseif (strpos($url, 'produto') !== false):
    $Segment = 'curso';
elseif (strpos($url, 'ead') !== false):
    $Segment = 'ead';
endif;


//var_dump($url, $Segment);
//die;
?>
<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Nova Isca</h1>
                    <p class="tagline"> >> Flow State / Iscas / <b>Nova Isca</b></p>
                </div>

                <a class="btn btn-blue m-bottom1 radius" title="Minhas Iscas" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=optins/iscas/index">Minhas Iscas</a>  
                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Nova Isca" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=optins/iscas/create">Novo Isca</a>    
                    <?php
                endif;
                ?>

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create js_content_form">    

            <?php
            if ($id):

                $read = new Read();
//                $read->ExeRead(ISCAS, "WHERE isca_id = :id", "id={$id}");
//              DATE_FORMAT(isca_date, '%d/%m/%y %H:%i:%s') AS 
                $read->FullRead("SELECT isca_id, isca_name, isca_title, isca_file, isca_url, isca_cover, isca_author, isca_type, isca_arquivo_url isca_date FROM " . ISCAS . " WHERE isca_id = :id", "id={$id}");

                if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
//                    die;
                    extract($read->getResult()[0]);

                endif;

            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">



                <div class="container bg-body posts-novo">

                    <div class="content">


                        <div class="trigger-box-suspenso"></div>
                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="isca_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_isca' : 'create_isca'); ?>"/>


                        <label class="form-field">
                            <span class="form-legend">Capa:</span>
                            <input type="file" name="isca_cover" title="Capa" class="j_imagem" value="<?= (!empty($isca_cover) ? $isca_cover : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Título:</span>
                            <input type="text" title="Nome" name="isca_title" placeholder="Digite um Nome" value="<?= (!empty($isca_title) ? $isca_title : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Isca:</span>
                            <select name="isca_type">
                                <option selected disabled value="">Selecione um tipo de Isca</option>
                                <option <?= (!empty($isca_type) ? 'selected' : '' ); ?> value="ebook">E-book</option>
                                <option <?= (!empty($isca_type) ? 'selected' : '' ); ?> value="documento">Documento(Documento)</option>
                                <option <?= (!empty($isca_type) ? 'selected' : '' ); ?> value="planilha">Planilha</option>
                                <option <?= (!empty($isca_type) ? 'selected' : '' ); ?> value="apresentacao">Apresentação(PowerPoint)</option>
                                <option class="js_video_option" <?= (!empty($isca_type) ? 'selected' : '' ); ?> value="video">Vídeo (Link Externo)</option>
                                <option <?= (!empty($isca_type) ? 'selected' : '' ); ?> value="pdf">PDF</option>
                            </select>
                        </label>


                        <div class="form-check m-bottom2">
                            <span class="form-legend m-top2">Arquivo é um link externo?</span>
                            <label class="radio-inline"><input type="radio" name="isca_arquivo_url" <?= (!empty($id) && $isca_arquivo_url == '1' ? 'checked' : '' ); ?> value="1" required>Sim</label>
                            <label class="radio-inline"><input type="radio" name="isca_arquivo_url" <?= (!empty($id) && $isca_arquivo_url == '1' ? 'checked' : '' ); ?> value="0">Não</label>
                        </div>

                        <label class="form-field js_campo_oculto">
                            <span class="form-legend">Upload de Arquivo (Somente Arquivos abaixo de 2 MB):</span>
                            <input type="file" name="isca_file" title="Upload da Isca" value="<?= (!empty($isca_file) ? $isca_file : null ); ?>"/>
                        </label>

                        <label class="form-field js_campo_oculto">
                            <span class="form-legend">Url do Arquivo:</span>
                            <input type="text" title="Url do Arquivo" name="isca_url" placeholder="Digite uma Url" value="<?= (!empty($isca_url) ? $isca_url : null ); ?>"/>
                        </label>

                        <div class="clear"></div>  
                    </div>
                </div>



                <div class="posts-lateral">

                    <div class="container foto-categoria m-bottom3">


                        <img title="" src="<?= (!empty($isca_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $isca_cover : '' ); ?>" class="j_previa"/>


                    </div>

                    <div class="container posts-publicar bg-body">

                        <div class="content">

                            <h1>Publicar:</h1>

                            <form method="post" action="" >

                                <label class="form-field">
                                    <span class="form-legend">Agendar Para:</span>
                                    <input id="calendar" type="text" title="Nome" name="isca_date" placeholder="Digite uma data" value="<?= (!empty($isca_date) ? date('d/m/Y H:i', strtotime($isca_date)) : date('d/m/Y H:i')); ?>" />

                                </label>

                                <label class="form-field">
                                    <select name="isca_author">
                                        <option disabled selected value="">Selecione um usuário</option>
                                        <?php
                                        $readUser = new Read;
                                        $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                        if ($readUser->getResult()):
                                            foreach ($readUser->getResult() as $user) :
                                                echo "<option " . (!empty($id) && $user['user_id'] == $produto_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </label>

                                <button class="btn btn-green radius j_btn">Atualizar!</button>
                                <div title="Carregando" class="load fl-right"></div>
                                <div class="clear"></div>
                        </div>

                    </div>

                </div>

            </form>

            <div class="clear"></div>
        </div>




