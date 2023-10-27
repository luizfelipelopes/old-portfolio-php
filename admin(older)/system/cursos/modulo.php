<?php 
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$curso = filter_input(INPUT_GET, 'curso', FILTER_VALIDATE_INT); 
?>
<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Módulo</h1>
                    <p class="tagline"> >> <?= SOFTWARE; ?> / Cursos / <b>Novo Módulo</b></p>
                </div>
                <?php 
                if($id):
                    ?>
                <a class="btn btn-green radius m-bottom1" title="Adicionar Disciplina" href="?exe=cursos/aula&modulo=<?=$id?>&curso=<?=$curso;?>">Adicionar Disciplina</a>
                <a class="btn btn-orange radius btn-separador m-bottom1" title="Novo Módulo" href="?exe=cursos/modulo">Novo Módulo</a>
                <?php
                
                endif; ?>
                
                <a class="btn btn-blue radius btn-separador" title="Gerenciar Curso" href="?exe=cursos/gerenciar&id=<?=$curso;?>">Gerenciar Curso</a>
                
                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create">    

            <?php
            
            
            if ($id):

                $read = new Read();
                $read->ExeRead(MODULOS, "WHERE modulo_id = :id", "id={$id}");
                if ($read->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($read->getResult()[0]);

                endif;

            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">

                <div class="container bg-body modulo-novo">

                    <div class="content">



                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="modulo_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="modulo_curso" value="<?= (!empty($curso) ? $curso : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_modulo' : 'create_modulo'); ?>"/>


                        <label class="form-field">
                            <span class="form-legend">Título:</span>
                            <input type="text" title="Titulo do Modulo" name="modulo_title" placeholder="Digite um Modulo" value="<?= (!empty($modulo_title) ? $modulo_title : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Descrição:</span>
                            <textarea rows="5" name="modulo_descricao" title="descricao" placeholder="Digite uma Descrção" ><?= (!empty($modulo_descricao) ? $modulo_descricao : null ); ?></textarea>
                        </label>


                        <label class="form-field">
                            <span class="form-legend">Liberação em Dias:</span>
                            <input type="date" title="Liberação em Dias" name="modulo_liberacao" placeholder="Em quantos dias será liberado" value="<?= (!empty($modulo_liberacao) ? date('Y-m-d', strtotime($modulo_liberacao)) : null ); ?>" />
                        </label>


                        <button class="btn btn-green radius j_btn fl-right">Atualizar!</button>
                        <div title="Carregando" class="load fl-right"></div>    
                        
                        <div class="clear"></div>  
                    </div>
                </div>


                


            </form>

            <div class="clear"></div>
        </div>




