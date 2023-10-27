<footer class="container">

    <div class="container antirodape">

        <div class="content">
            <article class="m-bottom3 bloco_facebook">
                <header class="container m-bottom3">
                    <a target="_blank" href="https://facebook.com/<?= URL_FACEBOOK; ?>" title="Facebook da Nutri"><h1>Facebook da Nutri</h1></a>
                </header>
                <?php include '_cdn/app_sociais/plugin-facebook-timeline.php'; ?>
                <!--<img title="Face da Nutri" alt="[Face da Nutri]" src="<?= INCLUDE_PATH; ?>/img/face-da-nutri.png" />-->
            </article>

            <nav class="m-bottom3 al-center">
                <ul>
                    <li><a title="Início" href="<?= HOME . '/&theme=' . THEME; ?>">Início</a></li>
                    <li><a title="Sobre a Nutri" href="<?= HOME . '/sobre/&theme=' . THEME; ?>">Sobre a Nutri</a></li>
                    <li class="highlight_link"><a title="Treinamento" href="<?= HOME . '/treinamentoreal/&theme=' . THEME; ?>">Treinamento</a></li>
                    <li><a title="Dicas" href="<?= HOME . '/dicas/&theme=' . THEME; ?>">Dicas</a></li>
                    <li><a title="Receitas" href="<?= HOME . '/receitas/&theme=' . THEME; ?>">Receitas</a></li>
                    <li><a title="Depoimentos" href="<?= HOME . '/depoimentos/&theme=' . THEME; ?>">Depoimentos</a></li>
                    <li><a title="Contato" href="<?= HOME . '/contato/&theme=' . THEME; ?>">Contato</a></li>
                </ul>
            </nav>

            <article class="m-bottom3 bloco_instagram">
                <header class="container m-bottom3">
                    <a target="_blank" href="https://instagram.com/<?= URL_INSTAGRAM; ?>" title="Instagram da Nutri"><h1>Instagram da Nutri</h1></a>
                </header>
                <?php include '_cdn/app_sociais/plugin-instagram-vertical.inc.php'; ?>
                <!--<img title="Insta da Nutri" alt="[Insta da Nutri]" src="<?= INCLUDE_PATH; ?>/img/insta-da-nutri.png" />-->
            </article>

            <div class="clear"></div>
        </div>

    </div>

    <div class="container rodape">
        <div class="content">
            <p class="copy">Copyright&copy; - <?= (!empty($_SESSION['theme']) ? NOME_RESPONSAVEL_EMPRESA_THEME : NOME_RESPONSAVEL_EMPRESA); ?></p>
            <p class="assinatura">Feito Com <span class="img_coracao_rodape"></span> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Por <a target="_blank" title="" href="<?= LINK_DEVELOPER; ?>"><?= NAME_DEVELOPER; ?></a></p>
            <div class="clear"></div>
        </div>
    </div>

</footer>
<!--<script type="text/javascript" src="../_cdn/jquery.js"></script>
<script type="text/javascript" src="js/scripts.inc.js"></script>-->