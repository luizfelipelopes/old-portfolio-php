<!--MODAL-->
<div class="lpoptin_modal j_optin_modal">
    <div class="lpoptin_modal_box">
        <div class="header bg_<?= $OPTIIN['ac_button_color']; ?>">
            <p><?= $OPTIIN['headline']; ?></p>
            <span class="j_optin_close lpoptin_modal_box_close">X</span>
        </div>
        <?php require './require/' .$OPTIIN['require_form']. '.php'; ?>
    </div>
</div>

<!--OPTIN-->
<div class="lp_hunter">
    <article class="lp_hunter_optin">
        <header>
            <img src="<?= BASE; ?>/images/logo.png" alt="<?= $OPTIIN['headline']; ?>" title="<?= $OPTIIN['headline']; ?>"/>
            <h1><?= $OPTIIN['headline']; ?></h1>
            <p class="tagline"><?= $OPTIIN['tag_copy']; ?></p>
        </header>

        <div class="lp_hunter_optin_btn">
            <span class="j_optin btn btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $OPTIIN['ac_button']; ?></span>
        </div>

        <div class="lp_hunter_optin_social">
            <div class="g-ytsubscribe" data-channel="<?= $SEO['yt_channel']; ?>" data-layout="full" data-count="default"></div>
            <div>&nbsp;</div>
            <iframe src="https://www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2F<?= $SEO['fb_page']; ?>&width=420&layout=standard&action=like&size=small&show_faces=true&share=true&height=80" width="420" height="56" style="border:none; overflow:hidden; max-width: 80%;" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
        </div>
    </article>
</div>

<!--DESCRIÇÃO-->
<section class="lp_description">
    <div class="content">
        <header class="section_header">
            <h1><?= $SECTIONS[0]; ?></h1>
        </header>
        <?php
        foreach ($DESCRIPTION as $DescItem):
            ?><article class="box box2">
                <div class="lp_description_item">
                    <h1><span><?= $DescItem['title']; ?></span></h1>
                    <p><?= $DescItem['content']; ?></p>
                </div>
            </article><?php
        endforeach;
        ?>
        <div class="section_button">
            <span class="j_optin btn btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $OPTIIN['ac_button']; ?></span>
        </div>
    </div>
</section>

<!--AUTHOR-->
<article class="lp_author">
    <div class="content">
        <header class="section_header">
            <h1><?= $SECTIONS[1]; ?></h1>
        </header>
        <article class="lp_author_box">
            <header>
                <h1>Robson V. Leite</h1>
                <img class="lp_author_box_avatar" src="images/author.jpg" alt="Robson V. Leite" title="Robson V. Leite"/>
            </header>
            <p>Robson V. Leite é webmaster a mais de 12 anos. Filho de professora, apaixonado por web e viciado em resultados. É pai do Pedro e do Lucas, eterno parceiro da Grazi e está à frente da UpInside Treinamentos.</p>
            <p>A UpInside é uma escola 100% online e eleita a melhor do BRASIL em treinamentos de desenvolvimento, programação e marketing digital pela master pesquisa e destaque educacional e empresa do ano pela Latin Quality American Institute.</p>
            <p>Trabalha com o que ama, é dono do próprio tempo e tem como missão trasmitir esses valores a seus alunos! Robson será seu mentor nesta jornada pelo Projeto e Produção!</p>
        </article>
    </div>
</article>

<!--SOCIAL-->
<section class="lp_social">
    <div class="content">
        <header class="section_header">
            <h1><?= $SECTIONS[2]; ?></h1>
        </header>
        <?php require './require/reviews.php'; ?>
        <div class="section_button">
            <span class="j_optin btn btn_<?= $OPTIIN['ac_button_color']; ?>"><?= $OPTIIN['ac_button']; ?></span>
        </div>
    </div>
</section>