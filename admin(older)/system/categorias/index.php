<?php
$Segment = filter_input(INPUT_GET, 'segment', FILTER_DEFAULT);
?>
<main>
    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-categoria shorticon-botao ds-inblock">Categorias</h1>
                    <p class="tagline"> >> Flow State / Posts / <b>Categorias</b></p>
                </div>
                <a class="btn btn-blue-baby shorticon shorticon-adicionar shorticon-minimo nova-categoria radius" title="Adicionar Nova Categoria" href="?exe=categorias/create&segment=<?= $Segment; ?>">Adicionar Nova Categoria</a>
                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->

        <div class="box-line"></div>

        <div class="content main-conteudo categorias">    

            <?php
            $readSecao = new Read();
            $readSecao->FullRead("SELECT category_id, category_title, category_content FROM " . CATEGORIAS . " WHERE category_segment = :segment AND category_parent IS NULL ORDER BY category_date DESC", "segment={$Segment}");

            if (!$readSecao->getResult()):
                WSErro("Ainda Não Existe Nenhuma Categoria", WS_INFOR);
            else:

                foreach ($readSecao->getResult() as $secao):
                    ?>

                    <div class="container bg-body categorias-item sectiontitle" id="<?= $secao['category_id']; ?>">

                        <div class="content">
                            <header>
                                <h1 class="shorticon shorticon-categoria shorticon-botao fontsize1b"><?= $secao['category_title'] ?>:</h1>
                                <p class="tagline"><?= $secao['category_content'] ?></p>
                            </header>

                            <div class="botoes al-center">
                                <a class="btn btn-blue-baby radius shorticon shorticon-ver" title="Ver Posts da Seção" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=posts/index&id=<?= $secao['category_id'] ?>&sec=true"></a>
                                <a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Seção" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=categorias/create&id=<?= $secao['category_id'] ?>&segment=<?= $Segment ?>"></a>
                                <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm" title="Excluir Seção" id="<?= $secao['category_id']; ?>"></a>
                                <div class="bloco-confirm" id="<?= $secao['category_id']; ?>">
                                    <small class="msg-confirm">Deseja excluir? (Todas as categorias desta Seção também serão excluídas.)</small>    
                                    <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_categoria" id="<?= $secao['category_id']; ?>">Sim</a>
                                    <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $secao['category_id']; ?>">Não</a>
                                </div>
                            </div>

                            <div class="clear"></div>
                        </div>

                        <div class="border-bottom"></div>

                        <div class="trigger-box m-bottom1 m-top1"></div>    

                        <?php
                        $readCategoria = new Read();
                        $readCategoria->FullRead("SELECT category_id, category_title, category_content FROM " . CATEGORIAS . " WHERE category_segment = :segment AND category_parent = :secao ORDER BY category_date DESC", "segment={$Segment}&secao={$secao['category_id']}");

                        if (!$readCategoria->getResult()):
                            WSErro("Ainda nenhuma categoria foi criada para esta seção!", WS_INFOR);
                        else:
                            foreach ($readCategoria->getResult() as $categoria):
                                extract($categoria);
                                ?>

                                <div class="categorias-subitem m-top1 fl-left" id="<?= $category_id; ?>">
                                    <div class="content">
                                        <header>
                                            <h1 class="shorticon shorticon-categoria shorticon-minimo fontsize1"><?= $category_title ?>:</h1>
                                            <p class="tagline"><?= $category_content; ?></p>
                                        </header>

                                        <div class="botoes al-center" id="<?= $category_id; ?>">
                                            <a class="btn btn-blue-baby radius shorticon shorticon-ver" title="Ver Posts da Categoria " href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=posts/index&id=<?= $category_id; ?>"></a>
                                            <a class="btn btn-blue radius shorticon shorticon-editar" title="Editar Categoria" href="?exe=categorias/create&id=<?= $category_id; ?>&segment=<?= $Segment ?>"></a>
                                            <a class="btn btn-pink radius shorticon shorticon-excluir j_confirm" title="Excluir Categoria" href="#" id="<?= $category_id; ?>"></a>
                                            <div class="bloco-confirm" id="<?= $category_id; ?>">
                                                <small class="msg-confirm">Deseja excluir?</small>    
                                                <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_categoria" id="<?= $category_id; ?>">Sim</a>
                                                <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="<?= $category_id; ?>">Não</a>
                                            </div>
                                        </div>

                                        <div class="clear"></div>
                                    </div>
                                </div>

                                <?php
                            endforeach;
                        endif;
                        ?>

                    </div>

                    <?php
                endforeach;
            endif;
            ?>

        </div>