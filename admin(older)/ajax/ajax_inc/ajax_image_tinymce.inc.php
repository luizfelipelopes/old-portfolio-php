<?php

/**
 * ajax_image_tinymce.php - <b>IMAGE TINYMCE</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Controle de Imagens do Tinymce
 */
$read = new Read;
$read->FullRead("SELECT post_content FROM " . POSTS . " WHERE post_id = :id", "id={$Post['id']}");
if ($read->getResult()):
    $jSon['error'] = ["Não há posts cadastrados", "WS_INFOR"];
    else:
    $jSon['content'] = $read->getResult()[0]['post_content'];    
    
endif;

        
        var_dump($Conteudo);
//        $jSon['error'] = $delete->getError();
