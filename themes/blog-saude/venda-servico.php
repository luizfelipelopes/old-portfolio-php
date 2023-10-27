<?php
//require '_app/Config.inc.php';
//require '_app/Config-Mail.inc.php';
//spl_autoload_register('carregarClasses');
//define(HOME, "http://n4qqno-user.freehosting.host");
?>
<!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="https://schema.org/WebSite">
    <head>
        <meta charset="UTF-8">
        <title>Nutricionista Low Carb</title>
        <meta name="description" content="Bem Vindo à Excelência em Emagrecimento Definitivo!"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </head>
    <body>

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


            <section class="container apresentacao apresentacao_venda">
                <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/logo-embaixo.fw.png">
                <div class="content">

                    <header class="container">
                        <h1 itemprop="description">Descubra Como Emagrecer Sem Sofrimento, Melhorar Sua Auto-Estima e Transformar a Mente PARA A SUA MELHOR VERSÃO</h1>
                    </header>

                    <div class="box video-large no-margin video_apresentacao">
                        <div class="video no-margin video_chamada_curso">
                            <div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/kvRNEXZFIEo" frameborder="0" allowfullscreen></iframe></div>
                            <!--<div class="ratio js_media js_video_dobra1"></div>-->
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div class="clear"></div>
                </div>
            </section>

            <div class="container botao_apresentacao botao_apresentacao_venda">
                <div class="content">
                    <a class="btn btn-green radius j_optin" title="Eu Quero! Preciso Emagrecer" href="#">Eu Quero! Preciso Emagrecer</a>
                    <div class="clear"></div>
                </div>
            </div>

            <section class="container dobra_atributos">
                <h1 class="ds-none">Qualidades do Serviço:</h1>

                <div class="limitador_view">
                    <div class="content">

                        <div class="flex">
                            <div class="atributo flex-2">
                                <div class="content">
                                    <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/coracao-topicos.png">
                                    <h2 class="ds-none">Atendimento Personalizado</h2>
                                    <p><span class="atributo_titulo">Atendimento Personalizado:</span> Nosso atendimento de Coach Nutricional não é uma simples consulta, vai além do tradicional e do comum. Nós trabalhamos com a excelência em conhecer você, identificar quais são os seus verdadeiros desejos, necessidades e valores para assim, conseguirmos te ajudar a resolver seus problemas, levando-a a alcançar suas metas e objetivos sem sofrimentos. Com nossa metodologia, VOCÊ EMAGRECER será apenas uma consequência das melhorias que viverá como um todo.</p>
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="atributo flex-2">
                                <div class="content">
                                    <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/coracao-topicos.png">
                                    <h2 class="ds-none">Liberdade de Vestir a Roupa que Quiser</h2>
                                    <p><span class="atributo_titulo">Liberdade de Vestir a Roupa que Quiser:</span> Você sabe o que é procurar uma roupa pra vestir e não encontrar nenhum que te agrade? Sabe o que é nada ficar bom? Sabe o que é ir em uma loja e ver olhares de julgamento ou ver aquela roupa que você amou, mas não te serviu? Sabe o que é experimentar uma roupa e ela rasgar porque ficou apertada? Sabe o que é oferecer ou pedir uma roupa emprestada pra uma amiga e ela olhar pro seu corpo e dizer não vai da? Se você sabe ou sentiu um apertinho no peito quando leu ou não quer deixar chegar a esse ponto, acredite esse trabalho é pra você. Nós podemos te ajudar!</p>
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="atributo flex-2">
                                <div class="content">
                                    <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/coracao-topicos.png">
                                    <h2 class="ds-none">Tenha o Corpo que Você Deseja Sem Sofrimentos</h2>
                                    <p><span class="atributo_titulo">Tenha o Corpo que Você Deseja Sem Sofrimentos:</span> Muitas pessoas pensam que para emagrecer é preciso sofrer. Isso é uma mentira. Tem sim, maneiras de você conseguir emagrecer sem grandes sofrimentos, grandes loucuras, sem passar fome, sem achar que não terá forças pra nada. Acredite em mim, se você aprender como emagrecer de verdade e de forma definitiva irá parar de sofrer e voltar a acreditar que é possível pra você sim!</p>
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="atributo flex-2">
                                <div class="content">
                                    <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/coracao-topicos.png">
                                    <h2 class="ds-none">Melhora do Corpo e da Mente</h2>
                                    <p><span class="atributo_titulo">Melhora do Corpo e da Mente:</span> Não adianta se você tentar emagrecer somente o seu corpo vai engordar tudo de novo. É o famoso efeito sanfona  “emagreci meu corpo, mas minha cabeça continuou como era antes...” não tem jeito se for assim volta tudo de novo mesmo. O único caminho para ser definitivo, para ter um corpo bonito, magro, sarado, em forma, do jeito que você sonha, sem efeito sanfona, é melhorando além do seu corpo, mas a sua mente também. Comece já a investir no que você tem de mais importante, sua mente, com ela boa, no caminho certo, sabendo e fazendo o que é certo você vai muito longe!</p>
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="atributo flex-2">
                                <div class="content">
                                    <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/coracao-topicos.png">
                                    <h2 class="ds-none">Tenha Hábitos Saudáveis Sem Dor</h2>
                                    <p><span class="atributo_titulo">Tenha Hábitos Saudáveis Sem Dor:</span> Mudança de hábitos geralmente é algo muito difícil não é mesmo? Mas isso se você não estiver trabalhando na raiz dos hábitos. Com a nossa metodologia a sua mentalidade vai mudando aos poucos e as vezes até sem você perceber. É muito comum escutar pacientes dizendo: “Nossa Nutri eu gostava tanto de salgado de rua aí esses dias passei em frente uma lanchonete, olhei e me deu uma repulsa, achei tão gorduroso, imaginei aquilo tudo me fazendo mal e nem pensei em comprar”. Isso é maravilhoso, a mudança verdadeira é aquela que ninguém te força ou te obriga, mas sim, a que você aprende e faz de forma comum e natural. Isso é LINDO, é uma das partes que mais amo!</p>
                                    <div class="clear"></div>
                                </div>
                            </div>

                            <div class="atributo flex-2">
                                <div class="content">
                                    <img title="" alt="[]" src="<?= INCLUDE_PATH; ?>/img/coracao-topicos.png">
                                    <h2 class="ds-none">Não Tenha Mais Vergonha ou Medo</h2>
                                    <p><span class="atributo_titulo">Não Tenha Mais Vergonha ou Medo:</span> Chega! Chega de se envergonhar de si mesma. Chega de não ter coragem. Chega de ter medo do que vão dizer de você. Chega de se julgar e se condenar como a “gordinha comilona” ou como a “fraca por doces” ou como a “pra mim não tem jeito mais não”. Já ta na hora de você da um basta nisso, levantar essa cabeça e tomar a decisão de “Agora Vai”, “Eu Preciso Me Cuidar”. Você é Linda, é Poderosa e eu tenho certeza que pode muito mais do que pensa! Se precisar de ajuda nessa caminhada de vitórias, aperta esse botão logo abaixo e vamos juntas começar a SUA NOVA FASE, a fase MUITO MELHOR da sua vida!</p>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </div>

                        <div class="clear"></div>
                    </div>
                </div>

            </section>


            <section class="container dobra_depoimentos m-bottom3">
                <header class="sectiontitle titulo_dobra_depoimentos container pd-top3 pd-bottom3">
                    <div class="content">
                        <h1>O Que Elas Falam Sobre a Nutri</h1>
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

            <section class="dobra_bonus container al-center m-bottom3">
                <div class="content al-center">
                    <header class="container">
                        <img title="Bônus Exclusivo" alt="[Bônus Exclusivo]" src="<?= INCLUDE_PATH ?>/img/icone-bonus.fw.png">
                        <h1 class="m-bottom3 caps-lock font-bold">Bônus Exclusivos</h1>
                    </header>

                    <div class="flex container">
                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>1ª Sessão Gratuita para conhecer e transformar a sua mente!</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>Receitas Fit da Nutri</p>
                        </div>

                        <div class="item_bonus flex-3">
                            <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-estrela.fw.png">
                            <p>30 Dias de Acompanhamento Online Via Whatsapp</p>
                        </div>
                    </div>

                    <div class="clear"></div>
                </div>
            </section>

            <section class="dobra_prazo container m-bottom3">
                <div class="aviso_escassez container m-bottom3">
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

                <div class="chamada_escassez botao_apresentacao container al-center">
                    <div class="content">
                        <a class="btn btn-green m-top3 m-bottom3 radius j_optin" title="Eu Quero! Preciso Emagrecer" href="#">Eu Quero! Preciso Emagrecer</a>
                        <div class="clear"></div>
                    </div>
                </div>
            </section>

            <article class="dobra_chamada container">
                <div class="content">
                    <h1>Saiba Como se Sentir MUITO Mais Bonita em 10 Semanas!</h1>
                    <div class="clear"></div>
                </div>
            </article>

            <section class="dobra_garantia container m-bottom3 al-center">
                <div class="content">
                    <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/icone-garantia.fw.png">
                    <h1 class="m-bottom1 font-bold">15 Dias de Garantia !</h1>
                    <p class="m-bottom3">Não se preocupe! Você tem 15 dias após a 1ª Sessão Transformadora para pedir o seu dinheiro de volta, caso não esteja satisfeito com o nosso serviço.</p>
                    <div class="clear"></div>
                </div>
            </section>

            <section class="dobra_prazo2 container al-center m-bottom3">
                <div class="content">
                    <img title="" alt="[]" src="<?= INCLUDE_PATH ?>/img/logo-embaixo.fw.png">
                    <h1 class="font-bold">Mas Não Perca Tempo!</h1>
                    <p class="font-bold m-bottom3">Pois com a grande procura as vagas estão limitadas!</p>
                    <div class="botao_apresentacao">
                        <a class="btn btn-green botao_escassez radius j_optin" title="Eu Quero! Preciso Emagrecer" href="#">Eu Quero! Preciso Emagrecer</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </section>
        </div>

        <footer class="footer_venda container al-center">
            <div class="content">
                <p><a class="js_exibir_autor" title="Sobre o Autor" href="#">Sobre o Autor</a> | <a title="Termos de Uso" target="_blank" href="<?= $LEGAL['termos-completo'] ?>">Termos de Uso</a></p>
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
    <script type="text/javascript" src="<?= HOME; ?>/_cdn/jquery.js"></script>
    <script type="text/javascript" src="<?= HOME; ?>/_cdn/jquery.form.js"></script>
    <script type="text/javascript" src="<?= INCLUDE_PATH; ?>/js/scripts1.inc.js"></script>
    <script src="<?= HOME; ?>/_cdn/app_campaign/scripts/landing.js"></script>
    <script src="<?= INCLUDE_PATH; ?>/js/servicos.inc.js"></script>
</html>
