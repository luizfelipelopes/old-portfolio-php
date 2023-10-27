<?php
$segment = filter_input(INPUT_GET, 'segment', FILTER_DEFAULT);
$IdSegment = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);

//var_dump($readPost->getResult());
//die;

$tabela_coluna_type = null;
$tabela_coluna_title = null;
$tabela_coluna_id = null;
$tabela = null;
switch ($segment):

    case 'post':
        $tabela = POSTS;
        $tabela_coluna_type = 'comentario_post = :id AND';
        $tabela_coluna_title = 'post_title';
        $tabela_coluna_id = 'post_id';
        break;
    case 'review-produto':
        $tabela = PRODUTOS;
        $tabela_coluna_type = 'comentario_produto = :id AND';
        $tabela_coluna_title = 'produto_title';
        $tabela_coluna_id = 'produto_id';
        break;
    case 'tickets':
        $tabela = AULAS;
        $tabela_coluna_type = 'comentario_aula = :id AND';
        $tabela_coluna_title = 'aula_title';
        $tabela_coluna_id = 'aula_id';
        break;
    default :
        $tabela_coluna_type = '';
        break;

endswitch;

$readSegment = new Read;
$readSegment->FullRead("SELECT " . $tabela_coluna_title . " FROM " . $tabela . " WHERE " . $tabela_coluna_id . " = :id", "id={$IdSegment}");

//var_dump("WHERE " . $tabela_coluna_type . " comentario_type = :segment AND comentario_resposta IS NULL OR comentario_resposta = 0 ORDER BY comentario_date DESC");
?>

<!--
MODAL DE EDIÇÂO DE COMENTÁRIOS
-->
<div class="fundo-comentario j_popup">
    <div class="comentario_edicao container js_content_form">
        <div class="ajax_close">X</div>
        <h1 class="m-bottom3">Editar Comentário</h1>
        <form action="" method="post" id="j_resposta' . $comentario_id . '">
            <div class="trigger-box-suspenso"></div>
            <input type="hidden" name="action" value="update_comentario">
            <input type="hidden" name="comentario_id">

            <span>
                <label for="comentario_author">Nome:</label>
                <input type="text" name="comentario_author">
            </span>

            <span>
                <label for="comentario_content">Comentário:</label>
                <textarea id="resposta" name="comentario_content" rows="7"></textarea>
            </span>


            <button class="btn btn-blue fl-right radius j_enviar_resposta">Enviar</button>
            <div title="Carregando" class="load fl-right"></div>
        </form>

    </div>
</div>
<!--
MODAL DE EDIÇÂO DE COMENTÁRIOS
-->

<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-comentarios-menu shorticon-minimo ds-inblock"><?= ($segment == 'post' ? 'Comentários' : ($segment == 'review-produto' ? 'Reviews' : ($segment == 'tickets' ? 'Tickets' : ''))); ?></h1>
            <p class="tagline"> >> Flow State / <b><?= ($segment == 'post' ? 'Comentários' : ($segment == 'review-produto' ? 'Reviews' : ($segment == 'tickets' ? 'Tickets' : ''))); ?>/<?= $readSegment->getResult()[0][$tabela_coluna_title] ?></b></p>
        </div>

        <form action="" method="POST" id="j_filtro_produtos" class="filtro_pedido_status fl-right m-bottom1 ds-none">
            <div class="form-group">
                <label for="filtro_comentario_produto" class="m-bottom1">Filtrar por Produto:</label>
                <select name="filtro_comentario_produto" class="form-control">
                    <option value="" selected>Escolha um Produto</option>
                    <option value="">Todos</option>

                    <?php
                    $readProdutos = new Read;
                    $readProdutos->ExeRead(PRODUTOS);
                    if ($readProdutos->getResult()):
                        foreach ($readProdutos->getResult() as $produto):
                            extract($produto);
                            ?>
                            <option value="<?= $produto_id; ?>"><?= $produto_title; ?></option>
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

        <a title="Voltar para Tickets" href="?exe=comentarios-segmentos&segment=tickets" style="margin-left: 10px;" class="btn btn-blue radius <?= ($segment == 'tickets' ? '' : 'ds-none'); ?>">Voltar para Tickets</a>
        <a title="Voltar para Review Produtos" href="?exe=comentarios-segmentos&segment=review-produto" style="margin-left: 10px;" class="btn btn-green radius <?= ($segment == 'review-produto' ? '' : 'ds-none'); ?>">Voltar para Reviews</a>
        <a title="Voltar para Posts" href="?exe=comentarios-segmentos&segment=post" class="btn btn-red radius <?= ($segment == 'post' ? '' : 'ds-none'); ?>">Voltar para Posts</a>


        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line m-bottom3"></div>

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
            $Pager = new Pager("dashboard.php?exe=comentarios&segment=" . $segment . "&id=" . $IdSegment . "&pag=");
            $Pager->ExePager($getPage, 12);

            $i = 0;
            $readComentarios = new Read;
            $readComentarios->ExeRead(COMENTARIOS, "WHERE " . $tabela_coluna_type . " comentario_type = :segment AND (comentario_resposta IS NULL OR comentario_resposta = 0) ORDER BY comentario_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&segment={$segment}&id={$IdSegment}");
            if (!$readComentarios->getResult()):

                WSErro("Nenhum comentário ainda", WS_INFOR);
            else:
                $View = new View;
                $tpl_comentario = $View->Load('comentario-admin');
                foreach ($readComentarios->getResult() as $comentario):
                    extract($comentario);
                    ?>


                    <?php
                    $comentario['resposta_content'] = array();

                    $comentario['comentario_segment_id'] = $IdSegment;

                    $comentario['comentario_cabecalho'] = '<div class="comentarios-linha" id="' . $comentario['comentario_id'] . '">';

                    $comentario['comentario_author'] = (!empty($comentario['comentario_author']) ? $comentario['comentario_author'] : 'Usuário Sem Nome');

                    $comentario['comentario_cover'] = (!empty($comentario_cover) && file_exists(HOME . DIRECTORY_SEPARATOR . 'uploads' . $comentario_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $comentario_cover : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png');

                    $readProduto = new Read;
                    $readProduto->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$comentario_produto}");

                    if ($readProduto->getResult()):

                        $comentario['produto_title'] = 'Produto: <span class="font-bold">' . $readProduto->getResult()[0]['produto_title'] . '</span>';

                    else:

                        $comentario['produto_title'] = '';

                    endif;


                    $comentario['comentario_estrelas'] = HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . ($comentario['comentario_avaluation'] < 2 ? 'img/1-estrela.png' : ($comentario['comentario_avaluation'] >= 2 && $comentario['comentario_avaluation'] < 3 ? 'img/2-estrelas.png' : ($comentario['comentario_avaluation'] >= 3 && $comentario['comentario_avaluation'] < 4 ? 'img/3-estrelas.png' : ($comentario['comentario_avaluation'] >= 4 && $comentario['comentario_avaluation'] < 5 ? 'img/4-estrelas.png' : ($comentario['comentario_avaluation'] >= 5 ? 'img/5-estrelas.png' : '')))));

                    if (Check::countWords($comentario['comentario_content']) > 10):
                        $comentario['comentario_content'] = '<span id="' . $comentario['comentario_id'] . '" class="comentarios-conteudo m-top1 j_parcial"><span class="texto">' . Check::Words($comentario['comentario_content'], 10) . '</span><a href="#" class="j_mais">mais</a> </span> <span id="' . $comentario['comentario_id'] . '" class="comentarios-conteudo m-top1 j_completo"><span class="texto">' . $comentario['comentario_content'] . '</span><a href="#" class="j_menos">ocultar</a></span>';
                    else:
                        $comentario['comentario_content'] = '<span id="' . $comentario['comentario_id'] . '" class="comentarios-conteudo m-top1"><span class="texto">' . $comentario['comentario_content'] . '</span></span>';
                    endif;

                    if ($comentario_status == '1'):
                        $comentario['botao_status'] = '<a title="Aprovado" id="' . $comentario['comentario_id'] . '_pai" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>';
                    else:
                        $comentario['botao_status'] = '<a title="Pendente" id="' . $comentario['comentario_id'] . '_pai" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>';
                    endif;

                    $comentario['resposta_cabecalho'] = '<div class="comentarios-resposta" id="resposta' . $comentario['comentario_id'] . '">';
                    $comentario['data_formatada'] = date('d/m/Y \à\s H:i', strtotime($comentario['comentario_date']));
                    
                    $comentarioResposta = new Read;
                    $comentarioResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :comentario_id ORDER BY comentario_date ASC", "comentario_id={$comentario_id}");

                    if (!$comentarioResposta->getResult()):
                        $comentario['resposta_content'] = '';
                    else:

                        $tpl_resposta = $View->Load('comentario-resposta');


                        foreach ($comentarioResposta->getResult() as $resposta):

                            $resposta['comentario_segment_id'] = $IdSegment;

                            $resposta['comentario_author'] = (!empty($resposta['comentario_author']) ? $resposta['comentario_author'] : 'Usuário Sem Nome');

                            if (isset($resposta['comentario_user'])):
                                $readUser = new Read;
                                $readUser->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$resposta['comentario_user']}");
                                if ($readUser->getResult()):
                                    $resposta['comentario_cover'] = (!empty($readUser->getResult()[0]['user_foto']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $readUser->getResult()[0]['user_foto'] : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png');
                                endif;
                            elseif (isset($resposta['comentario_cliente'])):
                                $readCliente = new Read;
                                $readCliente->ExeRead(CLIENTES, "WHERE cliente_id = :id", "id={$resposta['comentario_cliente']}");
                                if ($readCliente->getResult()):
                                    $resposta['comentario_cover'] = (!empty($readCliente->getResult()[0]['cliente_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $readCliente->getResult()[0]['cliente_cover'] : HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png');
                                endif;
                            else:
                                $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . ADMIN . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png';
                            endif;

                            

                            $resposta['data_formatada'] = date('d/m/Y \à\s H:i', strtotime($resposta['comentario_date']));

                            $resposta['comentario_content_abreviado'] = (Check::countWords($resposta['comentario_content']) > 10 ? '<span class="comentarios-conteudo m-top1 j_parcial_resposta" id="j_parcial_resposta_' . $resposta['comentario_id'] . '"><span class="texto">'
                                    . '' . Check::Words($resposta['comentario_content'], 10) . '</span><a href="#" class="j_mais_resposta" id="' . $resposta['comentario_id'] . '">mais</a></span>'
                                    . '<span class="comentarios-conteudo m-top1 j_completo_resposta" id="j_completo_resposta_' . $resposta['comentario_id'] . '"><span class="texto">' . $resposta['comentario_content'] . '</span><a href="#" class="j_menos_resposta" id="' . $resposta['comentario_id'] . '">ocultar</a></span>' : '<span class="comentarios-conteudo m-top1"><span class="texto">' . $resposta['comentario_content'] . '</span></span>');


                            $resposta['comentario_ativo_pendente'] = ($resposta['comentario_status'] == '1' ? '<a id="' . $resposta['comentario_id'] . '_filho" title="Aprovado" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>' : '<a id="' . $resposta['comentario_id'] . '_filho" title="Pendente" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>');

                            $resposta['comentario_resposta_id'] = $resposta['comentario_id'];

                            $comentario['resposta_content'][$i] = $View->returnView($resposta, $tpl_resposta);
//                            $View->Show($resposta, $tpl_resposta);

                            $i++;

                        endforeach;
//                        var_dump($comentario['resposta_content'][0]);
//                        die;
                        $comentario['resposta_content'] = implode(' ', $comentario['resposta_content']);

                    endif;

                    $comentario['resposta_fim'] = '</div>';

                    $comentario['resposta_textarea'] = '<form action="" method="post" class="j_resposta" id="j_resposta' . $comentario_id . '">
                            <div class="trigger-box-suspenso"></div>
                            <input type="hidden" name="action" value="create_resposta">
                            <input type="hidden" name="comentario_author" value="' . (isset($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_name'] . " - (Tutor)" : $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname']) . '">
                            <input type="hidden" name="comentario_user" value="' . (isset($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_id'] : null) . '">
                            <input type="hidden" name="comentario_cliente" value="' . (isset($_SESSION['clientelogin']['cliente_id']) ? $_SESSION['clientelogin']['cliente_id'] : null) . '">
                            <input type="hidden" name="comentario_email" value="' . (isset($_SESSION['userlogin']['user_id']) ? $_SESSION['userlogin']['user_email'] : $_SESSION['clientelogin']['cliente_email']) . '">
                            <input type="hidden" name="comentario_cover" value="' . (!empty($_SESSION['userlogin']['user_foto']) ? $_SESSION['userlogin']['user_foto'] : (!empty($_SESSION['clientelogin']['cliente_cover']) ? $_SESSION['clientelogin']['cliente_cover'] : null)) . '">
                            <input type="hidden" name="comentario_status" value="1">
                            <input type="hidden" name="' . ($segment == 'post' ? 'comentario_post' : ($segment == 'review-produto' ? 'comentario_produto' : ($segment == 'tickets' ? 'comentario_aula' : ''))) . '" value="' . $IdSegment . '">
                            <input type="hidden" name="comentario_type" value="' . $segment . '">
                            <input type="hidden" name="comentario_resposta" value="' . $comentario_id . '">
                            <textarea id="resposta" name="comentario_content" rows="5" class="m-top3 m-bottom1"></textarea>
                            <button class="btn btn-blue fl-right radius j_enviar_resposta">Enviar</button>
                            <div title="Carregando" class="load fl-right"></div>
                            <!--<button class="btn btn-blue fl-right radius j_cancelar_resposta">Cancelar</button>-->
                        </form>';

                    $comentario['comentario_fim'] = '</div>';

                    $View->Show($comentario, $tpl_comentario);

                endforeach;

                $Pager->ExePaginator(COMENTARIOS, "WHERE " . $tabela_coluna_type . " comentario_type = :segment AND (comentario_resposta IS NULL OR comentario_resposta = 0) ORDER BY comentario_date ASC", "segment={$segment}&id={$IdSegment}");
                ?>

                <div class="clear"></div>
                <div class="j_paginator" attr-id-segment="<?= $IdSegment; ?>" attr-segment="<?= $segment; ?>" attr-coluna-type="<?= $tabela_coluna_type; ?>" attr-action="paginator_comentario"></div>

                <?php
                echo $Pager->getPaginator();
            endif;
            ?>    


        </div>

    </div>
</article>
<!--COMENTÁRIOS/AVALIÇÕES-->
