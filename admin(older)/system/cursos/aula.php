<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$curso = filter_input(INPUT_GET, 'curso', FILTER_VALIDATE_INT);
$modulo = filter_input(INPUT_GET, 'modulo', FILTER_VALIDATE_INT);


$readCurso = new Read;
$readCurso->ExeRead(CURSOS, "WHERE curso_id = :id", "id={$curso}");
if ($readCurso->getResult()):
    extract($readCurso->getResult()[0]);
endif;

$readModulo = new Read;
$readModulo->ExeRead(MODULOS, "WHERE modulo_id = :id", "id={$modulo}");
if ($readModulo->getResult()):
    extract($readModulo->getResult()[0]);
endif;

?>
<!--<main>

    <section class="container">-->

<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Disciplinas </h1>
            <p class="tagline"> >> <?= SOFTWARE; ?> / <?= $curso_title; ?> / <?= $modulo_title; ?> / <b>Disciplinas</b></p>
        </div>
        <?php
        if ($id):
            ?>
            <a class="btn btn-green radius m-bottom1" title="Adicionar Disciplina" href="?exe=cursos/aula&modulo=<?= $modulo ?>&curso=<?= $curso; ?>">Adicionar Disciplina</a>
            <?php endif;
        ?>

        <a class="btn btn-blue btn-separador radius" title="Gerenciar Curso" href="?exe=cursos/gerenciar&id=<?= $curso; ?>">Gerenciar Curso</a>
        <!--<a class="btn btn-green radius" title="Adicionar Disciplina" href="<?= HOME; ?>/admin/dashboard.php?exe=cursos/gerenciar&id=">Adicionar Disciplina</a>-->
        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line"></div>


<div class="main-conteudo posts posts-create aulas-criadas">    

    <div class="j_dinamic">

        <?php
        $read = new Read();

        if ($id):
            $read->ExeRead(AULAS, "WHERE aula_modulo = :modulo AND aula_id != :aula", "modulo={$modulo}&aula={$id}");
        else:
            $read->ExeRead(AULAS, "WHERE aula_modulo = :id", "id={$modulo}");
        endif;


        if (!$read->getResult()):

            WSErro("Não há nenhuma disciplina cadastrada neste módulo", WS_INFOR);

        else:

            $View = new View();
            $tpl_curso = $View->Load('aula');

            foreach ($read->getResult() as $aula):
                $aula['modulo_title'] = $modulo_title;
                $aula['modulo_id'] = $modulo_id;
                $aula['curso_id'] = $curso_id;
                $aula['aula_date'] = date('d/m/Y', strtotime($aula['aula_date']));
                $View->Show($aula, $tpl_curso);

            endforeach;
        endif;

        if ($id):

            $readAtual = new Read();
            $readAtual->ExeRead(AULAS, "WHERE aula_id = :id", "id={$id}");

            extract($readAtual->getResult()[0]);

        endif;
        ?>

    </div>




    <form action="" method="post" enctype="multipart/form-data">

        <div class="container bg-body modulo-novo">



            <div class="content">

                <header>
                    <h1><?= ($id ? 'Atualizar ' : 'Adicionar ' ); ?>Disciplina </h1>
                </header>


                <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                <input readonly type="hidden" name="aula_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                <input readonly type="hidden" name="aula_modulo" value="<?= (!empty($modulo) ? $modulo : null); ?>"/>
                <input readonly type="hidden" name="aula_curso" value="<?= (!empty($curso) ? $curso : null); ?>"/>
                <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_aula' : 'create_aula'); ?>"/>


                <label class="form-field">
                    <span class="form-legend">Título:</span>
                    <input type="text" title="Titulo do Modulo" name="aula_title" placeholder="Digite o nome da Disciplina" value="<?= (!empty($aula_title) ? $aula_title : null ); ?>" />
                </label>

                <label class="form-field">
                    <span class="form-legend">Link do Vídeo(Opcional):</span>
                    <input type="text" title="Titulo do Modulo" name="aula_video" placeholder="Apenas os Caracteres Finais" value="<?= (!empty($aula_video) ? $aula_video : null ); ?>" />
                </label>

                <label class="form-field">
                    <span class="form-legend">Descrição:</span>
                    <textarea rows="5" name="aula_descricao" title="descricao" placeholder="Digite uma Descrição" ><?= (!empty($aula_descricao) ? $aula_descricao : null ); ?></textarea>
                </label>


                <label class="form-field j_up_material">
                    <span class="form-legend">Material:</span>

                    <div class="j_lista_material"></div>

                    <?php
                    if ($id):
                        $readMateriais = new Read;
                        $readMateriais->ExeRead(MATERIAIS, "WHERE material_aula = :material", "material={$id}");

                        if ($readMateriais->getResult()):

                            foreach ($readMateriais->getResult() as $material):
                                ?>

                                <div class="m-bottom1 materiais-cadastrados" id="<?= $material['material_id']; ?>" > 

                                    <span class="j_material_listado" id="<?= $material['material_id']; ?>"> <span class="coluna-material"> <?= $material['material_title']; ?> </span> <a class="btn btn-blue radius j_editar_material">Editar</a> <a class="btn btn-red radius j_excluir" attr-action="delete_material" id="<?= $material['material_id']; ?>" >Excluir</a></span>

                                </div>

                                <?php
                            endforeach;
                        else:
                            ?>
                                
                            <input type="file" multiple title="Material" name="material_aula[]" class="m-bottom1"/>
                            
                        <?php
                        endif;
                    else:
                        ?>

                        <input type="file" multiple title="Material" name="material_aula[]" class="m-bottom1"/>
                        
                    <?php
                    endif;
                    ?>


                    <div class="j_inputs"></div>  

                </label>

                <a title="Adicionar Mais Materiais" class="btn btn-blue radius j_mais_materiais">+</a>

                <button class="btn btn-green radius j_btn fl-right m-top3">Salvar!</button>
                <div title="Carregando" class="load fl-right m-top3"></div>

                <div class="clear"></div>  
            </div>
        </div>

    </form>



    <div class="clear"></div>
</div>
<div class="box-line m-bottom3"></div>
