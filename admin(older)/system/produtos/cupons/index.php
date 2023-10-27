
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Cupons</h1>
            <p class="tagline"> >> Flow State / <b>Cupons</b></p>
        </div>


        <a class="btn btn-blue btn-option-header radius" title="Novo Cupom" href="<?= HOME . ADMIN; ?>/dashboard.php?exe=produtos/cupons/create">Novo Cupom</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar_cupom" />
            <input type="text" name="s" title="Pesquisar Cupom" placeholder="Pesquisar Cupom" attr-pesquisa="pesquisar_cupom" class="j_pesquisar"/> 
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

        $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
        $Pager = new Pager("dashboard.php?exe=produtos/cupons/index&pag=");
        $Pager->ExePager(1, 12);

        $read->ExeRead(CUPONS, "ORDER BY cupom_validade DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getResult()):
            $Pager->ReturnPage();
            WSErro("Nenhum Cupom Foi Criado Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_cupom = $View->Load('cupom');

            foreach ($read->getResult() as $cupom):
//                $posCss++;
                extract($cupom);

                $cupom['cupom_codigo_img'] = Check::Words($cupom['cupom_codigo'], 1);
                $cupom['cupom_desconto'] = (!empty($cupom['cupom_desconto']) ? '<div class="bg-red posts-item-off">' . $cupom['cupom_desconto'] * 100 . ' % OFF</div>' : '');
                $cupom['HOME'] = HOME;
                $cupom['botao_status'] = ($cupom_status == '1' ? '<a title="Publicado" attr-status="mudar_status_cupom" class="btn btn-green radius cupons-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_cupom" class="btn btn-yellow radius cupons-item-status j_pendente shorticon shorticon-pendente"></a>');


                $cupom['cupom_validade'] = date('d/m/Y', strtotime($cupom_validade)) . "</p>";
                $View->Show($cupom, $tpl_cupom);

            endforeach;
        endif;
        ?>
        
        <div class="j_paginator" attr-action="paginator_cupom"></div>
        <?php
        
        $Pager->ExePaginator(CUPONS);
        echo $Pager->getPaginator();
        ?>

        <div class="clear"></div>
    </div>
</div>