<?php
//if ($Link->getLocal()[0] != 'post'):

//if(!$Link->getLink()):
    $sessao = new Session(1);
//endif;

//endif;
//var_dump($_SESSION);
?>
<link id="j_base" rel="<?= HOME; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'work' . DIRECTORY_SEPARATOR . 'ProjetoGabadi2'; ?>">
<header>
    <h1 class="fontzero"><?= SITENAME; ?></h1>

    <!--HEADER ICONS SOCIAL MEDIA E RADIO--> 
    <div class="header_icon_radio bg-gray-l">
        <div class="icons_group">
            <a title="Facebook" href="https://www.facebook.com/<?= URL_FACEBOOK; ?>/" target="_blank" class="icon-facebook"></a>
            <a title="Instagram" href="https://www.instagram.com/<?= URL_INSTAGRAM; ?>/" target="_blank" class="icon-instagram"></a>
            <a title="Youtube" href="https://www.youtube.com/channel/<?= URL_YOUTUBE; ?>" target="_blank" class="icon-youtube"></a>
            <a title="Baixe o App da Gabadi" href="https://play.google.com/store/apps/details?id=io.ionic.gabadi4" target="_blank" class="icon-android"></a>
        </div>

        <div class="radio_group">
            <span class="radio_group_noar">No Ar:</span>
            <div class="radio_group_stream">
                <div class="embed-container">
                    <iframe src="http://paineldj5.com.br:8076/stream?type=.mp3" allow="autoplay" id="audio" frameborder="0"></iframe>
                </div>
                <span class="cc_streaminfo legenda" data-type="song" data-username="gabadi">Carregando ...</span>
            </div>
        </div>
    </div>

    <!--HEADER LOGO E MENU-->
    <div class="header_logo_menu bg-black">
        <!--<div class="content">-->

        <a class="logo" title="<?= SITENAME; ?>" href="<?= HOME . '/&theme=' . THEME; ?>"><img title="<?= SITENAME; ?>" alt="" src="<?= INCLUDE_PATH; ?>/Assets/Images/logo.fw.png"></a>

        <div class="menu_mobile js_menu_mobile">
            <div class="menu_mobile_line"></div>
            <div class="menu_mobile_line"></div>
            <div class="menu_mobile_line"></div>
        </div>

        <nav class="menu main_nav">
            <span class="menu_close js_close">x</span>
            <ul>
                <li><a class="<?= $Link->getLocal()[0] == 'index' || $Link->getLocal()[0] == 'pesquisa' ? 'color-pink' : ''; ?>" title="Home" href="<?= HOME . '/&theme=' . THEME; ?>">Home</a></li>
                <li><a class="<?= $Link->getLocal()[0] == 'posts' || $Link->getLocal()[0] == 'post' ? 'color-pink' : ''; ?>" title="Posts" href="<?= HOME . '/posts/&theme=' . THEME; ?>">Posts</a></li>
               <?php if(VIDEOS_YT): ?> <li><a class="<?= $Link->getLocal()[0] == 'videos' ? 'color-pink' : ''; ?>" title="Vídeos" href="<?= HOME . '/videos/&theme=' . THEME; ?>">Vídeos</a></li> <?php endif; ?>
                <li><a class="<?= $Link->getLocal()[0] == 'contato' ? 'color-pink' : ''; ?>" title="Contato" href="<?= HOME . '/contato/&theme=' . THEME; ?>">Contato</a></li>
            </ul>
        </nav>

        <span class="search icon-search icon-notext js_search"></span>


        <!--<div class="clear"></div>-->
        <!--</div>-->

    </div>

</header>

<form class="search_form js_search_form" method="post" name="form-search">
    <input type="hidden" name="action" value="pesquisar_termo">
    <input type="hidden" name="current-theme" value="<?= THEME; ?>">
    <input type="text" name="pesquisa" placeholder="Pressione 'Enter' Para Pesquisar">
</form>