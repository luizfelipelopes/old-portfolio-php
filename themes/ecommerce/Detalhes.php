<?php
// SE A SESSÂO NÂO TIVER SIDO ATRIBUÍDA COM UM ARRAY 
if (!isset($_SESSION['carrinho'])):
    if (!session_id()):
        session_start();
    endif;
    $_SESSION['carrinho'] = array();
endif;


$produtoid = filter_input(INPUT_GET, 'produtoid', FILTER_VALIDATE_INT);
//$Link->setId($produtoid);

if ($Link->getData()):
//    var_dump($Link->getData());
    extract($Link->getData());
else:
    header('Location: ' . HOME . '404');
endif;


$data = filter_input(INPUT_POST, 'venda_quantidade', FILTER_DEFAULT);


if ($data):

//    unset($data['venda_comprar']);

    $quantidade = $data['venda_quantidade'];

//    var_dump($data);

endif;


//$_SESSION['carrinho'][$produtoid] = ($data ? $_SESSION['carrinho'][$produtoid] = ['produto_quantidade' => $data['venda_quantidade'] ] : 1);

if ($data):
//    var_dump($_SESSION['carrinho'][$produtoid]);
    header('Location: ' . HOME . 'Carrinho&action=adicionar&prodqnt=' . $quantidade . '&name=' . $produto_name . '&produtoid=' . $produto_id . '#carrinho');
endif;


//var_dump($_SESSION['carrinho']['produto_quantidade']);
?>


<!-- CONTENT_CONTEUDO -->
<section id="detalhes" class="container content_conteudo detalhes_bloco">

    <h1 id="detalhe" class="caminho">Home &raquo; Detalhes do Produto</h1>

    <div class="content">

        <section  class="content_detalhes" itemscope itemtype="https://schema.org/Product">

            <div class="content">

                <div class="divisao_cima">

                    <div class="fotos">
                        <div class="imagem_destaque">
                            <img style="height:250px; width: 100%;" alt="[<?= $produto_title; ?>]" title="<?= $produto_title; ?>" src="<?= HOME . '/uploads' . $produto_image; ?>" />
                        </div>

                        <?php
                        $readGallery = new Read();
                        $readGallery->ExeRead(GALERIA, "WHERE produto_id = :produtoid", "produtoid={$produto_id}");
                        if ($readGallery->getResult()):
                            ?>


                            <div class="galeria">

                                <div class="galeria_overflow">
                                    <?php
                                    $i = 0;

                                    foreach ($readGallery->getResult() as $gallery):
                                        $i++;
                                        extract($gallery);
                                        ?>
                                        <a class="j_galeria_shadowbox" href="<?= HOME . 'uploads' . DIRECTORY_SEPARATOR . $gallery_image; ?>"  title="Foto <?= $i; ?> do <?= $produto_title; ?>" rel="shadowbox[<?= $produto_id; ?>]" >
                                            <img alt="[<?= 'Foto ' . $i . ' do ' . $produto_title; ?>]" title="<?= 'Foto ' . $i . ' do ' . $produto_title; ?>" src="<?= HOME . 'uploads' . DIRECTORY_SEPARATOR . $gallery['gallery_image'] ?>" />
                                        </a>
                                        <?php
                                    endforeach;
                                    ?>

                                    <!-- CLEAR -->
                                    <div class="clear"></div><!-- CLEAR -->
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                    <div class="descricao_produto">
                        <h1 class="titulo_detalhes" itemprop="name"><?= $produto_title; ?></h1>

                        <!--<span class="preco m-bottom1">R$ <?= number_format($produto_valor, 2, ',', '.'); ?></span>-->

                        <?= (!empty($produto_desconto) ? '<small class="valor_anterior m-top1"> De: <del>R$ ' . number_format($produto_valor, 2, ',', '.') . '</del> o m<sup>2</sup></small><h1 class="valor_atual"><span class="valor_atual_digitos">Por: R$ ' . number_format($produto_valor_descontado, 2, ',', '.') . ' o m<sup>2</sup></span></h1><p class="m-bottom1 fl-left js_opt_cart ate-12x">Até em 12x no cartão</p>' : '<span class="preco m-bottom1">R$ ' . number_format($produto_valor, 2, ',', '.') . '</span><p class="m-bottom1 fl-left js_opt_cart ate-12x">Até em 12x no cartão</p>'); ?>


                        <div class="bloco_descricao m-bottom3">
                            <p class="detalhes" itemprop="description"><?= $produto_descricao; ?></p>
                        </div>


                        <div class="info_quantidade m-bottom3">
                            <?php
                            $visivel = ($produto_disponivel == '1' ? "style='display:none;'" : '');
                            ?>

                            <p class="estoque" <?= $visivel; ?>>Produto Indisponível</p>	


                            <?php if ($produto_disponivel == '1' && CARRINHO == '1'): ?>

                                <div class="detalhes_quantidade">	

                                    <form name="QuantidadeForm" action="" method="post">

                                        <div class="info_quantidade_left">
                                            <p class="txt_detalhes">Quantidade por m<sup>2</sup>:</p>
                                            <input class="quantidade" type="number" name="venda_quantidade" min="1" value="1" />
                                        </div>

                                        <div class="info_quantidade_right">
                                            <a title="" href="#">
                                                <div produto_id="<?= $produtoid; ?>" produto_valor="<?= (!empty($produto_desconto) && $produto_desconto > 0 ? $produto_valor_descontado : $produto_valor); ?>" class="btn_confirmar btn btn-green radius">
                                                    <p class="txt_confirmar">
                                                        <input type="submit" name="venda_comprar" value="Comprar"/>
                                                    <div class="load_carrinho"></div>
                                                    </p>

                                                </div>
                                            </a>
                                        </div>    
                                    </form>


                                </div>	

                                <?php
                            else:
                                ?>
                                <p class="m-bottom1">Faça agora o seu pedido! Nos ligue pelos telefones: <strong> <?= TELEFONES_EMPRESA; ?> </strong></p>
                                <p>Ou mande-nos um e-mail para: <strong><?= EMAIL_EMPRESA; ?></strong></p>
                            <?php endif; ?>

                        </div>


                        <img alt="" title="" src="<?= INCLUDE_PATH; ?>/img/divisao_descricao.jpg" />	

                        <?php
                        $readCategoria = new Read;
                        $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :cat", "cat={$produto_categoria}");
                        ?>

                        <span class="txt_detalhes categoria">Categoria: <?= (!empty($readCategoria->getResult()[0]['category_name']) ? ucwords($readCategoria->getResult()[0]['category_name']) : '') ?></span>

                    </div>

                </div>

                <div class="divisao_embaixo">


                    <section class="especificacoes">

                        <h1 class="titulo_1">Especificações Técnicas</h1>

                        <article class="especificacoes_tecnicas">

                            <article>
                                <nav class="menu_1">
                                    <?php
                                    $readEspecificacoes = new Read();
                                    $readEspecificacoes->ExeRead(ESPECIFICACOES, "WHERE produto_id = :produtoid", "produtoid={$produto_id}");
                                    if ($readEspecificacoes->getResult()):
                                        extract($readEspecificacoes->getResult()[0]);
                                    endif;
                                    ?>
                                    <ul>
                                        <li>Número de ordem: <?= $especificacao_ref; ?></li>
                                        <li>Modelo: <?= $especificacao_modelo; ?></li>
                                        <li>Cor: <?= $especificacao_cor; ?></li>
                                        <li>Dimensões: <?= $especificacao_dimensoes; ?></li>
                                        <li>Fabricação: Inicial: <?= $especificacao_fab_inicial; ?> / Final:<?= $especificacao_fab_final; ?></li>
                                        <li>Artesâs: <?= $especificacao_artesas; ?></li>
                                        <li>Tonalidade: <?= $especificacao_tonalidade; ?></li>
                                    </ul>

                                </nav>
                            </article>    

                            <article>
                                <h1 class="titulo_2">Cuidados para conservação</h1>


                                <nav class="menu_2">

                                    <ul>
                                        <li>-Lavagem â mão</li>
                                        <li>-Não alvejar</li>
                                        <li>-Não secar em tambor</li>
                                        <li>-Não passar ferro e/ou não vaporizar</li>
                                        <li>-Limpeza a seco profissional p. normal</li>
                                    </ul>
                                </nav>


                                <img src="<?= INCLUDE_PATH; ?>/img/cuidados_conservacao.jpg" />

                            </article>    
                        </article>

                    </section>

                    <div class="clear"></div>
                </div>
            </div>
        </section>    

        <section class="container relacionados">

            <h1 class="titulo_relacionados">Ver também:</h1>    
            <div class="content">


                <?php
                $readProduto = new Read();
                $readProduto->ExeRead(PRODUTOS, "WHERE produto_id != :produtoid AND produto_status = 1 ORDER BY rand() DESC LIMIT :limit OFFSET :offset", "produtoid={$produto_id}&limit=4&offset=0");
                if (!$readProduto->getResult()):
                    WSErro("Este produto não está disponível no momento! Por favor, tente mais tarde.", WS_INFOR);
                else:

                    $View = new View();
                    $tpl_produto = $View->Load('produto');

                    foreach ($readProduto->getResult() as $produto):
                        $produto['produto_indisponivel'] = ($produto['produto_disponivel'] == '0' ? '<div class="bg-yellow-escuro posts-item-indisponivel">Indisponível</div>' : '');
                        $produto['produto_desconto_off'] = (!empty($produto['produto_desconto']) ? '<div class="bg-red produtos-item-off">' . $produto['produto_desconto'] * 100 . ' % OFF</div>' : '');
                        if (!empty($produto['produto_desconto'])):
                            $produto['produto_valor_descontado_formatado'] = number_format($produto['produto_valor_descontado'], 2, ',', '.');
                        endif;
                        $produto['THEME'] = THEME;
                        $produto['produto_valor_anterior'] = $produto['produto_valor'];
                        $produto['produto_valor_anterior_formatado'] = number_format($produto['produto_valor'], 2, ',', '.');
                        $produto['produto_valor'] = ((!empty($produto['produto_desconto']) && $produto['produto_desconto'] > 0) ? $produto['produto_valor_descontado'] : $produto['produto_valor']);
                        $produto['produto_valor_formatado'] = number_format($produto['produto_valor'], 2, ',', '.');
                        $produto['produto_desconto_ativo'] = (!empty($produto['produto_desconto']) ? '<small class="valor_anterior m-top1"> De: <del>R$ ' . $produto['produto_valor_anterior_formatado'] . '</del> o m<sup>2</sup></small><h1 class="valor_atual al-center">  <span class="valor_atual_digitos">Por: R$ ' . $produto['produto_valor_descontado_formatado'] . ' o m<sup>2</sup></span></h1><p class="m-bottom1 fl-left js_opt_cart ate-12x">Até em 12x no cartão</p>' : '<h1 class="valor_atual valor_sem_desconto"><p>Preço por m<sup>2</sup></p><span class="valor_atual_digitos">R$ ' . $produto['produto_valor_formatado'] . '</span></h1><div class="container"></div><p class="m-bottom1 fl-left js_opt_cart ate-12x ate-12x-no-desconto">Até em 12x no cartão</p>');
                        $produto['produto_desabilitar_carrinho'] = ($produto['produto_disponivel'] == '1' ? 'j_loadcarrinho' : '');
                        $produto['produto_desabilitar_botao'] = ($produto['produto_disponivel'] != '1' ? 'style="pointer-events: none;"' : '');
                        $produto['produto_texto_botao'] = (CARRINHO == '0' ? 'Ver Detalhes' : 'Adicionar ao Carrinho');
                        $produto['produto_link'] = (CARRINHO == '0' ? HOME . '/Detalhes/' . $produto['produto_name'] . '&produtoid=' . $produto['produto_id'] . '&theme=' .THEME. '#detalhes' : '#seletor#add=ok&produtoid=#produto_id#&valor=#produto_valor#');
                        $produto['seletor'] = '?';

                        $View->Show($produto, $tpl_produto);
                    endforeach;

                endif;
                ?>

                <div class="clear"></div>
            </div>
        </section>


        <section class="content_detalhes">
            <section class="avaliacoes">


                <?php
                $read = new Read();
                $read->ExeRead(COMENTARIOS, "WHERE comentario_status = :status AND comentario_produto = :produtoid ORDER BY comentario_date DESC", "status=1&produtoid={$produto_id}");
                ?>


                <h1 class="titulo_1" style="width:100%" >Avaliações (<?= $read->getRowCount(); ?>)</h1>

                <?php
                if (!$read->getResult()):
                    ?>
                    <div class="erro_detalhes j_erro_padrao">

                        <?= WSErro("Seja o primeiro a avaliar Este Produto!", WS_INFOR); ?>

                    </div>
                    <?php
                else:
                    $readResposta = new Read;

                    $view = new View();
                    $tpl_comment = $view->Load('comentario');

                    foreach ($read->getResult() as $comment):
                        ?>
                        <div class="comment_reply">
                            <?php
                            $comment['data_formatada'] = date('d/m/Y H:i', strtotime($comment['comentario_date']));
                            if (strlen($comment['comentario_cidade']) <= 3):

                                $read = new Read();
                                $read->ExeRead("app_cidades", "WHERE cidade_id = :cidadeid", "cidadeid={$comment['comentario_cidade']}");

                                if ($read->getResult()):
                                    $comment['comentario_cidade'] = $read->getResult()[0]['cidade_nome'] . '-' . $read->getResult()[0]['cidade_uf'];
                                endif;


                            endif;
                            $view->Show($comment, $tpl_comment);

                            $readResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :id AND comentario_status = 1", "id={$comment['comentario_id']}");
                            if ($readResposta->getResult()):

                                $tpl_resposta = $view->Load('resposta');

                                foreach ($readResposta->getResult() as $resposta):

                                    $resposta['data_formatada'] = date('d/m/Y H:i', strtotime($resposta['comentario_date']));
                                    if (strlen($resposta['comentario_cidade']) <= 3):

                                        $read = new Read();
                                        $read->ExeRead("app_cidades", "WHERE cidade_id = :cidadeid", "cidadeid={$resposta['comentario_cidade']}");

                                        if ($read->getResult()):
                                            $resposta['comentario_cidade'] = $read->getResult()[0]['cidade_nome'] . '-' . $read->getResult()[0]['cidade_uf'];
                                        endif;


                                    endif;

                                    $view->Show($resposta, $tpl_resposta);

                                endforeach;


                            endif;
                            ?>
                        </div>
                        <?php
                    endforeach;


                endif;
                ?>



                <?php
                $url = filter_input_array(INPUT_GET, FILTER_DEFAULT);
                $comentario = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                if (isset($comentario) && $comentario['SendFormComentario'] == 'Enviar'):

                    unset($comentario['SendFormComentario']);

                    $comentario['comentario_produto'] = $produtoid;

                    if (isset($_SESSION['clientelogin'])):
                        $comentario['comentario_cliente'] = $_SESSION['clientelogin']['cliente_name'];
                        $comentario['comentario_cidade'] = $_SESSION['clientelogin']['cliente_cidade'];
                        $comentario['comentario_email'] = $_SESSION['clientelogin']['cliente_email'];
                    endif;


                    $adminComentario = new Comentarios();
                    $adminComentario->ExeCreate($comentario);

                    echo "<br>";
                    ?>

                    <div class="erro_detalhes m-top3 fl-left">
                        <?php
                        WSErro($adminComentario->getError()[0], $adminComentario->getError()[1]);
                        ?>
                    </div>

                    <section id="avaliacao" class="formulario_avaliacao">

                        <?php
                    endif;
//                    var_dump($_SESSION['userlogin']);
                    ?>


                    <form name="FormComentario" class="formulario form_detalhes" action="" method="post">
                        <div class="trigger-box-suspenso"></div>
                        <input type="hidden" name="action" value="create_comentario">
                        <input type="hidden" name="comentario_author" value="<?= (isset($_SESSION['clientelogin']['cliente_name']) ? $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] . ' - (Tutor)' : '')); ?>" />
                        <input type="hidden" name="comentario_produto" value="<?= $produtoid; ?>" />
                        <input type="hidden" name="comentario_status" value="0" />
                        <input type="hidden" name="comentario_date" value="<?= date('Y-m-d H:i:s'); ?>" />
                        <input type="hidden" name="comentario_type" value="review-produto" />

                        <?php
                        if (!isset($_SESSION['clientelogin'])):
                            ?>


                            <label>	
                                <span>Nome:</span>			
                                <input type="text" name="comentario_author" required/>
                            </label>

                            <label>	
                                <span>Email:</span>			
                                <input type="email" name="comentario_email" required/>
                            </label>

                            <label>	
                                <span>Cidade:</span>			
                                <input type="text" placeholder="Ex: Diamantina - MG" name="comentario_cidade" required/>
                            </label>


                            <?php
                        else:
                            ?>
                            <input type="hidden" name="comentario_email" value="<?= (isset($_SESSION['clientelogin']['cliente_email']) ? $_SESSION['clientelogin']['cliente_email'] : $_SESSION['userlogin']['user_email']); ?>" />

                            <?php
                            if (isset($_SESSION['clientelogin']['cliente_id'])):

                                $readCidade = new Read;
                                $readCidade->ExeRead("app_cidades", "WHERE cidade_id = :id", "id={$_SESSION['clientelogin']['cliente_cidade']}");
                                if ($readCidade->getResult()):
                                    ?>
                                    <input type="hidden" name="comentario_cidade" value="<?= $readCidade->getResult()[0]['cidade_nome'] . '-' . $readCidade->getResult()[0]['cidade_uf']; ?>" />
                                    <?php
                                endif;

                            else:
                                ?>
                                <input type="hidden" name="comentario_cidade" value="<?= 'Diamantina - MG' ?>" />
                            <?php
                            endif;
                            ?>

                        <?php endif; ?>

                        <label>	
                            <span>Mensagem:</span>			
                            <textarea type="text" name="comentario_content" rows="8" cols="30" required></textarea>
                        </label>


                        <input class="btn_form" type="submit"  name="SendFormComentario" value="Enviar" />
                        <div title="Carregando" class="load fl-right m-top1"></div>
                    </form>


                </section>


            </section>

        </section>	

        <!-- CLEAR -->
        <div class="clear"></div><!-- CLEAR -->

    </div>

</section><!-- CONTENT_CONTEUDO -->
<!--Evitar Excesso de Carregamento  Na Home-->


