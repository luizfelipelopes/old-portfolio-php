<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$getPage = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
?>
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Vídeos</h1>
            <p class="tagline"> >> Flow State / <b>Vídeos</b></p>
        </div>


        <a class="btn btn-blue radius" title="Novo Vídeo" href="<?= HOME; ?>/admin/dashboard.php?exe=videos/create">Novo Vídeo</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar" />
            <input type="text" name="s" title="Pesquisar Video" placeholder="Pesquisar Video" class="j_pesquisar" attr-pesquisa="pesquisar_video"/> 
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
        $Pager = new Pager("dashboard.php?exe=videos/index&pag=");
        $Pager->ExePager($getPage, 12);

        $read = new Read;
        $read->ExeRead(VIDEOS, "ORDER BY video_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

        if (!$read->getResult()):
            WSErro("Nenhum Destaque Foi Escrito Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_video = $View->Load('video');

            foreach ($read->getResult() as $video):
                extract($video);

                $video['video'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $video['HOME'] = HOME;
                $video['video_desc'] = Check::Words($video['video_desc'], 10);
                $video['botao_status'] = ($video_status == '1' ? '<a title="Publicado" attr-status="mudar_status_video" class="btn btn-green radius posts-item-status j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_video" class="btn btn-yellow radius posts-item-status j_pendente shorticon shorticon-pendente"></a>');
                $video['botao_destaque'] = ($video_destaque == '1' ? '<a title="Em destaque" attr-status="mudar_destaque_video" class="btn btn-green radius item-destaque j_publicado shorticon shorticon-destaque"></a>' : '<a title="Sem Destaque" attr-status="mudar_destaque_video" class="btn btn-yellow radius item-destaque j_pendente shorticon shorticon-sem-destaque"></a>');
                $video['data_formatada'] = date('d/m/Y - H:i', strtotime($video_date)) . "</p>";
                $View->Show($video, $tpl_video);

            endforeach;
            $Pager->ExePaginator(VIDEOS, "ORDER BY video_date DESC");
            ?>
            <div class="j_paginator" attr-action="paginator_video">
                <?php
                echo $Pager->getPaginator();
            endif;
            ?>

            <div class="clear"></div>
        </div>
    </div>