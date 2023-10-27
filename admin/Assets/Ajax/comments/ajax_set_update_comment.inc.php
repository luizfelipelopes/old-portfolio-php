<?php

/**
 * ajax_set_update_comment.php - <b>Seta Dados Para Atualizar Comentário</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Setar Dados do Comentário a ser Atualizado no Form
 */

if(!empty($Post['id'])):
    
    $readComment = new Read;
    $readComment->FullRead("SELECT comentario_id, comentario_author, comentario_content FROM " . COMENTARIOS . " WHERE comentario_id = :id", "id={$Post['id']}");
    if($readComment->getResult()):
        $jSon['result'] = $readComment->getResult()[0];
    endif;
    
endif;