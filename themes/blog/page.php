<section class="container posts_box m-bottom3" id="j_content">


    <?php
    $readPage = new Read;
    $readPage->ExeRead(PAGINAS, "WHERE pagina_name = :page", "page={$Url[0]}");

    if (!$readPage->getResult()):
        header('Location: ' . HOME . DIRECTORY_SEPARATOR . '404.php&link=' . $Url[0]);
    else:
        extract($readPage->getResult()[0]);
        ?>

        <header class="bg-blue_marinho al-center header_page container">
            <div class="content">
                <h1 class="caps-lock m-bottom1 fontsize1b"><?= $pagina_title; ?></h1>
                <div class="clear"></div>
            </div>
        </header>

        <?php if (!empty($pagina_cover)): ?>
            <div class="banner container bg-body">
                <a title="" href="">
                    <picture alt="[<?= $pagina_title; ?>]">
                        <img title="<?= $pagina_title; ?>" alt="[<?= $pagina_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $pagina_cover; ?>" />
                    </picture>
                </a>
            </div>
        <?php endif; ?>
    
        <div class="separator m-bottom3"></div>

        <div class="content content_sobre">

            <div class="page_text">
                <?= $pagina_content; ?>
            </div>

            <div class="clear"></div>
        </div>   

    <?php
    endif;
    ?>


</section>
