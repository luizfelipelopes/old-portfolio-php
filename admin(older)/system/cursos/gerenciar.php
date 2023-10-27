<?php ?>
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Gerenciar Cursos</h1>
            <p class="tagline"> >> <?= SOFTWARE; ?> / Cursos /  <b>Gerenciar Cursos</b></p>
        </div>
        <a class="btn btn-blue radius" href="?exe=cursos/index">Meus Cursos</a>

        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line"></div>


<div class="container main-conteudo cursos">    

    <div class="trigger-box m-bottom1 m-top1"></div>    

    <div class="content">



        <?php
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if ($id):

            $read = new Read();
            $read->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$id}");
            if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                extract($read->getResult()[0]);

            endif;

        endif;
        ?>

        <!--MODULOS-->
        <article class="container modulos m-bottom3 table-modulos">

            <header class="bg-green-claro fl-left">
                <div class="content">
                    <h1 class="shorticon shorticon-pedidos caps-lock font-bold fl-left">Módulos</h1> <a class="fl-right btn btn-blue" href="?exe=cursos/modulo&curso=<?= $id; ?>">+ Adicionar Módulo</a>
                    <div class="clear"></div>
                </div>    
            </header>

            <div class="bg-body">



                <?php
                if ($id):

                    $readModulo = new Read();
                    $readModulo->ExeRead(MODULOS, "WHERE modulo_curso = :modulo ORDER BY modulo_name ASC", "modulo={$id}");
                    if ($readModulo->getResult()):
//                    var_dump($read->getResult()[0]);


                        foreach ($readModulo->getResult() as $modulo) :


                            extract($modulo);
                            ?>

                            <div class="container linha" id="<?= $modulo_id; ?>">
                                <div class="content-modulo">
                                    <div class="col-15 fl-left titulo-modulo"><span><?= $modulo_title; ?></span></div>
                                    <div class="col-20 coluna-data-liberacao"><span><?= date('d/m/Y', strtotime($modulo_liberacao)); ?></span></div>

                                    <?php
                                    $readAulas = new Read;
                                    $readAulas->ExeRead(AULAS, "WHERE aula_modulo = :modulo", "modulo={$modulo_id}");
                                    ?>


                                    <div class="col-20 coluna-aulas"><span><?= $readAulas->getRowCount(); ?> Disciplinas</span></div>
                                    <div class="botoes botoes-gerenciar al-center col-44">
                                        <a class="btn btn-blue radius" title="Editar Módulo" href="?exe=cursos/modulo&id=<?= $modulo_id; ?>&curso=<?= $id; ?>">Editar</a>
                                        <a class="btn btn-green radius" title="Aulas" href="?exe=cursos/aula&modulo=<?= $modulo_id; ?>&curso=<?= $id; ?>">Aulas</a>
                                        <a class="btn btn-red radius j_confirm" title="Excluir Módulo" href="#">Excluir</a>
                                        <div class="bloco-confirm" id="<?= $modulo_id; ?>">
                                            <small class="msg-confirm">Deseja excluir?</small>
                                            <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_modulo" id="<?= $modulo_id; ?>">Sim</a>
                                            <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $modulo_id; ?>">Não</a>
                                        </div>
                                    </div> 
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <?php
                        endforeach;
                    endif;

                endif;
                ?>

                <div class="clear"></div>
            </div>
        </article>
        <!--ÚLTIMOS PEDIDOS-->


        <div class="posts-lateral modulo-info">

            <div class="container foto-categoria m-bottom3">


                <img title="" src="<?= (!empty($curso_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $curso_cover : '' ); ?>" class="j_previa"/>

                <div class="container bg-body">

                    <div class="content">

                        <h1 class="fontsize1b m-bottom1"><?= $curso_title; ?></h1>
                        <p class="fontsize1"><?= $curso_descricao; ?></p>

                        <div class="clear"></div>
                    </div>
                </div>     

            </div>

            <div class="clear"></div>
        </div>
    </div>