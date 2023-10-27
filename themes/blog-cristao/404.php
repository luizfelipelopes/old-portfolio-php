<main>
    <section class="bloco_404 container">

        <header class="container">
            <h1>Opss! A página <span>"<?= $Url[0]; ?>"</span> não existe!</h1>
            <p>Mas calma! Nem tudo está perdido :)</p>
        </header>

        <?php include '_cdn/app_forms/form_sugestao.inc.php'; ?>

        <?php include '_cdn/app_posts/posts-relacionados.inc.php'; ?>

    </section>
</main>