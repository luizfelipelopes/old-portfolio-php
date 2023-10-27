<?php
/*
 * comprovante-pagamento.php
 * Arquivo Responsável por chamar a partir de um IFRAME o Arquivo que irá gerar o PDF do Comprovante de Pagamento.
 */

$registro = filter_input(INPUT_GET, 'registro', FILTER_DEFAULT);
$tipo = 'voucher-eletronico';
?>
<style>
    .js_cabecalho_sistema{display: none;}
</style>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>-->
<script src="<?= HOME . DIRECTORY_SEPARATOR . '_cdn/jquery.js' ?>"></script>
<script>

    $(function () {
        $("iframe").attr("height", window.innerHeight);
    });

</script>

<iframe src="<?= HOME . DIRECTORY_SEPARATOR . 'printPdf.php?registro=' . $registro . '&tipo=' . $tipo; ?>" frameborder="0" allowfullscreen style="position: absolute; top: 0; left:0; overflow: hidden !important; width: 100% !important; margin: 0 !important; padding: 0 !important; float: left;"></iframe>
<!--<iframe src="<?= HOME; ?>" frameborder="0" allowfullscreen style="width: 100%; float: left;"></iframe>-->
<!--<iframe src="https://google.com/" allowfullscreen frameborder="0" style="width: 100%; float: left;"></iframe>-->
