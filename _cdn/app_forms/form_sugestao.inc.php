<article class="dobra-sugestao container m-bottom3">
    <header class="container">
        <div class="content al-left">
            <h1 class="m-bottom1">Deixe sua sugestão de conteúdo:</h1>
            <p>Informe o seu e-mail para sugerir conteúdo relacionado a "<?= (!empty($search) ? $search : $Url[0]); ?>"</p>
            <div class="clear"></div>
        </div>
    </header>
    <div class="content">

        <form class="flex" action="" method="post">
            <div class="trigger-absolute js_trigger_absolute"></div>
            <input type="hidden" name="action" value="receber_sugestao">
            <input type="hidden" name="lead_type" value="form-sugestao">
            <input type="hidden" name="lead_suggestion" value="<?= (!empty($search) ? $search : $Url[0]); ?>">

            <label class="form-field">
                <input type="text" name="lead_name" placeholder="Informe seu nome:" required>
            </label>
            <label class="form-field">
                <input type="email" name="lead_email" placeholder="Informe seu e-mail:" required>
            </label>

            <button class="btn btn-green btn-small radius">Deixe sua sugestão</button>

        </form>
        <div class="clear"></div>
    </div>
</article>

<?php include REQUIRE_PATH . '/inc/loading_message.inc.php'; ?>