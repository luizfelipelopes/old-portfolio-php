<?php

/**
 * ajax_create_resposta_post.inc.php - <b>CREATE REPOSTA COMENTÁRIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Resposta de Comentário dos Posts
 */
//        unset($Post['modulo_id']);
//        $Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//$readType = new Read;
//$readType->ExeRead(COMENTARIOS, "WHERE comentario_id = :id", "id={$meuArray['comentario_resposta']}");
//if ($readType->getResult()):
//    $meuArray += ["comentario_type" => $readType->getResult()[0]['comentario_type']];
//endif;

//$meuArray += ["comentario_date" => date('Y-m-d H:i:s')];

//var_dump($meuArray);
//die;

//if(!empty($Post['segment'])):
//    $meuArray += ["comentario_segment" => $Post['segment']];
//endif;


//        $meuArray +=["comentario_estado" => null];
//        var_dump($meuArray);
$adminComentario = new adminComentario;
$adminComentario->ExeCreate($meuArray);

$comentarioResposta = new Read;
$comentarioResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :comentario_id ORDER BY comentario_date ASC", "comentario_id={$meuArray['comentario_resposta']}");
$View = new View;
$tpl_resposta = $View->Load('comentario-resposta');

if (!$comentarioResposta->getResult()):
//            WSErro("Nenhum Comentário!", WS_INFOR);
else:
    $jSon['comentario_pai'] = $meuArray['comentario_resposta'];
    $jSon['total'] = $comentarioResposta->getRowCount();
    $jSon['result_comentarios'] = array();
    $i = 0;

    foreach ($comentarioResposta->getResult() as $resposta):

        $resposta['comentario_pai'] = $resposta['comentario_id'];
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

//        $resposta['comentario_cover'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . $resposta['comentario_cover'];

        $resposta['data_formatada'] = date('d/m/Y H\hi', strtotime($resposta['comentario_date']));

        if (Check::countWords($resposta['comentario_content']) > 10):
            $resposta['comentario_content_abreviado'] = '<span class="comentarios-conteudo m-top1 j_parcial_resposta" id="j_parcial_resposta_' . $resposta['comentario_id'] . '"><span class="texto">'. '' . Check::Words($resposta['comentario_content'], 10) . '</span><a href="#" class="j_mais_resposta" id="' . $resposta['comentario_id'] . '">mais</a></span><span class="comentarios-conteudo m-top1 j_completo_resposta" id="j_completo_resposta_' . $resposta['comentario_id'] . '"><span class="texto">' . $resposta['comentario_content'] . '</span><a href="#" class="j_menos_resposta" id="' . $resposta['comentario_id'] . '">ocultar</a></span>';
        else:
            $resposta['comentario_content_abreviado'] = '<span class="comentarios-conteudo m-top1"><span class="texto">' . $resposta['comentario_content'] . '</span></span>';
        endif;

        if ($resposta['comentario_status'] == '1'):
            $resposta['comentario_ativo_pendente'] = '<a title="Aprovado" id="' . $resposta['comentario_id'] . '_pai" class="btn btn-green radius shorticon shorticon-publicado j_aprovado"></a>';
        else:
            $resposta['comentario_ativo_pendente'] = '<a title="Pendente" id="' . $resposta['comentario_id'] . '_pai" class="btn btn-yellow radius shorticon shorticon-pendente m-top1 j_espera"></a>';
        endif;

        $jSon['result_comentarios'] += [$i => $View->returnView($resposta, $tpl_resposta)];

        $i++;

    endforeach;
endif;



$jSon['error'] = $adminComentario->getError();


