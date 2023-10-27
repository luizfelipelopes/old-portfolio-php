<?php
//unset($_SESSION['clientelogin']);
//require '_app/Config.inc.php';
//require '_app/Config-Mail.inc.php';
//spl_autoload_register('carregarClasses');
//define(HOME, "http://n4qqno-user.freehosting.host");
$mode = filter_input(INPUT_GET, 'm', FILTER_DEFAULT);
//$interest = filter_input(INPUT_GET, 'interest', FILTER_VALIDATE_BOOLEAN);
//
//$readLead = new Read;
//$readLead->FullRead("SELECT lead_name FROM " . LEADS . " WHERE lead_email = :mail", "mail={$mail}");
//if ($readLead->getResult()):
//    $name = $readLead->getResult()[0]['lead_name'];
//else:
//    $name = '';
//endif;
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

        <style>

            .apresentacao_venda .logo_topo{margin-left: auto !important; margin-right: auto !important;}
            .sales_cards{width: 400px !important; margin-right: 10px;}
            .sales_ssl{width: 100px !important;}
            @media(min-width: 600px){
                .item_bonus {padding-left: 60px !important;}
            }
            @media(max-width: 600px){
                .botao_sessao_gratuita {margin: 20px auto !important;}
                .sales_info_top {margin-bottom: 20px !important;}
                .modal_header{text-align: center;}
                .modal_header h1{text-align: center; margin-bottom: 10px;}
                .modal_header .box_imagem{margin: auto !important; top: 0 !important; left: 0 !important; right: 0 !important; position: relative !important;}
            }

        </style>

        <!--MODAL-->
        <div style="display: none;" class="lpoptin_modal j_optin_modal">
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


            <section class="container apresentacao_venda" style="margin-bottom: 0 !important;">
                <img class="logo_topo" title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/logo-embaixo.fw.png">
                <div class="content" style="padding-top: 0px !important;">

                    <header class="container">
                        <h1 itemprop="description">Prepare-se Para o Desafio Que Irá Mudar a Sua Vida e Fazer Com Que Você Tenha o CORPO Que SEMPRE Desejou!</h1>
                    </header>

                    <div class="box video-large no-margin video_apresentacao" style="margin-bottom: 0 !important;">
                        <div class="video no-margin video_chamada_curso">
                            <div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/<?= (!empty($mode) && $mode == 'fb' ? '3QVnVgaeVnQ' : 'DQBCNjhf8O0'); ?>" frameborder="0" allowfullscreen></iframe></div>
                            <!--<div class="ratio js_media js_video_dobra1"></div>-->
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="container botao_apresentacao botao_apresentacao_venda botao_sessao_gratuita">
                        <div class="content">
                            <div style="display:block;" class="js_sale_buttons">
                                <a style="background-color: #3F9C35; margin: 0;" id="2" class="btn btn-green radius" title="Clique Aqui Para Fazer O Treinamento" target="_blank" href="https://pay.hotmart.com/X9823785S">Clique Aqui Para Fazer O Treinamento<small style="font-size: 0.6em; display: block; margin-top: 5px;">Sim! Eu Quero Emagrecer Com O Treinamento Real.</small></a>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="container sales_info sales_info_top">
                        <img class="sales_cards" title="" alt="" src="<?= INCLUDE_PATH ?>/img/bandeiras_cartoes.png"> |
                        <img class="sales_ssl" title="" alt="" src="<?= INCLUDE_PATH ?>/img/certificado_ssl.png">
                    </div>

                    <div class="clear"></div>
                </div>

            </section>

            <section class="container dobra_depoimentos">
                <header class="sectiontitle titulo_dobra_depoimentos container pd-bottom3" style="margin-top: 0 !important;">
                    <div class="content">
                        <h1>O Que Elas Falam Sobre a Nutri, Confira Os Depoimentos Reais</h1>
                        <div class="clear"></div>
                    </div>
                </header>

                <span itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                    <meta itemprop="ratingValue" content="5.0">
                    <meta itemprop="reviewCount" content="5">
                </span>

                <div class="content al-center">

                    <div class="flex container depoimentos_video">
                        <?php
                        $readVideos = new Read;
                        $readVideos->ExeRead(DEPOIMENTOS, "WHERE depoimento_status = 1 AND depoimento_type = :type ORDER BY depoimento_order ASC LIMIT 3", "type=video");
                        if ($readVideos->getResult()):
                            foreach ($readVideos->getResult() as $video):
                                extract($video);
                                ?>
                                <article class="ds-inblock depoimento_video flex-3" itemprop="review" itemscope itemtype="https://schema.org/Review">
                                    <div class="box video-large no-margin">
                                        <div class="video">
                                            <div class="ratio js_media js_video_dobra1" itemprop="video" itemscope itemtype="https://schema.org/VideoObject">
                                                <iframe itemprop="thumbnailUrl" class="media" src="https://www.youtube.com/embed/<?= $depoimento_video; ?>" frameborder="0" allowfullscreen></iframe>
                                                <meta itemprop="name" content="<?= $depoimento_name; ?>">
                                                <meta itemprop="description" content="<?= $depoimento_name . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf']; ?>">
                                                <meta itemprop="uploadDate" content="<?= date('Y-m-d H:i:s', strtotime($depoimento_date)); ?>">
                                            </div>
                                        </div>
                                        <div class="clear"></div>
                                    </div>
                                    <h2><?= $depoimento_name; ?> - <?= BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf'] ?></h2>
                                    <meta itemprop="author" content="<?= $depoimento_name; ?>">
                                    <div class="clear"></div>
                                </article>

                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>

                    <div class="depoimento_textos container">
                        <div class="content">
                            <div class="flex">
                                <?php
                                $readTextos = new Read;
                                $readTextos->ExeRead(DEPOIMENTOS, "WHERE depoimento_status = 1 AND depoimento_type = :type ORDER BY depoimento_order ASC LIMIT 2", "type=texto");
                                if ($readTextos->getResult()):
                                    foreach ($readTextos->getResult() as $texto):
                                        extract($texto);
                                        ?>

                                        <article class="depoimento_texto flex-2" itemprop="review" itemscope itemtype="https://schema.org/Review">
                                            <img itemprop="image" title="<?= $depoimento_name; ?>" alt="[<?= $depoimento_name; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $depoimento_cover; ?>">
                                            <div class="descricao_depoimento">
                                                <p>“<?= $depoimento_content; ?>”.</p>
                                                <h2 class="font-bold"><?= $depoimento_name; ?> - <?= BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf'] ?></h2>
                                                <meta itemprop="author" content="<?= $depoimento_name; ?>">
                                                <meta itemprop="description" content="<?= $depoimento_name . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($depoimento_cidade)[0]['cidade_uf']; ?>">
                                            </div>
                                        </article>

                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </section>

            <section class="dobra_bonus container al-center" style="background: #fff; margin-top: 0 !important;">
                <div class="content al-center" >
                    <header class="container">
                        <img title="Bônus Exclusivo" alt="[Bônus Exclusivo]" src="<?= INCLUDE_PATH ?>/img/icone-bonus.fw.png">
                        <h1 class="m-bottom3 caps-lock font-bold">Bônus Exclusivos</h1>
                    </header>

                    <div class="flex container">
                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>Cardápio Semanal!</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>Comunidade Exclusiva do Treinamento Real</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>Acesso às Aulas Ao Vivo</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>2 Sessões de Coaching Nutricional</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>10 dias de garantia</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>Receitas Saudáveis, Fitness e Lowcarb</p>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </section>

            <section class="dobra_prazo container" style="margin-bottom: 0; background: #fff;">
                <div class="aviso_escassez container">
                    <div class="content">
                        <div class="bloco_escassez">
                            <div class="bloco_escassez_img">
                                <img title="" alt="" src="<?= INCLUDE_PATH ?>/img/icone-atencao.fw.png">
                                <p>Atenção!</p>
                                <div class="clear"></div>
                            </div>
                            <h1>Não deixe para depois, porque com a grande procura as vagas estão limitadas!</h1>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="container botao_apresentacao botao_apresentacao_venda botao_sessao_gratuita" style="background: #fff; margin-top: 30px !important;">
                    <div class="content">
                        <div style="display:block;" class="js_sale_buttons">
                            <a style="background-color: #3F9C35; margin: 0;" id="2" class="btn btn-green radius" title="Clique Aqui Para Fazer O Treinamento" target="_blank" href="https://pay.hotmart.com/X9823785S">Clique Aqui Para Fazer O Treinamento<small style="font-size: 0.6em; display: block; margin-top: 5px;">Sim! Eu Quero Emagrecer Com O Treinamento Real.</small></a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>

                <div class="container sales_info" style="background: #fff; padding: 30px;">
                    <img class="sales_cards" title="" alt="" src="<?= INCLUDE_PATH ?>/img/bandeiras_cartoes.png"> |
                    <img class="sales_ssl" title="" alt="" src="<?= INCLUDE_PATH ?>/img/certificado_ssl.png">
                </div>
            </section>

            <article class="dobra_chamada container" style="margin-top: 0 !important;">
                <div class="content">
                    <h1>Saiba Como se Sentir MUITO Mais Bonita em 30 Dias!</h1>
                    <div class="clear"></div>
                </div>
            </article>

            <section class="dobra_garantia container m-bottom3 al-center">
                <div class="content">
                    <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-garantia.fw.png">
                    <h1 class="m-bottom1 font-bold">Garantia Incondicional de 10 Dias !</h1>
                    <p class="m-bottom3">Não se preocupe! Você tem 10 dias após a compra do treinamento para pedir o seu dinheiro de volta, caso não esteja satisfeito com o produto. Você terá o reembolso de 100% do valor investido, sem burocracia, sem nenhum problema.</p>
                    <div class="clear"></div>
                </div>
            </section>

        </div>
        <!--<div class="js_final_content">Teste</div>-->

        <footer class="footer_venda container al-center" style="background: #C66579;">
            <div class="content">
                <p style="color: #fff;"><a style="color: #fff;" class="js_exibir_autor" title="Sobre a Nutri" href="#">Sobre a Nutri</a> | <a style="color: #fff;" title="Termos de Uso e Aviso Legal" target="_blank" href="<?= $LEGAL['termos-completo'] . '/&theme=' . THEME; ?>">Termos de Uso</a> | <a style="color: #fff;" title="Políticas de Privacidade" target="_blank" href="<?= $LEGAL['politicas'] . '/&theme=' . THEME; ?>">Política de Privacidade</a></p>
                <div class="clear"></div>
            </div>
        </footer>

        <section class="fundo js_autor j_popup ds-none">
            <div class="modal_janela radius" style="width: 80% !important;">
                <div class="ajax_close fechar_modal pointer" style="z-index: 9999;">x</div>
                <div class="content" style="text-align: left;">
                    <header class="container radius modal_header" style="background: #FFAAAA; padding-left: 0 !important;">
                        <h1 style="margin-left: 10px !important;">Nilma Nayara</h1>
                        <div class="box_imagem">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/sobre.jpeg">
                        </div>
                    </header>
                    <div style="height: 400px; overflow-y: auto; overflow-x: hidden; width: 100%; padding: 10px;">
                        <p>Como nutricionista fui doutrinada a pensar em primeiro lugar na saúde do meu paciente, por isso sempre ficava muito frustrada com os pequenos resultados, com poucas mudanças e principalmente com quase nada de melhoria nos resultados dos exames.</p>
                        <p>Então conheci a Estratégia Nutricional Low Carb e amei os resultados, porque com essa nova estratégia minhas pacientes voltavam ao consultório mais felizes por não terem passado fome e mesmo assim terem emagrecido, isso é lindo.</p>
                        <p>Não tem dinheiro que pague o brilho e o amor nos olhos de uma pessoa que sempre desejou com todas as suas forças emagrecer e nunca conseguiu. Ajudar alguém a dar aquela respirada de felicidade, de prazer pela vitória, é muito empolgante. É fascinante.</p>
                        <p>Falamos que o nosso trabalho é transformador, mas uma definição mais acertada ainda seria “voltando ao seu habitat natural”, ajudamos pessoas a voltar para o caminho certo, a comida de verdade, aquilo que as nutre e não aquilo que as destrói, por isso dá tão certo.</p>
                        <p>Alguns dizem que é o caminho do filho voltando pra casa, voltando as suas boas origens, voltando a comer o que de fato faz bem para o seu corpo. E um corpo feliz é um corpo bem nutrido, é um corpo SAUDÁVEL. E se você pensou “nossa mais eu nunca comi certo, toda vida fui errada” acredite, sempre é hora de melhorar, não desista de você, NUNCA desista de você!</p>
                        <p>Então amiga, em que eu posso te ajudar hoje? Conta comigo.</p>
                        <p>Grande Beijo da Nutri S2</p>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
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

    <script id="hotmart_launcher_script">
        (function (l, a, u, n, c, h, e, r) {
            l['HotmartLauncherObject'] = c;
            l[c] = l[c] || function () {
                (l[c].q = l[c].q || []).push(arguments)
            }, l[c].l = 1 * new Date();
            h = a.createElement(u),
                    e = a.getElementsByTagName(u)[0];
            h.async = 1;
            h.src = n;
            e.parentNode.insertBefore(h, e)
        })(window, document, 'script', '//launcher.hotmart.com/launcher.js', 'hot');

        hot('account', 'bce2c2d3-8e76-3d76-8472-7e2d240823b5');
    </script>


</html>
