<section class="bloco_404 container">

    <header class="container">
        <div class="content">
            <h1>Opss! A página "<?= $Url[0]; ?>" não existe!</h1>
            <p>Mas calma! Nem tudo está perdido :)</p>
            <div class="clear"></div>
        </div>
    </header>

    <?php include '_cdn/app_forms/form_sugestao.inc.php'; ?>

    <?php include '_cdn/app_posts/posts-relacionados.inc.php'; ?>

</section>