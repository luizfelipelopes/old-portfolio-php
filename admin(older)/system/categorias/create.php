<?php
$Segment = filter_input(INPUT_GET, 'segment', FILTER_DEFAULT);
//var_dump($Segment);
?>


<main>

    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Categorias</h1>
                    <p class="tagline"> >> Flow State / Posts / Categorias / <b>Nova Categoria</b></p>
                </div>

                <a class="btn btn-blue radius" title="Ver Categoria" href="?exe=categorias/index&segment=<?= $Segment; ?>">Ver Categoria</a>

                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->

        <div class="box-line"></div>


        <div class="content main-conteudo categorias">    


            <div class="container bg-body categorias-novo">


                <div class="content js_content_form">
                    <header>
                        <h1>Cadastrar Categoria:</h1>
                    </header>

                    <?php
                    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

                    if (!empty($id)):

                        $read = new Read;
//                        $read->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$id}");
                        $read->FullRead("SELECT category_id, category_title, category_content, category_parent FROM " . CATEGORIAS . " WHERE category_id = :id AND category_segment = :segment", "id={$id}&segment={$Segment}");

                    endif;
                    ?>

                    <form class="form-categoria" action="" method="post">

                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="category_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="category_segment" value="<?= $Segment; ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_categoria' : 'create_categoria'); ?>"/>

                        <label class="form-field m-top1">
                            <span class="form-legend">Nome:</span>
                            <input type="text" title="Nome" name="category_title" placeholder="Digite um Nome" value="<?= (!empty($id) ? $read->getResult()[0]['category_title'] : ''); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Descrição:</span>
                            <textarea rows="5" name="category_content" title="Descrição" placeholder="Sobre a Categoria"><?= (!empty($id) ? $read->getResult()[0]['category_content'] : ''); ?></textarea>
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Seção</span>
                            <select name="category_parent" class="m-bottom2">
                                <option value="">Esta é uma sessão</option>

                                <?php
                                $readCategorias = new Read();
                                $where = (!empty($id) ? " AND category_id != {$id}" : '');
                                $readCategorias->FullRead("SELECT category_id, category_title FROM " . CATEGORIAS . " WHERE category_segment = :segment AND category_parent IS NULL {$where} ORDER BY category_date DESC", "segment={$Segment}");

                                foreach ($readCategorias->getResult() as $secao):
                                    ?>
                                    <option <?= ((!empty($id) && $secao['category_id'] == $read->getResult()[0]['category_parent']) ? 'selected' : ''); ?> value="<?= $secao['category_id']; ?>" ><?= $secao['category_title']; ?></option>
                                    <?php
                                endforeach;
                                ?>  

                                <!--                                <option>Eventos</option>-->
                            </select>
                        </label>


                        <button class="btn btn-green j_atualizar_categoria" title="Atualizar Categoria" name="atualizar">Atualizar Categoria</button>
                        <div title="Carregando" class="load fl-right"></div>
                    </form>    




                    <div class="clear"></div>
                </div>
            </div>

