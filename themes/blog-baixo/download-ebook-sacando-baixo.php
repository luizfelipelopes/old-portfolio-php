<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box m-bottom3" id="j_content">

    <?php
//    $readPag = new Read();
//    $readPag->ExeRead(PAGINAS, "WHERE pagina_name = :name", "name={$Link->getLocal()[0]}");
//    if (!$readPag->getResult()):
//        WSErro("Ainda Não Existe Conteúdo Para Esta Página", WS_INFOR);
//    else:
//        extract($readPag->getResult()[0]);
    ?>

    <header class="bg-blue al-center no-margin header_page">
        <div class="content">
            <h1 class="caps-lock m-bottom1 fontsize1b">Faça o download do seu e-book abaixo:</h1>
            <p class="tagline"></p>
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
            <p> Obrigado por se cadastrar na lista de novidades e receitas da Sacando Baixo. Sua inscrição foi confirmada e você já pode efetuar download do seu e-book gratuito!</p>
            <p><b>Vamos Entraar em contato em breve com muito mais artoigos e sacadas para você</b></p>

            <div class="container al-center m-bottom1 m-top1">
                <a class="btn btn-big btn-green ds-block">>>BAIXAR E-BOOK AGORA!<<</a>
            </div>

            <p>Atenciosamente Luiz Felipe!</p>

        </div>

        <?php
//        endif;
        ?>


        <div class="clear"></div>
    </div>   
</section>
