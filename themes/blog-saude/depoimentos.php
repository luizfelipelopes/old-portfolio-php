<div itemscope itemtype="https://schema.org/Product">
    <meta itemprop="name" content="Pacote Emagrecimento Total">

    <section class="container section_depoimento">
        <header class="container">
            <div class="content">
                <h1>Depoimentos</h1>
                <p>Veja o que eles tem a dizer sobre a Nutri e Coach Nilma Nayara.</p>
                <div class="clear"></div>
            </div>
        </header>

        <span itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
            <meta itemprop="ratingValue" content="5.0">
            <meta itemprop="reviewCount" content="10">
        </span>

        <div class="content">
            <div class="depoimentos_video container flex">


                <?php
                $readVideos = new Read;
                $readVideos->ExeRead(DEPOIMENTOS, "WHERE depoimento_status = 1 AND depoimento_type = :type ORDER BY depoimento_order ASC LIMIT 6", "type=video");
                if ($readVideos->getResult()):
                    foreach ($readVideos->getResult() as $video):
                        extract($video);
                        ?>

                        <article class="depoimento_video flex-3" itemprop="review" itemscope itemtype="https://schema.org/Review">
                            <div class="content">
                                <div class="video-large no-margin">
                                    <div class="video no-margin">
                                        <div class="ratio js_media js_video_depoimento1" itemprop="video" itemscope itemtype="https://schema.org/VideoObject">
                                            <iframe class="media" itemprop="thumbnailUrl" src="https://www.youtube.com/embed/<?= $depoimento_video; ?>" frameborder="0" allowfullscreen></iframe>
                                            <meta itemprop="name" content="<?= $depoimento_name; ?>">
                                            <meta itemprop="description" content="<?= $depoimento_name . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf']; ?>">
                                            <meta itemprop="uploadDate" content="<?= date('Y-m-d H:i:s', strtotime($depoimento_date)); ?>">
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                <h2><?= $depoimento_name; ?> - <?= BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf'] ?></h2>
                                <meta itemprop="author" content="<?= $depoimento_name; ?>">
                                <div class="clear"></div>
                            </div>
                        </article>

                        <?php
                    endforeach;
                endif;
                ?>

            </div>

            <div class="dobra_depoimentos_texto container flex">

                <!--<div class="content">-->

                <!--<div class="container flex">-->

                <?php
                $readTextos = new Read;
                $readTextos->ExeRead(DEPOIMENTOS, "WHERE depoimento_status = 1 AND depoimento_type = :type ORDER BY depoimento_order ASC LIMIT 2", "type=texto");
                if ($readTextos->getResult()):
                    foreach ($readTextos->getResult() as $texto):
                        extract($texto);
                        ?>


                        <article class="depoimento_texto flex-2" itemprop="review" itemscope itemtype="https://schema.org/Review">
                            <div class="content">
                                <img itemprop="image" title="<?= $depoimento_name; ?>" alt="[<?= $depoimento_name; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $depoimento_cover; ?>">
                                <div class="descricao_depoimento">
                                    <p>“<?= $depoimento_content; ?>”.</p>
                                    <h2 class="font-bold"><?= $depoimento_name; ?> - <?= BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf'] ?></h2>
                                    <meta itemprop="author" content="<?= $depoimento_name; ?>">
                                    <meta itemprop="description" content="<?= $depoimento_name . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf']; ?>">
                                </div>
                                <div class="clear"></div>
                            </div>
                        </article>

                        <?php
                    endforeach;
                endif;
                ?>

            </div>

            <a title="Eu Quero! Preciso Emagrecer" href="<?= HOME . DIRECTORY_SEPARATOR . 'treinamentoreal' . '/&theme=' . THEME ?>" class="btn btn-green radius">Eu Quero! Preciso Emagrecer</a>

            <div class="clear"></div>
        </div>

    </section>
</div>
