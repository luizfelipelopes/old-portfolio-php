<div id="j_content">

    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.8&appId=467593886964781";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <span class="pagina_principal fontzero">Sacando Baixo</span>
    <?php require 'inc/slides-post.inc.php'; ?>

    <article class="container bg-orange bloco_lead">
        <div class="content">
            <header class="bg-orange">
                <h1>Deixe Seu E-mail Para Nós e Fique Sabendo de Novas Sacadas!</h1>
            </header>

            <?php
            $dataErro = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if (isset($dataErro)):

                $dataErro['comentario_status'] = '0';
                $dataErro['comentario_type'] = 'front_lead';
                $dataErro['comentario_date'] = date('Y-m-d H:i:s');
                $dataErro['comentario_content'] = $dataErro['comentario_email'];

                $adminComentario = new adminComentario;
                $adminComentario->ExeCreate($dataErro);
                if ($adminComentario->getResult()):
                    header('Location: ' . HOME . '/sucesso');
                else:
                    WSErro("Erro ao cadastrar comentário! =)", WS_ERROR);
                endif;

            endif;
            ?>

            <form id="captura_lead" name="sendcontent" action="" method="post" class="bg-orange lead_front">

                <input class="form-field box box-medium" type="text" title="Seu Nome" name="comentario_author" placeholder="Seu Nome:" />
                <input class="form-field box box-medium" type="text" title="Seu Melhor E-mail" name="comentario_email" placeholder="Seu Melhor E-mail:" />

                <button class="btn btn-green radius">Quero Mais Sacadas!</button>
            </form>
            <div class="clear"></div>
        </div>  
    </article>

    <div class="posts_sobre">
        <div class="bloco_maisvistos">
            <?php require 'inc/mais-vistos.inc.php'; ?>
        </div>
        <div class="separador bloco_lateral">
            <?php require 'inc/plugin-facebbok.php'; ?>
            <?php require 'inc/plugin-youtube.php'; ?>
           

        </div>

    </div>



    <div class="box-line m-bottom3"></div>

    <?php require REQUIRE_PATH . '/inc/publicidade-full-body.inc.php'; ?>

    <div class="posts_sobre">
        <?php require 'inc/posts-por-categoria.inc.php'; ?>
    </div>

    <?php // require 'inc/galeria-fotos.inc.php'; ?>
    <?php // require 'inc/galeria-videos.inc.php';  ?>

    <div class="recados_anunciantes">
        <?php // require 'inc/recados.inc.php';  ?>
        <?php // require 'inc/anunciantes.inc.php';  ?>
    </div>
</div>