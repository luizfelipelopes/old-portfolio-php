
<!--POSTS MAIS VISTOS-->
<section class="container posts posts_box m-bottom3 single no-margin" id="j_content">

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.9&appId=1479108538830915";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>


    <?php
    //
    $read = new Read();

    if (isset($_SESSION['userlogin']['user_id'])):
        $read->ExeRead(POSTS, "WHERE post_name = :name", "name={$Link->getLocal()[1]}");
    else:
        $read->ExeRead(POSTS, "WHERE post_status = 1 and post_name = :name", "name={$Link->getLocal()[1]}");
    endif;

    if (!$read->getResult()):
        WSErro("Desculpe! Não existe nenhum post com este nome!", WS_INFOR);
    else:
        extract($read->getResult()[0]);
        $readAuthor = new Read();
        $readAuthor->ExeRead(USUARIOS, "WHERE user_id = :id", "id={$post_author}");
        ?>


        <header class = "bg-blue al-center no-margin container header_page">
            <div class = "content">
                <h1 class = "caps-lock m-bottom1 fontsize1b font-normal"><?= $post_title; ?></h1>
                <span class = "autor">
                    <img class="round" title = "<?= $readAuthor->getResult()[0]['user_name']; ?>" alt="[<?= $readAuthor->getResult()[0]['user_name']; ?>]" src= "<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $readAuthor->getResult()[0]['user_foto']; ?>" />
                    <p><?= $readAuthor->getResult()[0]['user_name']; ?></p>
                </span>
                <span class="data_publicacao"><time datetime = "<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                <?php
                $readCategoria = new Read();
                $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :category", "category={$post_category}");
                if ($readCategoria->getResult()):
                    ?>
                    <span class="caminho"><?= SITENAME; ?> >> <?= $readCategoria->getResult()[0]['category_title']; ?></span>
                <?php endif; ?>
                <span class="visitas"><?= $post_views; ?> Visitas!</span>
                <span class="comentarios ds-none">25 Comentários!</span>
                <div class="clear"></div>
            </div>
        </header>


        <div class="post_conteudo boxshadow">
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
                        <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" />
                    </picture>
                </a>
                <div class="btn_like">
                    <div class="fb-like" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                </div>
            </div>    
            <div class="separator m-bottom2"></div>


            <div class="content">

                <p class="subtitle fl-left fontsize2 container m-bottom3">"<?= $post_subtitle; ?>"</p>
                <div class="content_single">

                    <?= $post_content; ?>
                </div>




                <div class="clear"></div>
            </div>

        </div>

        <div class="separador_post">
            <?php require 'inc/plugin-facebbok.php'; ?>
            <?php require 'inc/plugin-youtube.php'; ?>
            <?php require 'inc/publicidade-sidebar.inc.php'; ?>
            <div class="banner_afiliado">
                <a target="_blank"  href="https://go.hotmart.com/B6177684W"><img title="Treinamento Fórmula Negócio Online Funciona?" alt="[Treinamento Fórmula Negócio Online Funciona?]" src="http://formulanegocioonline.com/afiliados/banners/banner-formulanegocioonline-250-2.jpg" border="0" width="100%" height="250" /></a>
            </div>
        </div>

        <!--RECADOS-->
        <section class="container recados comments_post">


            <header class="bg-light al-center">
                <div class="content">
                    <h1>Olá, Deixe seu Comentário Para</h1>
                    <p class="tagline font-normal"><?= $post_title; ?>!</p>

                    <div class="numero_comentarios bg-body al-center">
                        <p class="font-light no-margin">Veja O(s) Comentário(s) Logo Abaixo!</p>
                        <p class="junte_se">Junte-se à Eles! ;)</p>
                    </div>

                    <div class="clear"></div>
                </div>
            </header>

        <?php
        endif;
        ?>

        <div class="content">



            <div class="separator m-bottom3"></div>
            <!--            <article class="recado_item box comentario">
                            <div class="content_comentario">
                                <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/foto-recados.png" />
                                <div class="comment">
                                    <h1 class="nome_comentario">Luiz Felipe Lopes</h1>
                                    <p>Mussum Ipsum, cacilds vidis litro abertis. Vehicula non. Ut sed ex eros. Vivamus sit amet nibh non tellus tristique interdum. Per aumento de cachacis, eu reclamis. Todo mundo vê os porris que eu tomo, mas ninguém vê os tombis que eu levo! undefined...</p>
                                    <img class="estrelas" title="" src="<?= INCLUDE_PATH; ?>/img/estrelas.png" />
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
                                <img class="estrelas" title="" src="<?= INCLUDE_PATH; ?>/img/estrelas.png" />
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
                                <img class="estrelas" title="" src="<?= INCLUDE_PATH; ?>/img/estrelas.png" />
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
            
                            <div class="form-check">
                                <span class="form-field">Avalie Este Conteúdo</span>
                                <label class="ds-block"><input type="radio" name="review" value="1">1</label>
                                <label class="ds-block"><input type="radio" name="review" value="2">2</label>
                                <label class="ds-block"><input type="radio" name="review" value="3">3</label>
                                <label class="ds-block"><input type="radio" name="review" value="4">4</label>
                                <label class="ds-block"><input type="radio" name="review" value="5">5</label>
                            </div>
            
            
                            <input class="btn btn-blue" type="submit" name="Enviar" value="Enviar Comentário"/>
            
                        </form>-->


            <div class="fb-comments" data-href="<?= HOME; ?>/post/<?= $post_name; ?>" data-width="100%" data-numposts="10"></div>

            <div class="content"></div>
        </div>
    </section>



    <section class="posts_relacionados container bg-bluelight no-margin">

        <div class="content">

            <header class="al-center m-bottom3">
                <h1 class="m-bottom1">Confira Outros Posts Relacionados!</h1>
                <p class="tagline fontsize1 font-light">Quer saber mais sobre essse assunto? Veja abaixo alguns posts que possa ser do seu interesse!</p>
            </header>    


            <?php
            $read = new Read();
            $read->ExeRead(POSTS, "WHERE post_status = 1 AND post_id != :postid ORDER BY rand()", "postid={$post_id}");
            if (!$read->getResult()):

                WSErro("Estamos Trabalhando em mais sacadas para você! Aguarde =)", WS_INFOR);

            else:
                foreach ($read->getResult() as $posts):
                    ?>

                    <article class="post_item box m-bottom3 post_box post_relacionado">
                        <a title="<?= $posts['post_title']; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $posts['post_name'] . '/&theme=' . THEME; ?>">
                            <img title="<?= $posts['post_title']; ?>" alt="[<?= $posts['post_title']; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $posts['post_cover']; ?>" />
                            <h1><?= $posts['post_title']; ?></h1>
                        </a>
                        <?php
                        $readCat = new Read();
                        $readCat->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$posts['post_category']}");
                        if ($readCat->getResult()):
                            ?>

                            <span><?= $readCat->getResult()[0]['category_title'] ?></span>
                        <?php endif;
                        ?>
                    </article>


                    <?php
                endforeach;

            endif;
            ?>

            <!--            <article class="post_item box m-bottom3 post_box post_relacionado">
                            <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/futuro-presente-300x180.jpg" />
                            <h1>Atalhos:Caminhos Perigosos!</h1>
                            <span>Devocional</span>
                        </article>
            
                        <article class="post_item box m-bottom3 post_box post_relacionado">
                            <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/futuro-presente-300x180.jpg" />
                            <h1>Atalhos:Caminhos Perigosos!</h1>
                            <span>Devocional</span>
                        </article>
            
                        <article class="post_item box m-bottom3 post_box post_relacionado">
                            <img title="" alt="" src="<?= INCLUDE_PATH; ?>/img/futuro-presente-300x180.jpg" />
                            <h1>Atalhos:Caminhos Perigosos!</h1>
                            <span>Devocional</span>
                        </article>-->



            <div class="clear"></div>
        </div>
    </section>



</section>

<script src="<?= HOME; ?>/_cdn/jquery.js"></script>
<script src="<?= HOME; ?>/_cdn/shadowbox/shadowbox.js"></script>
<script src="<?= HOME; ?>/_cdn/scripts.js"></script>

