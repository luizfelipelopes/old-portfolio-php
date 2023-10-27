<?php
$GATES = [
    "video" => "ArmrWukf2xE",
    "cta" => "GARANTIR MINHA VAGA AGORA!",
    "cta_link" => "https://www.upinside.com.br",
    "comments" => "https://wspp.upinside.com.br/",
    "comment_count" => 10
];
?>

<div class="lp_gates_video">
    <div class="content">
        <div class="lp_gates_video_content">
            <div class="lp_gates_video_content_yt">
                <div class="embed-container">
                    <iframe width="853" height="480" src="https://www.youtube.com/embed/<?= $GATES['video']; ?>?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <a target="_blank" href="<?= $GATES['cta_link']; ?>" title="<?= $GATES['cta']; ?>" class="lp_gates_video_cta btn btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $GATES['cta']; ?></a>
        </div>
    </div>
</div>

<div class="lp_thanks_social">
    <div class="content">
        <p>Curta e acompanhe novidades no facebook</p>
        <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F<?= $SEO['fb_page']; ?>&width=420&layout=standard&action=like&size=small&show_faces=true&share=true&height=80" width="420" height="56" style="border:none; overflow:hidden; max-width: 80%;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
    </div>
</div>

<div class="lp_gates_more">
    <div class="content">
        <p class="j_reload lp_gates_more_reload">Para Recarregar os Comentários <b class="bg_<?= $OPTIIN['ac_button_color']; ?>">Clique Aqui!</b></p>
        <div class="lp_gates_more_social" style="width: 100%; padding: 0;">
            <div class="fb-comments" data-href="<?= $GATES['comments']; ?>" data-width="100%" data-numposts="<?= $GATES['comment_count']; ?>"></div>
        </div>
    </div>
</div>

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