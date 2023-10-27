<?php
$GATES = [
    "video" => "ArmrWukf2xE",
    "video_autoplay" => 0,
    "cta" => "BAIXAR MATERIAL DE APOIO!",
    "cta_link" => "https://www.upinside.com.br",
    "comments" => "https://wspp.upinside.com.br/",
    "comment_count" => 18
];
?>

<div class="content" style="text-align: center;">
    E-BOOK
</div>

<div class="lp_gates_share">
    <iframe class="lp_gates_share_item" src="https://www.facebook.com/plugins/share_button.php?href=<?= BASE; ?>&layout=button_count&size=large&mobile_iframe=true&width=143&height=28" width="156" height="40" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    <iframe class="lp_gates_share_item" src="https://platform.twitter.com/widgets/tweet_button.html?size=l&url=<?= BASE; ?>&via=<?= $SEO['twitter']; ?>&text=<?= strip_tags($OPTIIN['headline']); ?>" width="77" height="40" title="Enviar para o Twitter!" style="border:none;overflow:hidden" frameborder="0" allowTransparency="true"></iframe>
</div>

<section class="lp_gates_more">
    <div class="content">
        <div class="lp_gates_more_social">
            <?php if ($GATES['cta']): ?>
                <a target="_blank" href="<?= $GATES['cta_link']; ?>" title="<?= $GATES['cta']; ?>" class="lp_gates_more_cta btn btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $GATES['cta']; ?></a>
            <?php endif; ?>

            <article>
                <h1>1 - Inscreva-se e acompanhe:</h1>
                <div class="box box2">
                    <div class="fb-like" data-href="https://facebook.com/<?= $SEO['fb_page']; ?>" data-layout="standard" data-action="like" data-show-faces="true" data-share="false" data-width="240"></div>
                </div><div class="box box2">
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <div class="g-ytsubscribe" data-channel="<?= $SEO['yt_channel']; ?>" data-layout="full" data-count="default"></div>
                </div>
            </article>

            <article>
                <h1>2 - Deixe aqui um comentário:</h1>
                <div class="fb-comments" data-href="<?= $GATES['comments']; ?>" data-width="100%" data-numposts="<?= $GATES['comment_count']; ?>"></div>
            </article>

        </div><aside class="lp_social lp_gates_more_reviews">
            <h1 class="title"><?= $SECTIONS[2]; ?></h1>
            <?php require 'require/reviews.php'; ?>
        </aside>
    </div>
</section>

<div id="fb-root"></div>
<script>
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id))
            return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.7";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>