<?php
//unset($_SESSION['clientelogin']);
//require '_app/Config.inc.php';
//require '_app/Config-Mail.inc.php';
//spl_autoload_register('carregarClasses');
//define(HOME, "http://n4qqno-user.freehosting.host");
$mail = filter_input(INPUT_GET, 'mail', FILTER_VALIDATE_EMAIL);
$interest = filter_input(INPUT_GET, 'interest', FILTER_VALIDATE_BOOLEAN);

$readLead = new Read;
$readLead->FullRead("SELECT lead_name FROM " . LEADS . " WHERE lead_email = :mail", "mail={$mail}");
if ($readLead->getResult()):
    $name = $readLead->getResult()[0]['lead_name'];
else:
    $name = '';
endif;
?>
<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="https://schema.org/WebSite">
    <head>
        <meta charset="UTF-8">
        <title>Nilma Nayara Nutri e Coach</title>
        <meta name="description" content="Bem Vindo à Excelência em Emagrecimento Definitivo!"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img/favicon.png' ?>" />
        <link rel="canonical" href="<?= HOME . '/venda-servico' ?>">

        <meta itemprop="author" content="<?= AUTHOR_GOOGLE; ?>" />
        <meta itemprop="publisher" content="<?= PUBLISHER_GOOGLE; ?>" />
        <meta itemprop="name" content="Nutricionista Low Carb" />
        <meta itemprop="description" content="Bem Vindo à Excelência em Emagrecimento Definitivo!" />
        <meta itemprop="url" content="<?= HOME; ?>/venda-servico'" />
        <meta itemprop="image" content="<?= INCLUDE_PATH; ?>/img/logo.png" />

        <meta property="og:app_id" content="" />
        <meta property="article:author" content="https://www.facebook.com/LuizFelipeC.Lopes" />
        <meta property="article:publisher" content="https://www.facebook.com/nilma.nayara" />
        <meta property="og:site_name" content="Nutricionista Low Carb" />
        <meta property="og:locale" content="pt_BR" />
        <meta property="og:title" content="Nutricionista Low Carb" />
        <meta property="og:description" content="Bem Vindo à Excelência em Emagrecimento Definitivo!" />
        <meta property="og:image" content="<?= INCLUDE_PATH; ?>/img/logo.png" />
        <meta property="og:url" content="<?= HOME; ?>" />
        <meta property="og:type" content="article" />

        <meta property="twitter:card" content="summary_large_image"/>
        <meta property="twitter:site" content=""/>
        <meta property="twitter:domain" content="<?= HOME; ?>"/>
        <meta property="twitter:title" content="Nutricionista Low Carb"/>
        <meta property="twitter:description" content="Bem Vindo à Excelência em Emagrecimento Definitivo!"/>
        <meta property="twitter:image:src" content="<?= INCLUDE_PATH; ?>/img/logo.png"/>
        <meta property="twitter:url" content="<?= HOME; ?>"/>

        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Coming+Soon|Goudy+Bookletter+1911|IBM+Plex+Serif:100,100i,300,300i,400,500" rel="stylesheet">
        <link rel="stylesheet" href="_cdn/app_campaign/opt-in.css" />
        <link rel="stylesheet" href="<?= INCLUDE_PATH ?>/css/boot1.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style3.css">
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/Icons.css">
        <link id="j_base" rel="j_base" href="<?= HOME; ?>">
        <link id="j_theme" rel="j_theme" href="<?= THEME; ?>">
    </head>
    <body class="apresentacao">

        <!--MODAL-->
        <div class="lpoptin_modal j_optin_modal">
            <div class="lpoptin_modal_box">
                <div class="header bg_<?= $OPTIIN['ac_button_color']; ?>">
                    <p><?= $OPTIIN['headline']; ?></p>
                    <span class="j_optin_close lpoptin_modal_box_close">X</span>
                </div>
                <?php require '_cdn/app_campaign/require/formmc.php'; ?>
            </div>
        </div>

        <div itemscope itemtype="https://schema.org/Product">
            <meta itemprop="name" content="Pacote Emagrecimento Total">


            <section class="container apresentacao_venda">
                <!--<img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/logo-embaixo.fw.png">-->
                <div class="content">

                    <header class="container">
                        <h1 itemprop="description">Olá <?= (!empty($name) ? $name : ''); ?> ! Prepare-se para se transformar NA SUA MELHOR VERSÃO</h1>
                    </header>

                    <div class="box video-large no-margin video_apresentacao" style="margin-bottom: 0 !important;">
                        <div class="video no-margin video_chamada_curso">
                            <div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/h-7DiJJWV6Q" frameborder="0" allowfullscreen></iframe></div>
                            <!--<div class="ratio js_media js_video_dobra1"></div>-->
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="container botao_apresentacao botao_apresentacao_venda botao_sessao_gratuita">
                        <div class="content">
                            <div class="js_sale_buttons">
                                <a id="1" attr-interest="<?= (!empty($interest) ? $interest : null); ?>" attr-email="<?= (!empty($mail) ? $mail : null); ?>" attr-name="<?= (!empty($name) ? $name : null); ?>" class="btn btn-red radius js_buy_service radius" title="10 Sessões" href="#">Quero 10 Sessões<small style="font-size: 0.6em; display: block; margin-top: 5px;">Até 12x no Cartão</small></a>
                                <a id="2" attr-interest="<?= (!empty($interest) ? $interest : null); ?>" attr-email="<?= (!empty($mail) ? $mail : null); ?>" attr-name="<?= (!empty($name) ? $name : null); ?>" class="btn btn-green radius js_buy_service radius" title="20 Sessões" href="#">Quero 20 Sessões<small style="font-size: 0.6em; display: block; margin-top: 5px;">Até 12x no Cartão</small></a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>

            </section>

        </div>
        <!--<div class="js_final_content">Teste</div>-->

        <footer class="footer_venda container al-center ds-none" style="background: #fff;">
            <div class="content">
                <p style="color: #333;"><a style="color: #333;" class="js_exibir_autor" title="Sobre o Autor" href="#">Sobre o Autor</a> | <a style="color: #333;" title="Termos de Uso" target="_blank" href="<?= $LEGAL['termos-completo'] ?>">Termos de Uso</a></p>
                <div class="clear"></div>
            </div>
        </footer>

        <section class="fundo js_autor j_popup ds-none">
            <div class="modal_janela radius">
                <div class="ajax_close fechar_modal pointer">x</div>
                <div class="content">
                    <header class="container radius modal_header">
                        <h1>Luiz Felipe Lopes</h1>
                        <div class="box_imagem">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/depoimento1.jpg">
                        </div>
                    </header>
                    <p>Luiz Felipe Lopes, é Web Developer, formado em Sistemas de Informação. Apaixonado por soluções web, e por ver a mudança na vida das pessoas através dos seus serviços.</p>
                    <p>Trabalha com o que ama, e tem como missão impactar a vida das pessoas de forma positiva através de ferramentas e serviços que proporcionam uma melhor gestão e visibilidade em seus conteúdos e negócios.</p>
                    <p>O Luiz Felipe dará a você a solução web ideal para o seu negócio!</p>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        </section>

        <section class="fundo js_termos j_popup ds-none">
            <div class="modal_janela">
                <div class="ajax_close fechar_modal pointer">x</div>
                <div class="content scroll">
                    <header class="container modal_header">
                        <h1>Termos de Uso e Políticas de Privacidade</h1>
                        <p>Estes termos de serviço regulam o uso deste site. Ao acessá-lo você concorda com estes termos.</p>
                    </header>

                    <article class="container">
                        <header class="container">
                            <h2>Acesso ao site</h2>
                        </header>
                        <p>Para acessar o conteúdo do site Flowstate Blog, pode ser solicitado ao usuário algumas informações pessoais como nome, e-mail e outros. Se acharmos que as informações não são corretas ou verdadeiras, temos o direito de recusar e/ou cancelar o acesso a qualquer tempo, sem notificação prévia.</p>
                    </article>

                    <article class="container">
                        <header class="container">
                            <h2>Restrições ao uso</h2>
                        </header>
                        <p>Você só poderá usar este site para propósito permitido por nós. Você não poderá usá-lo em qualquer outro objetivo, especialmente comercial, sem o nosso consentimento prévio. Não associe nossas marcas a nenhuma outra. Não exponha nosso nome, logotipo, logomarca entre outros, indevidamente e de forma a causar confusão.</p>
                    </article>

                    <article class="container">
                        <header class="container">
                            <h2>Propriedade da Informação</h2>
                        </header>
                        <p>O conteúdo deste site não pode ser copiado, distribuído, publicado, carregado, postado ou transmitido por qualquer outro meio sem o nosso consentimento prévio, a não ser que a finalidade seja apenas a divulgação.</p>
                    </article>

                    <article class="container">
                        <header class="container">
                            <h2>Aviso Legal</h2>
                        </header>
                        <p>A informação obtida ao usar este site não é completa e não cobre todas as questões, tópicos ou fatos que possam ser relevantes para seus objetivos. O uso deste site é de sua total responsabilidade. O conteúdo é oferecido como está. O conteúdo deste site não é palavra final sobre qualquer assunto, e podemos fazer melhorias a qualquer momento.</p>
                        <p>Você, e não o Luiz Felipe Cordeiro Lopes (autor do site), assume o custo de qualquer serviço, reparo ou correção necessários no caso de qualquer perda ou dano consequente do uso deste site ou seu conteúdo, a não ser que esteja coberto por alguma garantia oferecida com o serviço.</p>
                        <p>Você entende que não podemos e não garantimos que arquivos disponíveis para download da Internet estejam livres de vírus, worms, cavalos de Tróia ou outro código que possa manifestar propriedades contaminadoras ou destrutivas.</p>
                    </article>

                    <div class="container termos_assinatura">
                        <p>Luiz Felipe Cordeiro Lopes</p>
                        <p>CPF: 100.437.706-14</p>
                    </div>

                    <div class="clear"></div>
                </div>
            </div>
        </section>

    </body>
    <?php include 'inc/loading_message.inc.php'; ?>
    <script type="text/javascript" src="<?= HOME; ?>/_cdn/jquery.js"></script>
    <script type="text/javascript" src="<?= HOME; ?>/_cdn/jquery.form.js"></script>
    <script type="text/javascript" src="<?= INCLUDE_PATH; ?>/js/scripts1.inc.js"></script>
    <script src="<?= HOME; ?>/_cdn/app_campaign/scripts/landing.js"></script>
    <script src="<?= INCLUDE_PATH; ?>/js/servicos.inc.js"></script>
    <script>

        $(function () {
            setTimeout(function () {
                $('.js_sale_buttons').fadeIn();
            }, '1200000'); //1800000
        });

    </script>
</html>
