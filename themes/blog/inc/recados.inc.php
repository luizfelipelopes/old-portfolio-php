<!--RECADOS-->
<section class="container recados">

    <div class="content">
        <header>
            <h1 class="title no-margin">Recados</h1>
            <div class="form-barra"></div>
        </header>
        <div class="separator m-bottom3"></div>


        <?php
        $readRecado = new Read();
        $readRecado->ExeRead("gabadi_comentarios", "WHERE comentario_status = 1 AND comentario_type = :type LIMIT :limit OFFSET :offset", "type=recados&limit=3&offset=0");
        if (!$readRecado->getResult()):
            WSErro("Ainda não existem Comentários! Seja o primeiro a nos deixar um recado!", WS_INFOR);

        else:

            foreach ($readRecado->getResult() as $recado):
                extract($recado);
                ?>

                <article class="recado_item box">
                    <img height="90" title="<?= $comentario_author; ?>" alt="[<?= $comentario_author; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $comentario_cover; ?>" />
                    <div class="comment">
                        <p><?= $comentario_content; ?></p>
                        <h1><?= $comentario_author; ?>, <?= $comentario_cidade; ?></h1>
                    </div>
                </article>


                <?php
            endforeach;

        endif;
        ?>

        <div class="content"></div>
    </div>
</section>