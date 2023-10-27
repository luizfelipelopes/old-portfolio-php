<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock"><?= (!empty($id) ? 'Cadastrar Novo Usuário' : 'Editar Usuário'); ?> </h1>
                    <p class="tagline"> >> Flow State / Usuarios / <b><?= (!empty($id) ? 'Novo Usuário' : 'Editar Usuário'); ?></b></p>
                </div>

                <a class="btn btn-blue radius" href="<?= HOME . ADMIN; ?>/dashboard.php?exe=usuarios/index">Ver Usuários</a>
                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        
        
        <div class="main-conteudo posts posts-create js_content_form">    

            <?php
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            if ($id):

                $read = new Read();
                $read->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$id}");
                if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($read->getResult()[0]);
                    
                endif;

            endif;

            ?>
            
            
            
            <form action="" method="post">
            <div class="container bg-body posts-novo">

                <div class="content">

                    

                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>
                        <input readonly type="hidden" name="user_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_user' : 'create_user'); ?>"/>
                        
                        <label class="form-field">
                            <span class="form-legend">Nome:</span>
                            <input type="text" title="Nome" name="user_name" placeholder="Digite um Nome" value="<?= (!empty($user_name) ? $user_name : null );?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Sobrenome:</span>
                            <input type="text" title="Sobrenome" name="user_lastname" placeholder="Digite um Sobrenome" value="<?= (!empty($user_lastname) ? $user_lastname : null );?>"/>
                        </label>

<!--                        <label class="form-field">
                            <span class="form-legend">Telefone:</span>
                            <input type="tel" title="Telefone" name="telefone" placeholder="Digite um Telefone" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Celular:</span>
                            <input type="tel" title="Celular" name="celular" placeholder="Digite um Celular" />
                        </label>-->

                        <label class="form-field">
                            <span class="form-legend">E-mail:</span>
                            <input type="email" title="E-mail" name="user_email" placeholder="Digite um E-mail" value="<?= (!empty($user_email) ? $user_email : null );?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Senha:</span>
                            <input type="password" title="Senha" name="user_password" placeholder="Digite uma Senha" value="<?= (!empty($user_password) ? $user_password : null );?>" />
                        </label>

                        
                        <label class="form-field">
                            <span class="form-legend">Nível de Acesso:</span>
                            <select name="user_level">
                                <option>Selecione um Nível</option>
                                <option value="1" <?= (!empty($user_level) && $user_level == '1' ? 'selected' : '' );?>>Editor</option>
                                <option value="2" <?= (!empty($user_level) && $user_level == '2' ? 'selected' : '' );?>>Administrador</option>
                            </select>
                        </label>

                    

                    <div class="clear"></div>  
                </div>
            </div>



            <div class="posts-lateral">

                <div class="container foto-categoria m-bottom3 foto-usuario">


                    <img title="" src="<?= (!empty($user_foto) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $user_foto : '' );?>" class="j_previa" />

                    <div class="content">
                        

                            <label class="form-field">
                                <span class="form-legend">Foto do Usuário (JPEG, JPG ou PNG):</span>
                                <input type="file" title="Foto do Usuario" name="user_foto" class="j_imagem" />
                            </label>
                            
                            
                            <button class="btn btn-green radius">Atualizar Usuário!</button>
                            <div title="Carregando" class="load fl-right m-top1"></div>
                        
                        <div class="clear"></div>
                    </div>    
                </div>

                
                </div>

            
            </form>
            
            </div>


            




