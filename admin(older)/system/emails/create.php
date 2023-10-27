<main>
    <?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo E-mail</h1>
                    <p class="tagline"> >> Flow State / E-mails / <b>Novo E-mail</b></p>
                </div>


                <a class="btn btn-blue radius" title="Meus E-mails" href="<?= HOME; ?>flowstate_admin/dashboard.php?exe=emails/index">Meus E-mails</a>    

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create">    

            <?php
            if ($id):

//                PRODUTO
                $readEmail = new Read();
                $readEmail->ExeRead(EMAILS, "WHERE email_id = :id", "id={$id}");
                if ($readEmail->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($readEmail->getResult()[0]);

                endif;



            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">



                <div class="container bg-body posts-novo">

                    <div class="content">


                        <div class="trigger-box-suspenso"></div>
                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="email_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_email' : 'create_email'); ?>"/>


                        <label class="form-field">
                            <span class="form-legend">Título:</span>
                            <input type="text" title="Título do E-mail" name="email_title" placeholder="Digite um Tìtulo Para o e-mail" value="<?= (!empty($email_title) ? $email_title : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Saudação:</span>
                            <input type="text" title="Saudção do E-mail" name="email_saudacao" placeholder="Digite uma Saudação Para o e-mail" value="<?= (!empty($email_saudacao) ? $email_saudacao : null ); ?>" />
                        </label>


                        <label class="form-field">
                            <span class="form-legend">Conteúdo:</span>
                            <div class="j_limpa_conteudo">
                                <textarea id="j_post" class="js_editor" rows="5" name="email_content" title="Conteúdo do E-mail"><?= (!empty($email_content) ? $email_content : null ); ?></textarea>
                            </div>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Assinatura:</span>
                            <textarea class="js_editor" title="Assinatura do E-mail" rows="2" name="email_assinatura" placeholder="Digite uma Assinatura Para o e-mail"><?= (!empty($email_assinatura) ? $email_assinatura : null ); ?></textarea>
                        </label>


                        <div class="clear"></div>  
                    </div>
                </div>



                <div class="posts-lateral">

                   

                    <div class = "container posts-publicar bg-body">

                        <div class = "content">

                            <h1>Objetivo:</h1>

                            <form method = "post" action = "">

                                <label class = "form-field">
                                    <select name = "email_type" disabled>
                                        <option disabled selected value = "">Selecione um objetivo</option>
                                        <option value = "pos-venda" <?= (!empty($id) && $email_type == 'pos-venda' ? 'selected' : '');?>>Pós-venda</option>
                                        <option value = "pos-cadastro" <?= (!empty($id) && $email_type == 'pos-cadastro' ? 'selected' : '');?>>Pós-cadastro</option>
                                    </select>
                                </label>

                                <button class="btn btn-green radius j_btn">Atualizar!</button>
                                <div title="Carregando" class="load fl-right"></div>
                                </form>

                                
                                <div class="clear"></div>
                        </div>

                    </div>

                </div>

            </form>

            <div class="clear"></div>
        </div>




