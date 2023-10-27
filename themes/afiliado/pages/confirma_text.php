<article class="lp_confirm">
    <div class="content">
        <header>
            <img class="lp_confirm_inbox" src="<?= BASE; ?>/img/inbox.png" alt="Obrigado por se cadastrar!" title="Obrigado por se cadastrar!"/>
            <h1><?= $CONFIRM['title']; ?></h1>
            <p><?= $CONFIRM['headline']; ?></p>
        </header>

        <div class="lp_confirm_step">
            <div class="box box3">
                <div class="lp_confirm_step_content">
                    <span class="step round bg-<?= $OPTIIN['ac_button_color']; ?>">1</span>
                    <b>Acesse sua conta de e-mail:</b> Enviamos uma mensagem de confirmação para você!
                </div>
            </div><div class="box box3">
                <div class="lp_confirm_step_content">
                    <span class="step round bg-<?= $OPTIIN['ac_button_color']; ?>">2</span>
                    <b>Localize a mensagem:</b><?= $CONFIRM['subject']; ?>
                </div>
            </div><div class="box box3">
                <div class="lp_confirm_step_content">
                    <span class="step round bg-<?= $OPTIIN['ac_button_color']; ?>">3</span>
                    <b>Clique no link de confirmação:</b> No corpo do e-mail você deve clicar no link para confirmar!
                </div>
            </div>
        </div>

        <div class="lp_confirm_share">
            <p class="lp_confirm_share_title">Compartilhe com seus amigos:</p><div class="lp_confirm_share_items">
                <iframe src="https://www.facebook.com/plugins/share_button.php?href=<?= BASE; ?>&layout=button_count&size=large&mobile_iframe=true&width=143&height=28" width="156" height="40" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
                <iframe src="https://platform.twitter.com/widgets/tweet_button.html?size=l&url=<?= BASE; ?>&via=<?= $SEO['twitter']; ?>&text=<?= strip_tags($OPTIIN['headline']); ?>" width="77" height="40" title="Enviar para o Twitter!" style="border:none;overflow:hidden" frameborder="0" allowTransparency="true"></iframe>
            </div>
        </div>
    </div>
</article>

<!--SOCIAL-->
<section class="lp_social lp_confirm_social">
    <div class="content">
        <header class="section_header">
            <!--<h1><?= $SECTIONS[2]; ?></h1>-->
        </header>
        <?php // require './require/reviews.php'; ?>
    </div>
</section>