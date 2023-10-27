<?php

/**
 * ajax_update_comentario_post.inc.php - <b>UPDATE COMENTARIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Comentário dos Posts
 */
//        unset($Post['modulo_id']);
//        $Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);


$Id = $Post['comentario_id'];
unset($Post['comentario_id']);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

$adminComentario = new adminComentario;
$adminComentario->ExeUpdate($Id, $meuArray);

$jSon['error'] = $adminComentario->getError();
$jSon['edicao_comentarios'] = true;
$jSon['comentario_id'] = $Id;

$jSon['comentario_author'] = (!empty($meuArray['comentario_author']) ? $meuArray['comentario_author'] : null);

if (Check::countWords($meuArray['comentario_content']) > 10):
    $jSon['comentario_content'] = '<span id="' . $Id . '" class="comentarios-conteudo m-top1 j_parcial"><span class="texto">' . Check::Words($meuArray['comentario_content'], 10) . '</span><a href="#" class="j_mais">mais</a> </span> <span id="' . $Id . '" class="comentarios-conteudo m-top1 j_completo"><span class="texto">' . $meuArray['comentario_content'] . '</span><a href="#" class="j_menos">ocultar</a></span>';
else:
    $jSon['comentario_content'] = '<span id="' . $Id . '" class="comentarios-conteudo m-top1"><span class="texto">' . $meuArray['comentario_content'] . '</span></span>';
endif;


