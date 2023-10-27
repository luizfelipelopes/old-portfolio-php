<main>
    <?php $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT); ?>
    <section class="container">

        <!--CAMINHO-->
        <header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
            <div class="content">
                <div class="titulo-caminho">
                    <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Novo Produto</h1>
                    <p class="tagline"> >> Flow State / Produtos / <b>Novo Produto</b></p>
                </div>


                <a class="btn btn-blue radius m-bottom1" title="Meus Produtos" href="<?= HOME; ?>flowstate_admin/dashboard.php?exe=produtos/index">Meus Produtos</a>    

                <?php
                if ($id):
                    ?>
                    <a style="margin-right: 1%;" class="btn btn-green radius" title="Novo Produto" href="<?= HOME; ?>flowstate_admin/dashboard.php?exe=produtos/create">Novo Produto</a>    
                    <?php
                endif;
                ?>


                <div class="clear"></div>
            </div>
        </header>
        <!--CAMINHO-->


        <div class="box-line"></div>


        <div class="main-conteudo posts posts-create js_content_form">    

            <?php
            if ($id):

//                PRODUTO
                $readProduto = new Read();
                $readProduto->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$id}");
                if ($readProduto->getResult()):
//                    var_dump($read->getResult()[0]);
                    extract($readProduto->getResult()[0]);

                endif;

//                ESPECIFICACOES DO PRODUTO
                $readEspecificacoes = new Read;
                $readEspecificacoes->ExeRead(ESPECIFICACOES, "WHERE produto_id = :id", "id={$id}");
                if ($readEspecificacoes->getResult()):
                    extract($readEspecificacoes->getResult()[0]);
                endif;

//                GALERIA
                $readGaleria = new Read;
                $readGaleria->ExeRead(GALERIA, "WHERE produto_id = :id", "id={$id}");


            endif;
            ?>



            <form action="" method="post" enctype="multipart/form-data">



                <div class="container bg-body posts-novo">

                    <div class="content">


                        <div class="trigger-box-suspenso"></div>
                        <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                        <input readonly type="hidden" name="produto_id" value="<?= (!empty($id) ? $id : null); ?>"/>
                        <input readonly type="hidden" name="action" value="<?= (!empty($id) ? 'update_produto' : 'create_produto'); ?>"/>


                        <label class="form-field">
                            <span class="form-legend">Capa:</span>
                            <input type="file" name="produto_image" title="Capa" class="j_imagem" value="<?= (!empty($produto_image) ? $produto_image : null ); ?>" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Título:</span>
                            <input type="text" title="Nome" name="produto_title" placeholder="Digite um Nome" value="<?= (!empty($produto_title) ? $produto_title : null ); ?>" />
                        </label>


                        <label class="form-field">
                            <span class="form-legend">Conteúdo:</span>
                            <div class="j_limpa_conteudo">
                                <textarea id="j_post" class="js_editor" rows="5" name="produto_descricao" title="Descrição" placeholder="Sobre a Categoria" ><?= (!empty($produto_descricao) ? $produto_descricao : null ); ?></textarea>
                            </div>
                        </label>



                        <label class="form-field col-49">
                            <span class="form-legend">Preço:</span>
                            <input class="j_valor" type="text" name="produto_valor" title="Preço" placeholder="Digite um valor" value="<?= (!empty($produto_valor) ? number_format($produto_valor, 2, ',', '.') : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Desconto (%):</span>
                            <input <?= ((empty($id) || empty($produto_valor)) ? 'disabled' : ''); ?>  class="j_desconto j_valor" attr-desconto="realizar_desconto_produto" type="text" name="produto_desconto" title="Preço" placeholder="Digite um valor" value="<?= (!empty($produto_desconto) ? number_format($produto_desconto * 100, 2, ',', '.') : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Valor Com Desconto:</span>
                            <input disabled class="j_valor_descontado" type="text" name="produto_valor_descontado" title="Preço" placeholder="Digite um valor" value="<?= (!empty($produto_valor_descontado) ? number_format($produto_valor_descontado, 2, ',', '.') : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Disponibilidade:</span>
                            <select name="produto_disponivel">
                                <option selected disabled value="">Selecione a disponibilidade</option>
                                <option value="1" <?= (!empty($id) && $produto_disponivel == '1' ? 'selected' : '') ?>>Disponível</option>
                                <option value="0" <?= (!empty($id) && $produto_disponivel == '0' ? 'selected' : '') ?>>Indisponível</option>
                            </select>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Destaque:</span>
                            <select name="produto_destaque">
                                <option selected disabled value="">Escolha o destaque</option>
                                <option value="1" <?= (!empty($id) && $produto_destaque == '1' ? 'selected' : '') ?>>Com Destaque</option>
                                <option value="0" <?= (!empty($id) && $produto_destaque == '0' ? 'selected' : '') ?>>Sem Destaque</option>
                            </select>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Número de Ordem:</span>
                            <input type="text" name="especificacao_ref" title="Nº de Ordem" placeholder="Digite um nº de Ordem" value="<?= (!empty($especificacao_ref) ? $especificacao_ref : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Modelo:</span>
                            <input type="text" name="especificacao_modelo" title="Modelo" placeholder="Digite um modelo" value="<?= (!empty($especificacao_modelo) ? $especificacao_modelo : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Cor:</span>
                            <input type="text" name="especificacao_cor" title="Cor" placeholder="Digite uma cor" value="<?= (!empty($especificacao_cor) ? $especificacao_cor : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Dimensões:</span>
                            <input type="text" name="especificacao_dimensoes" title="Dimensão" placeholder="Digite uma dimensão" value="<?= (!empty($especificacao_dimensoes) ? $especificacao_dimensoes : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Fabricação Inicial:</span>
                            <input type="text" name="especificacao_fab_inicial" title="Fabricação Inicial" placeholder="Digite a Fabricação Inicial" value="<?= (!empty($especificacao_fab_inicial) ? $especificacao_fab_inicial : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Fabricação Final:</span>
                            <input type="text" name="especificacao_fab_final" title="Fabricação Final" placeholder="Digite a Fabricação Final" value="<?= (!empty($especificacao_fab_final) ? $especificacao_fab_final : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Tonalidade:</span>
                            <input type="text" name="especificacao_tonalidade" title="Tonalidade" placeholder="Digite uma Tonalidade" value="<?= (!empty($especificacao_tonalidade) ? $especificacao_tonalidade : null ); ?>"/>
                        </label>

                        <label class="form-field col-49">
                            <span class="form-legend">Artesãs:</span>
                            <input type="text" name="especificacao_artesas" title="Artesãs" placeholder="Digite uma Artesã" value="<?= (!empty($especificacao_artesas) ? $especificacao_artesas : null ); ?>"/>
                        </label>



                        <div class="clear"></div>  
                    </div>
                </div>



                <div class="posts-lateral">

                    <div class="container foto-categoria m-bottom3">

                        <div class="j_limpa_capa">
                            <img title="" src="<?= (!empty($produto_image) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $produto_image : '' ); ?>" class="j_previa"/>
                        </div>

                        <div class="content">

                            <label class="form-field fl-left">
                                <span class="form-legend">Categoria:</span>
                                <select name="produto_categoria">

                                    <option selected disabled value="">Selecione uma categoria</option>

                                    <?php
                                    $read = new Read;
                                    $read->ExeRead(CATEGORIAS, "WHERE category_parent IS NULL ORDER BY category_title");
                                    if ($read->getResult()):
                                        $readCategoria = new Read;

                                        foreach ($read->getResult() as $secao) :

                                            $readCategoria->ExeRead(CATEGORIAS, "WHERE category_parent = :id ORDER BY category_title", "id={$secao['category_id']}");
                                            if ($readCategoria->getResult()):
                                                echo "<option disabled class='bg-gray' value='" . $secao['category_id'] . "'> >>" . $secao['category_title'] . "</option>";
                                                foreach ($readCategoria->getResult() as $categoria) :
                                                    echo "<option " . (!empty($id) && $categoria['category_id'] == $produto_categoria ? 'selected' : '') . " value='" . $categoria['category_id'] . "'>" . $categoria['category_title'] . "</option>";
                                                endforeach;
                                            endif;


                                        endforeach;

                                    endif;
                                    ?>

                                </select>
                            </label>

                            <div class="clear"></div>
                        </div>    
                    </div>

                    <div class="container foto-galeria">
                        <div class="content">
                            <label class="form-field">
                                <span class="form-legend">Galeria:</span>

                                <input class="j_gallery" type="file" multiple name="gallery_covers[]" />

                            </label>

                            <div class="gallery_itens">


                                <?php
                                if ($id):

                                    if ($readGaleria->getResult()):


                                        foreach ($readGaleria->getResult() as $galeria):
                                            extract($galeria);
                                            ?>


                                            <div attr-total="<?= $readGaleria->getRowCount(); ?>" class="gallery" id="gb_<?= $gallery_id; ?>">
                                                <img title = "<?= $produto_title; ?> Foto 1" alt = "[<?= $produto_title; ?>  Foto 1]" src = "<?= HOME . 'uploads/' . $gallery_image; ?>" >
                                                <div attr-action="delete_galeria" id="gb_<?= $gallery_id; ?>" class = "delete_galeria">x</div>
                                            </div>

                                            <?php
                                        endforeach;
                                    endif;
                                endif;
                                ?>

                            </div>

                        </div>

                    </div>

                    <div class = "container posts-publicar bg-body">

                        <div class = "content">

                            <h1>Publicar:</h1>

                            <form method = "post" action = "" >

                                <label class = "form-field">
                                    <span class = "form-legend">Dia:</span>
                                    <input type = "date" title = "Nome" name = "produto_data" placeholder = "Digite uma data" value = "<?= (!empty($produto_data) ? date('Y-m-d', strtotime($produto_data)) : date('Y-m-d')); ?>" />
                                </label>

                                <label class = "form-field">
                                    <select name = "produto_author">
                                        <option disabled selected value = "">Selecione um usuário</option>
                                        <?php
                                        $readUser = new Read;
                                        $readUser->ExeRead(USUARIOS, "ORDER BY user_name ASC");
                                        if ($readUser->getResult()) :
                                            foreach ($readUser->getResult() as $user) :
                                                echo "<option " . (!empty($id) && $user['user_id'] == $produto_author ? 'selected' : (($user['user_id'] == $_SESSION['userlogin']['user_id']) ? 'selected' : '')) . " value='" . $user['user_id'] . "'>" . $user['user_name'] . " " . $user['user_lastname'] . "</option>";
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </label>


                                <div class="form-check">
                                    <label><input type="checkbox" name="produto_status" <?= (!empty($id) && $produto_status == '1' ? 'checked' : '' ); ?> value="<?= (!empty($id) ? $produto_status : '1' ); ?>">Publicar Agora</label>
                                </div>

                                <button class="btn btn-green radius j_btn">Atualizar!</button>
                                <div title="Carregando" class="load fl-right"></div>
                                <!--</form>-->

                                <div class="clear"></div>
                        </div>

                    </div>

                </div>

            </form>

            <div class="clear"></div>
        </div>




