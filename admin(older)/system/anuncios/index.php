
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Anúncios</h1>
            <p class="tagline"> >> Flow State / <b>Anúncios</b></p>
        </div>


        <a class="btn btn-blue radius" title="Novo Anúncio" href="<?= HOME; ?>/admin/dashboard.php?exe=anuncios/create">Novo Anúncio</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar" />
            <input type="text" name="s" title="Pesquisar Anúncio" placeholder="Pesquisar Anúncio" class="j_pesquisar" attr-pesquisa="pesquisar_anuncio"/> 
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

        $Pager = new Pager("dashboard.php?exe=anuncios/index&pag=");
        $Pager->ExePager($getPage, 12);

        $read = new Read;
        $read->ExeRead(ANUNCIOS, "ORDER BY anuncio_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getResult()):
            WSErro("Nenhum Anúncio Foi Cadastrado Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_anuncio = $View->Load('anuncio');

            foreach ($read->getResult() as $anuncio):
                extract($anuncio);

                $anuncio['imagem_anuncio'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $anuncio['HOME'] = HOME;
                $anuncio['botao_status'] = ($anuncio_status == '1' ? '<a title="Publicado" attr-status="mudar_status_anuncio" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_anuncio" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
                $anuncio['type_registro'] = ($anuncio_type ? "<p class=\"posts-item-categoria\"> >> {$anuncio_type}" : "") . " - " . date('d/m/Y - H:i', strtotime($anuncio_date)) . "</p>";
                $View->Show($anuncio, $tpl_anuncio);

            endforeach;
            $Pager->ExePaginator(ANUNCIOS, "ORDER BY anuncio_date DESC");
            ?>
            <div class="j_paginator" attr-action="paginator_anuncio">
                <?php
                echo $Pager->getPaginator();
            endif;
            ?>

            <div class="clear"></div>
        </div>
    </div>