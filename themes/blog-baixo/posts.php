<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box" id="j_content">


    <header class="bg-blue al-center header_page">
        <div class="content">
            <h1 class="caps-lock m-bottom1 fontsize1b">Sacadas</h1>
            <p class="tagline fontsize1 font-light">Confira as Nossas Sacadas nos Graves!</p>
            <div class="clear"></div>
        </div>
    </header>
    <div class="separator m-bottom3"></div>


    <div class="content content_category">

        <?php
        $dateHoje = date("Y-m-d H:i:s");
        $read = new Read();
        $read->ExeRead(POSTS, "WHERE post_status = 1 AND (post_date < :date OR post_date = :date)  ORDER BY post_date DESC", "date={$dateHoje}");
        if (!$read->getResult()):
            WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);

        else:

            foreach ($read->getResult() as $post):
                extract($post);
                ?>


                <article class="post_item box m-bottom3 post_box posts_lista">
                    <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                        <img class="m-bottom1" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                        <h1><?= $post_title; ?></h1>
                    </a>
                    <?php
                    $readCat = new Read();
                    $readCat->ExeRead(CATEGORIAS, "WHERE category_id = :category", "category={$post_category}");
                    if($readCat->getResult()):
                        
                    
                    ?>

                    <span><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?> Em <?= $readCat->getResult()[0]['category_title']; ?></time></span>
                    <?php endif; ?>
                </article>


                <?php
            endforeach;

        endif;
        ?>


        <div class="clear"></div>
    </div>   
</section>
