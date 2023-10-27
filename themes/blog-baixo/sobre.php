<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box m-bottom3" id="j_content">

    <?php
    $readPag = new Read();
    $readPag->ExeRead(PAGINAS, "WHERE pagina_name = :name", "name={$Link->getLocal()[0]}");
    if (!$readPag->getResult()):
        WSErro("Ainda Não Existe Conteúdo Para Esta Página", WS_INFOR);
    else:
        extract($readPag->getResult()[0]);
        ?>

        <header class="bg-blue al-center no-margin header_page">
            <div class="content">
                <h1 class="caps-lock m-bottom1 fontsize1b"><?= $pagina_title; ?></h1>
                <p class="tagline"><?= $pagina_desc; ?></p>
                <div class="clear"></div>
            </div>
        </header>


        <div class="banner container bg-gray ds-none">
            <a title="" href="">
                <picture alt="Gabadi">
        <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                    <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                    <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                    <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                    <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                    <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                    <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                    <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/temaGabadi2.jpg" />
                </picture>
            </a>
        </div>    
        <div class="separator m-bottom3"></div>


        <div class="content content_sobre">

            <div class="page_text">
                <p> Olá, Seja muito bem-vindo ao Sacando Baixo! Eu me chamo Luiz Felipe Lopes, e neste blog vou abordar algumas sacadas rápidas que me ajudaram a melhorar no contra-baixo nesses últimos 12 anos de aventuras com os graves deste instrumento maravilhoso! E como é maravilhoso, ouvir esses graves, não é mesmo!? </p>
                <p>O blog irá conter algumas dicas rápidas de exercícios e técnicas que eu costumo praticar e me ajudam a tocar melhor. Serão postagens, covers, e alguns vídeos curtos e objetivos para que você possa praticar em casa. Quero deixar claro que neste blog eu falo de dicas que funcionaram para mim, de experiências que tive ao longo dos anos praticando tais exercícios. Fique a vontade para testar e deixe um comentário dizendo se funcionou para você! Ok?</p>
                <p>No mais.. um Grande Abraço e seja muito Bem-vindo!</p>

            </div>

        <?php
        endif;
        ?>


        <div class="clear"></div>
    </div>   
</section>
