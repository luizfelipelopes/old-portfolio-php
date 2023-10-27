<?php

/**
 * ajax_atualizar_status_post_realtime.inc.php - <b>Atualizar Status Post Real Time</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Atualização de Status do Post em Real Time
 */
$read = new Read;
$read->FullRead("SELECT post_id, post_status, post_date FROM " . POSTS . " WHERE post_status = 0");
if ($read->getResult()):

    $Hoje = new DateTime('now');
    $adminPost = new adminPost;

    foreach ($read->getResult() as $post):

        extract($post);

        $DataPublicacao = new DateTime($post_date);

        if ($DataPublicacao <= $Hoje): // Se chegou ou já passou dadata de publicação atualizar mudar o status do post como ativado
            $adminPost->ExeStatus($post_id, ['post_status' => '1']);
            $jSon['error'] = $adminPost->getError();
        endif;

    endforeach;
endif;
