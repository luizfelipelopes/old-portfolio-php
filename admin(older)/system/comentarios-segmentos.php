<?php
$segment = filter_input(INPUT_GET, 'segment', FILTER_DEFAULT);
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);

$tabela_coluna_type = null;
$tabela_grupo_type = null;
$tabela_join = null;
$tabela_join_id = null;
$tabela_join_title = null;
$tabela_join_cover = null;
$name_filtro = null;
$sql_segment = 'comentario_type = :segment AND ';
switch ($segment):

    case 'post':
        $tabela_coluna_type = ', comentario_post ASC';
        $tabela_grupo_type = 'comentario_post';
        $tabela_join = POSTS;
        $tabela_join_id = 'post_id';
        $tabela_join_title = 'post_title';
        $tabela_join_cover = ', post_cover';
//        $name_filtro = 'filtro_comentario_post';
        break;
    case 'review-produto':
        $tabela_coluna_type = ', comentario_produto ASC';
        $tabela_grupo_type = 'comentario_produto';
        $tabela_join = PRODUTOS;
        $tabela_join_id = 'produto_id';
        $tabela_join_title = 'produto_title';
        $tabela_join_cover = ', produto_image';
//        $name_filtro = 'filtro_comentario_produto';
        break;
    case 'tickets':
        $tabela_coluna_type = ', comentario_aula ASC';
        $tabela_grupo_type = 'comentario_aula';
        $tabela_join = AULAS;
        $tabela_join_id = 'aula_id';
        $tabela_join_title = 'aula_title';
        $tabela_join_cover = '';
//        $name_filtro = 'filtro_comentario_aula';
        break;
    default :
        $tabela_coluna_type = '';
        $tabela_grupo_type = '';
        $sql_segment = '';
        $tabela_join = '';
        $tabela_join_id = '';
        $tabela_join_title = '';
        $tabela_join_cover = '';
//        $name_filtro = '';
//        die;
        break;
endswitch;
?>


<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-comentarios-menu shorticon-minimo ds-inblock"><?= ($segment == 'post' ? 'Comentários' : ($segment == 'review-produto' ? 'Reviews' : ($segment == 'tickets' ? 'Tickets' : ''))); ?></h1>
            <p class="tagline"> >> Flow State / <b><?= ($segment == 'post' ? 'Comentários' : ($segment == 'review-produto' ? 'Reviews' : ($segment == 'tickets' ? 'Tickets' : ''))); ?></b></p>
        </div>

        <form action="" method="POST" id="j_filtro_produtos" class="filtro_pedido_status fl-right m-bottom1">
            <div class="form-group">
                <label for="filtro_comentario_segment" class="m-bottom1">Filtrar por <?= ($segment == 'post' ? 'Post' : ($segment == 'review-produto' ? 'Produto' : ($segment == 'tickets' ? 'Aula' : ''))); ?>:</label>
                <select name="filtro_comentario_segment" class="form-control">
                    <option value="" selected disabled>Escolha <?= ($segment == 'post' ? 'um Post' : ($segment == 'review-produto' ? 'um Produto' : ($segment == 'tickets' ? 'uma Aula' : ''))); ?></option>
                    <option value="">Todos</option>

                    <?php
                    $readItensSegment = new Read;
                    $readItensSegment->FullRead("SELECT " . $tabela_join_id . ", " . $tabela_join_title . " FROM " . $tabela_join . " a INNER JOIN " . COMENTARIOS . " b WHERE b." . $tabela_grupo_type . " = a." . $tabela_join_id . " GROUP BY " . $tabela_grupo_type);

                    if ($readItensSegment->getResult()):
                        foreach ($readItensSegment->getResult() as $item):
                            extract($item);
                            ?>
                            <option value="<?= $$tabela_join_id; ?>"><?= $$tabela_join_id . '-' . $$tabela_join_title; ?></option>
                            <?php
                        endforeach;
                    endif;
                    ?>

                </select>
            </div>
        </form>


        <form action="" method="POST" id="j_filtro_tipos" class="filtro_pedido_status fl-right m-bottom1 ds-none" style="margin-right: 2%;">
            <div class="form-group">
                <label for="filtro_comentario_tipo" class="m-bottom1">Filtrar por Tipo:</label>
                <select name="filtro_comentario_tipo" class="form-control">
                    <option value="" selected>Escolha um Tipo</option>
                    <option value="">Todos</option>
                    <option value="review-produto">Review Produtos</option>
                    <option value="recados">Recados Post</option>
                    <option value="tickets">Tickets</option>
                </select>
            </div>
        </form>

        <div class="container"></div>
        <a title="Tickets" href="?exe=comentarios-segmentos&segment=tickets" style="margin-left: 10px;" class="btn btn-blue radius <?=($segment == 'tickets'? ' ds-none' : '');?>">Tickets</a>
        <a title="Review Produtos" href="?exe=comentarios-segmentos&segment=review-produto" style="margin-left: 10px;" class="btn btn-green radius <?=($segment == 'review-produto'? ' ds-none' : '');?>">Reviews</a>
        <a title="Posts" href="?exe=comentarios-segmentos&segment=post" class="btn btn-red radius <?=($segment == 'post'? ' ds-none' : '');?>">Posts</a>
        
        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->

<div class="box-line m-bottom3"></div>

<?php
//var_dump($readItensSegment->getResult());
//die;
?>

<!--COMENTÁRIOS/AVALIçÕES-->
<article class="container main-conteudo comentarios widgets-abaixo table-comentarios m-bottom3">

    <header class="bg-blue">
        <div class="content">
            <h1 class="caps-lock font-bold"><?= ($segment == 'post' ? 'Comentários' : ($segment == 'review-produto' ? 'Reviews' : ($segment == 'tickets' ? 'Tickets' : ''))); ?>:</h1>
            <div class="clear"></div>
        </div>
    </header>

    <div class="bg-body comentarios-lista js_paginator">

        <div class="content j_post_conteudo js_content_form">

            <div class="trigger-box m-bottom1 m-top1"></div>    


            <!--<div class="j_comentarios_real_time"></div>-->

            <?php
            $Pager = new Pager("dashboard.php?exe=comentarios-segmentos&segment=segment&pag=");
            $Pager->ExePager($getPage, 12);

            $i = 0;
            $readComentarios = new Read;
            $readComentarios->FullRead("SELECT COUNT(comentario_id) AS TOTAL, comentario_status, " . $tabela_join_title . " , " . $tabela_grupo_type . $tabela_join_cover . " FROM " . COMENTARIOS . " a LEFT JOIN " . $tabela_join . " b ON a." . $tabela_grupo_type . " = b." . $tabela_join_id . " WHERE " . $sql_segment . $tabela_grupo_type . " IS NOT NULL GROUP BY " . $tabela_grupo_type . " ORDER BY comentario_date DESC " . $tabela_coluna_type . " LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&segment={$segment}");
            if (!$readComentarios->getResult()):

                WSErro("Nenhum comentário ainda", WS_INFOR);

            else:
                $ArrayComentario = array();
                $readPendentes = new Read;
                $readMedia = new Read;
                $readUltimoComentario = new Read;

                $View = new View;
                $tpl_comentario_segment = $View->Load('comentarios-segmentos');

                foreach ($readComentarios->getResult() as $comentario):

                    $readPendentes->FullRead("SELECT COUNT(comentario_id) AS PENDENTES FROM " . COMENTARIOS . " WHERE " . $tabela_grupo_type . " = :id AND comentario_status = 0", "id={$comentario[$tabela_grupo_type]}");
                    $readMedia->FullRead("SELECT COUNT(comentario_id) AS TOTAL, SUM(comentario_avaluation) AS SOMA FROM " . COMENTARIOS . " WHERE " . $tabela_grupo_type . " = :id AND comentario_status = 1 AND (comentario_resposta IS NULL OR comentario_resposta = 0)", "id={$comentario[$tabela_grupo_type]}");
                    $readUltimoComentario->FullRead("SELECT comentario_date FROM " . COMENTARIOS . " WHERE " . $tabela_grupo_type . " = :id", "id={$comentario[$tabela_grupo_type]}");
                    $comentario['total_pendentes'] = $readPendentes->getResult()[0]['PENDENTES'];
                    $comentario['total_ativos'] = $comentario['TOTAL'] - $readPendentes->getResult()[0]['PENDENTES'];
                    $Media = ($readMedia->getResult()[0]['SOMA'] == '0' || $readMedia->getResult()[0]['TOTAL'] == '0' ? 0 : $readMedia->getResult()[0]['SOMA'] / $readMedia->getResult()[0]['TOTAL']);
                    $comentario['media_avaliacao'] = ($segment == 'post' || $segment == 'review-produto' ? '<div class="comentarios-avaliacao"><span class="ds-block font-bold">Avaliação média:</span> ' . number_format($Media, 1, ',', '.')  . '</div>' : '');
                    $comentario['media_estrelas'] = ($segment == 'post' || $segment == 'review-produto' ? ($Media < 2 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/1-estrela.png" />' : ($Media >= 2 && $Media < 3 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/2-estrelas.png" />' : ($Media >= 3 && $Media < 4 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/3-estrelas.png" />' : $Media >= 4 && $Media < 5 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/4-estrelas.png" />' : ($Media >= 5 ? '<img class="avaliacao" title="" alt="" src="' . HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img/5-estrelas.png" />' : '')))) : '');
                    $comentario['ultimo_comentario'] = $readUltimoComentario->getResult()[$readUltimoComentario->getRowCount() - 1]['comentario_date'];
                    $ArrayComentario[] = $comentario;
                    $ArrayComentario[$i]['segment'] = $segment;
                    $ArrayComentario[$i]['titulo_segment'] = $comentario[$tabela_join_title];
                    $ArrayComentario[$i]['grupo_segment'] = $comentario[$tabela_grupo_type];
                    $ArrayComentario[$i]['imagem_segment'] = (!empty($ArrayComentario[$i][str_replace([',', ' '], '', $tabela_join_cover)]) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $ArrayComentario[$i][str_replace([',', ' '], '', $tabela_join_cover)] : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png');
                    $ArrayComentario[$i]['ultima_data_segment'] = ($segment == 'post' ? 'Comentário' : ($segment == 'review-produto' ? 'Review' : ($segment == 'tickets' ? 'Ticket' : '')));
                    $ArrayComentario[$i]['data_segment'] = date('d/m/Y \à\s H:i', strtotime($ArrayComentario[$i]['ultimo_comentario']));
                    $ArrayComentario[$i]['comentario_segment'] = ($segment == 'post' ? 'Comentários' : ($segment == 'review-produto' ? 'Reviews' : ($segment == 'tickets' ? 'Tickets' : '')));

                    $View->Show($ArrayComentario[$i], $tpl_comentario_segment);

                    $i++;
                endforeach;

                $Pager->ExeFullPaginator("SELECT COUNT(comentario_id) AS TOTAL, comentario_status, " . $tabela_join_title . " , " . $tabela_grupo_type . $tabela_join_cover . " FROM " . COMENTARIOS . " a LEFT JOIN " . $tabela_join . " b ON a." . $tabela_grupo_type . " = b." . $tabela_join_id . " WHERE " . $sql_segment . $tabela_grupo_type . " IS NOT NULL GROUP BY " . $tabela_grupo_type . " ORDER BY comentario_date DESC " . $tabela_coluna_type, "segment={$segment}");
                ?>
                <div class="clear"></div>
                <div class="j_paginator" attr-title="<?= $tabela_join_title; ?>" attr-grupo-type="<?= $tabela_grupo_type; ?>" attr-cover="<?= $tabela_join_cover; ?>" attr-join-id="<?= $tabela_join_id; ?>" attr-tabela-join="<?= $tabela_join; ?>" attr-segment="<?= $segment; ?>" attr-sql-segment="<?= $sql_segment; ?>" attr-coluna-type="<?= $tabela_coluna_type; ?>" attr-action="paginator_comentario_segment"></div>

                <?php
                echo $Pager->getPaginator();

            endif;
            ?>    




        </div>

    </div>
</article>
<!--COMENTÁRIOS/AVALIÇÕES-->
