<!--SLIDES-->
<section class="main_slides bg-green container fl-left" itemscope itemtype="https://schema.org/Event">

    <?php
    if (SLIDES_APP_ULTIMOS == '1' || SLIDES_APP_BANNERS == '1' || SLIDES_APP_VIDEOS == '1'):
        ?>
        <div class="fundo"></div>
        <div class="slide_controll">
            <div class="slide_nav back round"><</div>
            <div class="slide_nav go round">></div>
        </div>
        <?php
    endif;
    ?>

    <?php
    $i = 0;

    if (SLIDES_APP_ULTIMOS == '1'):

        $readPost = new Read();
        $readPost->FullRead("SELECT post_title, post_name, post_cover, post_date, post_content FROM " . POSTS . " WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit", "limit=3");
        if (!$readPost->getResult()):
            WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);
        else:

            foreach ($readPost->getResult() as $post):

                extract($post);
                ?>

                <article class="slide_item slide_post <?= ($i == 0 ? 'first' : ''); ?>">
                    <a class="link" title="<?= $post_title; ?>" href="<?= (!empty($post_name) ? HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME : '#'); ?>">
                        <picture alt="[<?= $post_title; ?>]">
                            <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover ?>" />
                        </picture>
                    </a>

                    <div class="slide_post_desc">
                        <h1><a title="<?= $post_title; ?>" href="<?= (!empty($post_name) ? HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME : '#'); ?>" itemprop="name"><?= Check::Words($post_title, 15); ?></a></h1>
                        <small class="desc_date fl-left m-bottom1" itemprop="description"><?= date('d/m/Y \à\s H:i', strtotime($post_date)); ?></small>
                        <p class="tagline" itemprop="description"><?= Check::Words($post_content, 26); ?></p>
                    </div>

                </article>    


                <?php
                $i++;
            endforeach;
        endif;

    endif;

    if (SLIDES_APP_BANNERS == '1'):

        $readDestaque = new Read();
        $readDestaque->FullRead("SELECT destaque_title, destaque_subtitle, destaque_name, destaque_url, destaque_cover, destaque_date FROM " . DESTAQUES . " WHERE destaque_status = 1 ORDER BY destaque_date DESC LIMIT :limit", "limit=3");
        if ($readDestaque->getResult()):

            foreach ($readDestaque->getResult() as $destaque):

                extract($destaque);
                ?>

                <article class="slide_item slide_post <?= ($i == 0 ? 'first' : ''); ?>">
                    <a class="link" title="<?= $destaque_title; ?>" href="<?= (!empty($post_url) ? $post_url : '#'); ?>">
                        <picture alt="[<?= $destaque_title; ?>]">

                            <img title="<?= $destaque_title; ?>" alt="[<?= $destaque_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover ?>" />
                        </picture>
                    </a>

                    <div class="slide_post_desc">
                        <h1><a title="<?= $destaque_title; ?>" href="<?= (!empty($post_url) ? $post_url . '/&theme=' . THEME : '#'); ?>" itemprop="name"><?= Check::Words($destaque_title, 15); ?></a></h1>
                        <small class="desc_date fl-left m-bottom1" itemprop="description"><?= date('d/m/Y \à\s H:i', strtotime($destaque_date)); ?></small>
                        <p class="tagline" itemprop="description"><?= Check::Words($destaque_subtitle, 26); ?></p>
                    </div>

                </article>    

                <?php
                $i++;
            endforeach;
        endif;

    endif;

    if (SLIDES_APP_VIDEOS == '1'):

        $readVideo = new Read();
        $readVideo->FullRead("SELECT video_title, video_desc, video_url, video_date FROM " . VIDEOS . " WHERE video_status = 1 AND video_destaque = 1 ORDER BY video_date DESC LIMIT :limit", "limit=3");
        if ($readVideo->getResult()):

            foreach ($readVideo->getResult() as $video):

                extract($video);
                ?>

                <article class="slide_item slide_post <?= ($i == 0 ? 'first' : ''); ?>">
                    <a class="link" title="<?= $video_title; ?>" target="_blank" href="<?= (!empty($video_url) ? 'https://www.youtube.com/watch/?v=' . $video_url : '#'); ?>">
                        <article class="video_slide">
                            <div class="video">
                                <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/<?= (!empty($video_url) ? $video_url : '' ); ?>" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        </article>
                    </a>

                    <div class="slide_post_desc">
                        <h1><a title="<?= $video_title; ?>" target="_blank" href="<?= (!empty($video_url) ? 'https://www.youtube.com/watch/?v=' . $video_url : '#'); ?>" itemprop="name"><?= Check::Words($video_title, 15); ?></a></h1>
                        <small class="desc_date fl-left m-bottom1" itemprop="description"><?= date('d/m/Y \à\s H:i', strtotime($video_date)); ?></small>
                        <p class="tagline" itemprop="description"><?= Check::Words($video_desc, 26); ?></p>
                    </div>

                </article>    

                <?php
                $i++;
            endforeach;
        endif;

    endif;
    ?>

</section>