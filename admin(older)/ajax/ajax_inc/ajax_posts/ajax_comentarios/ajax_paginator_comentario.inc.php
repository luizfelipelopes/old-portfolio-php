<?php

/**
 * ajax_paginator_comentario.php - <b>PAGINAÇÂO COMENTÁRIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação do Post em REAL-TIME
 */
//$tabela_grupo_type = $Post['grupo_type'];
$tabela_coluna_type = $Post['coluna_type'];
$segment = $Post['segment'];
$IdSegment = $Post['id_segment'];




$Pager = new Pager("dashboard.php?exe=comentarios&segment=" . $Post['segment'] . "&id=" . $IdSegment . "&pag=");
$Pager->ExePager($Post['pagina'], 12);

//var_dump($Post['pagina'], $tabela_coluna_type, $segment, $IdSegment);
//var_dump($Pager->getOffset(), $Pager->getLimit());
//die;


$readComentarios = new Read;
$readComentarios->ExeRead(COMENTARIOS, "WHERE " . $tabela_coluna_type . " comentario_type = :segment AND (comentario_resposta IS NULL OR comentario_resposta = 0) ORDER BY comentario_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&segment={$segment}&id={$IdSegment}");
//var_dump($readComentarios->getResult());
//die;
if (!$readComentarios->getResult()):

    $jSon[' error'] = ["Nehum comentária ainda", "infor"];

else:

    $i = 0;
    $j = 0;
    $jSon['success '] = ["Foi encontrado {$readComentarios->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $readComentarios->getRowCount();
    $jSon['result'] = array();
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
        $comentarioResposta = new Read;
        $comentarioResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :comentario_id ORDER BY comentario_date ASC", "comentario_id={$comentario_id}");

        if (!$comentarioResposta->getResult()):
            unset($comentario['resposta_content']);
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

                $comentario['data_formatada'] = date('d/m/Y \à\s H:i', strtotime($comentario['comentario_date']));

                $resposta['data_formatada'] = date('d/m/Y \à\s H:i', strtotime($resposta['comentario_date']));

                $resposta['comentario_content_abreviado'] = (Check::countWords($resposta['comentario_content']) > 10 ? '<span class="comentarios-conteudo m-top1 j_parcial_resposta" id="j_parcial_resposta_' . $resposta['comentario_id'] . '">'
                        . '' . Check::Words($resposta['comentario_content'], 10) . '<a href="#" class="j_mais_resposta" id="' . $resposta['comentario_id'] . '">mais</a></span>'
                        . '<span class="comentarios-conteudo m-top1 j_completo_resposta" id="j_completo_resposta_' . $resposta['comentario_id'] . '">' . $resposta['comentario_content'] . '<a href="#" class="j_menos_resposta" id="' . $resposta['comentario_id'] . '">ocultar</a></span>' : '<span class="comentarios-conteudo m-top1">' . $resposta['comentario_content'] . '</span>');


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

        $jSon['result'] += [$j => $View->returnView($comentario, $tpl_comentario)];
        $j++;
    endforeach;

    
//    var_dump($jSon['result']);
//    $Pager->ExePaginator(COMENTARIOS);
    $Pager->ExePaginator(COMENTARIOS, "WHERE " . $tabela_coluna_type . " comentario_type = :segment AND (comentario_resposta IS NULL OR comentario_resposta = 0) ORDER BY comentario_date DESC", "segment={$segment}&id={$IdSegment}");
    $jSon['action_paginator'] = '<div class="clear"></div><div class="j_paginator" attr-id-segment="' . $IdSegment . '" attr-segment="' . $segment . '" attr-coluna-type="' . $tabela_coluna_type . '" attr-action="paginator_comentario"></div>';
    $jSon['paginator'] = $Pager->getPaginator();
endif;