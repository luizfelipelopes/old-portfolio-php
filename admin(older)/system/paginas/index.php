
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Paginas</h1>
            <p class="tagline"> >> Flow State / <b>Paginas</b></p>
        </div>


        <a class="btn btn-blue radius" title="Novo Pagina" href="<?= HOME; ?>/admin/dashboard.php?exe=paginas/create">Novo Pagina</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar" />
            <input type="text" name="s" title="Pesquisar Pagina" placeholder="Pesquisar Pagina" class="j_pesquisar" attr-pesquisa="pesquisar_pagina"/> 
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
        $getPage = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);

        $Pager = new Pager("dashboard.php?exe=paginas/index&pag=");
        $Pager->ExePager($getPage, 12);

        $read = new Read;
        $read->ExeRead(PAGINAS, "ORDER BY pagina_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getResult()):
            WSErro("Nenhuma Pagina Foi Escrito Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_pagina = $View->Load('pagina');

            foreach ($read->getResult() as $pagina):
                extract($pagina);

                $pagina['imagem_pagina'] = (!empty($pagina_cover) ?  HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'foto-novo-post.png');
                $pagina['HOME'] = HOME;
                $pagina['botao_status'] = ($pagina_status == '1' ? '<a title="Publicado" attr-status="mudar_status_pagina" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_pagina" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
                $pagina['segment_registro'] = ($pagina_segment ? "<p class=\"posts-item-categoria\"> >> {$pagina_segment}" : "") . " - " . date('d/m/Y - H:i', strtotime($pagina_date)) . "</p>";
                $View->Show($pagina, $tpl_pagina);

            endforeach;
            $Pager->ExePaginator(PAGINAS, "ORDER BY pagina_date DESC");
            ?>
            <div class="j_paginator" attr-action="paginator_pagina">
                <?php
                echo $Pager->getPaginator();
            endif;
            ?>

            <div class="clear"></div>
        </div>
    </div>