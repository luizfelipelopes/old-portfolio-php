<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Alunos</h1>
                    <p class="tagline"> >> <?= SOFTWARE; ?> / <b>Alunos</b></p>
                </div>

                <!--<a class="btn btn-blue radius" href="<?= HOME; ?>/admin/dashboard.php?exe=usuarios/create">Adicionar Usuário</a>-->
                <form class="form-search" method="get" action="">
                    <input type="text" name="s" title="Pesquisar usuário" placeholder="Pesquisar Usuário" /> 
                    <button class="btn btn-green radius"></button>
                </form>

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="container main-conteudo posts">    


            <div class="content">




                <div class="j_detalhes_aluno">


                    <div class="info_aluno bg-body">

                        <div class="trigger-box-suspenso"></div>

                        <?php
                        $readAlunoSelecionado = new Read;
                        $readAlunoSelecionado->ExeRead(CLIENTES, "WHERE cliente_id = :id", "id=26");
                        if ($readAlunoSelecionado->getResult()):
                            extract($readAlunoSelecionado->getResult()[0]);

                        endif;
                        ?>



                        <div class="content">
                            <header class="container m-bottom3">
                                <h1>Ficha do Aluno</h1>
                            </header>

                            <div class="info_cima fl-left">
                                <div class="fl-left info_aluno_foto">
                                    <img class="j_previa" title="" alt="" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $cliente_cover; ?>" />
                                </div>

                                <div class="col-70 info_aluno_field">
                                    <span class="ds-block">Nome:</span><span><?= $cliente_name . ' ' . $cliente_lastname; ?></span>
                                </div>

                                <div class="col-25 info_aluno_field">
                                    <span class="ds-block">Idade:</span><span> 26 anos</span>
                                </div>

                                <div class="col-25 info_aluno_field">
                                    <span class="ds-block">E-mail:</span><span><?= $cliente_email; ?></span>
                                </div>

                                <div class="col-25 info_aluno_field">
                                    <span class="ds-block">Telefone:</span><span><?= $cliente_telefone; ?></span>
                                </div>

                                <div class="col-25 info_aluno_field">
                                    <span class="ds-block">CPF:</span><span><?= $cliente_cpf; ?></span>
                                </div>

                                <div class="col-25 info_aluno_field">
                                    <span class="ds-block">RG:</span><span><?= $cliente_rg; ?></span>
                                </div>

                                <div class="col-12 info_aluno_field">
                                    <span class="ds-block">Estado Civil:</span><span><?= $cliente_estado_civil; ?></span>
                                </div>
                            </div>    

                            <div class="container info_curso_notas">

                                <header class="container m-bottom3">
                                    <h1>Cursos</h1>
                                </header>

                                <?php
                                $i = 0;
                                $readVendaAluno = new Read;
                                $readVendaAluno->ExeRead(VENDAS, "WHERE venda_cliente = :id AND venda_status = 3", "id=26");
                                if ($readVendaAluno->getResult()):
                                    $readCursosAluno = new Read;

                                    foreach ($readVendaAluno->getResult() as $venda):
                                        extract($venda);


                                        $readCursosAluno->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$venda_produto}");
                                        if ($readCursosAluno->getResult()):
                                            foreach ($readCursosAluno->getResult() as $curso):
                                                extract($curso);
                                                ?>




                                                <article class="meus_cursos_item col-24 info_curso">

                                                    <div class="meus_cursos_foto_progresso">
                                                        <img title="" alt="[]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso_cover; ?>" class="j_previa">
                                                        <?php
                                                        $readProg = new Read;
                                                        $readProg->ExeRead(PROGRESSOS, "WHERE progresso_aluno = :aluno AND progresso_curso = :curso", "aluno={$cliente_id}&curso={$curso_id}");
                                                        ?>
                                                        <div class="bg-gray">
                                                            <div class="progresso" style="width:<?= (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : 0); ?>%"><span><?= (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : 0); ?>%</span></div>
                                                        </div>
                                                    </div>

                                                    <div class="bg-light meus_cursos_info">
                                                        <h1 class="fontsize1 m-bottom1"><?= $curso_title; ?></h1>
                                                        <p class="fontsize1">Quando começou: <?= date('d/m/Y', strtotime($venda_data)); ?></p>
                                                        <p class="fontsize1">Último Acesso: <?= date('d/m/Y'); ?></p>
                                                    </div>
                                                </article>


                                                <div class="info_aluno_notas box">
                                                    <header>
                                                        <h1>Notas</h1>
                                                    </header>

                                                    <div class="lin">
                                                        <!--<span class="container m-bottom1">Médio em Teologia</span>-->

                                                        <div class="container">

                                                            <p class="col-15 font-bold">Aula-Nota</p>
                                                            <p class="col-11 font-bold al-center" title="Tarefa 1">Tarefa 1</p>
                                                            <p class="col-11 font-bold al-center" title="Dissertação">Tarefa 2</p>
                                                            <p class="col-11 font-bold al-center" title="Resenha">Tarefa 3</p>
                                                            <p class="col-11 font-bold al-center" title="Trabalho">Tarefa 4</p>
                                                            <p class="col-11 font-bold al-center" title="Prova">Tarefa 5</p>
                                                            <p class="col-7 font-bold al-center" title="Nota FInal">Nota Final</p>
                                                            <p class="col-9 font-bold al-center">Situação</p>
                                                            <!--<p class="col-5 font-bold bg-gray col_btn">-</p>-->
                                                        </div>

                                                        <div class="container al-center">

                                                            <?php
                                                            $readModulos = new Read;
                                                            $readModulos->ExeRead(MODULOS, "WHERE modulo_curso = :curso ORDER BY modulo_id", "curso={$curso_id}");
                                                            if ($readModulos->getResult()):
                                                                foreach ($readModulos->getResult() as $modulo):
                                                                    extract($modulo);
                                                                    ?>

                                                                    <p class="col-15"><?= $modulo_title; ?></p>    


                                                                    <?php
                                                                    $readDisciplina = new Read;
                                                                    $readDisciplina->ExeRead(AULAS, "WHERE aula_modulo = :modulo ORDER BY aula_id", "modulo={$modulo_id}");
                                                                    if ($readDisciplina->getResult()):

                                                                        foreach ($readDisciplina->getResult() as $aula):
                                                                            extract($aula);


                                                                            $readNotas = new Read;
                                                                            $readNotas->ExeRead(NOTAS, "WHERE nota_aluno = :aluno AND nota_aula = :aula", "aluno={$cliente_id}&aula={$aula_id}");
                                                                            if ($readNotas->getResult()):
                                                                                extract($readNotas->getResult()[0]);
                                                                                ?>

                                                                                <form action="" method="post" class="container" id="<?= $nota_id; ?>">
                                                                                    <p class="col-15"><?= $aula_title; ?></p>    
                                                                                    <input type="hidden" name="nota_id" value="<?= $nota_id; ?>" />
                                                                                    <input type="hidden" name="nota_aula" value="<?= $nota_aula; ?>" />
                                                                                    <input type="hidden" name="nota_aluno" value="<?= $cliente_id; ?>" />
                                                                                    <input type="hidden" name="nota_author" value="<?= $_SESSION['userlogin']['user_id']; ?>" />
                                                                                    <input type="hidden" name="action" value="update_nota" />

                                                                                    <input type="text" class="col-11 al-center" name="nota_1" value="<?= $nota_1; ?>" />
                                                                                    <input type="text" class="col-11 al-center" name="nota_2" value="<?= $nota_2; ?>" />
                                                                                    <input type="text" class="col-11 al-center" name="nota_3" value="<?= $nota_3; ?>" />
                                                                                    <input type="text" class="col-11 al-center" name="nota_4" value="<?= $nota_4; ?>" />
                                                                                    <input type="text" class="col-11 al-center" name="nota_5" value="<?= $nota_5; ?>" />
                                                                                    <input type="text" class="col-7 al-center" id="<?= 'total' . $i; ?>" name="nota_total" value="<?= $nota_total; ?>" readonly/>
                                                                                    <p id="<?= 'total' . $i; ?>" class="col-9 j_status al-center"><?= ($nota_status ? $nota_status : '-'); ?></p>
                                                                                    <input type="submit" class="btn btn-green btn_nota radius col-1 m-top1 shorticon shorticon-minimo shorticon-salvar" title="Salvar Nota" value="" />
                                                                                </form>

                                                                                <?php
                                                                            endif;
                                                                            $i++;
                                                                        endforeach;

                                                                    endif;

                                                                endforeach;
                                                            endif;
                                                            ?>

                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="b-bottom m-bottom3 container"></div>
                                                <?php
                                            endforeach;
                                        endif;

                                    endforeach;
                                endif;
                                ?>


                            </div>



                            <div class="container info_aluno_endereco m-top3">
                                <header class="container m-bottom3">
                                    <h1>Endereço:</h1>
                                </header>

                                <div class="col-70">
                                    <span class="ds-block">Endereço:</span><span><?= $cliente_endereco; ?></span>
                                </div>

                                <div class="col-25">
                                    <span class="ds-block">Número:</span><span><?= $cliente_numero; ?></span>
                                </div>

                                <div class="col-25">
                                    <span class="ds-block">Bairro:</span><span><?= $cliente_bairro; ?></span>
                                </div>

                                <div class="col-25">

                                    <?php
                                    $readCidade = new Read;
                                    $readCidade->ExeRead(CIDADES, "WHERE cidade_id = :id", "id={$cliente_cidade}");
                                    if ($readCidade->getResult()):
                                        extract($readCidade->getResult()[0]);
                                    endif;
                                    ?>

                                    <span class="ds-block">Cidade:</span><span><?= $cidade_nome . ' - ' . $cidade_uf ?></span>
                                </div>

                                <div class="col-25">
                                    <span class="ds-block">Cep:</span><span><?= $cliente_cep; ?></span>
                                </div>


                            </div>
                        </div>
                        <div class="clear"></div>

                    </div>    
                    <div class="clear"></div>

                </div>




                <?php
                $read = new Read;
                $read->ExeRead(CLIENTES, "ORDER BY cliente_name ASC, cliente_registro DESC, cliente_level DESC");
                if ($read->getResult()):


                    foreach ($read->getResult() as $aluno):
                        extract($aluno);

//                            if($user_level < 3):
                        ?>


                        <div class="bg-body posts-item usuarios-item" id="<?= $cliente_id; ?>">


                            <div class="usuarios-image">
                                <img title="" src="<?= ($cliente_cover ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $cliente_cover : ''); ?>" class="m-bottom1"/>
                            </div>

                            <div class="content al-center">
                                <header class="m-bottom1">
                                    <h1 class="no-margin"><?= $cliente_name . ' ' . $cliente_lastname; ?></h1>
                                    <p class="usuario-nivel"><?= ($cliente_level == '1' ? 'Status: Pendente' : 'Status: Pago'); ?></p>
                                </header>

                                <p class="usuario-email"><?= $cliente_email; ?></p>
                                <p class="usuario-data-cadastro">Desde <?= date('d/m/Y \à\s H\hi', strtotime($cliente_registro)); ?></p>

                                <div class="botoes">
                                    <!--<a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Usuário" href="<?= HOME; ?>/admin/dashboard.php?exe=usuarios/create&id=<?= $cliente_id; ?>"></a>-->
                                    <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm" title="Excluir Usuário" id="<?= $cliente_id; ?>"></a>
                                    <div class="bloco-confirm" id="<?= $cliente_id; ?>">
                                        <small class="msg-confirm msg-confirm-user">Deseja excluir?</small>
                                        <a class="btn btn-orange btn-confirm btn-confirm-sim btn-confirm-sim-user radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_user" id="<?= $cliente_id; ?>">Sim</a>
                                        <a class="btn btn-pink btn-confirm btn-confirm-nao btn-confirm-nao-user radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $cliente_id; ?>">Não</a>
                                    </div>
                                    <div class="container">
                                        <a class="btn btn-blue radius al-center j_conhecer_aluno" title="Conhecer Aluno" href="#">Conhecer Aluno</a>
                                    </div>
                                </div>

                                <div class="clear"></div>
                            </div>



                        </div>


                        <?php
//                        endif;
                    endforeach;

                endif;
                ?>

                <div class="clear"></div>
            </div>
        </div>      