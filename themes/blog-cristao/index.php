<!--CORPO DO SITE--> 
<main>

    <!--SLIDES-->
    <div class="slides">


        <div class="main_slides">
            <?php include '_cdn/app_slides/slides-fotos.inc.php'; ?>
        </div>

        <!--<div class="content">-->
        <!--                <div class="slides_item">
        
                            <img title="" alt="" src="Assets/Images/foto-slide.jpg">
        
                        </div>-->
        <!--<div class="clear"></div>-->
        <!--</div>-->

    </div>

    <!--ÚLTIMOS POSTS-->
    <section class="last_posts flex">

        <div class="last_posts_header">
            <h1 class="icon-post">Últimas Postagens</h1>    
        </div>


        <?php
        $readPosts = new Read;
        $readTotalPosts = new Read;
        $readPosts->FullRead('SELECT post_name, post_title, post_cover FROM ' . POSTS . ' WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit', 'limit=3');
        $readTotalPosts->FullRead('SELECT COUNT(post_id) AS TOTAL FROM ' . POSTS . ' WHERE post_status = 1');
        $TotalPosts = $readTotalPosts->getResult()[0]['TOTAL'];
        if (!$readPosts->getResult()):
            echo 'Nenhum post ainda!';
        else:
            foreach ($readPosts->getResult() as $post):
                extract($post);
                ?>
                <article class="last_posts_item flex-3">
                    <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                        <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><span class="image-background"><img title="<?= $post_title; ?>" alt="<?= $post_title; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>"></span></a>
                        <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><h2><?= $post_title; ?></h2></a>
                        <meta itemprop="width" content="300" />
                        <meta itemprop="height" content="180" />
                    </span>
                </article>
                <?php
            endforeach;

            echo ($TotalPosts > 3 ? '<a title="" href="' . HOME . '/posts/&theme=' . THEME.'" class="ver_mais">Ver mais</a>' : '');

        endif;
        ?>

    </section>

    <!--ÚLTIMOS VÍDEOS-->
    <!--
    <section class="last_videos flex">

        <div class="last_videos_header">
            <h1 class="icon-videos">Últimos Vídeos</h1>
        </div>

        <?php
        /*
        $readVideos = new Read;
        $readTotalVideos = new Read;
        $readVideos->FullRead('SELECT video_url FROM ' . VIDEOS . ' WHERE video_status = 1 ORDER BY video_date DESC LIMIT :limit', 'limit=3');
        $readTotalVideos->FullRead('SELECT COUNT(video_id) AS TOTAL FROM ' . VIDEOS . ' WHERE video_status = 1');
        $TotalVideos = $readTotalVideos->getResult()[0]['TOTAL'];

        if (!$readVideos->getResult()):
            echo 'Nenhum vídeo ainda!';
        else:
            foreach ($readVideos->getResult() as $video):
                extract($video);
                ?>
                <div class="last_videos_item flex-3">
                    <div class="video">
                        <div class="embed-container"><iframe src="https://www.youtube.com/embed/<?= $video_url; ?>" frameborder="0" allowfullscreen></iframe></div>
                    </div>
                </div>
                <?php
            endforeach;
            echo ($TotalVideos > 3 ? '<a title="" href="' . HOME . DIRECTORY_SEPARATOR . 'videos" class="ver_mais">Ver mais</a>' : '');
        endif;
        */
        ?>
-->

    </section>

    <section class="last_photos">
        <div class="last_photos_header">
            <h1 class="icon-photos">Últimas Fotos</h1>
        </div>    

        <?php
        if (INSTAGRAM_APP == '1' && INSTAGRAM_APP_FOTOS_HORIZONTAL_POST == '1'):
            ?>
            <div class="last_photos_item">
                <?php
                include './_cdn/app_sociais/plugin-instagram-horizontal.inc.php';
                ?>
            </div>
            <?php
        endif;
        ?>

        <a title="Ver mais" href="https://instagram.com/<?= URL_INSTAGRAM; ?>" target="_blank" class="ver_mais">Ver mais</a>
    </section>

    <!--ÚLTIMOS RECADOS-->
    <!--
    <section class="last_comments flex">
        <div class="last_comments_header">
            <h1 class="icon-comment">Últimos Recados</h1>
        </div>

        <?php
        /*
        $readTestimonials = new Read;
        $readTestimonials->FullRead("SELECT comentario_author, comentario_content FROM " . COMENTARIOS . " WHERE comentario_status = 1 AND comentario_type = :type ORDER BY comentario_date DESC LIMIT :limit", "type=recados&limit=3");
        if (!$readTestimonials->getResult()):
            WSErro("Nenhum Recado Ainda! Seja o primeiro e enviar um recado pra gente! ;)", "success");
            echo '<a class="ver_mais" style="text-align: left !important;" title="Envie-nos um recado" href="' . HOME . DIRECTORY_SEPARATOR . 'contato">Enviar Recado</a>';
        else:
            foreach ($readTestimonials->getResult() as $testimonial):
                extract($testimonial);
                ?>
                <article class="last_comments_item flex-3">
                    <p class="last_comments_item_text">"<?= $comentario_content; ?>"</p>
                    <h2 class="last_comments_item_author"><?= ucwords(strtolower($comentario_author)); ?></h2>
                </article>
                <?php
            endforeach;
            ?>
            <a class="ver_mais" title="Envie-nos um recado" href="' . HOME . DIRECTORY_SEPARATOR . ' contato">Enviar Recado</a>
        <?php
        endif;
        */
        ?>

    </section>
-->

    <!--ENDEREÇO IGREJA-->
    <div class="cta_address">
        <div class="cta_text">
            <div itemscope itemtype="https://schema.org/Organization">
                <meta itemprop="name" content="<?= NOME_RESPONSAVEL_EMPRESA; ?>">
                <p class="cta_address_call">Venha Adorar a Deus Conosco!</p>
                <p class="cta_address_culto_jovens">Culto dos Jovens - Todos os Sábados às 19:30 Hs</p>
                <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                    <p class="cta_address_culto_church_name"><?= NOME_EMPRESA; ?></p>
                    <p class="cta_address_culto_church_street" itemprop="streetAddress"><?= ENDERECO_EMPRESA; ?></p>
                    <p class="cta_address_culto_church_city"><?= CIDADE_EMPRESA . ' - ' . UF_EMPRESA; ?></p>
                    <meta itemprop="addressLocality" content="<?= CIDADE_EMPRESA; ?>">
                    <meta itemprop="addressRegion" content="<?= UF_EMPRESA; ?>">
                    <meta itemprop="addressCountry" content="<?= PAIS_EMPRESA; ?>">
                    <meta itemprop="postalCode" content="<?= CEP_EMPRESA; ?>">
                </div>
            </div>
        </div>
        <!--<img title="" alt="" src="Assets/Images/foto-igreja.jpg">-->
        <span class="cta_address_background"></span>
    </div>

    <!--VERSÍCULO-->
    <div class="versicle">
        <p class="versicle_text">“E disse-lhes: Ide por todo o mundo, pregai o evangelho a toda criatura”</p>
        <p class="versicle_reference">Marcos 15:16</p>
    </div>

</main>


