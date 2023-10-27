
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Produtos</h1>
            <p class="tagline"> >> Flow State / <b>Produtos</b></p>
        </div>


        <a class="btn btn-blue btn-option-header radius" title="Novo Produto" href="<?= HOME . ADMIN; ?>/dashboard.php?exe=produtos/create">Novo Produto</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar_produto" />
            <input type="text" name="s" title="Pesquisar Produto" placeholder="Pesquisar Produto" attr-pesquisa="pesquisar_produto" class="j_pesquisar"/> 
            <button name="s_pesquisar" class="btn btn-green radius shorticon shorticon-search j_pesquisar"></button>
        </form>

        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line"></div>


<div class="container main-conteudo posts js_paginator">    

    <div class="trigger-box m-bottom1 m-top1"></div>    

    <div class="content j_post_conteudo">



        <?php
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $sec = filter_input(INPUT_GET, 'sec', FILTER_VALIDATE_BOOLEAN);

        $read = new Read;
        $readVendas = new Read;
        if (!empty($id)):

            if ($sec):
                $read->ExeRead(PRODUTOS, "WHERE produto_cat_parent = :id ORDER BY produto_data DESC", "id={$id}");
            else:
                $read->ExeRead(PRODUTOS, "WHERE produto_categoria = :id ORDER BY produto_data DESC", "id={$id}");
            endif;

        else:

            $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
            $Pager = new Pager("dashboard.php?exe=produtos/index&pag=");
            $Pager->ExePager($getPage, 24);

            $read->ExeRead(PRODUTOS, "ORDER BY produto_data DESC LIMIt :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");


        endif;

        if (!$read->getResult()):
            $Pager->ReturnPage();
            WSErro("Nenhum Produto Foi Criado Ainda!", WS_INFOR);
        else:
            $posCss = 0;
            $View = new View();
            $tpl_produto = $View->Load('produto_admin');

            foreach ($read->getResult() as $produto):
                $posCss++;
                extract($produto);

                $readVendas->ExeRead(VENDAS, "WHERE venda_produto = :id AND venda_transacao IS NOT NULL AND venda_status = 3", "id={$produto_id}");

                $produto['produto_desconto'] = (!empty($produto['produto_desconto']) ? '<div class="bg-red posts-item-off">' . $produto['produto_desconto'] * 100 . ' % OFF</div>' : '');
                $produto['produto_valor'] = number_format($produto['produto_valor'], 2, ',', '.');
                if (!empty($produto['produto_desconto'])):
                    $produto['produto_valor_descontado'] = number_format($produto['produto_valor_descontado'], 2, ',', '.');
                endif;
                $produto['produto_desconto_ativo'] = (!empty($produto['produto_desconto']) ? '<small class="valor_anterior"> De: <del>R$ ' . $produto['produto_valor'] . '</del> o m<sup>2</sup></small><h1 class="valor_atual"> Por: <span class="valor_atual_digitos">R$ ' . $produto['produto_valor_descontado'] . '</span> o m<sup>2</sup></h1>' : '<h1 class="valor_atual"><span class="valor_atual_digitos">R$ ' . $produto['produto_valor'] . '</span> o m<sup>2</sup></h1><div class="container m-top2"></div>');
                $produto['imagem_produto'] = HOME . DIRECTORY_SEPARATOR . 'uploads';
                $produto['HOME'] = HOME;
                $produto['vendas'] = (!empty($readVendas->getResult()) ? sprintf("%05d", intval($readVendas->getRowCount())) : sprintf("%05d", 0));
                $produto['botao_status'] = ($produto_status == '1' ? '<a title="Publicado" attr-status="mudar_status_produto" class="btn btn-green radius posts-item-status-post j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_produto" class="btn btn-yellow radius posts-item-status-post j_pendente shorticon shorticon-pendente"></a>');
                $produto['botao_disponivel'] = ($produto_disponivel == '1' ? '<a title="Disponivel" attr-disponibilidade="mudar_disponibilidade_produto" class="btn btn-green radius produtos-item-disponibilidade j_disponivel shorticon shorticon-disponivel"></a>' : '<a title="Indisponível" attr-disponibilidade="mudar_disponibilidade_produto" class="btn btn-orange radius produtos-item-disponibilidade j_indisponivel shorticon shorticon-indisponivel"></a>');

                $readCategoria = new Read;
                $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$produto_categoria}");

                $produto['categoria_data'] = ($readCategoria->getResult() ? "<p class=\"posts-item-categoria\"> >> {$readCategoria->getResult()[0]['category_title']}" : "") . " - " . date('d/m/Y - H:i', strtotime($produto_data)) . "</p>";
                $View->Show($produto, $tpl_produto);

            endforeach;
        endif;
        ?>

        <div class="j_paginator" attr-action="paginator_produto"></div>
        <?php
        
        $Pager->ExePaginator(PRODUTOS);
        echo $Pager->getPaginator();
        ?>

        <div class="clear"></div>
    </div>
</div>