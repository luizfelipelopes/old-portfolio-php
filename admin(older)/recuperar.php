<?php
ob_start();
if (!empty($_SESSION['theme'])):
    session_start();
endif;
?>
<?php
require '../_app/Config.inc.php';
//session_start();
?>
<?php spl_autoload_register('carregarClasses'); ?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8" >
        <title>Login | Painel Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/boot.css">
        <link id="j_base" rel="j_base" href="<?= HOME; ?>">
    </head>



    <body>


        <header>

        </header>

        <main class="bg-light">

            <section class="container login">

                <div class="content js_content_form">


                    <?php
//                    $exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);
//                    $login = new Login(1);
//
//
//                    if ($exe == 'restrito'):
//                    WSErro("Acesso restrito! Faça Login", WS_ERROR);
//                    endif;
//
//                    if ($exe == 'logoff'):
//                        WSErro("Deslogado com sucesso!", WS_ACCEPT);
//                    endif;
//
//                    if($login->CheckLogin()):
//                    header('Location: dashboard');
//                    endif;
                    ?>

                    <div class="trigger-box fl-left m-bottom1 m-top1"></div>

                    <img title="" src="img/foto-novo-post.png" />

                    <form action="" method="post" class="bg-body m-bottom1" id="form_login">

                        <input type="hidden" name="action" value="recuperar_senha_admin">

                        <label class="form-field">
                            <span class="form-legend">E-mail:</span>
                            <input type="email" title="E-mail" name="user_email" placeholder="Digite seu E-mail" />
                        </label>

                        <button class="btn btn-green radius">Enviar!</button>
                        <div title="Carregando" class="load fl-right"></div>
                    </form>

                    <a class="fl-left" title="Voltar para <?= SITENAME; ?>" href="<?= HOME; ?>">Voltar para a <?= SITENAME; ?></a>

                </div>

            </section>



        </main>


        <footer></footer>

        <script src="../_cdn/jquery.js" ></script>
        <script src="../_cdn/shadowbox/shadowbox.js"></script>
        <script src="../_cdn/jquery.form.js" ></script>
        <script src="../_cdn/scripts.js" ></script>
        
        <!--<script src="../admin/__jsc/admin_scripts.js"></script>-->


        <script>

//            $('body').on('submit', 'form', function () {
//
//                var form = $(this);
//                var dados = $(this).serialize();
////        var path = null;
//
//                form.ajaxSubmit({
//                    url: '../_cdn/ajax.php',
//                    data: dados,
//                    type: 'POST',
//                    dataType: 'json',
//                    beforeSubmit: function () {
//
//                    },
//                    success: function (data) {
//
//                        if (data.caminho) {
//                            window.location.href = data.caminho;
//                        }
//
//                        if (data.error) {
//
//                            form.find('input[type!=submit], select, textarea').val('');
//
//                            $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
//                            $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
//                            $('.trigger-box-suspenso').fadeIn(400);
//
//                            setInterval(function () {
//                                $('.trigger-box-suspenso').fadeOut();
//                            }, 3000);
//
//                        }
//
//                        if (data.logado) {
//                            $('.j_entrar_cadastrar').fadeOut();
//                            $('.j_quantidade').fadeIn();
//                        }
//
//
//                    }
//
//                });
//
//                return false;
//            });
//

        </script>


    </body>


</html>
<?php ob_end_flush(); ?>