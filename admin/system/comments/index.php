<!DOCTYPE html>
<!--
Página: See Post Comments (Ver Comentários por Post)
Author: Luiz Felipe C. Lopes
Date: 30/08/2018
-->


<?php
$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$readPosts = new Read;
$Pager = new Pager("?exe=comments/index&pag=");
$Pager->ExePager($getPage, 12);
//$readPosts->FullRead("SELECT post_id, post_cover, post_title, post_date FROM " . POSTS . " WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
$readPosts->FullRead("SELECT p.post_id, p.post_cover, p.post_title, p.post_date, c.comentario_post FROM " . POSTS . " AS p, " . COMENTARIOS . " AS c WHERE p.post_id = c.comentario_post AND p.post_status = 1 GROUP BY p.post_id ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//var_dump($readPosts->getResult());
//die;
if (!$readPosts->getResult()):
    echo 'Nenhum post com comentários ainda!';
else:
    ?>

    <!--CONTEÚDO-->
    <div class="container content_variable">

        <div class="comment_options">
            <form action="" method="post">
                <input type="hidden" name="action" value="filter_posts_comments">
                <div class="container_search">
                    <input id="js_filter_search" type="text" name="search_post" placeholder="Pesquisar post" class="js_search_post_comment">
                    <span class="icon_search icon-search"></span>
                </div>

<!--                <select name="filter_post" class="col-50">
                    <option value="">Escolha um post</option>
                    <option value="0">Não confunda FOME com SEDE - Comer somente com FOME REAL</option>
                    <option value="1">Receitas</option>
                    <option value="2">Seção Categoria</option>
                </select>-->

            </form>
        </div>

        <section class="comments js_posts_comments">
            <h2>Comentários / Post</h2>


            <?php
            $readComments = new Read;
            $readLastComments = new Read;
            $readCommentsActive = new Read;
            $readCommentsInactive = new Read;

            foreach ($readPosts->getResult() as $post):
                extract($post);

                $readComments->FullRead("SELECT COUNT(*) AS TOTAL FROM " . COMENTARIOS . " WHERE comentario_post = :id", "id={$post_id}");
//                var_dump($readComments->getResult());

                if ($readComments->getResult() && $readComments->getResult()[0]['TOTAL'] > 0):
                    $readLastComments->FullRead("SELECT comentario_date FROM " . COMENTARIOS . " WHERE comentario_post = :id ORDER BY comentario_date DESC LIMIT 1", "id={$post_id}");
                    $readCommentsActive->FullRead("SELECT COUNT(*) AS ACTIVE FROM " . COMENTARIOS . " WHERE comentario_post = :id AND comentario_status = 1", "id={$post_id}");
                    $readCommentsInactive->FullRead("SELECT COUNT(*) AS INACTIVE FROM " . COMENTARIOS . " WHERE comentario_post = :id AND comentario_status = 0", "id={$post_id}");
                    $Total = $readComments->getResult()[0]['TOTAL'];

                    $LastCommentDate = $readLastComments->getResult()[0]['comentario_date'];
                    $CommentsActive = $readCommentsActive->getResult()[0]['ACTIVE'];
                    $CommentsInactive = $readCommentsInactive->getResult()[0]['INACTIVE'];
                    ?>

            <a id="<?=$post_id;?>" class="comments_link js_item" title="" href="?exe=comments/moderate&id=<?= $post_id; ?>">

                        <article class="comments_item">

                            <div class="comments_item_image image_preview">
                                <img title="" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                            </div>

                            <div class="comments_item_info">
                                <h3><?= $post_title; ?></h3>
                                <span class="comments_item_date icon-clock">Último comentário: <?= date('d/m/Y \à\s H:i \h', strtotime($LastCommentDate)); ?></span>

                                <div class="comments_item_analytics_group">
                                    <span class="comments_item_analytics_group_total icon-comment"><strong><?= $Total; ?></strong> comentários</span>
                                    <span class="comments_item_analytics_group_pending icon-alert-triangle"><strong><?= $CommentsInactive; ?></strong> pendentes</span>
                                    <span class="comments_item_analytics_group_active icon-check"><strong><?= $CommentsActive; ?></strong> ativos</span>
                                </div>
                            </div>

                        </article>
                    </a>
                <?php endif; ?>
            <?php endforeach; ?>

            <div class="js_paginator" attr-action="paginator_posts_comments">
                <?php
                $Pager->ExeFullPaginator("SELECT p.post_id, p.post_cover, p.post_title, p.post_date, c.comentario_post FROM " . POSTS . " AS p, " . COMENTARIOS . " AS c WHERE p.post_id = c.comentario_post AND p.post_status = 1 GROUP BY p.post_id ORDER BY post_date DESC");
                $Paginator = $Pager->getPaginator();

                if (!empty($Paginator)):
                    ?>
                    <div class="paginator_container">
                        <?php echo $Paginator; ?>
                    </div>
                <?php endif; ?>
            </div>

        </section>

    </div>
<?php endif; ?>

