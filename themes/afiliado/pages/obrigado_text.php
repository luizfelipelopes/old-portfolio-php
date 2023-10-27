<article class="lp_thanks_text">
    <div class="content">
        <header>
            <img class="lp_confirm_inbox" src="<?= BASE; ?>/img/check.png" alt="Obrigado por se cadastrar!" title="Obrigado por se cadastrar!"/>
            <h1><?= $THANKS['title']; ?></h1>
            <p><?= $THANKS['content']; ?></p>
        </header>

        <a class="btn btn_<?= $OPTIIN['ac_button_color']; ?>" href="<?= $THANKS['cta_link']; ?>" title="<?= $THANKS['cta']; ?>"><?= $THANKS['cta']; ?></a>
    </div>
</article>

<div class="lp_thanks_social">
    <div class="content">
        <p>Curta e acompanhe novidades no facebook</p>
        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F<?= $SEO['fb_page']; ?>&width=420&layout=standard&action=like&size=small&show_faces=true&share=true&height=80" width="420" height="56" style="border:none; overflow:hidden; max-width: 80%;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div>
</div>