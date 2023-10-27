<?php
/*
 * Módulo: Card Last Comments (Últimos Comentários)
 * Author: Luiz Felipe C. Lopes
 * Date: 23/08/2018
 */
?>

<?php
$readComments = new Read;
//$readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_type = :type ORDER BY comentario_date DESC LIMIT 2", "type=post");
$readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_type = :type ORDER BY comentario_date DESC LIMIT 2", "type=recados");
?>

<article class="card_comments">
    <header>
        <h2 class="icon-comment">Últimos Comentários</h2>
    </header>

    <?php
    if (!$readComments->getResult()):

        echo '<article class="comments_moderate_item">Nenhum comentário ainda!</article>';

    else:
        foreach ($readComments->getResult() as $comment):
            extract($comment);
            ?>
            <article id="<?= $comentario_id; ?>"  <?= (!empty($comentario_resposta) ? '' : 'attr-parent="true"'); ?> class="comments_moderate_item js_item">
                <span class="cards_comments_avatar icon-user icon-notext"></span>

                <div class="cards_comments_info">
                    <h3><?= $comentario_author; ?></h3>
                    <p class="cards_comments_info_date">Em <?= date('d/m/Y H\hi', strtotime($comentario_date)); ?></p>
                    <p class="cards_comments_info_post"><a title="<?= BuscaRapida::buscarPost($comentario_post)['post_title']; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . BuscaRapida::buscarPost($comentario_post)['post_name']; ?>" target="_blank"><?= BuscaRapida::buscarPost($comentario_post)['post_title']; ?></a></p>
                    <div class="cards_comments_info_comment_link js_comment_container">

                        <p class="<?= (Check::countWords($comentario_content) < 20 ? 'ds-none' : ''); ?> cards_comments_info_comment js_comment_content js_hidden_comment"><?= Check::Words($comentario_content, 20); ?><span style="width:100%;" class="cards_comments_info_comment_more js_more_comments">mais</span></p>
                        <p class="<?= (Check::countWords($comentario_content) > 20 ? 'ds-none' : ''); ?> cards_comments_info_comment js_comment_content js_complete_comment"><?= $comentario_content; ?><span style="width:100%;" class="js_less_comments"></span></p>

                    </div>

                </div>

                <div class="cards_comments_buttons">


                    <div class="js_container_status">
                        <?php if ($comentario_status == 1): ?>
                            <a id="<?= $comentario_id; ?>" attr-status="<?= $comentario_status; ?>" attr-action="change_status_comment" title="Aprovado" href="#" class="btn btn-green radius icon-check js_status">Aprovado</a>
                        <?php else: ?>
                            <a id="<?= $comentario_id; ?>" attr-status="<?= $comentario_status; ?>" attr-action="change_status_comment" title="Pendente" href="#" class="btn btn-orange radius icon-check js_status">Pendente</a>
                        <?php endif; ?>
                    </div>


                    <a id="<?= $comentario_id; ?>" attr-action="set_update_comment" title="Editar" href="#" class="btn btn-blue radius icon-edit js_btn_edit">Editar</a>
                    <a id="<?= $comentario_id; ?>" attr-action="delete_comment" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>
                </div>

            </article>

            <?php
        endforeach;
//        echo '<a title="Ver todos" href="?exe=comments/index" class="icon-goto card_comments_see_all">Ver todos</a>';
        echo '<a title="Ver todos" href="?exe=comments/moderate" class="icon-goto card_comments_see_all">Ver todos</a>';
    endif;
    ?>

    <?php include 'modal_comment_form_edit.inc.php'; ?>
    <?php include 'confirmation_delete_message.inc.php'; ?>
</article>