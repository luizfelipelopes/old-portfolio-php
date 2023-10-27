<?php

/**
 * ajax_update_comment.php - <b>Atualizar Comentário</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Comentário
 */
$jSon['noclear'] = true;
$id = $Post['comentario_id'];
unset($Post['comentario_id']);

$meuArray = Check::limparSubmit($Post);

//var_dump($meuArray);
//die;

$adminComment = new adminComentario;
$adminComment->ExeUpdate($id, $meuArray);
if ($adminComment->getResult()):
    $jSon['update_comment'] = true;
    $jSon['result'] = [
        'id' => $id,
        'nome' => $Post['comentario_author'],
        'content' => $Post['comentario_content'],
        'child' => (!empty(BuscaRapida::buscarComment($id)['comentario_resposta']) ? true : false)
    ];

endif;
//var_dump($adminComment);

$jSon['error'] = $adminComment->getError();
