<!DOCTYPE html>
<!--
Página: Moderate Comments (Moderação de Comentários)
Author: Luiz Felipe C. Lopes
Date: 30/08/2018
-->

<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);

//if ($id):

//    $Pager = new Pager("?exe=comments/moderate&id=" . $id . "&pag=");
    $Pager = new Pager("?exe=comments/moderate&pag=");
    $Pager->ExePager($getPage, 12);
    $readComments = new Read;
//    $readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_resposta IS NULL AND comentario_post = :post AND comentario_type = :type LIMIT :limit OFFSET :offset", "post={$id}&type=post&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    $readComments->FullRead("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC LIMIT :limit OFFSET :offset", "type=recados&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    if (!$readComments->getResult()):

        echo 'Nenhum comentário para este post ainda!';

    else:
        ?>

        <div class="comment_options comment_options_moderate">
            <form action="" method="post">
                <input type="hidden" name="action" value="filter_comments">
                <input type="hidden" name="post_id" value="<?= (!empty($id) ? $id : ''); ?>">
                <select id="js_filter_status" name="filter_status" class="js_filter_comments">
                    <option value="todos">Todos</option>
                    <option value="0">Pendente</option>
                    <option value="1">Aprovado</option>
                </select>
            </form>

            <!--<a title="" href="?exe=comments/index" class="btn btn-blue icon-check-square radius">Voltar</a>-->

        </div>

        <section class="comments js_comments_container">
            <h2>Moderar Comentários</h2>

            <div class="comments_moderate js_comments">

                <?php
                foreach ($readComments->getResult() as $comment):
                    extract($comment);
                    ?>

                    <article id="<?= $comentario_id; ?>" attr-parent="true" class="comments_moderate_item js_item">
                        <span class="comments_moderate_item_avatar icon-user icon-notext"></span>

                        <div class="comments_moderate_item_info js_comment_info_parent">
                            <h3><?= $comentario_author; ?></h3>
                            <p class="comments_moderate_item_info_date">Em <?= date('d/m/Y H\hi', strtotime($comentario_date)); ?></p>
                            <!--<p class="comments_moderate_item_info_post">Post: <?= BuscaRapida::buscarPost($comentario_post)['post_title']; ?></p>-->
                            <div class="comments_moderate_item_info_comment_link">
                                <p class="comments_moderate_item_info_comment js_comment_content"><?= $comentario_content; ?></p>
                            </div>
                        </div>

                        <div class="comments_moderate_item_buttons">

                            <div class="js_container_status">
                                <?php if ($comentario_status == 1): ?>
                                    <a id="<?= $comentario_id; ?>" attr-status="<?= $comentario_status; ?>" attr-action="change_status_comment" title="Aprovado" href="#" class="btn btn-green radius icon-check js_status">Aprovado</a>
                                <?php else: ?>
                                    <a id="<?= $comentario_id; ?>" attr-status="<?= $comentario_status; ?>" attr-action="change_status_comment" title="Pendente" href="#" class="btn btn-orange radius icon-check js_status">Pendente</a>
                                <?php endif; ?>
                            </div>

                            <!--<a id="<?= $comentario_id; ?>" attr-action="answer_comment" title="Responder" href="#" class="btn btn-gray radius icon-edit-square js_show_answers">Responder</a>-->
                            <a id="<?= $comentario_id; ?>" attr-action="set_update_comment" title="Editar" href="#" class="btn btn-blue radius icon-edit js_btn_edit">Editar</a>
                            <a id="<?= $comentario_id; ?>" attr-action="delete_comment" title="Excluir" href="#" class="btn btn-red radius icon-delete-circle js_btn_delete">Excluir</a>
                        </div>

                        <div class="comments_moderate_answers js_comments_answers">

                            <div class="js_comments_answers_itens"></div>

                            <form action="" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="action" value="create_comment">
                                <input type="hidden" name="comentario_type" value="post">
                                <input type="hidden" name="comentario_status" value="1">
                                <input type="hidden" name="comentario_post" value="<?= $comentario_post; ?>">
                                <input type="hidden" name="comentario_resposta" value="<?= $comentario_id; ?>">
                                <input type="hidden" name="comentario_author" value="<?= (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] : 'Luiz Felipe') . ' (Moderação)'; ?>">
                                <textarea rows="7" name="comentario_content" placeholder="Responda a um comentário"></textarea>
                                <div class="btn_container">
                                    <button class="btn btn-small btn-blue icon-check-square radius">Responder</button>
                                </div>
                            </form>
                            <span title="Ocultar" class="js_hidden_answer comments_moderate_answers_hidden">^</span>
                        </div>

                    </article>

                <?php endforeach; ?>

            </div>

            <div class="js_paginator" attr-action="paginator_comments" attr-post="<?= (!empty($id) ? $id : ''); ?>">
                <?php
//                $Pager->ExeFullPaginator("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_resposta IS NULL AND comentario_post = :post AND comentario_type = :type", "post={$id}&type=post");
                $Pager->ExeFullPaginator("SELECT comentario_id, comentario_author, comentario_date, comentario_post, comentario_content, comentario_status FROM " . COMENTARIOS . " WHERE comentario_resposta IS NULL AND comentario_type = :type ORDER BY comentario_date DESC", "type=recados");
                $Paginator = $Pager->getPaginator();

                if (!empty($Paginator)):
                    ?>
                    <div class="paginator_container">
                        <?php echo $Paginator; ?>
                    </div>
                <?php endif; ?>
            </div>

        </section>

    <?php
    endif;

//endif;
?>
<?php include 'inc/confirmation_delete_message.inc.php'; ?>
<?php include 'inc/loading_message.inc.php'; ?>
<?php include 'inc/modal_comment_form_edit.inc.php'; ?>


