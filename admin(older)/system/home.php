<?php
header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");
require '../_app/Models/TransacoesPagSeguro.class.php';

$adminNotificacoes = new TransacoesPagSeguro;
$adminNotificacoes->ExeNotificacoes();
//var_dump($adminNotificacoes);
?>

<!--MODAL PARA EDIÇÂO DE COMENTARIOS-->
<div class="fundo-comentario j_popup">
    <div class="comentario_edicao container js_content_form">
        <div class="ajax_close">X</div>
        <h1 class="m-bottom3">Editar Comentário</h1>
        <form action="" method="post" id="j_resposta' . $comentario_id . '">
            <div class="trigger-box-suspenso"></div>
            <input type="hidden" name="action" value="update_comentario">
            <input type="hidden" name="comentario_id">

            <span>
                <label for="comentario_author">Nome:</label>
                <input type="text" name="comentario_author">
            </span>

            <span>
                <label for="comentario_content">Comentário:</label>
                <textarea id="resposta" name="comentario_content" rows="5"></textarea>
            </span>


            <button class="btn btn-blue fl-right radius j_enviar_resposta">Enviar</button>
            <div title="Carregando" class="load fl-right"></div>
        </form>

    </div>
</div>
<!--MODAL PARA EDIÇÂO DE COMENTARIOS-->

<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Início</h1>
        <p class="tagline"> >> Flow State / <b>Início</b></p>
        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->

<div class="box-line"></div>

<div class="content main-conteudo bg-blue">    

    <?php
    $dateHoje = date('Y-m-d H:i:s');

    if (VIEWS_ADMIN == '1'):
        include 'inc/online-agora.inc.php';
        include 'inc/visitas-hoje.inc.php';
        include 'inc/visitas-mes.inc.php';
    endif;



    if (ECOMMERCE_ADMIN == '1'):
        include 'inc/vendas-mes.inc.php';
    endif;
    ?>

    <div class="box-line m-bottom3 container"></div>

    <?php
    if (COMENTARIOS_ADMIN == '1'):
        include 'inc/ultimos-comentarios.inc.php';
    endif;

    if (ECOMMERCE_ADMIN == '1'):
        include 'inc/ultimos-pedidos.inc.php';
    endif;
    ?>

</div>
