<?php
//ob_start();
//require '../_app/Config.inc.php';
//require '../_app/Config-Mail.inc.php';
//spl_autoload_register('carregarClasses');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Flowstate Blog</title>
        <meta name="description" content="Descubra o Flowstate Blog, gerencie os conteúdos do seu negócio de maneira simples e rápida e conquiste clientes todos os dias.">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="layout/img/logo.fw.png" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <link rel="stylesheet" href="_cdn/app_campaign/opt-in.css" />
        <link rel="stylesheet" href="layout/css/blog.css" />
        <link rel="stylesheet" href="layout/css/boot.css" />
    </head>
    <body>

        <!--<div class="fundo">-->
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
        <!--</div>-->



        <header class="container header_topo">
            <span class="fontzero fl-left main-logo main-logo-mobile m-bottom3"><a title="FLowstate Blog" href="#">Flowstate Blog</a></span>
            <h1 class="ds-none">Flowstate Blog</h1>
            <div class="content m-top1 al-center m-bottom5">
                <section class="bloco_apresentacao container al-center">
                    <h1 class="m-bottom3"> Descubra o Flowstate Blog, gerencie os conteúdos do seu negócio de maneira simples e rápida e conquiste clientes todos os dias!</h1>
                    <div class="box video-large no-margin video_apresentacao">
                        <div class="video no-margin video_chamada_curso al-center">
                            <!--<div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/RnP5RZCS1wA" frameborder="0" allowfullscreen></iframe></div>-->
                            <img title="Descubra o Flowstate Blog, gerencie os conteúdos do seu negócio de maneira simples e rápida e conquiste clientes todos os dias!" alt="Descubra o Flowstate Blog, gerencie os conteúdos do seu negócio de maneira simples e rápida e conquiste clientes todos os dias!" src="layout/img/dashboard.png">
                            <!--<div class="ratio js_media js_video_dobra1"></div>-->
                        </div>
                        <div class="clear"></div>
                    </div>
                </section>

                <div class="clear"></div>
            </div>

        </header>
        <div class="container al-center">
            <a class="btn btn-green botao_apresentacao radius j_optin" title="Consultoria Grátis" href="#">Consultoria Grátis</a>
        </div>

        <section class="dobra1 container m-top3">
            <div class="content">

                <article class="atributo">
                    <div class="content">
                        <img title="Seja Mais Produtivo" alt="[Seja Mais Produtivo]" src="layout/img/icone-estrela.fw.png">
                        <h2 class="ds-none">Seja Mais Produtivo:</h2>
                        <p><span class="atributo_titulo">Seja Mais Produtivo:</span> Sistema de blog que traz a você um painel de controle intuitivo, de fácil manuseio, possibilitando maior produtividade, economizando assim mais tempo na hora de postar seus conteúdos.</p>
                        <div class="clear"></div>
                    </div>
                </article>

                <article class="atributo">
                    <div class="content">
                        <img title="Veja o Que Seu Público Está Acessando" alt="[Veja o Que Seu Público Está Acessando]" src="layout/img/icone-estrela.fw.png">
                        <h2 class="ds-none">Veja o Que Seu Público Está Acessando:</h2>
                        <p><span class="atributo_titulo">Veja o Que Seu Público Está Acessando:</span> Acompanhamento de usuários online, visitas diárias, visitas mensais, e quais páginas seus clientes mais estão visualizando, proporcionando a você uma base no apoio de tomada de decisão sobre os conteúdos que mais agradam o seu público!</p>
                        <div class="clear"></div>
                    </div>
                </article>

                <article class="atributo">
                    <div class="content">
                        <img title="Interaja Com Seu Público" alt="[Interaja Com Seu Público]" src="layout/img/icone-estrela.fw.png">
                        <h2 class="ds-none">Interaja Com Seu Público:</h2>
                        <p><span class="atributo_titulo">Interaja Com Seu Público:</span> Sistema de comentários e respostas que traz a você uma melhor interação com o seu público proporcionando uma tomada de decisão de melhoria e criação de novos conteúdos, produtos ou serviços.</p>
                        <div class="clear"></div>
                    </div>
                </article>

                <article class="atributo">
                    <div class="content">
                        <img title="Conecte o Seu Blog Com o Mundo" alt="[Conecte o Seu Blog Com o Mundo]" src="layout/img/icone-estrela.fw.png">
                        <h2 class="ds-none">Conecte o Seu Blog Com o Mundo:</h2>
                        <p><span class="atributo_titulo">Conecte o Seu Blog Com o Mundo:</span> Integração com redes sociais como Facebook, Instagram e Youtube, proporcionando ao seu negócio uma presença maior na internet!</p>
                        <div class="clear"></div>
                    </div>
                </article>


                <article class="atributo">
                    <div class="content">
                        <img title="Temas Personalizados" alt="[Temas Personalizados]" src="layout/img/icone-estrela.fw.png">
                        <h2 class="ds-none">Temas Personalizados:</h2>
                        <p><span class="atributo_titulo">Temas Personalizados:</span> Criação de site sob medida para o seu negócio, com SEO otimizado de acordo com os padrões de marcação do Google e posicionamento de elementos de forma estratégica para atrair seus clientes!</p>
                        <div class="clear"></div>
                    </div>
                </article>

                <!--                <article class="atributo">
                                    <div class="content">
                                        <img title="Distribua Conteúdo Com Seu E-mail Marketing" alt="[Distribua Conteúdo Com Seu E-mail Marketing]" src="img/icone-estrela.fw.png">
                                        <h2 class="ds-none">Distribua Conteúdo Com Seu E-mail Marketing:</h2>
                                        <p><span class="atributo_titulo">Distribua Conteúdo Com Seu E-mail Marketing:</span> Sistema de captura de e-mails (opt-in) para você integrar com o seu e-mail marketing, oferencendo conteúdos exclusivos e aquecendo a relação com os seus clientes.</p>
                                        <div class="clear"></div>
                                    </div>
                                </article>-->

                <article class="atributo">
                    <div class="content">
                        <img title="Acesse o seu site de qualquer lugar" alt="[Acesse o seu site de qualquer lugar]" src="layout/img/icone-estrela.fw.png">
                        <h2 class="ds-none">Acesse o seu site de qualquer lugar:</h2>
                        <p><span class="atributo_titulo">Acesse o seu site de qualquer lugar:</span> Tenha um site que seja possível de ver em qualquer dispositivo: smartphones, celulares, computadores, tablets, smart Tv's...</p>
                        <div class="clear"></div>
                    </div>
                </article>

                <div class="clear"></div>
            </div>

        </section>

        <section class="dobra_depoimentos container">

            <header class="container header_depoimentos m-bottom3">
                <div class="content">
                    <h1>O Que Eles Falam Sobre o Serviço</h1>
                    <div class="clear"></div>
                </div>
            </header>

            <div class="content">

                <article class="depoimento">
                    <img class="rounded" height="70" title="Nilma Nayara Neves" alt="Nilma Nayara Neves" src="layout/img/depoimento-nayara.jpeg">
                    <h2 class="ds-none">Excelente</h2>
                    <div class="descricao_depoimento">
                        <p>“<strong>Excelente</strong>. O Luiz foi muito profissional e responsável com tudo que eu pedi, só tenho a agradecer pela paciência e dedicação que ele teve comigo. Cumpriu o nosso contrato a risca e ainda fez além do que eu pedi, foi ótimo, parabéns!”</p>
                        <p class="font-bold">Nilma Nayara Neves - Diamantina - MG</p>
                    </div>
                </article>

                <!--                <div class="divisor_depoimento"></div>-->

                <article class="depoimento">
                    <img class="rounded" height="70" title="" alt="[]" src="layout/img/vitoria-alves.jpg">
                    <h2 class="ds-none">Incrível</h2>
                    <div class="descricao_depoimento">
                        <p>“<strong>Incrível.</strong> Bem mais do que eu esperava, o site ficou super funcional, super prático, o Luiz Felipe ficou super disponível e conseguiu fazer todo o meu site em 1 semana! Sou muito grata, foi um ótimo trabalho. Valeu a pena o dinheiro investido.”</p>
                        <p class="font-bold">Vitória Alves - Curvelo - MG</p>
                    </div>    
                </article>

                <div class="clear"></div>
            </div>

        </section>

        <div class="borda_divisao">
            <div class="linha_divisao"></div>
        </div>

        <section class="dobra_bonus container al-center m-bottom3">
            <div class="content al-center">
                <img title="Bônus Exclusivo" alt="[Bônus Exclusivo]" src="layout/img/icone-bonus.fw.png">
                <h1 class="m-bottom3 caps-lock font-bold">Bônus Exclusivo</h1>
                <p>Treinamento de Gestão de Conteúdo em vídeo aulas para você utilizar o Flowstate Blog com total facilidade no seu negócio.</p>
                <div class="clear"></div>
            </div>
        </section>

        <section class="dobra_prazo container m-bottom3">
            <div class="aviso_escassez container m-bottom3">
                <div class="bloco_escassez">
                    <img title="" alt="" src="layout/img/icone-calendario.fw.png">
                    <h1>Não deixe para depois pois fazemos até 10 consultorias gratuitas por mês!</h1>
                </div>
            </div>

            <div class="chamada_escassez container al-center">
                <div class="content">
                    <a class="btn btn-green botao_escassez m-top3 m-bottom3 radius j_optin" title="Consultoria Grátis" href="#">Consultoria Grátis</a>
                    <div class="clear"></div>
                </div>
            </div>
        </section>

        <section class="dobra_demonstracao container">
            <div class="content m-top3 m-bottom3 al-center">
                <h1 class="m-bottom3">Torne mais ágil o gerenciamento do conteúdo do seu site, trazendo maior produtividade para o seu negócio. Veja mais um depoimento sobre o nosso serviço!</h1>

                <div class="bloco_apresentacao">
                    <div class="box video-large no-margin video_apresentacao">
                        <div class="video no-margin video_chamada_curso">
                            <div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/rXUvpmZgNGU" frameborder="0" allowfullscreen></iframe></div>
                            <!--<div class="ratio js_media js_video_dobra1"></div>-->
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </section>

        <section class="dobra_garantia container m-bottom3 al-center">
            <div class="content">
                <img title="" alt="[]" src="layout/img/icone-garantia.fw.png">
                <h1 class="m-bottom1 font-bold">30 Dias de Suporte Garantidos !</h1>
                <p class="m-bottom3">Não se preocupe! Você terá 30 dias de suporte gratuito após o final do projeto para qualquer auxílio, dicas e melhorias referentes ao serviço prestado.</p>
                <div class="clear"></div>
            </div>
        </section>

        <section class="dobra_prazo2 container al-center m-bottom3">
            <div class="content">
                <img title="" alt="[]" src="layout/img/logo-embaixo.fw.png">
                <h1 class="font-bold">Mas Não Perca Tempo!</h1>
                <p class="font-bold m-bottom3">Pois fazemos até 10 consultorias por mês!</p>
                <a class="btn btn-green botao_escassez radius j_optin" title="Consultoria Grátis" href="#">Consultoria Grátis</a>
                <div class="clear"></div>
            </div>
        </section>

        <footer class="container al-center">
            <div class="content">
                <p><a class="js_exibir_autor" title="Sobre o Autor" href="#">Sobre o Autor</a> | <a class="js_exibir_termos" title="Termos de Uso" href="#">Termos de Uso</a></p>
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
                            <img title="" alt="[]" src="layout/img/foto-autor2.jpg">
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
    <script src="_cdn/jquery.js"></script>
    <script src="_cdn/jquery.form.js"></script>
    <script src="_cdn/app_campaign/scripts/landing.js"></script>
    <script src="layout/js/blog.js"></script>
    <script>
        $(function () {
            $(".js_cel").mask("(99) 99999-9999", {autoclear: false});
        });
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122807631-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-122807631-2');
    </script>
    <!-- Global site tag (gtag.js) - AdWords: 792201948 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-792201948"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'AW-792201948');
    </script>

</html>

<?php ob_end_flush(); ?>