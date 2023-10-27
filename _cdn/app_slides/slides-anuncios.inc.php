<!--ANUNCIOS-->
<section class="anunciantes container m-bottom3">

    <header>
        <h1 class="title">Anunciantes</h1>
        <div class="form-barra"></div>
    </header>
    <div class="separator m-bottom3"></div>

    <div class="content">

        <?php
        $i = 0;
        $readAnuncio = new Read();
        $readAnuncio->FullRead("SELECT anuncio_title, anuncio_subtitle, anuncio_name, anuncio_url, anuncio_cover, anuncio_date FROM " . ANUNCIOS . " WHERE anuncio_status = 1 ORDER BY anuncio_date DESC LIMIT :limit", "limit=3");
        if (!$readAnuncio->getResult()):

            WSErro("Não Há Anúncios no Momento!", WS_INFOR);

        else:

            foreach ($readAnuncio->getResult() as $anuncio):

                extract($anuncio);
                ?>

                <article class="anunciante_item <?= ($i == 0 ? 'first' : ''); ?>">
                    <a target="_blank" title="<?= $anuncio_title; ?>" href="<?= $anuncio_url; ?>"><img title="<?= $anuncio_title; ?>" alt="[<?= $anuncio_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $anuncio_cover ?>" /></a>

                    <div class="anunciante_item_desc">
                        <h1><a target="_blank" rel="nofollow" title="<?= $anuncio_title; ?>" href="<?= $anuncio_url; ?>"><?= $anuncio_title; ?></a></h1>
                        <p class="tagline"><?= $anuncio_subtitle; ?></p>
                    </div>
                </article>

                <?php
                $i++;
            endforeach;
        endif;
        ?>
    </div>
</section>