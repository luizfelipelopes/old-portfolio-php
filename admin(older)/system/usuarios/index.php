<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Usuários</h1>
                    <p class="tagline"> >> Flow State / <b>Usuários</b></p>
                </div>

                <a class="btn btn-blue radius" href="<?= HOME . ADMIN; ?>/dashboard.php?exe=usuarios/create">Adicionar Usuário</a>
<!--                <form class="form-search" method="get" action="">
                    <input type="text" name="s" title="Pesquisar usuário" placeholder="Pesquisar Usuário" /> 
                    <button class="btn btn-green radius"></button>
                </form>-->
                
                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="container main-conteudo posts">    


            <div class="content">

                <?php
                $read = new Read;
                $read->ExeRead(USUARIOS, "WHERE user_id != :id ORDER BY user_registration DESC", "id={$_SESSION['userlogin']['user_id']}");
                if ($read->getResult()):


                    foreach ($read->getResult() as $user):
                        extract($user);
                
                            if($user_level < 3):
                                
                            
                        ?>

                
                        <div class="bg-body posts-item usuarios-item" id="<?= $user_id; ?>">

                            <div class="usuarios-image">
                            <img title="" src="<?= ($user_foto ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $user_foto : ''); ?>" class="m-bottom1"/>
                            </div>
                            
                            <div class="content al-center">
                                <header class="m-bottom1">
                                    <h1 class="no-margin"><?= $user_name; ?></h1>
                                    <p class="usuario-nivel"><?= ($user_level == '1' ? 'Editor(a)' : ($user_level == '2' ? 'Administrador(a)' : ($user_level == '3' ? 'Programador' : ''))); ?></p>
                                </header>

                                <p class="usuario-email"><?= $user_email; ?></p>
                                <p class="usuario-data-cadastro">Desde <?= date('d/m/Y \à\s H\hi', strtotime($user_registration)); ?></p>

                                <div class="botoes">
                                    <a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Usuário" href="<?=HOME . ADMIN;?>/dashboard.php?exe=usuarios/create&id=<?= $user_id; ?>"></a>
                                    <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm" title="Excluir Usuário" id="<?= $user_id; ?>"></a>
                                    <div class="bloco-confirm" id="<?= $user_id; ?>">
                                        <small class="msg-confirm msg-confirm-user">Deseja excluir?</small>
                                        <a class="btn btn-orange btn-confirm btn-confirm-sim btn-confirm-sim-user radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_user" id="<?= $user_id; ?>">Sim</a>
                                        <a class="btn btn-pink btn-confirm btn-confirm-nao btn-confirm-nao-user radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $user_id; ?>">Não</a>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>



                        </div>


                        <?php
                        endif;
                    endforeach;

                endif;
                ?>

                <div class="clear"></div>
            </div>
        </div>      