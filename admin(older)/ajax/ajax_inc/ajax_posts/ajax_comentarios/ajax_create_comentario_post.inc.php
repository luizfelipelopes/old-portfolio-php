<?php

/**
 * ajax_create_comentario_post.inc.php - <b>CREATE COMENTARIO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Criação de Comentário dos Posts
 */

//        unset($Post['modulo_id']);
//        $Post['curso_cover'] = ($_FILES['curso_cover']['tmp_name'] ? $_FILES['curso_cover'] : null);

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//        var_dump($meuArray);

$adminComentario = new adminComentario;
$adminComentario->ExeCreate($meuArray);
//        var_dump($adminComentario);


$jSon['error'] = $adminComentario->getError();

//        var_dump($meuArray);
