
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Destaques</h1>
            <p class="tagline"> >> Flow State / <b>Destaques</b></p>
        </div>


        <a class="btn btn-blue radius" title="Novo Destaque" href="<?= HOME; ?>/admin/dashboard.php?exe=destaques/create">Novo Destaque</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar" />
            <input type="text" name="s" title="Pesquisar Destaque" placeholder="Pesquisar Destaque" class="j_pesquisar" attr-pesquisa="pesquisar_destaque"/> 
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

        $Pager = new Pager("dashboard.php?exe=destaques/index&pag=");
        $Pager->ExePager($getPage, 12);

        $read = new Read;
        $read->ExeRead(DESTAQUES, "ORDER BY destaque_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getResult()):
            WSErro("Nenhum Destaque Foi Escrito Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_destaque = $View->Load('destaque');

            foreach ($read->getResult() as $destaque):
                extract($destaque);

                $destaque['imagem_destaque'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $destaque['HOME'] = HOME;
                $destaque['botao_status'] = ($destaque_status == '1' ? '<a title="Publicado" attr-status="mudar_status_destaque" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_destaque" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
                $destaque['type_registro'] = ($destaque_type ? "<p class=\"posts-item-categoria\"> >> {$destaque_type}" : "") . " - " . date('d/m/Y - H:i', strtotime($destaque_date)) . "</p>";
                $View->Show($destaque, $tpl_destaque);

            endforeach;
            $Pager->ExePaginator(DESTAQUES, "ORDER BY destaque_date DESC");
            ?>
            <div class="j_paginator" attr-action="paginator_destaque">
                <?php
                echo $Pager->getPaginator();
            endif;
            ?>

            <div class="clear"></div>
        </div>
    </div>