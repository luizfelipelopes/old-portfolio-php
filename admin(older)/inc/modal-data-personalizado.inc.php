<?php
$Action = (!empty($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] == 'exe=emails/leads' ? 'filtrar_data_lead' : (!empty($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] == 'exe=pedidos' ? 'filtrar_pedido_data' : ''));
?>

<div class="fundo-pedido j_popup j_popup_data_personalizado">
    <div class="bg-body fundo-data-personalizado">
        <div class="ajax_close">X</div>
        <div class="content js_content_form">

            <h1 class="m-bottom3">Digite um intervalo de data</h1>
            <form action="" method="post" class="pedido-personalizado">

                <input type="hidden" name="action" value="<?= $Action; ?>" />
                <input type="hidden" name="key" value="data_personalizada" />

                <label class = "form-field col-49">
                    <span class = "form-legend">Início:</span>
                    <input type = "date" title = "Nome" name = "data-inicio" placeholder = "Digite uma data" required/>
                </label>

                <label class = "form-field col-49">
                    <span class = "form-legend">Fim:</span>
                    <input type = "date" title = "Nome" name = "data-fim" placeholder = "Digite uma data" required/>
                </label>

                <button class="btn btn-green radius fl-right">Pesquisar</button>

            </form>
            <div class="clear"></div>
        </div>
    </div>

</div>