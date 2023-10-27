<?php
$post_id = null;

$readPost = new Read;
$readPost->FullRead("SELECT post_id FROM " . POSTS . " WHERE post_name = :name", "name={$Url[0]}");

if ($readPost->getResult()):
    $post_id = $readPost->getResult()[0]['post_id'];
endif;

$read = new Read();
$read->ExeRead(COMENTARIOS, "WHERE (comentario_resposta = 0 OR comentario_resposta IS NULL) AND comentario_status = :status AND comentario_post = :postid ORDER BY comentario_date DESC", "status=1&postid={$post_id}");

$ReadCount = new Read;
$ReadCount->FullRead("SELECT count(comentario_id) AS TOTAL FROM " . COMENTARIOS . " WHERE comentario_status = :status AND comentario_post = :postid", "status=1&postid={$post_id}");
?>

<section class="js_comentario_post comentario_post" attr-post="<?= $post_id; ?>">

    <div class="media_avaliacao <?= (AVALIACAO_MEDIA == '0' ? 'ds-none' : ''); ?>">

        <?php
        $readMedia = new Read;
        $readMedia->FullRead("SELECT COUNT(comentario_id) AS TOTAL, SUM(comentario_avaluation) AS SOMA FROM " . COMENTARIOS . " WHERE comentario_post = :id AND comentario_status = 1 AND (comentario_resposta IS NULL OR comentario_resposta = 0)", "id={$post_id}");
        $Media = ($readMedia->getResult()[0]['SOMA'] == 0 || $readMedia->getResult()[0]['TOTAL'] == 0 ? 0 : $readMedia->getResult()[0]['SOMA'] / $readMedia->getResult()[0]['TOTAL']);
        ?>
        <h1>Avaliaçao Média</h1>
        <div class="media_numero"><?= number_format($Media, 1, ",", "."); ?></div>
        <img class="avaliacao" title="" alt="" src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . ($Media < 2 ? 'img/1-estrela.png' : ($Media >= 2 && $Media < 3 ? 'img/2-estrelas.png' : ($Media >= 3 && $Media < 4 ? 'img/3-estrelas.png' : ($Media >= 4 && $Media < 5 ? 'img/4-estrelas.png' : ($Media >= 5 ? 'img/5-estrelas.png' : ''))))); ?>" />

    </div>

    <h1 class="fontsize1 caps-lock font-bold m-bottom3 js_total_comentario"><?= $ReadCount->getResult()[0]['TOTAL'] . ' ' . ($ReadCount->getResult()[0]['TOTAL'] > 1 ? 'Comentários' : 'Comentário'); ?> </h1>

    <div class="js_content_form">
        <?php
        if (!$read->getResult()):

            WSErro("Seja o primeiro a comentar este post!", WS_INFOR);
            ?>

            <div class="js_append_comment"></div>

            <?php
        else:
            $readResposta = new Read;
            $view = new View();
            $tpl_comment = $view->Load('comentario');
            ?>

            <div class="js_append_comment">
                <?php
                foreach ($read->getResult() as $comment):
                    ?>
                    <div class="comment_reply bd-bottom1 container m-bottom3">
                        <?php
                        $comment['INCLUDE_PATH'] = INCLUDE_PATH;
                        $comment['comentario_datetime'] = date('Y-m-d');
                        $comment['comentario_avatar'] = ((AVATAR == '1' && FORM_FOTO == '1') || (AVATAR == '1' && FORM_FOTO == '0') ? '<img class="avatar" title="" alt="" src="' . (!empty($comment['comentario_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $comment['comentario_cover'] : INCLUDE_PATH . '/img/perfil-avatar.png') . '"/>' : '');
                        $comment['comentario_author'] = (FORM_NOME == '1' ? '<h1 class="nome_comentario" itemprop="author">' . $comment['comentario_author'] . '</h1>' : '<div class="m-bottom1"></div>');
                        $comment['comentario_avaliacao'] = (AVALIACAO == '1' ? ($comment['comentario_avaluation'] == '1' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/1-estrela.png" />' : ($comment['comentario_avaluation'] == '2' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/2-estrelas.png" />' : ($comment['comentario_avaluation'] == '3' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/3-estrelas.png" />' : ($comment['comentario_avaluation'] == '4' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/4-estrelas.png" />' : ($comment['comentario_avaluation'] == '5' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/5-estrelas.png" />' : ''))))) : '');
                        $comment['comentario_responder'] = (FORM_RESPOSTA_PAI == '1' ? '<span class="resposta js_responder pointer">Responder</span>' : '');
                        $comment['data_formatada'] = date('d/m/Y \à\s H:i', strtotime($comment['comentario_date']));
                        $comment['comentario_form_author'] = (isset($_SESSION['clientelogin']['cliente_name']) ? $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] . ' - (Admin)' : ''));
                        $comment['post_id'] = $post_id;

                        if (strlen($comment['comentario_cidade']) <= 3):

                            $read = new Read();
                            $read->ExeRead("app_cidades", "WHERE cidade_id = :cidadeid", "cidadeid={$comment['comentario_cidade']}");

                            if ($read->getResult()):
                                $comment['comentario_cidade'] = $read->getResult()[0]['cidade_nome'] . '-' . $read->getResult()[0]['cidade_uf'];
                            endif;


                        endif;
                        $view->Show($comment, $tpl_comment);

                        $readResposta->ExeRead(COMENTARIOS, "WHERE comentario_resposta = :id AND comentario_status = 1", "id={$comment['comentario_id']}");
                        if ($readResposta->getResult()):

                            $tpl_resposta = $view->Load('resposta');

                            foreach ($readResposta->getResult() as $resposta):

                                $resposta['INCLUDE_PATH'] = INCLUDE_PATH;
                                $resposta['comentario_pai'] = $comment['comentario_id'];
                                $resposta['comentario_resposta'] = $resposta['comentario_id'];
                                $resposta['comentario_avatar'] = ((AVATAR == '1' && FORM_FOTO == '1') || (AVATAR == '1' && FORM_FOTO == '0') ? '<img class="avatar" title="" alt="" src="' . (!empty($resposta['comentario_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $resposta['comentario_cover'] : INCLUDE_PATH . '/img/perfil-avatar.png') . '"/>' : '');
                                $resposta['comentario_author'] = (FORM_NOME == '1' ? '<h1 class="nome_comentario" itemprop="author">' . $resposta['comentario_author'] . '</h1>' : '<div class="m-bottom1"></div>');
//                            $resposta['comentario_avaliacao'] = (AVALIACAO == '1' ? ($resposta['comentario_avaluation'] == '1' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/1-estrela.png" />' : ($resposta['comentario_avaluation'] == '2' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/2-estrelas.png" />' : ($resposta['comentario_avaluation'] == '3' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/3-estrelas.png" />' : ($resposta['comentario_avaluation'] == '4' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/4-estrelas.png" />' : ($resposta['comentario_avaluation'] == '5' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/5-estrelas.png" />' : ''))))) : '');
                                $resposta['comentario_responder'] = (FORM_RESPOSTA_FILHO == '1' ? '<span class="resposta js_responder pointer">Responder</span>' : '');
                                $resposta['data_formatada'] = date('d/m/Y \à\s H:i', strtotime($resposta['comentario_date']));
                                if (strlen($resposta['comentario_cidade']) <= 3):

                                    $read = new Read();
                                    $read->ExeRead("app_cidades", "WHERE cidade_id = :cidadeid", "cidadeid={$resposta['comentario_cidade']}");

                                    if ($read->getResult()):
                                        $resposta['comentario_cidade'] = $read->getResult()[0]['cidade_nome'] . '-' . $read->getResult()[0]['cidade_uf'];
                                    endif;


                                endif;

                                $view->Show($resposta, $tpl_resposta);

                            endforeach;


                        endif;
                        ?>
                        <div class="js_append_resposta"></div>
                        <div class="js_append_form_comentario"></div>
                    </div>
                    <?php
                endforeach;
                ?>
            </div>

        <?php
        endif;
        ?>

        <form class="container form_comentario_avaliacao"  action="" method="post">
            <div class="trigger-box-suspenso"></div>
            <input type="hidden" name="action" value="create_comentario">
            <input type="hidden" name="comentario_post" value="<?= $post_id; ?>" />
            <input type="hidden" name="comentario_status" value="<?= (MODERADOR == '0' ? '1' : '0'); ?>" />
            <input type="hidden" name="comentario_type" value="post" />

            <?php
            if (!isset($_SESSION['clientelogin']) && !isset($_SESSION['userlogin'])):


                if (!empty($_SESSION['usercomentario'])):
                    ?>

                    <input type="hidden" name="comentario_author" value="<?= (!empty($_SESSION['usercomentario']['comentario_author']) && FORM_NOME == '1' ? $_SESSION['usercomentario']['comentario_author'] : null); ?>" />
                    <input type="hidden" name="comentario_email" value="<?= (!empty($_SESSION['usercomentario']['comentario_email']) && FORM_EMAIL == '1' ? $_SESSION['usercomentario']['comentario_email'] : null); ?>" />
                    <input type="hidden" name="comentario_cover" value="<?= (!empty($_SESSION['usercomentario']['comentario_cover']) && FORM_FOTO == '1' ? $_SESSION['usercomentario']['comentario_cover'] : null); ?>" />
                    <input type="hidden" name="comentario_cidade" value="<?= (!empty($_SESSION['usercomentario']['comentario_cidade']) && FORM_CIDADE == '1' ? $_SESSION['usercomentario']['comentario_cidade'] : null); ?>" />
                    <input type="hidden" name="comentario_avaluation" value="<?= (!empty($_SESSION['usercomentario']['comentario_avaluation']) && AVALIACAO == '1' ? $_SESSION['usercomentario']['comentario_avaluation'] : null); ?>" />

                    <?php
                else:
                    ?>

                    <label class="<?= (FORM_FOTO == '1' ? '' : 'ds-none');
                    ?>">	
                        <span>Foto:</span>			
                        <input type="file" name="comentario_cover" <?= (FORM_FOTO == '1' ? 'required' : ''); ?>/>
                    </label>

                    <label class="<?= (FORM_NOME == '1' ? '' : 'ds-none'); ?>">	
                        <span>Nome:</span>			
                        <input type="text" name="comentario_author" <?= (FORM_NOME == '1' ? 'required' : ''); ?>/>
                    </label>

                    <label class="<?= (FORM_EMAIL == '1' ? '' : 'ds-none'); ?>">	
                        <span>Email:</span>			
                        <input type="email" name="comentario_email" <?= (FORM_EMAIL == '1' ? 'required' : ''); ?>/>
                    </label>

                    <label class="<?= (FORM_CIDADE == '1' ? '' : 'ds-none'); ?>">	
                        <span>Cidade:</span>			
                        <input type="text" placeholder="Ex: Diamantina - MG" name="comentario_cidade" <?= (FORM_CIDADE == '1' ? 'required' : ''); ?>/>
                    </label>


                <?php
                endif;
            else:
                ?>
                <input class="<?= (FORM_NOME == '1' ? '' : 'ds-none') ?>" type="hidden" name="comentario_author" value="<?= (isset($_SESSION['clientelogin']['cliente_name']) ? $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] . ' - (Admin)' : '')); ?>" />
                <input class="<?= (FORM_FOTO == '1' ? '' : 'ds-none') ?>" type="hidden" name="comentario_cover" value="<?= (isset($_SESSION['clientelogin']['cliente_cover']) ? $_SESSION['clientelogin']['cliente_cover'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_foto'] : '')); ?>" />
                <input class="<?= (FORM_EMAIL == '1' ? '' : 'ds-none') ?>" type="hidden" name="comentario_email" value="<?= (isset($_SESSION['clientelogin']['cliente_email']) ? $_SESSION['clientelogin']['cliente_email'] : $_SESSION['userlogin']['user_email']); ?>" />

                <?php
                if (FORM_CIDADE == '1'):

                    if (isset($_SESSION['clientelogin']['cliente_id'])):

                        $readCidade = new Read;
                        $readCidade->ExeRead("app_cidades", "WHERE cidade_id = :id", "id={$_SESSION['clientelogin']['cliente_cidade']}");
                        if ($readCidade->getResult()):
                            ?>
                            <input type="hidden" name="comentario_cidade" value="<?= $readCidade->getResult()[0]['cidade_nome'] . '-' . $readCidade->getResult()[0]['cidade_uf']; ?>" />
                            <?php
                        endif;

                    else:
                        ?>
                        <input type="hidden" name="comentario_cidade" value="<?= 'Diamantina - MG' ?>" />
                    <?php
                    endif;
                endif;
                ?>

            <?php endif; ?>

            <label>	
                <span>Mensagem:</span>			
                <textarea type="text" name="comentario_content" rows="8" cols="30" required></textarea>
            </label>

            <?php if (!isset($_SESSION['userlogin']) && AVALIACAO == '1'): ?>             

                <div class="form-check">
                    <span class="form-field">Avalie Este Conteúdo</span>
                    <label class="ds-block"><input type="radio" name="comentario_avaluation" value="1" required>1</label>
                    <label class="ds-block"><input type="radio" name="comentario_avaluation" value="2">2</label>
                    <label class="ds-block"><input type="radio" name="comentario_avaluation" value="3">3</label>
                    <label class="ds-block"><input type="radio" name="comentario_avaluation" value="4">4</label>
                    <label class="ds-block"><input type="radio" name="comentario_avaluation" value="5">5</label>
                </div>

            <?php endif; ?>

            <input class="btn btn-green" type="submit"  value="Enviar" />
            <div title="Carregando" class="load fl-right m-top1"></div>
        </form>

    </div>

    <div class="clear"></div>
</section>
