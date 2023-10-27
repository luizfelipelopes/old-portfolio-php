<div class="contentTransacao">
    <?php
//    ini_set('default_charset', 'UTF-8');


    require '../_app/Models/TransacoesPagSeguro.class.php';

    $transacao = filter_input(INPUT_GET, 'transacao', FILTER_DEFAULT);
    $reference = filter_input(INPUT_GET, 'reference', FILTER_DEFAULT);
    $response = new TransacoesPagSeguro();
    $response->getTransacoesPorCodigoTransacao($transacao);

    $read = new Read();
    $read->ExeRead("cardi_vendas", "WHERE venda_registro = :registro", "registro={$reference}");
    ?>

    <section class="content_statistics">

        <h1 class="boxtitle">Detalhes da Transação</h1>
        <?php
        if (!$read->getResult()):
            WSErro("Não há informações desta transação no banco de dados!", WS_ALERT);

        else:
            ?>   

            <section class="resumo_transacao">
                <article class="detalhes_transacao">
                    
                    <p>Status: <span><?= $response->getStatusTransacao($read->getResult()[0]['venda_status']); ?></span></p>
                    <p>Código de Transação: <span><?= $read->getResult()[0]['venda_transacao']; ?></span></p>
                    <p>Código de Referência: <span><?= $read->getResult()[0]['venda_registro']; ?></span></p>
                    
                    <?php
                    $somaValor = new Read();
                    $somaValor->FullRead("SELECT SUM(venda_total) as valor FROM cardi_vendas WHERE venda_registro = '" . $read->getResult()[0]['venda_registro'] . "'");
                    $valorTotal = $somaValor->getResult()[0]['valor'];
                    ?>
                    <p>Valor Total:  <span>R$ <?= number_format($valorTotal, 2, ',', '.'); ?></span></p>
                    <p>Valor Após Taxa do PagSeguro:  <span>R$ <?= number_format($read->getResult()[0]['venda_pag_descontado'], 2, ',', '.'); ?></span></p>
                    <p>Taxa de Transação do Pag Seguro:  <span>R$ <?= number_format($read->getResult()[0]['venda_taxa'], 2, ',', '.'); ?></span></p>
                    <p>Forma de Pagamento: <span><?= $response->getFormaDePagamento($read->getResult()[0]['venda_pagamento']) .' - (pagamento em '. $read->getResult()[0]['venda_parcela'] . 'x)';  ?></span></p>
                    <p>Data de Compra: <span><?= date('d/m/Y', strtotime($read->getResult()[0]['venda_data'])) . ' às ' . date('H:i:s', strtotime(substr($read->getResult()[0]['venda_data'], 11, 8))) . ' hrs'; ?></span></p>
                    <p>Data de Atualização: <span><?= date('d/m/Y', strtotime(substr($read->getResult()[0]['venda_atualizacao'], 0, 10))) . ' às ' . date('H:i:s', strtotime(substr($read->getResult()[0]['venda_atualizacao'], 11, 8))) . ' hrs'; ?></span></p>

                    
                </article>
            </section>


            <section class="comprador">
                <article>
                    <h1 class="boxtitle">Comprador</h1>


                    <?php
                    $lerComprador = new Read();
                    $lerComprador->ExeRead("cardi_clientes", "WHERE cliente_id = :clienteid", "clienteid={$read->getResult()[0]['venda_cliente']}");
                    ?>


                    <p>Nome Comprador: <span><?= $lerComprador->getResult()[0]['cliente_name'] . ' ' . $lerComprador->getResult()[0]['cliente_lastname']; ?></span></p>
                    <p>Email Comprador: <span><?= $lerComprador->getResult()[0]['cliente_email']; ?></span></p>
                    <p>Telefone Comprador: <span></span><?= '(' . $lerComprador->getResult()[0]['cliente_ddd'] . ") " . $lerComprador->getResult()[0]['cliente_telefone']; ?></p>
                    <p>Endereço: <span><?= $lerComprador->getResult()[0]['cliente_endereco']; ?></span></p>
                    <p>Número: <span><?= $lerComprador->getResult()[0]['cliente_numero']; ?></span></p>
                    <p>Bairro: <span><?= $lerComprador->getResult()[0]['cliente_bairro']; ?></span></p>
                    <p>Complemento: <span><?= $lerComprador->getResult()[0]['cliente_complemento']; ?></span></p>


                    <?php
                    $lerCidade = new Read();
                    $lerCidade->ExeRead("app_cidades", "WHERE cidade_id = :cidadeid", "cidadeid={$lerComprador->getResult()[0]['cliente_cidade']}");
                    
                    ?>

                    <p>Cidade: <span><?= $lerCidade->getResult()[0]['cidade_nome']; ?></span></p>
                    <p>UF: <span><?= $lerCidade->getResult()[0]['cidade_uf']; ?></span></p>
                    <p>País: <span> BRA </span></p>
                    <p>CEP: <span><?= $lerComprador->getResult()[0]['cliente_cep']; ?></span></p>


                </article>
            </section>

            <section class="entrega">
                <article>

                    <h1 class="boxtitle">Endereço de Entrega</h1>
                    
                    <p>Endereço: <span><?= utf8_encode($response->getResult()->getShipping()->getAddress()->getStreet()); ?></span></p>
                    <p>Número: <span><?= $response->getResult()->getShipping()->getAddress()->getNumber(); ?></span></p>
                    <p>Bairro: <span><?= $response->getResult()->getShipping()->getAddress()->getDistrict(); ?></span></p>
                    <p>Complemento: <span><?= $response->getResult()->getShipping()->getAddress()->getComplement(); ?></span></p>
                    <p>Cidade: <span><?= $response->getResult()->getShipping()->getAddress()->getCity(); ?></span></p>
                    <p>UF: <span><?= $response->getResult()->getShipping()->getAddress()->getState(); ?></span></p>
                    <p>País: <span><?= $response->getResult()->getShipping()->getAddress()->getCountry(); ?></span></p>
                    <p>CEP: <span><?= $response->getResult()->getShipping()->getAddress()->getPostalCode(); ?></span></p>
                </article>
            </section>

            <section class="itens_carrinho">

                <h1 class="boxtitle">Itens do Carrinho:</h1>

                <?php

                $i = 0;
                
                $readProdutos = new Read();
                
                for($i = 0; $i < $read->getRowCount(); $i++):
                
//                    $i++;
                
                    $readProdutos->ExeRead("cardi_produtos", "WHERE produto_id = :id", "id={$read->getResult()[$i]['venda_produto']}");
                    $style = "style='margin: 5px 110px 5px 0px'";
                    ?>

                    <article class="item_carrinho">
                        <span class="imgCarrinho"><?= Check::Image('../uploads' . $readProdutos->getResult()[0]['produto_image'], $readProdutos->getResult()[0]['produto_descricao'], 120, 80); ?></span>
                        <p>Nome Produto: <span><?= $readProdutos->getResult()[0]['produto_title']; ?></span></p>
                        <p>ID Produto: <span><?= $read->getResult()[$i]['venda_produto']; ?></span></p>
                        <p>Quantidade Produto: <span><?= $read->getResult()[$i]['venda_quantidade']; ?></span></p>
                        <p>Valor Produto: <span><?= number_format($read->getResult()[$i]['venda_unidade'], 2, ',', '.'); ?></span></p>
                    </article>
                    <?php
                endfor;
                ?>
                </article>
            </section>
        <?php
        endif;
        ?>
    </section>    

    <div class="clear"></div>
</div>