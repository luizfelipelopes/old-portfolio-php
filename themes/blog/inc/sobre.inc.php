<!--SOBRE-->
<article class="sobre radius m-top1 fl-right">
    <div class="content">
        <header class="m-bottom3">
            <h1 class="title no-margin fontsize1b">Sobre a <span>Autora</span></h1>
            <div class="form-barra"></div>
        </header>


        <div class="imagem">
            <img class="round" title="Nilma Nayara Neves" alt="[Nilma Nayara Neves]" src="<?= INCLUDE_PATH ?>/img/foto-autora.jpg"/>
        </div>




        <div class="separator m-bottom3"></div>



        <?php
        $read = new Read();
        $read->ExeRead(PAGINAS, "WHERE pagina_name = :pagina", "pagina=sobre");
        if (!$read->getResult()):

            WSErro("Desculpe! Não Existe Nenhum Conteúdo para esta página", WS_INFOR);

        else:
            extract($read->getResult()[0]);
        ?>

        <p><?= Check::Words($pagina_content, 50); ?></p>

        <?php
//
        endif;
        ?>
        <a class="mais m-top3" title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'sobre' . '/&theme=' . THEME; ?>">Ver mais...</a>

        <div class="clear"></div>
    </div>
</article>