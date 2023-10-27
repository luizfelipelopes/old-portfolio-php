
<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$sessao = new Session(1);
//var_dump($Link->getFile());

if (!isset($_SESSION['carrinho']) && empty($_SESSION['carrinho'])):
//    session_start();
endif;

if (!isset($_SESSION['clientelogin']) || empty($_SESSION['clientelogin'])):
    unset($_SESSION['carrinho']);
endif;

/*
 * Sequência de Arquivos p/ Executar Pagamento Pelo PagSeguro
 * 1 - scripts.js (Pega Dados do FORM)
 * 2 - ajax.php (Executa a ação de cadastro, para manipular dados do formulário)
 * 3 - AdminCliente (Cadastra o Comprador)
 * 4 - LoginCliente (Loga o comprador, iniciando uma seção)
 * 5 - index.php (Redirecionamento de volta para o index executar a ação de salvar para Checkout no PagSeguro)
 * 6 - Carrinho (Salva dados do Carrinho, ou seja, dados da venda no BD)
 * 7 - CheckoutPagSeguro (Executa o Checkout do PagSeguro)
 * 8 - TransacoesPagSeguro (Recebe Notificações Para Identificar a Confirmação do Pagamento e demais Status)
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--<link href="https://fonts.googleapis.com/css?family=BenchNine|Lato|Tajawal" rel="stylesheet">-->
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/fonts-sync.css"/>
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/boot3-sync.css"/>
        <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style15.css"/>
        <!--<link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/css/style15-sync.css"/>-->
    </head>

    <?php if (FACEBOOK_APP == '1'): ?>

        <!--        <div id="fb-root"></div>
                <script>(function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (d.getElementById(id))
                            return;
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=467593886964781";
                        fjs.parentNode.insertBefore(js, fjs);
                    }(document, 'script', 'facebook-jssdk'));</script>-->

    <?php endif; ?>



    <body>

        <div class="fundo js_modal_hoteis j_popup ds-none">
            <div class="inscricao_conferencia lista_hoteis bg-gray">
                <div class="fechar ajax_close" title="Fechar">x</div>
                <div class="cl-gray titulo_modal_hoteis m-bottom3">Hotéis</div>

                <div class="bloco_hotel cl-gray">
                    <div class="titulo_modal_hotel m-bottom1"><span>Nome: </span>Hotel Tereza</div>
                    <div class="site_modal_hotel m-bottom1"><span>Site: </span><a target="_blank" href="http://hoteltereza.com.br/site">http://hoteltereza.com.br/site</a></div>
                    <div class="site_modal_promocao m-bottom1"><p><span>Promoção: </span>Hospedagem por apenas <strong>R$ 70,00</strong>, incluindo <strong>todos os dias</strong> do evento. O código promocional é: <strong>Conferência Avante</strong>! Falar com o proprietário.</p></div>
                </div>


            </div>
        </div>

        <div class="fundo j_popup js_bloco_ingresso_menor ds-none">
            <div class="inscricao_conferencia bg-gray">
                <div class="fechar ajax_close" title="Fechar">x</div>
                <div class="trigger-box-suspenso"></div>
                <form action="" method="POST">

                    <input type="hidden" name="action" value="cadastrar">
                    <input type="hidden" name="cliente_tipo" value="menor">

                    <legend>Inscrição Menores de 18 Anos</legend>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_name_responsavel" placeholder="Nome Completo do Responsável" required>
                    </label>

                    <label class="form-field col-49 js_bloco_cpf">
                        <input id="cpf" class="js_auto_preencher" type="tel" name="cliente_cpf" placeholder="CPF responsável" required>
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_name" placeholder="Nome" required>
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_lastname" placeholder="Sobrenome" required>
                    </label>

                    <label class="form-field col-49">
                        <input id="calendario" type="tel" name="cliente_data_nascimento" placeholder="Data de Nascimento" required>
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_email" placeholder="E-mail" required>
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_telefone" placeholder="Telefone" required>
                    </label>

                    <label class="form-field col-49">	
                        <!--<span>UF:</span>-->			
                        <select class="j_loadstate" name="cliente_uf" required="required">
                            <option value="" disabled selected> Selecione o estado </option>
                            <?php
                            $readState = new Read;
                            $readState->ExeRead(ESTADOS, "ORDER BY estado_nome ASC");
                            foreach ($readState->getResult() as $estado):
                                extract($estado);
                                echo "<option value=\"{$estado_id}\" ";
//
                                if (isset($ClienteData['cliente_uf']) && $estado_id == $ClienteData['cliente_uf']):
                                    echo "selected=\"selected\" ";
                                endif;
//
                                echo "> {$estado_uf} / {$estado_nome} </option>";
                            endforeach;
                            ?>                        
                        </select>

                    </label>

                    <label class="form-field col-49">	
                        <!--<span>Cidade:</span>-->			
                        <select class="j_loadcity" name="cliente_cidade" required="required">

                            <?php
                            if (!isset($ClienteData['cliente_cidade'])):
                                echo "<option value=\"\" disabled selected> Selecione antes um estado </option>";
                            else:

                                $read = new Read();
                                $read->ExeRead(CIDADES, "WHERE estado_id = :id ORDER BY cidade_nome ASC", "id={$ClienteData['cliente_uf']}");
                                if ($read->getResult()):
                                    foreach ($read->getResult() as $city):

                                        echo "<option value=\"{$city['cidade_id']}\" ";

                                        if (isset($ClienteData['cliente_cidade']) && $ClienteData['cliente_cidade'] == $city['cidade_id']):

                                            echo "selected ";
                                        endif;

                                        echo "> {$city['cidade_nome']} </option>";

                                    endforeach;

                                endif;

                            endif;
                            ?>   
                        </select>
                    </label>

                    <label class="form-field col-49">
                        <span class="cl-red">* Obs: Menores abaixo de 7 anos entram gratuitamente.</span>
                        <span class="cl-red">* Obs: Menores de 7 a 10 anos pagam meia-entrada.</span>
                        <!--<input class="cl-gray" type="file" name="cliente_declaracao" required>-->
                    </label>

                    <label class="form-field col-49 m-top3">
                        <a class="link_declaracao" target="_blank" href="<?= INCLUDE_PATH; ?>/docs/declaracao-menor.pdf" title="Baixar Declaração">Baixar Declaração Para Menores de 18 Anos</a>
                    </label>

                    <label class="form-field col-49">
                        <span class="cl-red">Insira aqui a declaração assinada autorizando o menor a ir ao evento.</span>
                        <input class="cl-gray" type="file" name="cliente_declaracao" required>
                    </label>

                    <div class="container"></div>
                    <button title="Comprar Ingresso" class="botao_contato btn radius j_btn fl-right">Comprar</button>
                    <div title="Carregando" class="load fl-right"></div>
                </form>
                <div id="j_ajaxident" class="<?= INCLUDE_PATH . "/ajax" ?>"></div>         
                <div class="clear"></div>
            </div>
        </div>

        <div class="fundo j_popup ds-none js_bloco_ingresso_maior">
            <div class="inscricao_conferencia bg-gray">
                <div class="fechar ajax_close">x</div>
                <div class="trigger-box-suspenso"></div>
                <form action="" method="POST">
                    <legend>Inscrição Maiores de 18 Anos</legend>

                    <input type="hidden" name="action" value="cadastrar">
                    <input type="hidden" name="cliente_tipo" value="maior">


                    <label class="form-field col-49">
                        <input type="text" name="cliente_name" placeholder="Nome" required>
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_lastname" placeholder="Sobrenome" required>
                    </label>

                    <label class="form-field col-49 js_bloco_cpf">
                        <input id="cpf2" class="js_auto_preencher" type="tel" name="cliente_cpf" placeholder="CPF" required value="">
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_email" placeholder="E-mail" required>
                    </label>

                    <label class="form-field col-49">
                        <input type="text" name="cliente_telefone" placeholder="Telefone" required>
                    </label>

                    <label class="form-field col-49">	
                        <!--<span>UF:</span>-->			
                        <select class="j_loadstate" name="cliente_uf" required="required">
                            <option value="" disabled selected> Selecione o estado </option>
                            <?php
                            $readState = new Read;
                            $readState->ExeRead(ESTADOS, "ORDER BY estado_nome ASC");
                            foreach ($readState->getResult() as $estado):
                                extract($estado);
                                echo "<option value=\"{$estado_id}\" ";
//
                                if (isset($ClienteData['cliente_uf']) && $estado_id == $ClienteData['cliente_uf']):
                                    echo "selected=\"selected\" ";
                                endif;
//
                                echo "> {$estado_uf} / {$estado_nome} </option>";
                            endforeach;
                            ?>                        
                        </select>

                    </label>

                    <label class="form-field col-49">	
                        <!--<span>Cidade:</span>-->			
                        <select class="j_loadcity" name="cliente_cidade" required="required">

                            <?php
                            if (!isset($ClienteData['cliente_cidade'])):
                                echo "<option value=\"\" disabled selected> Selecione antes um estado </option>";
                            else:

                                $read = new Read();
                                $read->ExeRead(CIDADES, "WHERE estado_id = :id ORDER BY cidade_nome ASC", "id={$ClienteData['cliente_uf']}");
                                if ($read->getResult()):
                                    foreach ($read->getResult() as $city):

                                        echo "<option value=\"{$city['cidade_id']}\" ";

                                        if (isset($ClienteData['cliente_cidade']) && $ClienteData['cliente_cidade'] == $city['cidade_id']):

                                            echo "selected ";
                                        endif;

                                        echo "> {$city['cidade_nome']} </option>";

                                    endforeach;

                                endif;

                            endif;
                            ?>   
                        </select>
                    </label>

                    <div class="container"></div>
                    <button class="botao_contato btn radius j_btn fl-right">Comprar</button>
                    <div title="Carregando" class="load fl-right"></div>
                </form>
                <div id="j_ajaxident" class="<?= INCLUDE_PATH . "/ajax" ?>"></div>         
                <div class="clear"></div>
            </div>
        </div>

        <header class="container js_bloco_header">

            <div class="container bloco_header">
                <div class="content">
                    <!--<h1 class="ds-none">Conferência Avante Pelo Reino</h1>-->
                    <h1 class="ds-none"><?= SITENAME; ?></h1>

                <!--<img title="Conferência Avante Pelo Reino" alt="[Conferência Avante Pelo Reino]" src="<?= INCLUDE_PATH; ?>/img/logo transparente.png" />-->

                    <span class="fontzero fl-left main-logo main-logo-mobile"><a title="Conferência Avante Pelo Reino" href="<?= HOME . '/&theme='. THEME; ?>">Conferência Avante Pelo Reino</a></span>

                    <div class="j_menu_mobile main_mob_nav main_menu_mobile bg-blue fl-right round">
                        <div class="listras">
                            <div class="linhas"></div>
                            <div class="linhas"></div>
                            <div class="linhas"></div>
                        </div>
                    </div>

                    <nav class="main_nav js_menu">
                        <ul>
                            <li><a title="Home" href="#home">Home</a></li>
                            <li><div class="menu_bola"><div class="bola"></div></div></li>
                            <li><a title="Informações" href="#informacoes">Informações</a></li>
                            <li><div class="menu_bola"><div class="bola"></div></div></li>
                            <li><a title="Ministrantes" href="#ministrantes">Ministrantes</a></li>
                            <li><div class="menu_bola"><div class="bola"></div></div></li>
                            <li><a title="Preletores" href="#preletores">Preletores</a></li>
                            <li><div class="menu_bola"><div class="bola"></div></div></li>
                            <li><a title="Contato" href="#contato">Contato</a></li>
                            <li><div class="menu_bola"><div class="bola"></div></div></li>
                            <li><a title="Local" href="#local">Local</a></li>
                            <li><div class="menu_bola"><div class="bola"></div></div></li>
                            <li><a title="Ingressos" href="#ingressos">Ingressos</a></li>
                        </ul>
                    </nav>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="bloco_banner_topo container">
                <div class="box_imagem img_logo">
                    <img title="Conferência Avante Pelo Reino" alt="[Conferência Avante Pelo Reino]" src="tim.php?src=<?= INCLUDE_PATH; ?>/img/logo-transparente.png&h=250&w=850&zc=1" />
                </div>
                <div class="box_imagem img_data">
                    <img title="Conferência Avante Pelo Reino" alt="[Conferência Avante Pelo Reino]" src="<?= INCLUDE_PATH; ?>/img/data-google.png" />
                </div>

                <div class="box_imagem img_local">
                    <img title="Conferência Avante Pelo Reino" alt="[Conferência Avante Pelo Reino]" src="<?= INCLUDE_PATH; ?>/img/local-google.png" />
                </div>
            </div>

            <div class="countdown container m-bottom3">
                <div class="content">
                    <div class="bloco_countdown js_countdown">
                        <p class="faltam_apenas m-top1">Faltam Apenas:</p>
                        <div class="bloco_periodos">
                            <div class="bloco_periodo"><span class="numero js_dias">00</span><span class="tempo">Dias</span></div>
                            <div class="bloco_periodo"><span class="numero js_horas">00</span><span class="tempo">Horas</span></div>
                            <div class="bloco_periodo"><span class="numero js_minutos">00</span><span class="tempo">Minutos</span></div>
                            <div class="bloco_periodo"><span class="numero js_segundos">00</span><span class="tempo">Segundos</span></div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>

        </header>

        <section id="home" class="dobra1 container m-bottom3">
            <div class="content">
                <article class="sobre_evento m-bottom3">
                    <header class="container m-bottom5">
                        <div class="bloco_header_evento">
                            <span class="logo_titulo"></span>
                            <h1>Conferência Avante 2018</h1>
                        </div>
                    </header>

                    <p>A conferência Avante pelo Reino, foi gerada com o intuito de levar os jovens a conhecerem Cristo e o Reino de uma forma nova.</p>
                    <p>Sem pregar placas de igrejas e sim mostrando aos jovens que eles são a igreja. Nossa conferência quer impactar você com a presença do Espírito Santo, de uma forma que você nunca experimentou em união e amor, como o corpo de Cristo deve ser.</p>
                    <p>Iremos motivar  e mostrar a você qual o seu chamado em Cristo Jesus e como você pode fazer o Reino de Deus crescer aqui na terra.</p>
                    <p>Conferência Avante pelo Reino, avante com a Palavra!</p>
                </article>

                <article class="video_evento">
                    <header class="container m-bottom3">
                        <div class="bloco_header_lote">
                            <span class="lote">
                                <?php $Ingresso = BuscaRapida::buscarIngresso(1); ?>

                                <?php
                                /*
                                if (!empty($Ingresso['ingresso_lote_ativo'] == '1') && empty($Ingresso['ingresso_icone_lote1'])):
                                    ?>
                                    <span class="lote_titulo"> <?= $Ingresso['ingresso_lote_ativo']; ?> º Lote</span>        

                                    <?php
                                elseif (!empty($Ingresso['ingresso_lote_ativo'] == '2') && empty($Ingresso['ingresso_icone_lote2'])):
                                    ?>
                                    <span class="lote_titulo"> <?= $Ingresso['ingresso_lote_ativo']; ?> º Lote</span>        
                                    <?php
                                elseif (!empty($Ingresso['ingresso_lote_ativo'] == '3') && empty($Ingresso['ingresso_icone_lote3'])):
                                    ?>
                                    <span class="lote_titulo"> <?= $Ingresso['ingresso_lote_ativo']; ?> º Lote</span>        
                                    <?php
                                elseif (!empty($Ingresso['ingresso_lote_ativo'] == '4') && empty($Ingresso['ingresso_icone_lote4'])):
                                    ?>
                                    <span class="lote_titulo"> <?= $Ingresso['ingresso_lote_ativo']; ?> º Lote</span>        
                                    <?php
                                else:
                                    ?>    
                                    <img title="Lote do Ingresso" alt="[Lote do Ingresso]" src="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . ($Ingresso['ingresso_lote_ativo'] == '1' ? $Ingresso['ingresso_icone_lote1'] : ($Ingresso['ingresso_lote_ativo'] == '2' ? $Ingresso['ingresso_icone_lote2'] : ($Ingresso['ingresso_lote_ativo'] == '3' ? $Ingresso['ingresso_icone_lote3'] : ($Ingresso['ingresso_lote_ativo'] == '4' ? $Ingresso['ingresso_icone_lote4'] : $Ingresso['ingresso_lote_ativo'] . 'º')))); ?>&h=150&zc=1">
                                <?php
                                endif;
                                */
                                ?>
                            </span>


                            <?php
                            /*
                            if (!empty($Ingresso['ingresso_lote_ativo'] == '1') && !empty($Ingresso['ingresso_data_lote1'])):
                                ?>
                                <h1>Até dia <?= strftime('%d', strtotime($Ingresso['ingresso_data_lote1'])); ?> de <?= strftime('%B', strtotime($Ingresso['ingresso_data_lote1'])) ?></h1>        
                                <?php
                            elseif (!empty($Ingresso['ingresso_lote_ativo'] == '2') && !empty($Ingresso['ingresso_data_lote2'])):
                                ?>
                                <h1>Até dia <?= strftime('%d', strtotime($Ingresso['ingresso_data_lote2'])); ?> de <?= strftime('%B', strtotime($Ingresso['ingresso_data_lote2'])) ?></h1>        
                                <?php
                            elseif (!empty($Ingresso['ingresso_lote_ativo'] == '3') && !empty($Ingresso['ingresso_data_lote3'])):
                                ?>
                                <h1>Até dia <?= strftime('%d', strtotime($Ingresso['ingresso_data_lote3'])); ?> de <?= strftime('%B', strtotime($Ingresso['ingresso_data_lote3'])) ?></h1>        
                                <?php
                            elseif (!empty($Ingresso['ingresso_lote_ativo'] == '4') && !empty($Ingresso['ingresso_data_lote4'])):
                                ?>
                                <h1>Até dia <?= strftime('%d', strtotime($Ingresso['ingresso_data_lote4'])); ?> de <?= strftime('%B', strtotime($Ingresso['ingresso_data_lote4'])) ?></h1>        
                                <?php
                            else:
                                */
                                ?>    
                                <h1>Até dia 10 de Julho</h1>
                            <?php
                            /*
                            endif;
                            */
                            ?>


                        </div>
                    </header>

                    <div class="box video-large no-margin video_apresentacao">
                        <div class="video no-margin video_chamada_curso">
<!--                            <div class="ratio js_media js_video_dobra1"><iframe class="media" src="https://www.youtube.com/embed/RnP5RZCS1wA" frameborder="0" allowfullscreen></iframe></div>-->
                            <div class="ratio js_media js_video_dobra1"></div>
                        </div>
                    </div>

                </article>
                <div class="clear"></div>
            </div>
        </section>

        <section id="ministrantes" class="dobra_ministrantes container m-bottom3">
            <div class="content">
                <header class="container al-center m-bottom5 m-top1">
                    <div class="borda_titulo">
                        <div class="linha_titulo"></div>
                    </div>
                    <h1>Ministrantes</h1>
                    <div class="borda_titulo">
                        <div class="linha_titulo"></div>
                    </div>
                </header>

                <article class="bloco_ministrante container m-bottom3">

                    <div class="controle_blocos_ministrantes">


                        <div class="bloco_nome_ministrante container m-bottom3">
                            <h2>Cristo Vivo</h2>
                            <div class="borda_nome_ministrante">
                                <div class="linha_nome_ministrante"></div>
                            </div>
                        </div>

                        <div class="bloco_left_ministrante">
                            <div class="box_imagem img_ministrante">
                                <img title="Cristo Vivo" alt="[Cristo Vivo]" src="<?= INCLUDE_PATH; ?>/img/ministrantes/cristo-vivo-google.jpg" />
                            </div>
                        </div>

                        <div class="bloco_right_ministrante">

                            <div class="box video-large no-margin video_mistrante">
                                <div class="video no-margin video_chamada_curso">
                                    <!--<div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/uTLJ-utpbkY" frameborder="0" allowfullscreen></iframe></div>-->
                                    <div class="ratio js_media js_video_cristo_vivo"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>

                <article class="bloco_ministrante container m-bottom3">


                    <div class="controle_blocos_ministrantes">

                        <div class="bloco_nome_ministrante">
                            <h2>Eli Soares</h2>
                            <div class="borda_nome_ministrante">
                                <div class="linha_nome_ministrante"></div>
                            </div>
                        </div>


                        <div class="bloco_left_ministrante">
                            <div class="box_imagem img_ministrante">
                                <!--<img title="Eli Soares" alt="[Eli Soares]" src="tim.php?src=<?= INCLUDE_PATH; ?>/img/ministrantes/eli-soares.JPG&h=450&h=450&zc=1" />-->
                                <img title="Eli Soares" alt="[Eli Soares]" src="<?= INCLUDE_PATH; ?>/img/ministrantes/eli-soares-google.jpg" />
                            </div>
                        </div>

                        <div class="bloco_right_ministrante">

                            <div class="box video-large no-margin video_mistrante">
                                <div class="video no-margin video_chamada_curso">
                                    <!--<div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/Y1BWu509xyQ" frameborder="0" allowfullscreen></iframe></div>-->
                                    <div class="ratio js_media js_video_eli_soares"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>

                <article class="bloco_ministrante container m-bottom3">

                    <div class="controle_blocos_ministrantes">
                        <div class="bloco_nome_ministrante">
                            <h2>David Quinlan</h2>
                            <div class="borda_nome_ministrante">
                                <div class="linha_nome_ministrante"></div>
                            </div>
                        </div>


                        <div class="bloco_left_ministrante">
                            <div class="box_imagem img_ministrante">
                                <!--<img title="David Quinlan" alt="[David Quinlan]" src="tim.php?src=<?= INCLUDE_PATH; ?>/img/ministrantes/david-quinlan.jpeg&h=450&h=450&zc=1" />-->
                                <img title="David Quinlan" alt="[David Quinlan]" src="<?= INCLUDE_PATH; ?>/img/ministrantes/david-quinlan-google.jpg" />
                            </div>
                        </div>

                        <div class="bloco_right_ministrante">

                            <div class="box video-large no-margin video_mistrante">
                                <div class="video no-margin video_chamada_curso">
                                    <!--<div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/Ax--lHPxDMY" frameborder="0" allowfullscreen></iframe></div>-->
                                    <div class="ratio js_media js_video_david_quinlan"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>

                <article class="bloco_ministrante container m-bottom3">

                    <div class="controle_blocos_ministrantes">

                        <div class="bloco_nome_ministrante">
                            <h2>Banda Leme</h2>
                            <div class="borda_nome_ministrante">
                                <div class="linha_nome_ministrante"></div>
                            </div>
                        </div>

                        <div class="bloco_left_ministrante">
                            <div class="box_imagem img_ministrante">
                                <!--<img title="Banda Leme" alt="[Banda Leme]" src="tim.php?src=<?= INCLUDE_PATH; ?>/img/ministrantes/banda-leme.jpeg&h=450&h=450&zc=1" />-->
                                <img title="Banda Leme" alt="[Banda Leme]" src="<?= INCLUDE_PATH; ?>/img/ministrantes/leme-google.jpg" />
                            </div>
                        </div>

                        <div class="bloco_right_ministrante">

                            <div class="box video-large no-margin video_mistrante">
                                <div class="video no-margin video_chamada_curso">
                                    <!--<div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/_S9f4V23nJ4" frameborder="0" allowfullscreen></iframe></div>-->
                                    <div class="ratio js_media js_video_leme"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                </article>

                <div class="clear"></div>
            </div>
        </section>

        <section id="preletores" class="dobra_preletores container">
            <div class="content">
                <header class="container al-center m-bottom2">
                    <div class="borda_titulo">
                        <div class="linha_titulo"></div>
                    </div>
                    <h1>Preletores</h1>
                    <div class="borda_titulo">
                        <div class="linha_titulo"></div>
                    </div>
                </header>

                <article class="bloco_preletor m-bottom3">

                    <div class="controle_blocos_preletores">
                        <div class="bloco_left_preletor">
                            <div class="bloco_nome_preletor">
                                <h2>Dan Batista</h2>
                                <div class="borda_nome_preletor">
                                    <div class="linha_nome_preletor"></div>
                                </div>
                            </div>
                            <div class="box_imagem img_preletor">
                                <img title="Dan Batista" alt="[Dan Batista]" src="<?= INCLUDE_PATH; ?>/img/ministrantes/dan-batista-google.jpg" />
                            </div>
                        </div>

<!--                        <div class="bloco_right_preletores">
                            
                            <div class="box video-large no-margin video_preletor">
                                <div class="video no-margin video_chamada_curso">
                                    <div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/1NGrLfuGMcY" frameborder="0" allowfullscreen></iframe></div>
                                    <div class="ratio js_media js_video_dan_batista"></div>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>-->
                    </div>
                </article>

                <article class="bloco_preletor m-bottom3">

                    <div class="controle_blocos_preletores">
                        <div class="bloco_left_preletor">
                            <div class="bloco_nome_preletor">
                                <h2>Pr. Isaías</h2>
                                <div class="borda_nome_preletor">
                                    <div class="linha_nome_preletor"></div>
                                </div>
                            </div>
                            <div class="box_imagem img_preletor">
                                <img title="Pr. Isaías" alt="[Pr. Isaías]" src="<?= INCLUDE_PATH; ?>/img/ministrantes/pr-isaias-google.jpg" />
                            </div>
                        </div>

<!--                        <div class="bloco_right_preletores">

                            <div class="al-justify descricao_preletor">
                                <p>A conferência Avante pelo Reino, foi gerada com o intuito de levar os jovens a conhecerem Cristo e o Reino de uma forma nova.</p>
                                <p>Sem pregar placas de igrejas e sim mostrando aos jovens que eles são a igreja. Nossa conferência quer impactar você com a presença do Espírito Santo, de uma forma que você nunca experimentou em união e amor, como o corpo de Cristo deve ser.</p>
                                <p>Iremos motivar  e mostrar a você qual o seu chamado em Cristo Jesus e como você pode fazer o Reino de Deus crescer aqui na terra.</p>
                                <p>Conferência Avante pelo Reino, avante com a Palavra!</p>
                            </div>

                            <div class="box video-large no-margin video_preletor">


                            <div class="video no-margin video_chamada_curso">
                                                <div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/1NGrLfuGMcY" frameborder="0" allowfullscreen></iframe></div>
                            <div class="ratio js_media js_video_pr_batista"></div>
                            </div>
                            <div class="clear"></div>
                        </div>-->
                    </div>
            <!--</div>-->
        </article>

        <div class="clear"></div>
    </div>
</section>

<section id="chamada" class="dobra_chamada container m-bottom3">

    <div class="content">

        <header class="container al-center m-top3">
            <h1>Venha Celebrar Conosco, Para Juntos Seguirmos Avante Pelo Reino!</h1>
        </header>
        <div class="clear"></div>
    </div>

    <div class="bloco_video_chamada">
        <div class="box video-large video_chamada">
            <div class="video no-margin video_chamada_curso">
                <!--<div class="ratio js_media"><iframe class="media" src="https://www.youtube.com/embed/eFyOVVzldxM" frameborder="0" allowfullscreen></iframe></div>-->
                <div class="ratio js_media js_video_chamada"></div>
            </div>
        </div>
    </div>

    <div class="container m-bottom5 divisor_borda"></div>


    <!--</div>-->

</section>


<section id="informacoes" class="dobra_informacoes container">
    <div class="content">
        <header class="container m-bottom3 al-center">
            <div class="borda_titulo">
                <div class="linha_titulo"></div>
            </div>
            <h1 class="titulo_informacoes">Informações</h1>
            <div class="borda_titulo">
                <div class="linha_titulo"></div>
            </div>
        </header>
        <div class="container"></div>

        <div class="bloco_grupo_informacoes">
            <a class="bloco_informacoes box box-medium" target="_blank" title="Programação" href="<?= INCLUDE_PATH; ?>/docs/cronograma2.pdf">
                <article title="Confira Nossa Programação!">
                    <div class="content">
                        <header>
                            <div class="box_imagem img_programacao">
                                <img title="Programação" alt="[Programação]" src="<?= INCLUDE_PATH; ?>/img/icone-programacao-google.fw.png" />
                            </div>
                            <h1>Programação</h1>
                        </header>
                        <p class="no-margin">Confira tudo o que vai acontecer na Conferência. Os horários, ministrações e muito mais para que você não perca nada!</p>
                        <div class="clear"></div>
                    </div>
                </article>
            </a>

            <a class="bloco_informacoes box box-medium" title="Dicas" href="#">
                <article title="Confira Nossas Dicas!">
                    <div class="content">
                        <header>
                            <div class="box_imagem img_dicas">
                                <img title="Dicas" alt="[Dicas]" src="<?= INCLUDE_PATH; ?>/img/icone-dicas-google.fw.png" />
                            </div>
                            <h1>Dicas</h1>
                        </header>
                        <p class="no-margin">Confira aqui dicas e recados para você se organizar e aproveitar ao máximo a Conferência.</p>
                        <div class="clear"></div>
                    </div>
                </article>
            </a>

            <a class="bloco_informacoes m-bottom3 box box-medium last js_exibir_hoteis" title="Hotéis" target="_blank" href="#">
                <article title="Hospede-se nos Hotéis da Região!">
                    <div class="content">
                        <header>
                            <div class="box_imagem img_hoteis">
                                <img title="Hotéis" alt="[Hotéis]" src="<?= INCLUDE_PATH; ?>/img/icone-locais-google.fw.png" />
                            </div>
                            <h1>Hotéis</h1>
                        </header>
                        <p class="no-margin">Confira a lista de hotéis que são nossos parceiros, e irão hospedar você com comodidade, enquanto você aproveita a Conferência.</p>
                        <div class="clear"></div>
                    </div>
                </article>
            </a>
        </div>

        <div class="clear"></div>
    </div>
</section>

<section id="ingressos" class="dobra_ingressos container">
    <div class="content">

        <header class="container al-center m-top3 m-bottom3">
            <h1>Adquira Já Seu Ingresso!</h1>
            <p>Faça a Sua Inscrição!</p>
        </header>

        <div class="bloco_ingressos">
            <div class="bloco_ingresso js_ingresso_menor">
                <div class="content">
                    <span class="js_ingresso_menor" title="Inscrição Para Menores!">Menores de 18 Anos</span>
                    <div class="clear"></div>
                </div>
            </div>

            <div class="bloco_ingresso js_ingresso_maior">
                <div class="content">
                    <span class="js_ingresso_maior" title="Inscrição Para Maiores!">Maiores de 18 Anos</span>
                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</section>

<section id="contato" class="dobra_contato container">

    <div class="content">
        <header class="container al-center m-top3 m-bottom3">
            <div class="borda_titulo">
                <div class="linha_titulo"></div>
            </div>
            <h1>Contato</h1>
            <div class="borda_titulo">
                <div class="linha_titulo"></div>
            </div>
        </header>

        <form action="" method="POST" class="m-bottom3">
            <div class="trigger-box-suspenso"></div>
            <input type="hidden" name="action" value="enviar_contato">

            <label class="form-field">
                <input type="text" name="contato_nome" placeholder="Nome" value="" required/>
            </label>

            <label class="form-field">
                <input type="text" name="contato_email" placeholder="E-mail" value="" required />
            </label>

            <label class="form-field">
                <textarea rows="10" name="contato_mensagem" placeholder="Mensagem" required></textarea>
            </label>

            <button class="botao_contato btn radius j_btn fl-right">Enviar</button>
            <div title="Carregando" class="load fl-right"></div>
        </form>

        <div class="clear"></div>
    </div>

    <section class="container dobra_tel_contato">

        <div class="content al-center">

            <header class="container m-bottom3">
                <h1>Se preferir, entre em Contato pelos Telefones:</h1>
            </header>

            <div class="container al-center">
                <div class="bloco_tel_contato">
                    <h2>Igor</h2>
                    <span>(38) 99956-5358</span>
                </div>

                <div class="bloco_tel_contato">
                    <h2>Sandro</h2>
                    <span>(38) 99974-6132</span>
                </div>

                <div class="bloco_tel_contato">
                    <h2>Vitoria Alves</h2>
                    <span>(38) 99947-0783</span>
                </div>
            </div>

            <div class="clear"></div>
        </div>
    </section>


</section>



<section id="local" class="dobra_local container">


    <div class="bloco_endereco container">
        <div class="fundo_foto"></div>
        <div class="content al-center">
            <header class="header_endereco container">
                <div class="borda_titulo">
                    <div class="linha_titulo"></div>
                </div>
                <h1>Local</h1>
                <div class="borda_titulo">
                    <div class="linha_titulo"></div>
                </div>
            </header>

            <div class="local_endereco">
                <p>CAIC</p>
                <p>Rua Costa Rica, 320 - Bela Vista</p>
                <p>Curvelo - MG</p>

            </div>
            <div class="clear"></div>
        </div>

    </div>

    <div class="bloco_mapa box_imagem container js_mapa">
        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d1548.6418531633292!2d-44.440571128397416!3d-18.770857001521044!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa863214c1542bb%3A0x7bd8f7c380c24f27!2sR.+Costa+Rica%2C+320+-+Bela+Vista%2C+Curvelo+-+MG%2C+35790-000!5e1!3m2!1spt-BR!2sbr!4v1526966871305" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d1548.6418531633292!2d-44.440571128397416!3d-18.770857001521044!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa863214c1542bb%3A0x7bd8f7c380c24f27!2sR.+Costa+Rica%2C+320+-+Bela+Vista%2C+Curvelo+-+MG%2C+35790-000!5e1!3m2!1spt-BR!2sbr!4v1526966871305" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>-->
    </div>

    <div class="clear"></div>

</section>

<footer class="container">

    <div class="antirodape container">
        <div class="content">

            <div class="bloco_antirodape">


                <nav class="menu_footer js_menu">
                    <ul>
                        <li><a title="Home" href="#home">Home</a></li>
                        <li><a title="Informações" href="#informacoes">Informações</a></li>
                        <li><a title="Ministrantes" href="#ministrantes">Ministrantes</a></li>
                        <li><a title="Preletores" href="#preletores">Preletores</a></li>
                        <li><a title="Contato" href="#contato">Contato</a></li>
                        <li><a title="Local" href="#local">Local</a></li>
                        <li><a title="Ingressos" href="#ingressos">Ingressos</a></li>
                    </ul>
                </nav>

                <div class="bloco_realizacao">
                    <div class="box_imagem realizacao_img">
                        <img title="Conferência Avante Pelo Reino" alt="[Conferência Avante Pelo Reino]" src="<?= INCLUDE_PATH; ?>/img/logo-vertical-no-redim-google.png">
                    </div>
                    <div class="realizacao_texto">
                        <p class="realizacao">Realização:</p>
                        <p>Igreja Casa de Oração Para Todas as Nações</p>
                    </div>
                </div>

                <div class="bloco_redes_sociais">
                    <p class="siga_titulo">Siga-nos:</p>
                    <div class="box_imagem facebook_img">
                        <a target="_blank" href="https://facebook.com/<?= PUBLISHER_FACEBOOK ?>"><img title="Siga-nos no Facebook da Conferência Avante" alt="[Siga-nos no Facebook da COnferência Avante]" src="<?= INCLUDE_PATH; ?>/img/icone-facebook-google.fw.png"></a>
                    </div>
                    <div class="box_imagem instagram_img">
                        <a target="_blank" href="https://instagram.com/<?= URL_INSTAGRAM; ?>"><img title="Siga-nos no Instagram da Conferência Avante" alt="[Siga-nos no Instagram da Conferência Avante]" src="<?= INCLUDE_PATH; ?>/img/instagram-google.png"></a>
                    </div>
                </div>

            </div>
            <div class="clear"></div>
        </div>

    </div>

    <div class="rodape container al-center">
        <div class="pd-top1 pd-bottom1 bloco_footer">
            <p class="copy m-top1">Copyright &copy; - Todos os Direitos Reservados</p>
            <p class="desenvolvimento_assinatura">Desenvolvido por <a class="assinatura" title="Luiz Felipe Lopes" target="_blank" href="https://www.linkedin.com/in/<?= URL_LINKEDIN; ?>">Luiz Felipe Lopes</a></p>
            <div class="clear"></div>
        </div>
    </div>

</footer>
<div class="js_subir_topo slide_topo radius"><span>^</span></div>

</body>

<script src="<?= INCLUDE_PATH; ?>/js/jquery.js"></script>
<script async src="<?= INCLUDE_PATH; ?>/js/jquery.form.js"></script>
<script src="<?= INCLUDE_PATH; ?>/js/combo-sync.js"></script>
<script src="<?= HOME; ?>/_cdn/jmask.js"></script>
<script src="<?= HOME; ?>/_cdn/jquery.mask.js"></script>
<!--<script src="<?= INCLUDE_PATH; ?>/js/scripts3-sync.inc.js"></script>-->
<script src="<?= INCLUDE_PATH; ?>/js/scripts3.inc.js"></script>

<script type="text/javascript">
    $(window).load(function () {
        $('.js_mapa').append('<iframe src="https://www.google.com/maps/embed?pb=!1m17!1m11!1m3!1d1548.6418531633292!2d-44.440571128397416!3d-18.770857001521044!2m2!1f0!2f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xa863214c1542bb%3A0x7bd8f7c380c24f27!2sR.+Costa+Rica%2C+320+-+Bela+Vista%2C+Curvelo+-+MG%2C+35790-000!5e1!3m2!1spt-BR!2sbr!4v1526966871305" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>');
        $('.js_video_dobra1').append('<iframe class="media" src="https://www.youtube.com/embed/uTLJ-utpbkY" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_cristo_vivo').append('<iframe class="media" src="https://www.youtube.com/embed/uTLJ-utpbkY" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_eli_soares').append('<iframe class="media" src="https://www.youtube.com/embed/Y1BWu509xyQ" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_david_quinlan').append('<iframe class="media" src="https://www.youtube.com/embed/Ax--lHPxDMY" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_leme').append('<iframe class="media" src="https://www.youtube.com/embed/_S9f4V23nJ4" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_dan_batista').append('<iframe class="media" src="https://www.youtube.com/embed/1NGrLfuGMcY" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_pr_batista').append('<iframe class="media" src="https://www.youtube.com/embed/1NGrLfuGMcY" frameborder="0" allowfullscreen></iframe>');
        $('.js_video_chamada').append('<iframe class="media" src="https://www.youtube.com/embed/eFyOVVzldxM" frameborder="0" allowfullscreen></iframe>');
    });
</script>
</html>
