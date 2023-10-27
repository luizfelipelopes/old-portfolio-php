<?php
$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT); // RECEBE AÇÃO A SER EXECUTADA NO CARRINHO

?>


<?php
// CASO ALGUMA AÇÃO FOI PASSADA POR URL
switch ($action):
    case 'salvar':
        $adminCarrinho = new Carrinho();
        $adminCarrinho->ExeSalvar($_SESSION['carrinho']);
        $adminPagSeguro = new CheckoutPagSeguro();
        $adminPagSeguro->ExeTransacao($_SESSION['clientelogin']);
        break;
endswitch;
?>

<!--POSTS MAIS VISTOS-->
<section class = "container m-bottom3 single promocoes no-margin" id = "j_content">


    <div id = "fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=218245898608300";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        $(document).ajaxComplete(function () {
            try {
                FB.XFBML.parse();
            } catch (ex) {

            }
        });

    </script>




    <script type="text/javascript" src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>

    <div class="compra j_processo_compra">

        <section class="credenciamento radius j_entrar_cadastrar">

            <article class="content_entrar">

                <h1 class="titulo_entrar">Entrar</h1>

                <p class="entrar">Se você já é cadastrado acesse entre com o seu email e senha:</p>


                <form class="form_entrar" action="" method="post">



                    <input type="hidden" name="action" value="entrar"/>

                    <label>	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email" required />
                    </label>


                    <label>	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" required />
                    </label>


                    <input class="btn btn-green btn_entrar fl-right radius j_entrar" type="submit" name="cliente_enviar" value="Enviar" />

                    <div class="load"></div>     

                </form>






            </article>	


            <div class="div_ou">
                <span class="ou">OU</span>
            </div>


            <article class="content_cadastrar">

                <?php
                $idProduto = 0;
                $valorProduto = 0;
                $read = new Read;
                $read->ExeRead(PRODUTOS);
                if ($read->getResult()):
                    $idProduto = $read->getResult()[0]['produto_id'];
                    $valorProduto = $read->getResult()[0]['produto_valor'];
                endif;
                ?>


                <h1 class="titulo_cadastrar">Cadastrar</h1>

                <p class="cadastrar">Cadastre-se e compre os melhores tapetes da região:</p>


                <form name="PostForm"  class="form_cadastrar" action="" method="post">


                    <input type="hidden" name="action" value="cadastrar"/>

                    <label>	
                        <span>Nome:</span>			
                        <input class="input_fale" type="text" name="cliente_name" />
                    </label>


                    <label>	
                        <span>Sobrenome:</span>			
                        <input class="input_fale" type="text" name="cliente_lastname" />
                    </label>

                    <label>	
                        <span>CPF:</span>			
                        <input class="input_fale" type="text" name="cliente_cpf"/>
                    </label>


                    <label>	
                        <span>Telefone:</span>			
                        <input class="input_fale" type="tel" name="cliente_telefone"/>
                    </label>


                    <label>	
                        <span>Email:</span>			
                        <input class="input_fale" type="email" name="cliente_email"/>
                    </label>


                    <label>	
                        <span>Senha:</span>			
                        <input class="input_fale" type="password" name="cliente_senha" />
                    </label>

                    <input class="btn btn-green btn_cadastrar fl-right radius" type="submit"  name="enviarCliente" value="Cadastrar" />

                </form>

                <div id="j_ajaxident" class="<?= HOME . "/_cdn/ajax" ?>"></div>           
            </article>

            <div class="clear"></div>
        </section>


        <div class="quantidade_produto j_quantidade">
            <div class="ingresso">GabaNight</div>
            <form class="form_concluir" action="" method="post">

                <input type="hidden" name="action" value="alterar_quantidade" />
                <input type="hidden" name="produto_id" value="<?= $idProduto; ?>" />

                <label>
                    <span>Quantidade</span>
                    <input type="number" name="prodqnt" id="qtd" class="quantidade_carrinho form_control" value="<?= (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho']) ? $_SESSION['carrinho'][$idProduto] : '1'); ?>"/>
                </label>

                <button class="btn btn-green radius">Concluir Compra</button>
            </form>

            <div class="clear"></div>
        </div>


    </div>

    <!--#4e99b7-->
    <header class="bg-blue_marinho container sectiontitle promocoes_header fl-left">
        <div class="content al-center">
            <h1 class="caps-lock">GabaNight da Virada 2017!</h1>



            <a class="btn btn-green btn-big caps-lock radius j_comprar" id="<?= $idProduto; ?>" attr-valor="<?= $valorProduto; ?>">Compre Já</a>
            <!--            <div class="bloco_pagseguro ds-block">
                            <form action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post">
                                 NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO 
                                <input type="hidden" name="itemCode" value="23CD39C55858C0A554BD8FBB040E2DE6" />
                                <input type="hidden" name="iot" value="button" />
                                <input class="botao_pagseguro" src="<?= INCLUDE_PATH; ?>/img/Compreja-topo.png" type="image" name="submit" />
                            </form>
            
                             FINAL FORMULARIO BOTAO PAGSEGURO 
                            
                        </div>-->
            <p class="tagline">O Seu Ingresso!</p>
            <div class="clear"></div>
        </div>
    </header>




    <section class="container m-bottom3">


        <div class="promocoes_conteudo">

            <h1 class="promocoes_mark_title sectiontitle al-center fontsize1b">Veja o Que o <mark>Pastor Carlos Eduardo</mark> tem a Dizer Sobre o Evento!</h1>

            <article class="box video-medium m-bottom1">

                <div class="video no-margin">
                    <div class="ratio"><iframe class="media" src="https://www.youtube.com/embed/EoT6IEFDVRU" frameborder="0" allowfullscreen></iframe></div>
                </div>
                <div class="box-line m-bottom1"></div>
                <div class="btn_like fl-left">
                    <div id="social-fb" class="fb-like" data-href="http://gabadi.com.br/gabanight-da-virada" data-width="100" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
            </article>

            <!--#D1BE5A-->
            <aside class="container">
                <div class="content">

                    <div class="ds-block al-center bloco_pagseguro_meio">
                        <h1 class="fontsize1b m-top1 m-bottom1 al-center">Pronto para</h1>        
                        <form action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post" onsubmit="PagSeguroLightbox(this); return false;">
                            <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                            <input type="hidden" name="itemCode" value="23CD39C55858C0A554BD8FBB040E2DE6" />
                            <input type="hidden" name="iot" value="button" />
                            <input style="padding:0; margin: 0;" src="<?= INCLUDE_PATH; ?>/img/Compreja-meio-laranja.png" type="image" name="submit" />
                        </form>
                        <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
                        <h1 class="fontsize1b m-top1 ultima_frase">e Celebrar a Virada Com o Povo mais Feliz da Terra?</h1>
                    </div>
                    <div class="clear"></div>
                </div>
            </aside>


            <div class="clear"></div>
        </div>



    </section>   



    <section class="container">


        <header class="sectiontitle bg-orange">
            <div class="content">
                <h1 class="promocoes_title">Sobre a Festa</h1>
                <p class="tagline">Esse Ano o Tema é Retrô! :)</p>
            </div>
        </header>


        <div class="promocoes_conteudo fl-left">

            <div class="promocoes_conteudo">

                <div class="banner_post container bg-gray">

                    <a title="" href="">
                        <picture alt="Gabadi">
                <!--                            <source media="(min-width:1600px)" srcset="tim.php?src=img/fe.jpg&w=2000&h=500" />
                            <source media="(min-width:1366px)" srcset="tim.php?src=img/fe.jpg&w=1600&h=500" />
                            <source media="(min-width:1280px)" srcset="tim.php?src=img/fe.jpg&w=1366&h=420" />
                            <source media="(min-width:960px)" srcset="tim.php?src=img/fe.jpg&w=1280&h=420" />
                            <source media="(min-width:768px)" srcset="tim.php?src=img/fe.jpg&w=960&h=300" />
                            <source media="(min-width:480px)" srcset="tim.php?src=img/fe.jpg&w=768&h=400" />
                            <source media="(min-width:1px)" srcset="tim.php?src=img/fe.jpg&w=480&h=300" />-->
                            <img class="banner_promocao" title="" alt="" src="<?= INCLUDE_PATH; ?>/img/gabanight.jpeg" />
                        </picture>
                    </a>

                </div>    


                <div class="content_single">
                    <p class="subtitle">A Gabanight é uma confraternização dos jovens da 1º Igreja Batista de Diamantina! Essa festa já existe há mais de 15 anos e este ano não poderia ser diferente! Ou Melhor, será diferente sim! =)</p>
                    <p class="subtitle">A festa desse ano será com o tema: Retrô! Não é legal?! Vamos decorar o local especialmente para você, te levando para uma viagem ao tempo.. lá para os anos 90! Relembre aqueles momentos, e claro, as músicas que o povo de Deus cantava naquela época! =) Então não fique de fora! Venha virar esse ano com agente!</p>

                </div>

                <div class="clear"></div>
            </div>


            <div class="clear"></div>
        </div>
    </section>



    <article class="container bg-blue">
        <div class="promocoes_conteudo sectiontitle">
            <h1 class="promocoes_mark_title promocoes_title m-bottom3">O que Você Está Esperando? Venha a <mark>Celebrar a Deus</mark> na <mark>GabaNight da Virada</mark> Junto Com a Gente!</h1>
            <form style="max-width:370px; width: 90%; padding: 0; margin: 30px auto; background: #59AB66; float: none;" action="https://pagseguro.uol.com.br/checkout/v2/cart.html?action=add" method="post" onsubmit="PagSeguroLightbox(this);
                    return false;">
                <!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
                <input type="hidden" name="itemCode" value="23CD39C55858C0A554BD8FBB040E2DE6" />
                <input type="hidden" name="iot" value="button" />
                <input style="padding:0; margin: 0;" src="<?= INCLUDE_PATH; ?>/img/Compreja-chamada-final.png" type="image" name="submit" />
            </form>
            <!-- FINAL FORMULARIO BOTAO PAGSEGURO -->
            <div class="clear"></div>
        </div>
    </article>



    <!--RECADOS-->
    <section class="container recados comments_post">


        <header class="bg-light al-center">
            <div class="content">
                <h1>Olá, Deixe seu Comentário Sobre a <span class="fontzero">GabaNight da Virada 2017!</span></h1>
                <p class="tagline font-normal">GabaNight da Virada 2017!</p>

                <div class="numero_comentarios bg-body al-center">
                    <p class="font-light no-margin">Veja O(s) Comentário(s) Logo Abaixo!</p>
                    <p class="junte_se">Junte-se à Eles! ;)</p>
                </div>

                <div class="clear"></div>
            </div>
        </header>

        <div class="promocoes_conteudo promocoes_comentarios">

            <div class="separator m-bottom3"></div>
            <!--            <article class="recado_item box comentario">
                            <div class="content_comentario">
                                <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/foto-recados.png" />
                                <div class="comment">
                                    <h1 class="nome_comentario">Luiz Felipe Lopes</h1>
                                    <p>Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Per aumento de cachacis, eu reclamis. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! undefined...</p>
                                    <span class="data_comentario">Em <time datetime="<?= date('Y-m-d'); ?>"><?= date('d/m/Y \à\s H:i \H\r\s'); ?></time></span>
                                    <span class="like">2 Gostei :)</span>
                                    <span class="resposta">Responder</span>
                                </div>
                            </div>
                        </article>
            
                        <article class="recado_item box comentario">
                            <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/foto-recados.png" />
                            <div class="comment">
                                <h1 class="nome_comentario">Luiz Felipe Lopes</h1>
                                <p>Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Per aumento de cachacis, eu reclamis. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! undefined...</p>
                                <span class="data_comentario">Em <time datetime="<?= date('Y-m-d'); ?>"><?= date('d/m/Y \à\s H:i \H\r\s'); ?></time></span>
                                <span class="like">2 Gostei :)</span>
                                <span class="resposta">Responder</span>
                            </div>
                        </article>
            
                        <article class="recado_item box comentario">
                            <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/foto-recados.png" />
                            <div class="comment">
                                <h1 class="nome_comentario">Luiz Felipe Lopes</h1>
                                <p>Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Per aumento de cachacis, eu reclamis. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! undefined...</p>
                                <span class="data_comentario">Em <time datetime="<?= date('Y-m-d'); ?>"><?= date('d/m/Y \à\s H:i \H\r\s'); ?></time></span>
                                <span class="like">2 Gostei :)</span>
                                <span class="resposta">Responder</span>
                            </div>
                        </article>
            
            
                        <form class="form_comentario_avaliacao" action="" method="post">
            
                            <label>
                                <span>Nome:</span>
                                <input type="text" name="nome" placeholder="Seu Nome:" />
                            </label>
            
                            <label>
                                <span>Comentário:</span>
                                <textarea rows="3" name="mensagem" placeholder="Sua Mensagem"></textarea>
                            </label>
            
                            <input class="btn btn-blue" type="submit" name="Enviar" value="Enviar Comentário"/>
            
                        </form>-->


            <div class="fb-comments" data-href="http://gabadi.com.br/gabanight-da-virada" data-width="100%" data-numposts="10"></div>


            <div class="content"></div>
        </div>
    </section>


</section>
