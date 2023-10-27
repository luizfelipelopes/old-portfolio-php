<?php $tutor = filter_input(INPUT_GET, 'tutor', FILTER_VALIDATE_BOOLEAN); ?>
<section class="container curso_detalhes bg-body">

    <section class="container curso_detalhes bg-body m-bottom3">


        <aside class="meu_perfil">

            <div class="meu_perfil_id al-center">

                <div class="content">

                    <div class="img_perfil round fl-left container">
                        <img height="90" title="" alt="" src="<?= (isset($_SESSION['clientelogin']['cliente_id']) && $_SESSION['clientelogin']['cliente_cover'] ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $_SESSION['clientelogin']['cliente_cover'] : (isset($_SESSION['userlogin']['user_id']) && $_SESSION['userlogin']['user_foto'] ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $_SESSION['userlogin']['user_foto'] : '')); ?>" class="fl-left m-bottom1 round j_previa" />
                    </div>

                    <h1 class="fontsize1"><?= (isset($_SESSION['clientelogin']['cliente_id']) ? $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'] : $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname']); ?></h1>
                    <p class="fontsize1 tagline email"><?= (isset($_SESSION['clientelogin']['cliente_id']) ? $_SESSION['clientelogin']['cliente_email'] : $_SESSION['userlogin']['user_email']); ?></p>

                    <div class="clear"></div>
                </div>
            </div>


            <div class="bloco_opcoes container bg-light">
                <div class="content">

                    <div class="meu_perfil_opcoes bg-body m-bottom1">

                        <div class="meus_cursos b-bottom j_menu_cursos">Meus Cursos</div>
                        <?php if (isset($_SESSION['clientelogin']['cliente_id']) && !$tutor): ?>
                            <div class="meus_pedidos b-bottom j_menu_pedidos">Meus Pedidos</div>
                            <div class="minhas_notas b-bottom j_menu_notas">Minhas Notas</div>
                            <div class="meus_dados b-bottom j_menu_dados">Meu Perfil</div>
                            <div class="meu_endereco b-bottom j_menu_endereco">Meu Endereço</div>
                            <div class="minha_senha j_menu_senha">Minha Senha</div>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($_SESSION['clientelogin']['cliente_id']) && !$tutor): ?>
                        <div class="sair j_logout"><a title="Sair" href="#">Sair</a></div>
                    <?php endif ?>
                    <div class="clear"></div>
                </div>


            </div>


        </aside>

        <div class="margin_mobile"></div>
        
        <section class="container bloco_meus_cursos j_meus_cursos">

            <header>
                <h1>Meus Cursos</h1>
                <p class="tagline">Estes são seus cursos</p>
                <div class="b-bottom"></div>
            </header>


            <div class="content">


                <?php
                $read = new Read;
                if (!isset($_SESSION['clientelogin']['cliente_id']) || $tutor):


                    $read->ExeRead("cetrhema_cursos");
                    if ($read->getResult()):

                        foreach ($read->getResult() as $course):
                            extract($course);
                            ?>

                            <a title="<?= $curso_title; ?>" href="<?= HOME; ?>/plataforma/?exe=curso&name=<?= $curso_name; ?>&tutor=true">
                                <article class="meus_cursos_item box box-medium">

                                    <div class="meus_cursos_foto_progresso">
                                        <img height="150" title="" alt="[]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso_cover; ?>">
                                    </div>

                                    <div class="bg-light meus_cursos_info">
                                        <h1 class="fontsize1 m-bottom1"><?= $curso_title; ?></h1>
                                    </div>
                                </article>
                            </a>

                            <?php
                        endforeach;

                    endif
                    ?>

                    <?php
                else:
                    $read->ExeRead("cetrhema_vendas", "WHERE venda_cliente = :id AND venda_status = :status OR venda_status = :status2", "id={$_SESSION['clientelogin']['cliente_id']}&status=3&status2=4");
                    if ($read->getResult()):
                        $readDisciplina = new Read;

                        foreach ($read->getResult() as $venda):

                            $readDisciplina->ExeRead("cetrhema_cursos", "WHERE curso_id = :id", "id={$venda['venda_produto']}");
                            if ($readDisciplina->getResult()):
                                extract($readDisciplina->getResult()[0]);
                                ?>

                                <a title="<?= $curso_title; ?>" href="<?= HOME; ?>/plataforma/?exe=curso&name=<?= $curso_name; ?>">
                                    <article class="meus_cursos_item box box-medium">

                                        <div class="meus_cursos_foto_progresso">
                                            <img height="150" title="" alt="[]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso_cover; ?>">
                                            <?php
                                            $readProg = new Read;
                                            $readProg->ExeRead("cetrhema_progressos", "WHERE progresso_aluno = :aluno AND progresso_curso = :curso", "aluno={$_SESSION['clientelogin']['cliente_id']}&curso={$curso_id}");
                                            ?>
                                            <div class="bg-gray">
                                                <div class="progresso" style="width:<?= (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : 0); ?>%"><span><?= (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : 0); ?>%</span></div>
                                            </div>
                                        </div>

                                        <div class="bg-light meus_cursos_info">
                                            <h1 class="fontsize1 m-bottom1"><?= $curso_title; ?></h1>
                                            <p class="fontsize1">Minha Matrícula: <?= date('d/m/Y', strtotime($venda['venda_data'])); ?></p>
                                            <p class="fontsize1">Último Acesso: <?= date('d/m/Y'); ?></p>
                                        </div>
                                    </article>
                                </a>

                                <?php
                            endif;


                        endforeach;


                    endif;
                endif;
                ?>
                <div class="clear"></div>
            </div>

        </section>


        <?php if (isset($_SESSION['clientelogin']['cliente_id'])): ?>
            <section class="container bloco_meus_pedidos j_minhas_notas">


                <?php
                $jSon['result_info_curso'] = array();
                $jSon['result_cabecalho_nota_inicio'] = array();
                $jSon['result_info_modulos'] = array();
                $jSon['result_notas'] = array();
                $jSon['result_cabecalho_nota_fim'] = array();
                $jSon['nota_modulo_total'] = array();
                $jSon['modulo_curso_total'] = array();
                $jSon['ultima_nota'] = array();
                $jSon['ultimo_modulo'] = array();

                $curso_incremento = 0;
                $modulo_incremento = 0;
                $notas_incremento = 0;
                $tot_mod = 0;
                $tot_curso = 0;

                $i = 0;
                $j = 0;
                $z = 0;

                $View = new View;
                //            BUSCA EM VENDAS SE ELE JÀ POSSUI ALGUM CURSO PAGO
                $readVendaAluno = new Read;
                $readVendaAluno->ExeRead("cetrhema_vendas", "WHERE venda_cliente = :id AND venda_status = :status OR venda_status = :status2 ORDER BY venda_data DESC", "id={$_SESSION['clientelogin']['cliente_id']}&status=3&status2=4");
                if ($readVendaAluno->getResult()):
                    $readCursosAluno = new Read;
                    ?>
                    <div class="bloco-notas">
                        <?php
                        foreach ($readVendaAluno->getResult() as $venda):
                            extract($venda);

//                    RECUPERA O CURSO DE ACORDO COM O ID DO PRODUTO FORNECIDO NA VENDA
                            $readCursosAluno->ExeRead("cetrhema_cursos", "WHERE curso_id = :id", "id={$venda_produto}");
                            if ($readCursosAluno->getResult()):
                                foreach ($readCursosAluno->getResult() as $curso):
                                    extract($curso);

                                    $readProg = new Read;
                                    $readProg->ExeRead("cetrhema_progressos", "WHERE progresso_aluno = :aluno AND progresso_curso = :curso", "aluno={$_SESSION['clientelogin']['cliente_id']}&curso={$curso_id}");

                                    $curso['progressoLargura'] = "style = 'width:'" . (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : 0) . "%'";
                                    $curso['progresso'] = (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : 0);
                                    $curso['venda_data'] = date('d/m/Y', strtotime($venda_data));
                                    $curso['ultimo_acesso'] = date('d/m/Y');

//                            EXIBE INFORMAÇÔES DO CURSO
                                    $tpl_info_curso = $View->Load('info-curso-plataforma');
                                    $View->Show($curso, $tpl_info_curso);

//                            EXIBE CABEÇALHO DA NOTA
                                    $tpl_nota_inicio = $View->Load('info-cabecalho-notas');
                                    $View->Show(null, $tpl_nota_inicio);

//                            EXIBE OS MODULOS DO CURSO ATUAL
                                    $readModulos = new Read;
                                    $readModulos->ExeRead("cetrhema_modulos", "WHERE modulo_curso = :curso ORDER BY modulo_id", "curso={$curso_id}");
                                    if ($readModulos->getResult()):

                                        $tpl_modulos = $View->Load('info-modulos');
                                        foreach ($readModulos->getResult() as $modulo):
                                            extract($modulo);

//                                    EXIBE TITULO DOS MODULOS
                                            $View->Show($modulo, $tpl_modulos);

////                                    EXIBE AS DISICPLINAS DO MODULO ATUAL
                                            $readDisciplina = new Read;
                                            $readDisciplina->ExeRead("cetrhema_aulas", "WHERE aula_modulo = :modulo ORDER BY aula_id", "modulo={$modulo_id}");
                                            if ($readDisciplina->getResult()):

                                                foreach ($readDisciplina->getResult() as $aula):
                                                    extract($aula);

//                                            EXIBE AS NOTAS DO MÓDULO ATUAL
                                                    $readNotas = new Read;
                                                    $readNotas->ExeRead("cetrhema_notas", "WHERE nota_aluno = :aluno AND nota_aula = :aula", "aluno={$_SESSION['clientelogin']['cliente_id']}&aula={$aula_id}");
                                                    if ($readNotas->getResult()):

//                                                $View = new View;
                                                        $tpl_notas = $View->Load('info-notas-aluno');
                                                        $DadosNota = array();
                                                        extract($readNotas->getResult()[0]);

                                                        $DadosNota += ['aula_title' => $aula_title,
                                                            'user_id' => 1,
                                                            'cliente_id' => $_SESSION['clientelogin']['cliente_id'],
                                                            'i' => $i,
                                                            'nota_status' => ($nota_status ? $nota_status : '-')
                                                        ];

                                                        $DadosNota += $readNotas->getResult()[0];


                                                        $View->Show($DadosNota, $tpl_notas);
                                                        $tot_mod++; // Total de Notas por Módulo
                                                        $notas_incremento++;


                                                    endif;
                                                    $i++;
                                                endforeach;


                                            endif;
                                            $modulo_incremento++;

                                            $jSon['nota_modulo_total'] += [$j => $tot_mod]; //Passa Total de Notas por Módulo via JSON 
                                            $jSon['ultima_nota'] += [$j => $notas_incremento]; //Passa o Indice da ùltima nota de cada Módulo via JSON
                                            $tot_mod = 0;
                                            $j++;
                                            $tot_curso++; // Total de Módulos por Curso
                                        endforeach;

                                        $jSon['ultimo_modulo'] += [$z => $modulo_incremento]; //Recebe o índice do último módulo de cada curso via JSON
                                        $jSon['modulo_curso_total'] += [$z => $tot_curso]; // Recebe o total de módulos por curso via JSON 
                                        $tot_curso = 0;
                                    endif;

//                            EXIBE O FIM (RODAPE) DE NOTAS
                                    $tpl_cabecalho_fim = $View->Load('info-cabecalho-notas-fim');
                                    $jSon['result_cabecalho_nota_fim'] += [$curso_incremento => $View->returnView(null, $tpl_cabecalho_fim)];
                                    $curso_incremento++;
                                    $z++;

                                endforeach;


                            endif;
                        endforeach;
                        ?>
                        <div class="clear"></div>
                    </div>
                    <?php
                endif;
                ?>
            </section>
        <?php endif; ?>

        <?php if (isset($_SESSION['clientelogin']['cliente_id'])): ?>

            <section class="container bloco_meus_pedidos j_meus_pedidos">

                <header>
                    <h1>Meus Pedidos</h1>
                    <p class="tagline">Confira os seus últimos pedidos</p>
                    <div class="b-bottom"></div>
                </header>


                <div class="content">
                    

                    <?php
                    $read = new Read;
                    $read->ExeRead("cetrhema_vendas", "WHERE venda_cliente = :id", "id={$_SESSION['clientelogin']['cliente_id']}");
                    if ($read->getResult()):
                        $readDisciplina = new Read;

                        foreach ($read->getResult() as $venda):

                            $readDisciplina->ExeRead("cetrhema_cursos", "WHERE curso_id = :id", "id={$venda['venda_produto']}");
                            if ($readDisciplina->getResult()):
                                extract($readDisciplina->getResult()[0]);
                                ?>


                                <article class="meus_pedidos_item">

                                    <div class="col-30">
                                        <span><?= $curso_title; ?></span>
                                    </div>

                                    <div class="col-25">
                                        <span><?= date('d/m/Y H\hi', strtotime($venda['venda_data'])); ?></span>
                                    </div>

                                    <div class="col-20 al-center">
                                        <span>R$ <?= number_format($venda['venda_total'], 2, ',', '.'); ?></span>
                                    </div>

                                    <div class="col-20">
                                        <span>Aprovado</span>
                                    </div>
                                </article>
                                <?php
                            endif;
                        endforeach;
                    endif;
                    ?>


                    <div class="clear"></div>
                </div>

            </section>



            <div class="content_cadastrar container bloco_meus_dados j_meus_dados">


                <header class="m-bottom2">
                    <h1>Meus Dados</h1>
                    <p class="tagline">Confira os seus dados</p>
                    <div class="b-bottom"></div>
                </header>



                <form name="PostForm"  class="form_cadastrar m-top1" action="" method="post">

                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="cliente_id" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_id'] : null ); ?>"/>
                    <input readonly="" type="hidden" name="action" value="update_aluno"/>

                    <label class="m-bottom1 capa_perfil">
                        <span>Capa:</span>
                        <input type="file" name="cliente_cover" title="Capa" class="j_imagem" value="<?= (!empty($cliente_cover) ? $cliente_cover : null ); ?>" />
                    </label>

                    <div class="container foto-categoria label-50-real m-top1 m-bottom3 foto_aluno al-center">

                        <img height="400" title="" src="<?= (!empty($_SESSION['clientelogin']['cliente_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $_SESSION['clientelogin']['cliente_cover'] : null); ?>" class="j_previa"/>

                        <div class="clear"></div>
                    </div>

                    <label class="fl-left">	
                        <span class="m-bottom1">Nome:</span>			
                        <input class="input_fale" type="text" name="cliente_name" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_name'] : ''); ?>" />
                    </label>


                    <label class="fl-left">	
                        <span>Sobrenome:</span>			
                        <input class="input_fale" type="text" name="cliente_lastname" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_lastname'] : ''); ?>" />
                    </label>




                    <label class="fl-left">	
                        <span>Estado Civil:</span>			
                        <select name="cliente_estado_civil" class="input_fale">
                            <option value="solteiro(a)">Solteiro(a)</option>
                            <option value="casado(a)">Casado(a)</option>
                            <option value="divorciado(a)">Divorciado(a)</option>
                        </select>
                    </label>

                    <label class="fl-left">	
                        <span>RG:</span>			
                        <input class="input_fale" type="text" name="cliente_rg" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_rg'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>CPF:</span>			
                        <input class="input_fale" type="text" name="cliente_cpf" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_cpf'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>Telefone:</span>			
                        <input class="input_fale" type="tel" name="cliente_telefone" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_telefone'] : ''); ?>"/>
                    </label>

                    <!--                <label class="label-50-real fl-left">	
                                        <span>Celular:</span>			
                                        <input class="input_fale" type="tel" name="cliente_celular" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_telefone'] : ''); ?>"/>
                                    </label>-->



                    <div class="clear"></div>

                    <input class="btn btn-green btn_cadastrar fl-right radius" type="submit"  name="enviarCliente" value="Salvar" />
                    <div title="Carregando" class="load fl-right"></div>     
                </form>

                                                            <!--<div id="j_ajaxident" class="<?= HOME . "/_cdn/ajax" ?>"></div>-->           
            </div>



            <section class="container bloco_meu_endereco j_meu_endereco">


                <header>
                    <h1>Meu Endereço</h1>
                    <p class="tagline">Confira os seu Endereço</p>
                    <div class="b-bottom"></div>
                </header>


                <form action="" method="post" class="m-top1">

                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="cliente_id" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_id'] : null ); ?>"/>
                    <input readonly type="hidden" name="action" value="update_aluno"/>

                    <label class="fl-left">	
                        <span>Rua, av, etc:</span>			
                        <input class="input_fale" type="text" name="cliente_endereco" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_endereco'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>Número:</span>			
                        <input class="input_fale" type="text" name="cliente_numero" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_numero'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>Bairro:</span>			
                        <input class="input_fale" type="text" name="cliente_bairro" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_bairro'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>CEP:</span>			
                        <input class="input_fale" type="text" name="cliente_cep" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_cep'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>UF:</span>			
                        <select class="j_loadstate" name="cliente_uf" required="required">
                            <option value="" disabled selected> Selecione o estado </option>
                            <?php
                            $readState = new Read;
                            $readState->ExeRead("app_estados", "ORDER BY estado_nome ASC");
                            foreach ($readState->getResult() as $estado):
                                extract($estado);
                                echo "<option value=\"{$estado_id}\" ";

                                if (isset($_SESSION['clientelogin']['cliente_uf']) && $estado_id == $_SESSION['clientelogin']['cliente_uf']):
                                    echo "selected=\"selected\" ";
                                endif;

                                echo "> {$estado_uf} / {$estado_nome} </option>";
                            endforeach;
                            ?>                        
                        </select>

                    </label>

                    <label class="fl-left">	
                        <span>Cidade:</span>			
                        <select class="j_loadcity" name="cliente_cidade" required="required">

                            <?php
                            if (!isset($_SESSION['clientelogin']['cliente_cidade'])):
                                echo "<option value=\"\" disabled selected> Selecione antes um estado </option>";
                            else:

                                $read = new Read();
                                $read->ExeRead("app_cidades", "WHERE estado_id = :id ORDER BY cidade_nome ASC", "id={$_SESSION['clientelogin']['cliente_uf']}");
                                if ($read->getResult()):
                                    foreach ($read->getResult() as $city):

                                        echo "<option value=\"{$city['cidade_id']}\" ";

                                        if (isset($_SESSION['clientelogin']['cliente_cidade']) && $_SESSION['clientelogin']['cliente_cidade'] == $city['cidade_id']):

                                            echo "selected ";
                                        endif;

                                        echo "> {$city['cidade_nome']} </option>";
                                        ?>



                                        <?php
                                    endforeach;

                                endif;

                            endif;
                            ?>   
                        </select>
                    </label>


                    <div class="box-line no-margin"></div>
                    <input class="btn btn-green btn_cadastrar fl-right radius" type="submit"  name="enviarCliente" value="Salvar" />
                    <div title="Carregando" class="load fl-right"></div>     


                </form>
                <div id="j_ajaxident" class="<?= HOME . "/_cdn/ajax" ?>"></div>           


            </section>


            <section class="container bloco_minha_senha j_minha_senha">


                <header>
                    <h1>Minha Senha</h1>
                    <p class="tagline">Confira seus dados de acesso</p>
                    <div class="b-bottom"></div>
                </header>


                <form action="" method="post" class="m-top1">

                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <input readonly type="hidden" name="cliente_id" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_id'] : null ); ?>"/>
                    <input readonly="" type="hidden" name="action" value="update_aluno"/>


                    <label class="fl-left">	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_email'] : ''); ?>"/>
                    </label>

                    <label class="fl-left">	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" value="<?= (!empty($_SESSION['clientelogin']) ? $_SESSION['clientelogin']['cliente_senha'] : ''); ?>" />
                    </label>

                    <div class="box-line no-margin"></div>
                    <input class="btn btn-green btn_cadastrar fl-right radius" type="submit"  name="enviarCliente" value="Salvar" />
                    <div title="Carregando" class="load fl-right"></div>     


                </form>



            </section>

        <?php endif; ?>



    </section>
