<?php
// SE NÃO EXISTIR SESSÃO E ESTIVER VAZIO
if (!isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):
    session_start(); // INICIA SESSÃO
endif;

if (isset($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin'])):
//    var_dump($_SESSION['clientelogin']);
endif;

// RECEBE OS PARÊMTROS VIA URL PARA EXECUTER AÇÔES ESPECÌFICAS 
$add = filter_input(INPUT_GET, 'add', FILTER_DEFAULT); // VERIFICA SE O PRODUTO SERÁ ADICIONADO OU NÃO AO CARRINHO
$produtoid = filter_input(INPUT_GET, 'produtoid', FILTER_VALIDATE_INT); // RECEBE ID DO PRODUTO A SER ADICIONADO AO CARRINHO
$valor = filter_input(INPUT_GET, 'valor', FILTER_DEFAULT); // RECEBE VALOR A SER ADICIONADO AO CARRINHO
$venda_transacao = filter_input(INPUT_GET, 'venda_transacao', FILTER_DEFAULT); // RECEBE TRANSACAO DA VENDA
// SE EXISITIR AÇÃO ADD
if (isset($add)):

    // ESE ELA FOR 'ok'
    if ($add == 'ok'):

        $produto = new Carrinho(); // INSTENCIAR A CLASSE CARRINHO
        $produto->setId((int) $produtoid); // SETAR ID DO PRODUTO A SER ADICIONADO 
        $produto->adicionar(); // ADICIONAR PRODUTO AO CARRINHO
        $_SESSION['preco_total'] += $valor; // INCREMENTAR TOTAL DO CARRINHO COM VALOR DO PRODUTO ADICIONADO
        header('Location: ' . HOME); // LIMPAR URL
    endif;
endif;

if (isset($venda_transacao)):
    header('Location: ' . HOME); // LIMPAR URL
endif;

//unset($_SESSION['clientelogin'], $_SESSION['carrinho'], $_SESSION['preco_total']);
//var_dump($_SESSION['carrinho'], $_SESSION['clientelogin'], $_SESSION['preco_total']);
?>


<!-- CONTENT_CONTEUDO -->
<section class="container content_conteudo">

    <header class="fontzero">
        <h1>Tapetes Arraiolo e Smyrna da Cooperatia Artesanal Regional de Diamantina</h1>
        <p class="tagline">Compre os produtos da Cardi Tapetes</p>
    </header>

    <h1 class="caminho">Início &raquo; Tapetes</h1>




    <div class="content">

        <h1 class="fontzero">Tapetes Arraiolo e Smyrna de Diamantina-mg e Região</h1>


        <?php
        // CONFIGURAÇÃO DA PAGINAÇÃO DE RESULTADOS 
        $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
        $Pager = new Pager(HOME . "/&theme=" . THEME ."&pag=");
        $Pager->ExePager($getPage, 8);

        // REALIZA A LEITURA VERIFICANDO A EXISTÊNCIA DE PRODUTOS
        $readProduto = new Read();
        $readProduto->ExeRead(PRODUTOS, "WHERE produto_status = 1 ORDER BY produto_data DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
        if (!$readProduto->getResult()): // SE NÃO HOUVER PRODUTOS
            $Pager->ReturnPage(); //RETORNO PARA ÚLTIMA PÁGINA QUE POSSUI PRODUTOS 
            WSErro("Nenhum produto estpa cadastrado no momento! Por favor, tente mais tarde.", WS_INFOR); // EXIBIR MENSAGEM DE QUE NÃO EXISTE PRODUTOS
        else: // CASO CONTRÁRIO
            //ELES SERÃO EXIBIDOS
            // CARREGO O TEMPLATE COM O CÓDIGO QUE EXIBIRÁ OS PRODUTOS
            $View = new View();
            $tpl_produto = $View->Load('produto');

            foreach ($readProduto->getResult() as $prod):
                $prod['THEME'] = THEME;
                $prod['produto_indisponivel'] = ($prod['produto_disponivel'] == '0' ? '<div class="bg-yellow-escuro posts-item-indisponivel">Indisponível</div>' : '');
                $prod['produto_desconto_off'] = (!empty($prod['produto_desconto']) ? '<div class="bg-red produtos-item-off">' . $prod['produto_desconto'] * 100 . ' % OFF</div>' : '');
                if (!empty($prod['produto_desconto'])):
                    $prod['produto_valor_descontado_formatado'] = number_format($prod['produto_valor_descontado'], 2, ',', '.');
                endif;

                $prod['produto_valor_anterior'] = $prod['produto_valor'];
                $prod['produto_valor_anterior_formatado'] = number_format($prod['produto_valor'], 2, ',', '.');
                $prod['produto_valor'] = ((!empty($prod['produto_desconto']) && $prod['produto_desconto'] > 0) ? $prod['produto_valor_descontado'] : $prod['produto_valor']);
                $prod['produto_valor_formatado'] = number_format($prod['produto_valor'], 2, ',', '.');
                $prod['produto_desconto_ativo'] = (!empty($prod['produto_desconto']) ? '<small class="valor_anterior m-top1"> De: <del>R$ ' . $prod['produto_valor_anterior_formatado'] . '</del> o m<sup>2</sup></small><h1 class="valor_atual al-center">  <span class="valor_atual_digitos">Por: R$ ' . $prod['produto_valor_descontado_formatado'] . ' o m<sup>2</sup></span></h1><p class="m-bottom1 fl-left js_opt_cart ate-12x">Até em 12x no cartão</p>' : '<h1 class="valor_atual valor_sem_desconto"><p>Preço por m<sup>2</sup></p><span class="valor_atual_digitos">R$ ' . $prod['produto_valor_formatado'] . '</span></h1><div class="container"></div><p class="m-bottom1 fl-left js_opt_cart ate-12x ate-12x-no-desconto">Até em 12x no cartão</p>');
                $prod['produto_desabilitar_carrinho'] = ($prod['produto_disponivel'] == '1' ? 'j_loadcarrinho' : '');
                $prod['produto_desabilitar_botao'] = ($prod['produto_disponivel'] != '1' ? 'style="pointer-events: none;"' : '');
                $prod['produto_texto_botao'] = (CARRINHO == '0' ? 'Ver Detalhes' : 'Adicionar ao Carrinho');
                $prod['produto_link'] = (CARRINHO == '0' ? HOME . '/Detalhes/' . $prod['produto_name'] . '&produtoid=' . $prod['produto_id'] . '&theme=' . THEME . '#detalhes' : '#seletor#add=ok&produtoid=#produto_id#&valor=#produto_valor#');
                $prod['seletor'] = '?';
                $View->Show($prod, $tpl_produto);
            endforeach;

        endif;
        ?>



        <div class="clear"></div>        
    </div>        
</section><!-- CONTENT_CONTEUDO -->


<?php
// EXIBE NÚMEROS DE PAGINAÇÃO
$Pager->ExePaginator(PRODUTOS, "WHERE produto_status = 1 ORDER BY produto_data DESC");
echo $Pager->getPaginator();
?>

<!-- CLEAR -->
<div class="clear"></div><!-- CLEAR -->

<script>

//    window.setInterval(function(){
//        location.reload();
//    },2000);
//    
</script>

