<?php
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Credentials: true");
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
//header('Access-Control-Request-Headers: x-requested-with');
//header('Access-Control-Max-Age: 1000');
//header('Access-Control-Allow-Headers: Accept,Authorization,Cache-Control,Content-Type,DNT,If-Modified-Since,Keep-Alive,Origin,User-Agent,X-Requested-With');
//header('Content-Type: application/json; charset=UTF-8');

ob_start();
if (!empty($_SESSION['theme'])):
    session_start();
endif;
?>
<?php
require '../_app/Config.inc.php';
spl_autoload_register('carregarClasses');
date_default_timezone_set("America/Sao_Paulo");

//foreach(get_nginx_headers('apache_request_headers') as $key => $value):
//    
//    echo $key . '=>' . $value . '<br>';
//    
//endforeach;
//var_dump(getallheaders());
?>
<!DOCTYPE html>
<html lang="pt-br">

    <head>
        <meta charset="UTF-8" >
        <title>Login | Painel Admin</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH; ?>/img/favicon.png"/>
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="css/boot.css">
        <link id="j_base_home" rel="j_base" href="<?= HOME; ?>">
    </head>



    <body class="bg-light">


        <header>

        </header>

        <main class="bg-light">

            <section class="container login">

                <div class="content">


                    <img title="" src="<?= INCLUDE_PATH ?>/img/logo.png"/>

                    <div class="trigger-box fl-left m-bottom1"></div>
                    <?php
//                    var_dump(substr(md5('adm'), 0, 16));

                    $exe = filter_input(INPUT_GET, 'exe', FILTER_DEFAULT);

                    if ($exe == 'restrito'):
                        WSErro("Acesso restrito! Faça Login", WS_ERROR);
                    endif;

                    if ($exe == 'logoff'):
                        WSErro("Deslogado com sucesso!", WS_ACCEPT);
                    endif;

                    if ($exe == 'recover'):
                        WSErro("Sua senha foi enviada para o seu E-mail!", WS_INFOR);
                    endif;

                    if (isset($_SESSION['userlogin']['user_id'])):
                        header('Location: dashboard.php');
                    endif;
                    ?>








                    <form action="" method="post" class="bg-body m-bottom1" id="form_login">

                        <input type="hidden" name="action" value="logar">

                        <label class="form-field">
                            <span class="form-legend">E-mail:</span>
                            <input type="text" title="E-mail" name="user_email" placeholder="Digite um E-mail" />
                        </label>

                        <label class="form-field">
                            <span class="form-legend">Senha:</span>
                            <input type="password" title="Senha" name="user_password" placeholder="Digite uma Senha" />
                        </label>


                        <!--                        <div class="form-check">
                                                    <label class="form-check-title bg-light"><input type="checkbox" name="list" value="1">Lembrar!</label>
                                                </div>-->

                        <button class="btn btn-green radius">Entrar!</button>
                        <div title="Carregando" class="load fl-right"></div>
                    </form>

                    <a class="fl-left" title="Voltar para <?= SITENAME; ?>" href="<?= HOME; ?>">Voltar para <?= SITENAME; ?></a>
                    <a class="fl-right" title="Perdeu sua Senha?" href="recuperar.php">Perdeu Sua Senha?</a>


                </div>

            </section>



        </main>


        <footer></footer>

        <script src="../_cdn/jquery.js" ></script>
        <script src="../_cdn/shadowbox/shadowbox.js"></script>
        <script src="../_cdn/jquery.form.js" ></script>

<!--<script src="../_cdn/scripts.js" ></script>-->
<!--<script src="../admin/__jsc/admin_scripts.js"></script>-->


        <script>

            BASE = $("#j_base_home").attr('href');

            //    FECHA MENSAGENS DE ERRO
            $('.trigger-box').on('click', '.ajax_close', function () {

                $('.trigger').fadeOut();

            });

            //SCRIPT SOMENTE PARA O FORM DE LOGIN    
            $('body').on('submit', 'form', function () {

                var form = $(this);
                var dados = $(this).serialize();
//        var path = null;

                jQuery.support.cors = true;
                form.ajaxSubmit({
                    url: 'ajax/ajax.php',
                    data: dados,
                    type: 'POST',
                    dataType: 'json',
                    beforeSubmit: function () {
                        $('.load').fadeIn(500);
                    },
                    success: function (data) {
                        $('.load').fadeOut();
                        if (data.caminho) {
                            window.location.href = data.caminho;
                        }

                        if (data.error) {

//                            form.find('input[type!=submit], input[type!=hidden], select, textarea').val('');

                            $('.trigger-box').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                            $('.trigger-box-suspenso').html("<p class=\"trigger " + data.error[1] + "\">" + data.error[0] + "<span class=\"ajax_close\">X</span></p>");
                            $('.trigger-box-suspenso').fadeIn(400);

                            setInterval(function () {
                                $('.trigger-box-suspenso').fadeOut();
                            }, 3000);

                        }

                        if (data.logado) {
                            $('.j_entrar_cadastrar').fadeOut();
                            $('.j_quantidade').fadeIn();
                        }


                    }

                });

                return false;
            });


        </script>


    </body>


</html>
<?php ob_end_flush(); ?>