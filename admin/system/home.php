<!--CARDS DO TOPO-->
<div class="flex cards_top">

    <!--USUÁRIOS ONLINE-->
    <?php include './inc/card_views_online.inc.php'; ?>

    <!--VISUALIZAÇÕES DO DIA-->
    <?php include './inc/card_views_today.inc.php'; ?>

    <!--VISUALIZAÇÔES DO MÊS-->
    <?php include './inc/card_views_month.inc.php'; ?>

    <!--VENDAS DO MÊS-->
    <?php
    if (SALES_ADMIN == '1'):
        include './inc/card_sells_month.inc.php';
    endif;
    ?>

</div>

<!--CARDS ABAIXO-->
<div class="flex cards_bottom">

    <!--ÚLTIMOS COMENTÁRIOS-->
    <?php
    if (!empty($_SESSION['userlogin']) && $_SESSION['userlogin']['user_level'] > '1' && COMENTARIOS_ADMIN == '1'):
        include './inc/card_last_comments.inc.php';
    endif;
    ?>

    <!--POSTS MAIS VISTOS-->
    <?php include './inc/card_most_see_posts.inc.php'; ?>

</div>