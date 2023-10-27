
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Cursos</h1>
            <p class="tagline"> >> <?= SOFTWARE; ?> / <b>Cursos</b></p>
        </div>

        <a class="btn btn-blue btn-option-header radius" title="Novo Curso" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=cursos/create">Novo Curso</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar" />
            <input type="text" name="s" title="Pesquisar Curso" placeholder="Pesquisar Curso" attr-pesquisa="pesquisar_curso" class="j_pesquisar"/> 
            <button name="s_pesquisar" class="btn btn-green radius shorticon shorticon-search j_pesquisar"></button>
        </form>

        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line"></div>


<div class="container main-conteudo posts cursos">    

    <div class="trigger-box m-bottom1 m-top1"></div>    

    <div class="content j_post_conteudo j_curso_conteudo">



        <?php
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $sec = filter_input(INPUT_GET, 'sec', FILTER_VALIDATE_BOOLEAN);

        $read = new Read;
        if (!empty($id)):

            if ($sec):
                $read->ExeRead(CURSOS, "WHERE post_cat_parent = :id ORDER BY post_date DESC", "id={$id}");
            else:
                $read->ExeRead(CURSOS, "WHERE post_category = :id ORDER BY post_date DESC", "id={$id}");
            endif;

        else:

            $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
            $Pager = new Pager("dashboard.php?exe=cursos/index&pag=");
            $Pager->ExePager($getPage, 8);

            $read->ExeRead(CURSOS, "ORDER BY curso_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//                            var_dump($read->getResult()[0]);
        endif;

        if (!$read->getResult()):
            WSErro("Nenhum Curso Foi Criado Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_curso = $View->Load('curso');

            foreach ($read->getResult() as $curso):
                extract($curso);

                $curso['imagem_curso'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $curso['HOME'] = HOME;
                $curso['ADMIN'] = HOME . ADMIN;
//                $post['views'] = (isset($curso_views) ? $post_views : '0');
                $curso['botao_status'] = ($curso_status == '1' ? '<a title="Publicado" attr-status="mudar_status_curso" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_curso" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');

                $readSegmento = new Read;
                $readSegmento->ExeRead(SEGMENTOS, "WHERE segment_id = :id", "id={$curso_segment}");

                $curso['segmento_data'] = ($readSegmento->getResult() ? "<p class=\"posts-item-categoria\"> >> {$readSegmento->getResult()[0]['segment_title']}" : "") . " - " . date('d/m/Y - H:i', strtotime($curso_date)) . "</p>";
                $View->Show($curso, $tpl_curso);

            endforeach;
        endif;
        ?>        

        <div class="j_paginator" attr-action="paginator_curso"></div>
        <?php
        $Pager->ExePaginator(CURSOS);
        echo $Pager->getPaginator();
        ?>


        <div class="clear"></div>
    </div>
</div>