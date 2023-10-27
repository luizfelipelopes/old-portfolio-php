<div class="container posts posts_box">
    <header class="sectiontitle sectiontitle-nomargin bg-blue">    
        <div class="content">

            <h1 class="al-center">Oppss! A página "<?= $setUrl; ?>" Não Existe! </h1>
            <p class="tagline al-center">:(</p>

            <div class="clear"></div>
        </div>
    </header>      


    <article class="container">
        <div class="content">
            <header class="sectiontitle">
                <h1>Deixe sua sujestão de Conteúdo:</h1>
                <p class="tagline">Informe seu nome e e-mail para sugerir conteúdo relacionado à "<?= $setUrl; ?>"</p>
            </header>

            <?php
            $dataErro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($dataErro)):

                $dataErro['comentario_status'] = '0';
                $dataErro['comentario_type'] = '404';
                $dataErro['comentario_date'] = date('Y-m-d H:i:s');
                $dataErro['comentario_content'] = $setUrl;
                
                $adminComentario = new adminComentario;
                $adminComentario->ExeCreate($dataErro);
                if ($adminComentario->getResult()):
                    header('Location: ' . HOME . '/sucesso');
                else:
                    WSErro("Erro ao cadastrar comentário! =)", WS_ERROR);
                endif;

            endif;
            ?>



            <form id="captura_lead" name="sendcontent" action="" method="post" class="bg-body">
                <input class="form-field box box-medium" type="text" title="Informe Seu Nome" name="comentario_author" placeholder="Informe Seu Nome:" />
                <input class="form-field box box-medium" type="text" title="Informe Seu Email" name="comentario_email" placeholder="Informe Seu E-mail:" />

                <button class="btn btn-green radius box box-medium last al-center">Deixe Sua Sugestão</button>
            </form>
            <div class="clear"></div>
        </div>  
    </article>



    <section class="posts_relacionados container bg-bluelight">
        <div class="content">
            <header class="sectiontitle">
                <h1>Veja Conteúdo Relacionado com a Sua Pesquisa:</h1>
                <p class="tagline">Veja o que encontramos ao pesquisar por <b><?= $setUrl; ?></b> em nossa base de conhecimento.</p>
            </header>

            <?php
            $read = new Read();
            $read->ExeRead(POSTS, "WHERE post_status = 1 AND (post_title LIKE '%' :url '%' OR post_content LIKE '%' :url '%') ORDER BY post_date DESC", "url={$setUrl}");
            if (!$read->getResult()):

                WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);

            else:
                foreach ($read->getResult() as $posts):
                    ?>

                    <article class="post_item box m-bottom3 post_box post_relacionado">
                        <a title="<?= $posts['post_title']; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $posts['post_name']; ?>">
                            <img title="<?= $posts['post_title']; ?>" alt="[<?= $posts['post_title']; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $posts['post_cover']; ?>" />
                            <h1><?= $posts['post_title']; ?></h1>
                        </a>
                        <?php
                        $readCat = new Read();
                        $readCat->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$posts['post_category']}");
                        if ($readCat->getResult()):
                            ?>

                            <span><?= $readCat->getResult()[0]['category_title'] ?></span>
                        <?php endif;
                        ?>
                    </article>


                    <?php
                endforeach;

            endif;
            ?>

            <div class="clear"></div>
        </div>
    </section>



</div>
