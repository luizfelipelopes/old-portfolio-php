<main>
    <?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Configurações</h1>
                    <p class="tagline"> >> Flow State / Configurações / <b>Config</b></p>
                </div>

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create config js_content_form">    

            <?php
            if ($id):

//                PRODUTO
                $readCupom = new Read();
                $readCupom->ExeRead(CONFIGURACOES, "WHERE config_id = :id", "id={$id}");
                if ($readCupom->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($readCupom->getResult()[0]);

                endif;

            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">



                <div class="container bg-body">

                    <div class="content">


                        <div class="trigger-box-suspenso"></div>
                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="config_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_config' : 'create_config'); ?>"/>


                        
                        <h1 class="m-bottom1">Configurações Site</h1>
                        <label class="form-field">
                            <span class="form-legend">Título:</span>
                            <input type="text" title="titulo" name="config_title" placeholder="Digite o titulo" value="<?= (!empty($config_title) ? $config_title : null ); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Descrição:</span>
                            <input type="text" title="descricao" name="config_description" placeholder="Digite a descrição" value="<?= (!empty($config_description) ? $config_description : null ); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Página Inicial:</span>
                            <input type="text" title="Página Inicial" name="config_home" placeholder="Digite a página inicial" value="<?= (!empty($config_home) ? $config_home : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Tema do Site:</span>
                            <input type="text" title="Tema do Site" name="config_theme" placeholder="Digite um tema" value="<?= (!empty($config_theme) ? $config_theme : null); ?>" />
                        </label>
                        
                        <h1 class="m-bottom1 m-top3">Configurações Identidade Mídias</h1>
                        
                        <label class="form-field">
                            <span class="form-legend">Author_Google:</span>
                            <input type="text" title="Identificação Google Plus" name="config_author_google" placeholder="Digite uma identificação" value="<?= (!empty($config_author_google) ? $config_author_google : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Publisher_Google:</span>
                            <input type="text" title="Publisher Google Plus" name="config_publisher_google" placeholder="Digite uma identificação" value="<?= (!empty($config_publisher_google) ? $config_publisher_google : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">App_id Facebook :</span>
                            <input type="text" title="App Id Facebook" name="config_app_id_facebook" placeholder="Digite uma identificação" value="<?= (!empty($config_app_id_facebook) ? $config_app_id_facebook : null); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Author Facebook:</span>
                            <input type="text" title="Author Facebook" name="config_author_facebook" placeholder="Digite uma identificação" value="<?= (!empty($config_author_facebook) ? $config_author_facebook : null); ?>" />
                        </label>
    
                        <label class="form-field">
                            <span class="form-legend">Publisher Facebook:</span>
                            <input type="text" title="Publisher Facebook" name="config_publisher_facebook" placeholder="Digite uma identificação" value="<?= (!empty($config_publisher_facebook) ? $config_publisher_facebook : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Perfil Twitter:</span>
                            <input type="text" title="Perfil Twitter" name="config_perfil_twitter" placeholder="Digite um perfil de Twitter" value="<?= (!empty($config_perfil_twitter) ? $config_perfil_twitter : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Dominio (www.site.com.br):</span>
                            <input type="text" title="Domínio" name="config_domain" placeholder="Digite um dominio" value="<?= (!empty($config_domain) ? $config_domain : null); ?>" />
                        </label>
                        
                        
                        <h1 class="m-bottom1 m-top3">Configurações Servidor de E-mail</h1>
                        
                        <label class="form-field">
                            <span class="form-legend">MailUser:</span>
                            <input type="text" title="Usuário de E-mail" name="config_mail_user" placeholder="Digite um e-mail" value="<?= (!empty($config_mail_user) ? $config_mail_user : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">MailPass:</span>
                            <input type="text" title="Senha" name="config_mail_pass" placeholder="Digite uma senha" value="<?= (!empty($config_mail_pass) ? $config_mail_pass : null); ?>" />
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Mail Port:</span>
                            <input type="text" title="Porta" name="config_mail_port" placeholder="Digite uma porta" value="<?= (!empty($config_mail_port) ? $config_mail_port : null); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Mail Host:</span>
                            <input type="text" title="Host" name="config_mail_host" placeholder="Digite um host" value="<?= (!empty($config_mail_host) ? $config_mail_host : null); ?>" />
                        </label>
    
                        <label class="form-field">
                            <span class="form-legend">Mail Encrypt:</span>
                            <input type="text" title="Mail Encrypt" name="config_mail_encrypt" placeholder="Digite uma forma de encriptação" value="<?= (!empty($config_mail_encrypt) ? $config_mail_encrypt : null); ?>" />
                        </label>
                        
                        <h1 class="m-bottom1">Configurações PagSeguro</h1>
                        <label class="form-field">
                            <span class="form-legend">E-mail:</span>
                            <input type="text" title="E-mail" name="config_email" placeholder="Digite o e-mail" value="<?= (!empty($config_email) ? $config_email : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Frete:</span>
                            <input class="j_valor" type="text" title="Frete" name="config_frete" placeholder="Digite o valor de Frete" value="<?= (!empty($config_frete) ? $config_frete : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Ambiente (production ou sandbox):</span>
                            <input type="text" name="config_ambiente" title="Digite o ambiente do Pagseguro" placeholder="Digite o ambiente do Pagseguro" value="<?= (!empty($config_ambiente) ? $config_ambiente : null ); ?>"/>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Token Sandbox:</span>
                            <input type="text" name="config_token_sandbox" title="Token Sandbox" placeholder="Digite o Token Sandbox" value="<?= (!empty($config_token_sandbox) ? $config_token_sandbox : null ); ?>"/>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">APP ID Sandbox:</span>
                            <input type="text" name="config_app_id_sandbox" title="APP Id Sandbox" placeholder="Digite o App Id Sandbox" value="<?= (!empty($config_app_id_sandbox) ? $config_app_id_sandbox : null ); ?>"/>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">APP Key Sandbox:</span>
                            <input type="text" name="config_app_key_sandbox" title="APP Key Sandbox" placeholder="Digite o App Key Sandbox" value="<?= (!empty($config_app_key_sandbox) ? $config_app_key_sandbox : null ); ?>"/>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">Token Production:</span>
                            <input type="text" name="config_token_production" title="Token Production" placeholder="Digite o Token Production" value="<?= (!empty($config_token_production) ? $config_token_production : null ); ?>"/>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">APP ID Production:</span>
                            <input type="text" name="config_app_id_production" title="APP Id Production" placeholder="Digite o App Id Production" value="<?= (!empty($config_app_id_production) ? $config_app_id_production : null ); ?>"/>
                        </label>
                        
                        <label class="form-field">
                            <span class="form-legend">APP Key Production:</span>
                            <input type="text" name="config_app_key_production" title="APP Key Production" placeholder="Digite o App Key Production" value="<?= (!empty($config_app_key_production) ? $config_app_key_production : null ); ?>"/>
                        </label>


<!--                        <div class="form-check">
                            <label><input type="checkbox" name="cupom_status" <?= (!empty($id) && $cupom_status == '1' ? 'checked' : '' ); ?> value="1">Ativar Agora</label>
                        </div>-->

                        <button class="btn btn-green radius j_btn fl-right">Atualizar!</button>
                        <div title="Carregando" class="load fl-right"></div>

                        <div class="clear"></div>  
                    </div>
                </div>

            </form>

            <div class="clear"></div>
        </div>




