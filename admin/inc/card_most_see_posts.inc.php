<?php
/*
 * Módulo: Card Most See Posts (Posts Mais Vistos)
 * Author: Luiz Felipe C. Lopes
 * Date: 23/08/2018
 */
?>

<?php
$readPosts = new Read;
$readPosts->FullRead("SELECT post_id, post_title, post_name, post_cover, post_date, post_author, post_views FROM " . POSTS . " WHERE post_status = 1 ORDER BY post_views DESC LIMIT 4");
?>

<article class="card_most_seen_posts" <?= (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] == '1' || COMENTARIOS_ADMIN == '0' ? 'style="flex-basis:100% !important; padding-bottom: 30px !important;"' : ''); ?>>
    <header>
        <h2>Posts Mais Vistos</h2>
        <p>Confira quais são os seus posts mais vistos</p>
    </header>

    <?php
    if (!$readPosts->getResult()):
        echo 'Nenhum post ainda!';
    else:
        foreach ($readPosts->getResult() as $post):
            extract($post);
            ?>
            <article>
                <div class="card_most_seen_posts_img image_preview">
                    <img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                </div>
                <div class="card_most_seen_posts_info">
                    <h3 class="card_most_seen_posts_title">Post: <?= $post_title; ?></h3>
                    <p class="card_most_seen_posts_date">Em <?= date('d/m/Y \à\s H\hi', strtotime($post_date)); ?> por <?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?></p>
                    <div class="card_most_seen_posts_views_link">
                        <p class="card_most_seen_posts_views"><?= $post_views; ?> Visitas!</p>
                        <a title="Ver post" target="_blank" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>" class="icon-goto">Ver Post</a>
                    </div>
                </div>
            </article>

            <?php
        endforeach;
    endif;
    ?>

    <!--<a title="Ver todos" href="#" class="card_most_seen_posts_see_all icon-goto">Ver todos</a>-->

</article>