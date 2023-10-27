<!DOCTYPE html>
<!--
<b>Vídeos:</b> Exibe os Vídeos do Site
Desenvolvido por Luiz Felipe Lopes - 28/12/2018 às 18:13hrs
-->

<!--CORPO DO SITE--> 
<main>

    <section class="videos flex">
        <header>
            <h1 class="icon-videos">Vídeos</h1>
            <p>É um fato conhecido de todos que um leitor se distrairá com o conteúdo de texto legível de uma página quando estiver examinando sua diagramação.</p>
        </header>

        <?php
        $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
        $Pager = new Pager(HOME . '/videos&pag=');
        $Pager->ExePager((!empty($getPage) ? $getPage : 1), 6);
        $readVideos = new Read;
        $readVideos->ExeRead(VIDEOS, "WHERE video_status = 1 ORDER BY video_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//                var_dump($readVideos->getResult());
        if (!$readVideos->getResult()):
            WSErro('Nenhum vídeo ainda!', 'info');
        else:
            foreach ($readVideos->getResult() as $video):
                extract($video);
                ?>

                <article class="videos_item flex-3">
                    <div class="video">
                        <div class="embed-container"><iframe src="https://www.youtube.com/embed/<?= $video_url; ?>" frameborder="0" allowfullscreen></iframe></div>
                    </div>
                </article>

            <?php endforeach; ?>

            <nav>
                <?php
                $Pager->ExePaginator(VIDEOS, "WHERE video_status = 1 ORDER BY video_date DESC");
                echo $Pager->getPaginator();
                ?>
            </nav>

        <?php endif; ?>

        <!--                <article class="videos_item flex-3">
                            <div class="video">
                                <div class="embed-container"><iframe src="https://www.youtube.com/embed/8EG8APC3oMk" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        </article>
                        
                        <article class="videos_item flex-3">
                            <div class="video">
                                <div class="embed-container"><iframe src="https://www.youtube.com/embed/_1hDl3-xh9Y" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        </article>
        
                        <article class="videos_item flex-3">
                            <div class="video">
                                <div class="embed-container"><iframe src="https://www.youtube.com/embed/Bp6Wx2HMLFw" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        </article>
                        
                        <article class="videos_item flex-3">
                            <div class="video">
                                <div class="embed-container"><iframe src="https://www.youtube.com/embed/8EG8APC3oMk" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        </article>
                        
                        <article class="videos_item flex-3">
                            <div class="video">
                                <div class="embed-container"><iframe src="https://www.youtube.com/embed/_1hDl3-xh9Y" frameborder="0" allowfullscreen></iframe></div>
                            </div>
                        </article>
        
                        <nav class="paginator">
                            <ul>
                                <li><a title="" href="#">Primeira</a></li>
                                <li><a title="" href="#">1</a></li>
                                <li><a title="" href="#">2</a></li>
                                <li><a title="" href="#">3</a></li>
                                <li><a title="" href="#">4</a></li>
                                <li><a title="" href="#">Última</a></li>
                            </ul>
                        </nav>-->

    </section>

</main>
