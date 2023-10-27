<?php
// $search = $Link->getLocal()[1];
$search = $_GET['s'];
var_dump($search);
die;
$count = ($Link->getData()['count'] ? $Link->getData()['count'] : '0');
?>


<section class="container content_conteudo">
    <h1 class="caminho">Início &raquo; Tapetes</h1>

    <div class="content">

        <h1 class="caminho">Pesquisa por: <?= $search; ?></h1>
        <p class="tagline">Sua pesquisa <?= $search; ?> retornou <?= $count; ?> resultados!</p>







        <?php
        // CONFIGURAÇÃO DA PAGINAÇÃO DE RESULTADOS 
        $getPage = (!empty($Link->getLocal()[2]) ? $Link->getLocal()[2] : 1);
        $Pager = new Pager(HOME . "pesquisa/" . $search . '/');
        $Pager->ExePager($getPage, 6);

        // REALIZA A LEITURA VERIFICANDO A EXISTÊNCIA DE PRODUTOS
        $readProduto = new Read();
        $readProduto->ExeRead(PRODUTOS, "WHERE produto_status = 1 AND (produto_title LIKE '%' :link '%' or produto_descricao LIKE '%' :link '%') ORDER BY produto_data DESC LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
        if (!$readProduto->getResult()): // SE NÃO HOUVER PRODUTOS
            $Pager->ReturnPage(); //RETORNO PARA ÚLTIMA PÁGINA QUE POSSUI PRODUTOS 
            WSErro("Desculpe, a sua pesquisa não retornou resultados. Você pode resuir sua pesquisa ou tentar outros termos!", WS_INFOR); // EXIBIR MENSAGEM DE QUE NÃO EXISTE PRODUTOS
        else: // CASO CONTRÁRIO
            //ELES SERÃO EXIBIDOS
            // CARREGO O TEMPLATE COM O CÓDIGO QUE EXIBIRÁ OS PRODUTOS
            $View = new View();
            $tpl_produto = $View->Load('produto');

            foreach ($readProduto->getResult() as $prod):
                $prod['produto_indisponivel'] = ($prod['produto_disponivel'] == '0' ? '<div class="bg-yellow-escuro posts-item-indisponivel">Indisponível</div>' : '');
                $prod['produto_desconto_off'] = (!empty($prod['produto_desconto']) ? '<div class="bg-red produtos-item-off">' . $prod['produto_desconto'] * 100 . ' % OFF</div>' : '');
                if (!empty($prod['produto_desconto'])):
                    $prod['produto_valor_descontado_formatado'] = number_format($prod['produto_valor_descontado'], 2, ',', '.');
                endif;

                $prod['produto_valor_anterior'] = $prod['produto_valor'];
                $prod['produto_valor_anterior_formatado'] = number_format($prod['produto_valor'], 2, ',', '.');
                $prod['produto_valor'] = ((!empty($prod['produto_desconto']) && $prod['produto_desconto'] > 0) ? $prod['produto_valor_descontado'] : $prod['produto_valor']);
                $prod['produto_valor_formatado'] = number_format($prod['produto_valor'], 2, ',', '.');
                $prod['produto_desconto_ativo'] = (!empty($prod['produto_desconto']) ? '<small class="valor_anterior m-top1"> De: <del>R$ ' . $prod['produto_valor_anterior_formatado'] . '</del> o m<sup>2</sup></small><h1 class="valor_atual al-center">  <span class="valor_atual_digitos">Por: R$ ' . $prod['produto_valor_descontado_formatado'] . ' o m<sup>2</sup></span></h1><p class="m-bottom1 fl-left ate-12x">Até em 12x no cartão</p>' : '<h1 class="valor_atual valor_sem_desconto"><p>Preço por m<sup>2</sup></p><span class="valor_atual_digitos">R$ ' . $prod['produto_valor_formatado'] . '</span></h1><div class="container"></div><p class="m-bottom1 fl-left ate-12x ate-12x-no-desconto">Até em 12x no cartão</p>');
                $prod['produto_desabilitar_carrinho'] = ($prod['produto_disponivel'] == '1' ? 'j_loadcarrinho' : '');
                $prod['produto_desabilitar_botao'] = ($prod['produto_disponivel'] != '1' ? 'style="pointer-events: none;"' : '');
                $prod['seletor'] = '?';
                $View->Show($prod, $tpl_produto);
            endforeach;

        endif;

        // EXIBE NÚMEROS DE PAGINAÇÃO
        $Pager->ExePaginator(PRODUTOS, "WHERE produto_status = 1 AND (produto_title LIKE '%' :link '%' or produto_descricao LIKE '%' :link '%') ORDER BY produto_data DESC LIMIT :limit OFFSET :offset", "link={$search}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
        echo $Pager->getPaginator();
        ?>




        <!-- CLEAR -->
        <div class="clear"></div><!-- CLEAR -->
    </div>
</section>
