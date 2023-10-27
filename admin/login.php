<?php
ob_start();
date_default_timezone_set("America/Sao_Paulo");
header("Access-Control-Allow-Origin: *");
require '../_app/Config.inc.php';
spl_autoload_register('carregarClasses');
$exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
?>
<!DOCTYPE html>
<!--
Página: Login Page (Página de Login)
Author: Luiz Felipe C. Lopes
Date: 01/09/2018
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH_ADMIN . DIRECTORY_SEPARATOR . 'Assets/Images/favicon.png' ?>" />
        <title>Flowstate Admin | Dashboard</title>
        <link rel="stylesheet" href="Assets/Styles/Boot.css">
        <link rel="stylesheet" href="Assets/Styles/Icons.css">
        <!--<link href="https://file.myfontastic.com/UhPfVkMcFQzQFZQwXmMNC3/icons.css" rel="stylesheet">-->
        <link rel="stylesheet" href="Assets/Styles/Style.css">
        <link id="j_base_home" rel="js_home" href="<?= HOME_ADMIN . DIRECTORY_SEPARATOR . ADMIN; ?>">
    </head>
    <body class="login">

        <main>
            <div class="trigger-absolute js_trigger_absolute"></div>

            <div class="container_logo">
                <div class="trigger-absolute js_trigger_absolute"></div>
                <img title="" alt="" src="<?= INCLUDE_PATH_ADMIN . DIRECTORY_SEPARATOR . 'Assets/Images/favicon.png' ?>">
            </div>

            <div class="form_background">

                <?php
                if (!empty($exe)):
                    ?>
                    <div class="trigger trigger-<?= ($exe == 'restrito' ? 'error' : ($exe == 'logout' ? 'success' : ($exe == 'recover' ? 'info' : ''))); ?> <?= ($exe === 'logout' ? ' icon-check' : ($exe == 'restrito' ? ' icon-error-circle' : ($exe == 'recover' ? 'icon-info-circle' : ''))); ?> radius"><?= ($exe == 'restrito' ? 'Acesso restrito! Digite seu e-mail e senha!' : ($exe == 'logout' ? 'Deslogado com sucesso! ;)' : ($exe == 'recover' ? 'Sua senha foi enviada para o seu E-mail!' : ''))); ?></div>
                    <?php
                endif;
                ?>



                <header>
                    <h1>Flowstate Blog</h1>
                    <p>Acesse sua aplicação</p>
                </header>


                <form action="" method="post" enctype="multipart/form-data">

                    <input type="hidden" name="action" value="login">

                    <span class="form-control">
                        <input type="text" name="user_email" placeholder="Seu e-mail">
                    </span>

                    <span class="form-control capa_featured">
                        <input type="password" name="user_password" placeholder="Sua senha">
                    </span>

                    <span class="form-control container_link">
                        <a title="Esqueceu sua senha?" href="recover.php">Esqueceu sua senha?</a> 
                    </span>

                    <div class="button_block">
                        <button class="btn btn-blue radius icon-goto">Entrar</button>
                    </div>

                </form>
                <?php include 'inc/loading_message.inc.php'; ?>
            </div>
            <a title="Voltar para <?= SITENAME; ?>" href="<?= HOME; ?>" class="icon-goto">Voltar para <?= SITENAME; ?></a>

        </main>



        <!--FOOTER-->
        <footer>

            <script src="../_cdn/jquery.js"></script>
            <script src="../_cdn/jquery.form.js"></script>
            <script src="../_cdn/jquery-ui.min.js"></script>
            <script src="Assets/Scripts/scripts.js"></script>

        </footer>

    </body>
</html>

<?php ob_end_flush(); ?>