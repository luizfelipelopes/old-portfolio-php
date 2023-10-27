<?php echo "<script> fbq('track', 'Lead'); </script>"; ?>

<div class="container posts posts_box">
    <header class="sectiontitle sectiontitle-nomargin bg-blue">    
        <div class="content">

            <h1 class="al-center">Obrigado!</h1>
            <div class="al-center">
                <img width="40" src="<?=INCLUDE_PATH;?>/img/icon-check.png" alt="[Sua Mensagem foi Enviada com Sucesso!]" title="Sua Mensagem foi Enviada com Sucesso!" />
            </div>
            <p class="tagline al-center">Sua Mensagem foi Enviada com Sucesso! A partir de agora Você será um baixista por dentro das Nossas Novidades! Muito Bem-vindo e #BoraGroovar! =)</p>
            
            <div class="clear"></div>
        </div>
    </header>      


    <section class="container bg-body">
        <div class="content">
            <header class="sectiontitle">
                <h1>Veja Mais Sacadas Que Podem ser do Seu Interesse:</h1>
            </header>

            <?php
            $read = new Read();
            $read->ExeRead(POSTS, "WHERE post_status = 1 ORDER BY rand()");
            if (!$read->getResult()):

                WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);

            else:
                foreach ($read->getResult() as $posts):
                    ?>

                    <article class="post_item box m-bottom3 post_box post_relacionado">
                        <a title="<?= $posts['post_title']; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $posts['post_name']; ?>">
                            <img title="<?= $posts['post_title']; ?>" alt="[<?= $posts['post_title']; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $posts['post_cover']; ?>" />
                            <h1><?= $posts['post_title']; ?></h1>
                        </a>
                        <?php
                        $readCat = new Read();
                        $readCat->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$posts['post_category']}");
                        if ($readCat->getResult()):
                            ?>

                            <span><?= $readCat->getResult()[0]['category_title'] ?></span>
                        <?php endif;
                        ?>
                    </article>


                    <?php
                endforeach;

            endif;
            ?>

            <div class="clear"></div>
        </div>
    </section>



</div>
