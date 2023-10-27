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
Página: Recover Access Login Page (Recupera Cesso da Página de Login)
Author: Luiz Felipe C. Lopes
Date: 01/09/2018
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/favicon.png' ?>" />
        <title>Flowstate Admin | Dashboard</title>
        <link rel="stylesheet" href="Assets/Styles/Boot.css">
        <link rel="stylesheet" href="Assets/Styles/Icons.css">
        <!--<link href="https://file.myfontastic.com/UhPfVkMcFQzQFZQwXmMNC3/icons.css" rel="stylesheet">-->
        <link rel="stylesheet" href="Assets/Styles/Style.css">
        <link id="j_base_home" rel="js_home" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>">
    </head>
    <body class="login">

        <main>

            <div class="container_logo">
                <img title="" alt="" src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/favicon.png' ?>">
            </div>

            <div class="form_background form_recover">

                <header>
                    <h1>Flowstate Blog</h1>
                    <p>Recuperar Acesso</p>
                    <p class="form_recover_instruction">Você receberá uma nova senha de acesso em seu e-mail.</p>
                </header>


                <form action="" method="post" enctype="multipart/form-data">

                    <span class="js_trigger_absolute"></span>
                    
                    <input type="hidden" name="action" value="recover_password">

                    <span class="form-control">
                        <input type="text" name="user_email" placeholder="Seu e-mail">
                    </span>

                    <div class="button_block">
                        <button class="btn btn-blue radius icon-goto">Enviar Nova Senha</button>
                    </div>

                    <span class="form-control container_link">
                        <a title="Acessar aplicação" href="login.php">Acessar aplicação</a> 
                    </span>

                </form>
                <?php include 'inc/loading_message.inc.php'; ?>
            </div>
            <a title="<?= SITENAME; ?>" href="<?= HOME; ?>" class="icon-goto">Voltar para <?= SITENAME; ?></a>

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