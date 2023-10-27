<?php $tutor = filter_input(INPUT_GET, 'tutor', FILTER_VALIDATE_BOOLEAN); ?>
<section class="container curso_detalhes">

    <?php
    $name = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);

    $read = new Read();
    $read->ExeRead("cetrhema_cursos", "WHERE curso_name = :name", "name={$name}");
    if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
        extract($read->getResult()[0]);

    endif;

    $readMods = new Read;
    $readMods->ExeRead("cetrhema_modulos", "WHERE modulo_curso = :curso", "curso={$curso_id}");
    ?>



    <article class="container bg-light cabecalho_aula">

        <div class="content">

            <header>
                <p class="font-bold"> <a class="" href="<?= ($tutor ? HOME . DIRECTORY_SEPARATOR . 'plataforma?exe=home&tutor=true' : HOME . DIRECTORY_SEPARATOR . 'plataforma'); ?>"> Início </a> >> <a href="<?= ($tutor ? HOME . '/plataforma/?exe=curso&name=' . $curso_name . '&tutor=true' : HOME . '/plataforma/?exe=curso&name=' . $curso_name); ?>"> <?= $curso_title; ?> </a></p>
            </header>

            <div class="clear"></div>
        </div>
    </article>   



    <div class="bg-gray al-center">
        <div class="content al-center">
            <!--<header class="sectiontitle">-->
                <!--<h1><?= $curso_title; ?></h1>-->
                <!--<p class="tagline"><?= $curso_subtitle; ?></p>-->
            <!--</header>-->    

            <div class="al-center m-bottom2 m-top3">
                <img class="capa_curso" height="250" title="<?= $curso_title; ?>" alt="[<?= $curso_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $curso_cover ?>" />
            </div>

            <?php if (isset($_SESSION['clientelogin']['cliente_id'])): ?>
                <div class="curso_plataforma_info">
                    <div class="box bg-blue-marinho bloco_info">
                        <p class="font-bold">Tutor:</p>

                        <?php
                        $readTutor = new Read;
                        $readTutor->ExeRead("cetrhema_users", "WHERE user_id = :id", "id={$curso_tutor}");
                        ?>

                        <p><?= $readTutor->getResult()[0]['user_name'] . ' ' . $readTutor->getResult()[0]['user_lastname'] ?></p>
                    </div>

                    <div class="box bg-blue-marinho bloco_info">
                        <p class="font-bold">Andamento do Curso</p>

                        <?php
                        $readProg = new Read;
                        $readProg->ExeRead("cetrhema_progressos", "WHERE progresso_aluno = :aluno AND progresso_curso = :curso", "aluno={$_SESSION['clientelogin']['cliente_id']}&curso={$curso_id}");
                        ?>
                        <div class="bg-gray">
                            <div class="progresso" style="<?= (isset($readProg->getResult()[0]['progresso_andamento']) ? 'width:' . $readProg->getResult()[0]['progresso_andamento'] . '%' : 'width: 0%; padding: 0%;' ); ?>"><span><?= (isset($readProg->getResult()[0]['progresso_andamento']) ? $readProg->getResult()[0]['progresso_andamento'] : '0'); ?>%</span></div>
                        </div>
                    </div>

                    <?php
                    $readCliente = new Read;
                    $readCliente->ExeRead("cetrhema_clientes", "WHERE cliente_id = :id", "id={$_SESSION['clientelogin']['cliente_id']}");
                    ?>

                    <div class="box bg-blue-marinho bloco_info">
                        <p class="font-bold">Último Acesso</p>
                        <p><?= date('d/m/Y', strtotime($readCliente->getResult()[0]['cliente_entrada'])); ?></p>
                    </div>

                    <div class="box bg-blue-marinho bloco_info">
                        <p class="font-bold">Onde Parou</p>

                        <?php
                        $readClass = new Read;
                        $readClass->ExeRead("cetrhema_progressos", "WHERE progresso_aluno = :id AND progresso_curso = :curso", "id={$_SESSION['clientelogin']['cliente_id']}&curso={$curso_id}");
                        if ($readClass->getResult()):
                            $readUltimaAula = new Read;
                            $readUltimaAula->ExeRead("cetrhema_aulas", "WHERE aula_id = :aula", "aula={$readClass->getResult()[0]['progresso_aula']}");
                            ?>

                            <p><?= ($readUltimaAula->getResult() && isset($readUltimaAula->getResult()[0]['aula_title']) ? $readUltimaAula->getResult()[0]['aula_title'] : '-'); ?></p>

                            <?php
                        else:
                            ?>
                            <p>-</p>
                        <?php endif; ?>                    


                    </div>
                </div>
            <?php endif;
            ?>

            <div class="clear"></div>
        </div>    
    </div>




    <article class="curso_descricao bg-body fl-right curso_plataforma_modulos">


        <article class="container modulos modulos-site m-bottom3">

            <?php
            $readModulos = new Read;
            $readModulos->ExeRead("cetrhema_modulos", "WHERE modulo_curso = :curso ORDER BY modulo_name ASC", "curso={$curso_id}");
            if ($readModulos->getResult()):
                $porcentagemModulo = 100 / $readModulos->getRowCount();
                $i = 1;
                foreach ($readModulos->getResult() as $modulo):
                    extract($modulo);

                    $liberacao = ($modulo_liberacao > date('Y-m-d H:i:s') ? 'Libera em ' . date('d/m/Y', strtotime($modulo_liberacao)) : 'Liberado');
                    ?>

                    <header class="bg-green-claro fl-left" id="<?= $modulo_name; ?>">
                        <h1 class="shorticon shorticon-modulo shorticon-sectiontitle caps-lock font-bold"><?= $modulo_title; ?><span class="ds-inblock"><?= $liberacao; ?></span></h1>
                        <div class="b-bottom"></div>
                    </header>


                    <div class="bg-body">
                        <?php
                        $readAulas = new Read;
                        $readAulas->ExeRead("cetrhema_aulas", "WHERE aula_modulo = :modulo ORDER BY aula_date", "modulo={$modulo_id}");
                        if ($readAulas->getResult()):
                            $porcentagemAula = $porcentagemModulo / $readAulas->getRowCount();
                            foreach ($readAulas->getResult() as $aula):
                                extract($aula);
                                ?>

                                <div class="exibir_janela j_popup" id="<?= $aula_id; ?>">

                                    <div class="materiais_aluno container bg-body">

                                        <div class="ajax_close fechar_materiais">X</div>

                                        <header>
                                            <h1>Baixe Aqui os seus Materiais</h1>
                                        </header>


                                        <div class="content">


                                            <?php
                                            $readMateriais = new Read;
                                            $readMateriais->ExeRead("cetrhema_materiais", "WHERE material_aula = :id", "id={$aula_id}");

                                            if (!$readMateriais->getResult()):
                                                ?>
                                                <div class="box box-medium material_item m-bottom1"><p>Não há materiais disponíveis no momento!</p></div>
                                                <?php
                                            else:


                                                foreach ($readMateriais->getResult() as $material):
                                                    ?>

                                                    <div class="box box-medium material_item m-bottom1">
                                                        <a class="shorticon shorticon-folder shorticon-botao" title="<?= $material['material_title']; ?>" target="_blank" href="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $material['material_name']; ?>"><?= $material['material_title']; ?> </a>
                                                    </div>


                                                    <?php
                                                endforeach;
                                            endif;
                                            ?>

                                            <div class="clear"></div>

                                        </div>
                                    </div>
                                </div>

                                <div class="container linha b-bottom">
                                    <div class="content">

                                        <div class="coluna_curso_plataforma caps-lock"><span><a title="Ver Aula" href="<?= ($modulo_liberacao > date('Y-m-d H:i:s') ? '#' : ($tutor ? HOME . '/plataforma/?exe=aula&id=' . $aula_id . '&name=' . $aula_name . '&tutor=true' : HOME . '/plataforma/?exe=aula&id=' . $aula_id . '&name=' . $aula_name)); ?>"><?= $aula_title; ?></a></span></div>
                                        <div class="al-center bg-light radius codigo-curso"><span>D<?= ($i < 10 ? '00' : '0') . $i++; ?></span></div>
                                        <div class="al-center  btn_baixar"><a id="<?= $aula_id; ?>" class="btn btn-blue radius  <?= ($modulo_liberacao > date('Y-m-d H:i:s') ? '' : 'j_botao_material') ?> " title="Baixar Materiais" href="<?= ($modulo_liberacao > date('Y-m-d H:i:s') ? '#' . $modulo_name : '#') ?>">Baixar Material</a></div>    
                                        <div class="al-center  btn_ver"><a class="btn btn-green radius" title="Ver Aula" href="<?= ($modulo_liberacao > date('Y-m-d H:i:s') ? '#' : ($tutor ? HOME . '/plataforma/?exe=aula&id=' . $aula_id . '&name=' . $aula_name . '&tutor=true' : HOME . '/plataforma/?exe=aula&id=' . $aula_id . '&name=' . $aula_name)); ?>">Ver Aula</a></div>    
                                        <div class="clear"></div>
                                    </div>
                                </div>



                                <?php
                            endforeach;
                        endif;
                        ?>

                        <div class="box-line m-bottom3"></div>

                        <?php
                    endforeach;
                endif;
                ?>
            </div>
        </article>

    </article>


</section>