<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$url = $_SERVER['REQUEST_URI'];



$Segment = null;
if (strpos($url, 'posts') !== false):
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
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Post</h1>
                    <p class="tagline"> >> Flow State / Posts / <b>Novo Post</b></p>
                </div>

                <a class="btn btn-blue m-bottom1 radius" title="Novo Curso" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=posts/index">Meus Posts</a>  
                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Novo Produto" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=posts/create">Novo Post</a>    
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
//                $read->ExeRead(POSTS, "WHERE post_id = :id", "id={$id}");
//              DATE_FORMAT(post_date, '%d/%m/%y %H:%i:%s') AS 
                $read->FullRead("SELECT post_id, post_name, post_title, post_subtitle, post_content, post_cover, post_author, post_category, post_status, post_date, post_category, post_status FROM " . POSTS . " WHERE post_id = :id", "id={$id}");

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

                        <input readonly type="hidden" name="post_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_post' : 'create_post'); ?>"/>


                        <label class="form-field">
                            <span class="form-legend">Capa:</span>
                            <input type="file" name="post_cover" title="Capa" class="j_imagem" value="<?= (!empty($post_cover) ? $post_cover : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Título:</span>
                            <input type="text" title="Nome" name="post_title" placeholder="Digite um Nome" value="<?= (!empty($post_title) ? $post_title : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Subtítulo:</span>
                            <textarea rows="5" name="post_subtitle" title="subtitulo" placeholder="Digite um Subtítulo" ><?= (!empty($post_subtitle) ? $post_subtitle : null ); ?></textarea>
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Conteúdo:</span>
                            <textarea id="j_post" class="js_editor" rows="5" name="post_content" title="Descrição" placeholder="Sobre a Categoria" ><?= (!empty($post_content) ? htmlentities($post_content) : null ); ?></textarea>
                        </label>



                        <div class="clear"></div>  
                    </div>
                </div>



                <div class="posts-lateral">

                    <div class="container foto-categoria m-bottom3">


                        <img title="" src="<?= (!empty($post_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover : '' ); ?>" class="j_previa"/>

                        <div class="content">

                            <label class="form-field fl-left">
                                <span class="form-legend">Categoria:</span>
                                <select name="post_category">

                                    <option selected disabled value="">Selecione uma categoria</option>

                                    <?php
                                    $read = new Read;
                                    $read->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_segment = :segment AND category_parent IS NULL ORDER BY category_title", "segment={$Segment}");

                                    if ($read->getResult()):
                                        $readCategoria = new Read;

                                        foreach ($read->getResult() as $secao) :

                                            $readCategoria->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_segment = :segment AND category_parent = :id ORDER BY category_title", "segment={$Segment}&id={$secao['category_id']}");
                                            if ($readCategoria->getResult()):
                                                echo "<option disabled class='bg-gray' value='" . $secao['category_id'] . "'> >>" . $secao['category_title'] . "</option>";
                                                foreach ($readCategoria->getResult() as $categoria) :
                                                    echo "<option " . (!empty($id) && $categoria['category_id'] == $post_category ? 'selected' : ($categoria['category_id'] == $readCategoria->getResult()[0]['category_id'] ? 'selected' : '')) . " value='" . $categoria['category_id'] . "'>" . $categoria['category_title'] . "</option>";
                                                endforeach;
                                            endif;

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

                            <?php if (URL_DINAMICA == '1'): ?>
                                <label class="form-field">
                                    <span class="form-legend">Customizar Url (Opcional):</span>
                                    <input type="text" title="Customizar Url" name="post_name" placeholder="Customizar Url" value="<?= (!empty($post_name) ? $post_name : null ); ?>" />
                                </label>
                            <?php endif; ?>

                            <h1>Publicar:</h1>

                            <form method="post" action="" >

                                <label class="form-field">
                                    <span class="form-legend">Agendar Para:</span>
                                    <input id="calendar" type="text" title="Nome" name="post_date" placeholder="Digite uma data" value="<?= (!empty($post_date) ? date('d/m/Y H:i', strtotime($post_date)) : date('d/m/Y H:i')); ?>" />

                                </label>

                                <label class="form-field">
                                    <select name="post_author">
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


                                <div class="form-check">
                                    <label><input type="checkbox" name="post_status" <?= (!empty($id) && $post_status == '1' ? 'checked' : '' ); ?> value="1">Publicar Agora</label>
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




