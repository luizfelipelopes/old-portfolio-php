<?php
//if (!isset($_SESSION['userlogin'])):
//    $sessao = new Session(1);
//else:
//    unset($_SESSION['useronline']);
//endif;
?>

<header class="container header_topo">
    <div class="container topo">
        <div class="content">
            <h1 class="ds-none"><?= SITENAME; ?></h1>

            <span class="fontzero fl-left main-logo main-logo-mobile"><a title="<?= SITENAME; ?>" href="<?= HOME . '/&theme=' . THEME; ?>"><?= SITENAME; ?></a></span>

            <div class="j_menu_mobile main_mob_nav main_menu_mobile bg-pink-dark fl-right round">
                <div class="listras">
                    <div class="linhas"></div>
                    <div class="linhas"></div>
                    <div class="linhas"></div>
                </div>
            </div>

            <nav class="main_nav">
                <ul>
                    <li><a title="Início" href="<?= HOME . '/&theme=' . THEME; ?>">Início</a></li>
                    <li><div class="menu_bola"><div class="bola"></div></div></li>
                    <li><a title="Sobre a Nutri" href="<?= HOME . '/sobre/&theme=' . THEME; ?>">Sobre a Nutri</a></li>
                    <li><div class="menu_bola"><div class="bola"></div></div></li>
                    <!--<li><a title="Atendimento" href="<?= HOME; ?>/atendimento">Atendimento</a></li>-->
                    <li class="highlight_link"><a title="Treinamento" href="<?= HOME . '/treinamentoreal/&theme=' . THEME; ?>">Treinamento</a></li>
                    <li><div class="menu_bola"><div class="bola"></div></div></li>
                    <li><a title="Dicas" href="<?= HOME . '/dicas/&theme=' . THEME; ?>">Dicas</a></li>
                    <li><div class="menu_bola"><div class="bola"></div></div></li>
                    <li><a title="Receitas" href="<?= HOME . '/receitas/&theme=' . THEME; ?>">Receitas</a></li>
                    <li><div class="menu_bola"><div class="bola"></div></div></li>
                    <li><a title="Depoimentos" href="<?= HOME . '/depoimentos/&theme=' . THEME; ?>">Depoimentos</a></li>
                    <li><div class="menu_bola"><div class="bola"></div></div></li>
                    <li><a title="Contato" href="<?= HOME . '/contato/&theme=' . THEME; ?>">Contato</a></li>
                </ul>
            </nav>
            <div class="clear"></div>
        </div>
    </div>
</header>

<?php if ($Link->getFile() != 'atendimento'): ?>
    <div class="search_content js_search">
        <form class="js_search_form" action="" method="post">
            <input type="hidden" name="action" value="pesquisar_termo">
            <input type="hidden" name="current-theme" value="<?= THEME;?>">
            <div class="js_search_icon search_icon">
                <p>Pesquisar</p>
                <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/lupa.fw.png">
            </div>
            <input type="text" name="pesquisa" placeholder="Pressione 'Enter' ">
        </form>
    </div>
<?php endif; ?>