<?php

/**
 * ajax_filtrar_comentario_tipo_post.inc.php - <b>FILTRAR COMENTARIO POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de FIltro Comentários do Post em REAL-TIME
 */

$readComentarios = new Read;

        if ($Post['tipo'] == 'tickets'):
            $readComentarios->ExeRead(COMENTARIOS, "WHERE comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC", "type=tickets");
        elseif ($Post['tipo'] == 'recados'):
            $readComentarios->ExeRead(COMENTARIOS, "WHERE comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC", "type=recados");
        elseif ($Post['tipo'] == 'review-produto'):
            $readComentarios->ExeRead(COMENTARIOS, "WHERE comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC", "type=review-produto");
        else:
            $readComentarios->ExeRead(COMENTARIOS, "WHERE comentario_resposta IS NULL ORDER BY comentario_date DESC", "type=recados");
        endif;



        if (!$readComentarios->getResult()):

//            WSErro("Nenhum comentário ainda", WS_INFOR);
        else:

            $jSon['result_comentario'] = array();
            $jSon['result_resposta'] = array();
            $jSon['total'] = $readComentarios->getRowCount();

            $i = 0;


            $View = new View;
            $tpl_comentario = $View->Load('comentario-admin');
            foreach ($readComentarios->getResult() as $comentario):
                extract($comentario);

                $comentario['resposta_content'] = array();

                $comentario['comentario_cabecalho'] = '<div class="comentarios-linha" id="' . $comentario['comentario_id'] . '">';


                $comentario['comentario_cover'] = (!empty($comentario_cover) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $comentario_cover : HOME . DIRECTORY_SEPARATOR . 'flowstate_admin' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'perfil-avatar.png');

                $comentario['comentario_date'] = date('d/m/Y H\hi', strtotime($comentario['comentario_date']));

                $readProduto = new Read;
                $readProduto->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$comentario_produto}");
                if ($readProduto->getResult()):

                    $comentario['produto_title'] = 'Produto: <span class="font-bold">' . $readProduto->getResult()[0]['produto_title'] . '</span>';

                else:
                    $comentario['produto_title'] = '';

                endif;

                if (Check::countWords($comentario['comentario_content']) > 10):
                    $comentario['comentario_content'] = '<span class="comentarios-conteudo m-top1 j_parcial">' . Check::Words($comentario['comentario_content'], 10) . '<a href="#" class="j_mais">mais</a> </span> <span class="comentarios-conteudo m-top1 j_completo">' . $comentario['comentario_content'] . '<a href="#" class="j_menos">ocultar</a></span>';
                else:
                    $comentario['comentario_content'] = '<span class="comentarios-conteudo m-top1">' . $comentario['comentario_content'] . '</span>';
                endif;

                if ($comentario_status == '1'):
                    $comentario['botao_status'] = '<a title="Aprovado" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>';
                else:
                    $comentario['botao_status'] = '<a title="Pendente" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>';
                endif;


                $comentario['resposta_content'] = '';


                $comentario['resposta_cabecalho'] = '<div class="comentarios-resposta" id="resposta' . $comentario['comentario_id'] . '">';
                $comentarioResposta = new Read;
                $comentarioResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :comentario_id ORDER BY comentario_date ASC", "comentario_id={$comentario_id}");
                $View = new View;
                $tpl_resposta = $View->Load('comentario-resposta');

                if (!$comentarioResposta->getResult()):
//                            WSErro("Nenhum Comentário!", WS_INFOR);
                else:

                    $j = 0;
                    foreach ($comentarioResposta->getResult() as $resposta):




                        if (isset($resposta['comentario_user'])):
                            $readUser = new Read;
                            $readUser->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$resposta['comentario_user']}");
                            if ($readUser->getResult()):
                                $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $readUser->getResult()[0]['user_foto'];
                            endif;
                        elseif (isset($resposta['comentario_cliente'])):
                            $readCliente = new Read;
                            $readCliente->ExeRead(CLIENTES, "WHERE cliente_id = :id", "id={$resposta['comentario_cliente']
                                    }");
                            if ($readCliente->getResult()):
                                $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $readCliente->getResult()[0]['cliente_cover'];
                            endif;
                        else:
                            $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . 'flowstate_admin' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . '/perfil-avatar.png';
                        endif;

                        $comentario['resposta_content'][$j] = '<div class="container m-bottom3 j_dinamic" id="' . $resposta['comentario_id'] . '">
    <img height="80" class="round" title="' . $resposta['comentario_author'] . '" alt="[' . $resposta['comentario_author'] . ']" src="' . $resposta['comentario_cover'] . '" />
    <div class="comentarios-info"><h1>' . $resposta['comentario_author'] . '</h1>
        <span class="comentarios-data">- ' . date('d/m/Y H\hi', strtotime($resposta['comentario_date'])) . '</span>
        <span class="comentarios-categoria">em ' . $resposta['comentario_type'] . '</span>' . (Check::countWords($resposta['comentario_content']) > 10 ? '<span class="comentarios-conteudo m-top1 j_parcial_resposta" id="j_parcial_resposta_' . $resposta['comentario_id'] . '">' . Check::Words($resposta['comentario_content'], 10) . '<a href="#" class="j_mais_resposta" id="' . $resposta['comentario_id'] . '">mais</a> </span> <span class="comentarios-conteudo m-top1 j_completo_resposta" id="j_completo_resposta_' . $resposta['comentario_id'] . '">' . $resposta['comentario_content'] . '<a href="#" class="j_menos_resposta" id="' . $resposta['comentario_id'] . '">ocultar</a></span>' : '<span class="comentarios-conteudo m-top1">' . $resposta['comentario_content'] . '</span>') .
                                '<div class="comentarios-botoes comentarios-botoes-resposta ds-inblock m-top1" id="' . $resposta['comentario_id'] . '"><div class="botoes ds-inblock"><div class="comentarios-botoes-status ds-inblock">' .
                                ($resposta['comentario_status'] == '1' ? '<a title="Aprovado" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>' : '<a title="Pendente" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>') . '</div>
            <a title="Excluir" class="btn btn-red radius shorticon shorticon-excluir m-top1 j_confirm"></a>
                <div class="bloco-confirm" id="' . $resposta['comentario_id'] . '">
                    <small class="msg-confirm">Deseja excluir?</small>
                    <a class="btn btn-orange btn-confirm btn-confirm-sim radius j_excluir" title="Confirmar Exclusão" href="#" attr-action="delete_comentario" id="' . $resposta['comentario_id'] . '">Sim</a>
                    <a class="btn btn-pink btn-confirm btn-confirm-nao radius j_cancelar" title="Cancelar Exclusão" href="#" id="' . $resposta['comentario_id'] . '">Não</a>
                </div>
            </div>
        </div> 
    </div>
</div>';


                        $j++;

                    endforeach;
                    $comentario['resposta_content'] = implode(' ', $comentario['resposta_content']);
                endif;

                $comentario['resposta_fim'] = '</div>';

                $comentario['resposta_textarea'] = '<form action="" method="post" class="j_resposta" id="j_resposta' . $comentario_id . '">
                            <div class="trigger-box-suspenso"></div>
                            <input type="hidden" name="action" value="create_resposta">
                            <input type="hidden" name="comentario_resposta" value="' . $comentario_id . '">
                            <textarea id="resposta" name="comentario_content" rows="5" class="m-top3 m-bottom1"></textarea>
                            <button class="btn btn-blue fl-right radius j_enviar_resposta">Enviar</button>
                            <div title="Carregando" class="load fl-right"></div>
                            <!--<button class="btn btn-blue fl-right radius j_cancelar_resposta">Cancelar</button>-->
                        </form>';

                $comentario['comentario_fim'] = '</div>';


                $jSon['result_comentario'] += [$i => $View->returnView($comentario, $tpl_comentario)];
                $i++;


            endforeach;
        endif;
