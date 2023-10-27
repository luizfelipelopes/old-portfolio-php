<?php
// SE SESSÂO DE CARRINHO AINDA NÂO EXISTE
if (!isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):
    session_start(); // INICIAR SESSÂO
endif;

// RECEBE OS PARÊMTROS VIA URL PARA EXECUTER AÇÔES ESPECÌFICAS 
$produtoid = filter_input(INPUT_GET, 'produtoid', FILTER_VALIDATE_INT); // RECEBE ID DO PRODUTO ADICIONADO AO CARRINHO
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT); // RECEBE AÇÃO A SER EXECUTADA NO CARRINHO
$name = filter_input(INPUT_GET, 'name', FILTER_DEFAULT); // RECEBE NOME DO PRODUTO ADICIONADO AO CARRINHO
$prodqnt = filter_input(INPUT_GET, 'prodqnt', FILTER_VALIDATE_INT); // RECEBE QUANTIDADE DE ITENS DO PRODUTO A SER ADICIONADO AO CARRINHO
?>


<!-- CONTENT -->



<!-- CONTENT_CONTEUDO -->
<section class="content_conteudo bloco_carrinho">

    <h1 class="caminho">Home &raquo; Carrinho</h1>








    <article id="carrinho" class="carrinho_tabela">


        <?php
        // CASO ALGUMA AÇÃO FOI PASSADA POR URL
        switch ($action):

            case 'salvar':
                $adminCarrinho = new Carrinho();
                $adminCarrinho->ExeSalvar($_SESSION['carrinho']);
                $adminPagSeguro = new CheckoutPagSeguro();
                $adminPagSeguro->ExeTransacao($_SESSION['clientelogin']);
                break;


            // SE AÇÃO FOR PARA EXCLUIR PRODUTO
            case 'excluir':
                $adminCarrinho = new Carrinho(); // INSTANCIA A CLASSE CARRINHO
                $adminCarrinho->setId($produtoid); // SETO O ID DO PRODUTO A SER EXCLUÍDO
                $adminCarrinho->excluirPedido(); // EXCLUI PEDIDO
                // CASO SESSÃO CARRINHO ESTEJA VAZIA (OU SEJA, SE TODOS OS PRODUTOS TIVEREM SIDO EXCLUIDOS)
                if (empty($_SESSION["carrinho"])):
                    // PREÇO TOTAL NA SESSÃO RECEBE NULL PARA ZERAR O VALOR TOTAL DO CARRINHO
                    $_SESSION["preco_total"] = null;
                endif;
                // LIMPA URL
                header('Location:' . HOME . 'Carrinho#carrinho');
                break;

            // CASO SEJA PARA ADICIONAR UM PRODUTO    
            case 'adicionar':
                // SE O PRODUTO ADICIONADO JÁ EXISTIR NO CARRINHO
                if (array_key_exists($produtoid, $_SESSION['carrinho'])):
                    $_SESSION['carrinho'][$produtoid] += $prodqnt; // INCREMENTO O NÚMERO DE ITENS ANTIGO COM A NOVA QUANTIDADE ADICIONADA
                    header('Location:' . HOME . 'Carrinho'); // LIMPA URL
                //WSErro("Produto adicionado ao carrinho com sucesso!", WS_INFOR);
                else: // CASO CONTRÁRIO
                    $_SESSION['carrinho'][$produtoid] = $prodqnt; // APENAS INSERE A QUANTIDADE ADICIONADA
                    header('Location:' . HOME . 'Carrinho'); // LIMPA URL
                //WSErro("Produto adicionado ao carrinho com sucesso!", WS_INFOR);
                endif;
                break;

            // CASO SEJA PARA ESVAZIAR CARRINHO    
            case 'esvaziar':
                Carrinho::esvaziarCarrinho(); // CHAMAR MÉTODO ESTÁTICO esvaziarCarrinho()
                header('Location:' . HOME . 'Carrinho'); // LIMPA URL
                //WSErro("Carrinho esvaziado com sucesso!", WS_INFOR);
                break;

        endswitch;


        // INICIALIZA VARÍÁVEL QUE RECEBERÁ O VALOR TOTAL
        $PrecoTotal = floatval(0);

        // SE SESSÃO CARRINHO EXISTE
        if (isset($_SESSION['carrinho'])):
            ?>

            <div class="erro_carrinho j_relacionados">

                <?php
                WSErro("Seu Carrinho está Vazio", WS_INFOR); // EXIBE MENSAGEM AVISANDO QUE O CARRINHO ESTÁ VAZIO
                ?>

                <a class="btn btn-green btn_ir_loja radius ds-block" title="Voltar para Loja" href="<?= HOME; ?>">Voltar para Loja</a> 
            </div>


            <?php
            // SE SESSÃO CARRINHO ESTIVER VAZIA
            if (empty(($_SESSION['carrinho']))):
                ?>

                <section class="container relacionados rel_carrinho">

                    <div class="erro_carrinho">

                        <?php
                        WSErro("Você ainda não adicionou nenhum produto ao seu carrinho", WS_INFOR); // EXIBE MENSAGEM AVISANDO QUE O CARRINHO ESTÁ VAZIO
                        ?>
                    </div>



                    <div class="content">
                        <h1 class="titulo_relacionados">Ver também:</h1>    
                        <?php
                        $readProduto = new Read();
                        $readProduto->ExeRead(PRODUTOS, "WHERE produto_id != :produtoid AND produto_status = 1 ORDER BY rand() DESC LIMIT :limit OFFSET :offset", "produtoid={$produto_id}&limit=3&offset=0");
                        if (!$readProduto->getResult()):
                            WSErro("Nenhum produto está cadastrado no momento! Por favor, tente mais tarde.", WS_INFOR);
                        else:

                            $View = new View();
                            $tpl_produto = $View->Load('produto');

                            foreach ($readProduto->getResult() as $produto):
                                $produto['produto_indisponivel'] = ($produto['produto_disponivel'] == '0' ? '<div class="bg-yellow-escuro posts-item-indisponivel">Indisponível</div>' : '');
                                $produto['produto_desconto_off'] = (!empty($produto['produto_desconto']) ? '<div class="bg-red posts-item-off">' . $produto['produto_desconto'] * 100 . ' % OFF</div>' : '');
                                if (!empty($produto['produto_desconto'])):
                                    $produto['produto_valor_descontado_formatado'] = number_format($produto['produto_valor_descontado'], 2, ',', '.');
                                endif;

                                $produto['produto_valor_anterior'] = $produto['produto_valor'];
                                $produto['produto_valor_anterior_formatado'] = number_format($produto['produto_valor'], 2, ',', '.');
                                $produto['produto_valor'] = ((!empty($produto['produto_desconto']) && $produto['produto_desconto'] > 0) ? $produto['produto_valor_descontado'] : $produto['produto_valor']);
                                $produto['produto_valor_formatado'] = number_format($produto['produto_valor'], 2, ',', '.');
                                $produto['produto_desconto_ativo'] = (!empty($produto['produto_desconto']) ? '<small class="valor_anterior m-top1"> De: <del>R$ ' . $produto['produto_valor_anterior_formatado'] . '</del> o m<sup>2</sup></small><h1 class="valor_atual al-center">  <span class="valor_atual_digitos">Por: R$ ' . $produto['produto_valor_descontado_formatado'] . ' o m<sup>2</sup></span></h1><p class="m-bottom1 fl-left ate-12x">Até em 12x no cartão</p>' : '<h1 class="valor_atual valor_sem_desconto"><p>Preço por m<sup>2</sup></p><span class="valor_atual_digitos">R$ ' . $produto['produto_valor_formatado'] . '</span></h1><div class="container"></div><p class="m-bottom1 fl-left ate-12x ate-12x-no-desconto">Até em 12x no cartão</p>');
                                $produto['produto_desabilitar_carrinho'] = ($produto['produto_disponivel'] == '1' ? 'j_loadcarrinho' : '');
                                $produto['produto_desabilitar_botao'] = ($produto['produto_disponivel'] != '1' ? 'style="pointer-events: none;"' : '');
                                $produto['seletor'] = '?';

                                $View->Show($produto, $tpl_produto);
                            endforeach;

                        endif;
                        ?>


                        <div class="clear"></div>
                    </div>
                </section>


                <?php
            else: // CASO CONTRÁRIO EXIBE O CARRINHO
                ?>    
                <div class="j_carrinho">
                    <h1 class="titulo_carrinho">Carrinho</h1>

                    <table class="produtos">

                        <thead>
                            <tr>
                                <th></th>
                                <th class="coluna_produto">
                                    Produto
                                </th>
                                <th class="coluna_preco">Preço
                                </th>
                                <th class="quantidade_carrinho_titulo">
                                    Quantidade (por m<sup>2</sup>)
                                </th>
                                <th class="coluna_total">
                                    Total</th>
                            </tr>
                        </thead>     

                        <tbody>

                            <?php
                            $adminCarrinho = new Carrinho(); // INSTANCIA CLASSE ADMIN CARRINHO
                            $p = new ArrayIterator($_SESSION['carrinho']); // NOVA FORMA DE PEGAR RESULTADOS
                            $i = 0;
                            while ($p->valid()):
                                //$p->key() = pega as chaves (índices do array)
                                //$p->current() = pega a quantidade de cada produto
                                $adminCarrinho->setId($p->key());
                                $adminCarrinho->listarPedido();
                                if ($adminCarrinho->getResult()):
                                    $pedido = $adminCarrinho->getResult()[0];
                                    $vendas[$i] = $pedido;
                                    $i++;
                                endif;
                                ?>

                                <tr codigo-id="<?= $p->key(); ?>" class="cart-row">
                                    <td class="coluna_foto">
                                        <a id="<?= $pedido['produto_id']; ?>" class="j_excluir" href="<?= HOME; ?>Carrinho&action=excluir&name=<?= $pedido['produto_name']; ?>&produtoid=<?= $pedido['produto_id']; ?>" title="Excluir tapete do carrinho">
                                            <img class="excluir" alt="Excluir tapete do carrinho" title="Excluir tapete do carrinho" src="<?= REQUIRE_PATH; ?>/images/excluir.jpg" />
                                        </a>
                                        <img class="tapete_carrinho" alt="Tapete adicionado ao carrinho" title="Tapete adicionado ao carrinho" src="<?= HOME . DIRECTORY_SEPARATOR ?>uploads/<?= $pedido['produto_image']; ?>" />

                                    </td>
                                    <td class="produto_carrinho coluna_produto">
                                        <div class="product_id" style="display: none;"><?= $pedido['produto_id']; ?></div>
                                        <div class="product_name"><?= $pedido['produto_title']; ?></div>
                                    </td>
                                    <td class="preco_carrinho coluna_preco al-center">R$ <?= (!empty($pedido['produto_desconto']) && $pedido['produto_desconto'] > 0 ? number_format($pedido['produto_valor_descontado'], '2', ',', '.') : number_format($pedido['produto_valor'], '2', ',', '.')); ?></td>
                                    <td class="coluna_quantidade"><input type="number" name="prodqnt" id="qtd" class="quantidade_carrinho form_control" data_id ="<?= $p->key(); ?>" data_preco="<?= (!empty($pedido['produto_desconto']) && $pedido['produto_desconto'] > 0 ? $pedido['produto_valor_descontado'] : $pedido['produto_valor']); ?>" min="1" value="<?= $_SESSION['carrinho'][$p->key()]; ?>"/></td>
                                    <td class="preco_carrinho al-center j_preco_final" id="subtotal<?= $pedido['produto_id']; ?>" rel="<?= $_SESSION['carrinho'][$p->key()] * (!empty($pedido['produto_desconto']) && $pedido['produto_desconto'] > 0 ? $pedido['produto_valor_descontado'] : $pedido['produto_valor']); ?>"><span>R$ <?= number_format(floatval($_SESSION['carrinho'][$p->key()] * (!empty($pedido['produto_desconto']) && $pedido['produto_desconto'] > 0 ? $pedido['produto_valor_descontado'] : $pedido['produto_valor'])), 2, ',', '.'); ?></span></td>
                                </tr>

                                <?php
                                // SOMA O TOTAL DE TODOS OS PEDIDOS
                                $PrecoTotal += floatval($_SESSION['carrinho'][$p->key()] * (!empty($pedido['produto_desconto']) && $pedido['produto_desconto'] > 0 ? $pedido['produto_valor_descontado'] : $pedido['produto_valor']));
                                $p->next(); // INCREMENTA O PRÓXIMO PEDIDO

                            endwhile;

                            // INSERE O VALOR TOTAL NA SESSÃO 
                            $_SESSION['preco_total'] = $PrecoTotal;
                            ?>

                        </tbody>
                    </table>

                    <!-- BOTÃO QUE SERÁ UTILIZADO PARA ESVAZIAR CARRINHO EM BREVE -->
                    <div class="ds-none"><a href="<?= HOME; ?>Carrinho&action=esvaziar">Esvaziar Carrinho</a></td></div>


                    <!-- EXIBE O SUBTOTAL E TOTAL DO CARRINHO (O TOTAL TERÁ O VALOR DE FRETE INCLUÍDO) -->
                    <div class="confirmar_compra">

                        <h1 class="titulo_total_carrinho">Total no carrinho</h1>	
                        <table class="total">

                            <tbody>
                                <tr>
                                    <td class="titulo_subtotal">Subtotal</td>
                                    <td class="preco_subtotal j_subtotal" valor_total = "<?= $PrecoTotal; ?>">R$ <?= number_format($PrecoTotal, 2, ",", "."); ?></td>
                                </tr>	

                                <tr class="j_bloco_desconto_20mil"></tr>
                                <?php
                                if ($PrecoTotal > 20000):
                                    $descontoAcimaDe10Mil = $PrecoTotal - $PrecoTotal * 0.1;
//                                        $_SESSION['preco_total'] = $descontoAcimaDe10Mil;
                                    ?>

                                    <tr>
                                        <td class="titulo_total"> Desconto de 10% para compras acima de R$ 20 Mil</td>
                                        <!--<td class="preco_total j_total" rel="<?= $PrecoTotal + CUSTO_FRETE; ?>">R$ <?= number_format($PrecoTotal + CUSTO_FRETE, 2, ",", "."); ?></td>-->
                                        <td class="preco_total j_subtotal_desconto_20mil" rel="<?= $descontoAcimaDe10Mil; ?>"><?= '<small class="valor_anterior m-top1"> De: <del>R$ ' . number_format(($PrecoTotal), 2, ',', '.') . '</del></small><h1 class="valor_atual al-center"><span class="valor_atual_digitos">Por: R$ ' . number_format($descontoAcimaDe10Mil, 2, ',', '.') . '</span></h1>' ?></td>
                                    </tr>	


                                <?php endif; ?>

                                <?php
                                if (isset($_SESSION['cupom'])):
                                    $ValorComCupom = $PrecoTotal - ($PrecoTotal * $_SESSION['cupom']['desconto']);
                                endif;


                                $ValorTotalBruto = (($PrecoTotal > 20000 && isset($_SESSION['cupom'])) ? $PrecoTotal - ($PrecoTotal * (0.1 + $_SESSION['cupom']['desconto'])) : ($PrecoTotal > 20000 ? $descontoAcimaDe10Mil : (isset($_SESSION['cupom']) ? $ValorComCupom : $PrecoTotal)));
                                ?>    

                                <tr>

                                    <td class="titulo_total">Total (Carrinho + Frete)</td>
                                    <td class="preco_total j_total" rel="<?= $ValorTotalBruto; ?>">R$ <?= number_format($ValorTotalBruto + CUSTO_FRETE, 2, ',', '.'); ?></td>
                                </tr>	
                            </tbody> 
                        </table>


                        <?php if (!isset($_SESSION['cupom'])): ?>
                            <form class="container fl-left m-bottom3 j_form_cupom" method="post" action="">
                                <input type="hidden" name="action" value="descontar_cupom" />
                                <input type="hidden" name="valor_total" class="j_valor_total_form" value="<?= $ValorTotalBruto; ?>" />
                                <input type="hidden" name="frete" class="j_frete_form" value="<?= CUSTO_FRETE; ?>" />
                                <input style="margin-right:2%;" class="col-70" type="text" name="codigo_cupom" title="Inserir Código de Cupom" placeholder="Inserir Código de Cupom" attr-pesquisa="pesquisar_produto"/> 
                                <button class="col-30 btn btn-green btn_confirmar_cupom radius">Confirme</button>
                                <div title="Carregando" class="load fl-right m-top1"></div>
                            </form>
                        <?php endif; ?>

                        <!-- DIV PARA PASSAR O VALOR DA CONSTANTE CUSTO_FRETE POR JQUERY -->
                        <div id="frete"><?= CUSTO_FRETE; ?></div>

                        <?php
                        $url = null;

                        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):

                            if (isset($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin'])):


//                            $url = "redirect_pagseguro.php";

                                $url = HOME . "Carrinho&action=salvar";

                            else:

                                $url = HOME . "Entrar&carrinho=true#entrar";

                            endif;



                        endif;
                        ?>



                        <!-- ESTE BOTÃO SERÁ REDIRECIONADO AO PAG SEGURO -->
                        <a id="j_pixel_checkout" <?= (!isset($_SESSION['cupom']) ? 'style="float:left; margin-top: 5px !important;"' : ''); ?> href="#">
                            <div class="btn_confirmar_compra btn btn-green radius shorticon shorticon-seta">
                                <!--
                                                        <script type="text/javascript"
                                                                src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
                                                        </script>	-->

                                <div class="txt_confirmar_compra">
                                    Finalizar Compra
                                </div>
                            </div>
                        </a>


                    </div>

                <?php
                endif;

            else:
                ?>
                <div class="erro_carrinho">
                    <?php
                    WSErro("Você ainda não adicionou nenhum produto ao seu carrinho", WS_INFOR); // EXIBE MENSAGEM AVISANDO QUE O CARRINHO ESTÁ VAZIO
                    ?>
                    <div class="clear"></div>
                </div>
            <?php endif; ?>

        </div>
    </article>	

    <div class="clear"></div>
</div>
</section><!-- CONTENT_CONTEUDO -->


