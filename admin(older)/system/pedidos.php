
<div class="fundo-pedido j_popup j_popup_data_personalizado">
    <div class="bg-body fundo-data-personalizado">
        <div class="ajax_close">X</div>
        <div class="content">

            <h1 class="m-bottom3">Digite um intervalo de data</h1>
            <form action="" method="post" class="pedido-personalizado">

                <input type="hidden" name="action" value="filtrar_pedido_data" />
                <input type="hidden" name="data" value="personalizado" />

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
<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Pedidos</h1>
            <p class="tagline"> >> Flow State / <b>Pedidos</b></p>
        </div>

        <form action="" method="POST" id="j_filtro_pedidos" class="filtro_pedido_status fl-right m-bottom1">
            <div class="form-group">
                <label for="filtro_pedido_status" class="m-bottom1">Filtrar por Status:</label>
                <select name="filtro_pedido_status" class="form-control">
                    <option value="todos" selected>Todos</option>
                    <option value="1">Aguardando Pagamento</option>
                    <option value="2">Em Análise</option>
                    <option value="3">Paga</option>
                    <option value="4">Entregue</option>
                    <option value="5">Em Disputa</option>
                    <option value="6">Devolvida</option>
                    <option value="7">Cancelada</option>
                </select>
            </div>
        </form>

        <form action="" method="POST" id="j_filtro_pedidos" class="filtro_pedido_data fl-right m-bottom1" style="margin-right:2% !important;">
            <div class="form-group">
                <label for="filtro_pedido_data" class="m-bottom1">Filtrar por data:</label>
                <select name="filtro_pedido_data" class="form-control">
                    <option value="todos" selected>Em qualquer data</option>
                    <option value="ultima-hora">Na última hora</option>
                    <option value="24-horas">Nas últimas 24 horas</option>
                    <option value="ultima-semana">Na última semana</option>
                    <option value="ultimo-mes">No último mês</option>
                    <option value="ultimo-ano">No último ano</option>
                    <option value="personalizado">Intervalo Personalizado</option>
                </select>
            </div>
        </form>



        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line m-bottom3"></div>

<div class="j_detalhes_pedido"></div>

<!--ÚLTIMOS PEDIDOS-->
<article class="container main-conteudo ultimos-pedidos widgets-abaixo m-bottom3 table-pedidos">

    <header class="bg-green-claro">
        <div class="content">
            <h1 class="caps-lock font-bold">Últimos Pedidos</h1>
            <div class="clear"></div>
        </div>    

    </header>

    <div class="j_pedidos_real_time"></div>


    <?php
//        $transacao = new TransacoesPagSeguro();
//        $response = new TransacoesPagSeguro;
//        $transacao->getTransacoesPorData('2016-08-27', date('Y-m-d'));



    $read = new Read();
    $read->ExeRead(VENDAS, "WHERE venda_transacao IS NOT NULL ORDER BY venda_date DESC");

    if (!$read->getResult()):

        WSErro("Nenhum produto foi pago ainda.", WS_INFOR);

    else:

        $i = 0;
        $transacoes = array();
        $transacoesFinais = array();

//        CRIA UM ARRAY SÓ COM OS VALORES DE TRANSACAO
        foreach ($read->getResult() as $pedido):
            $transacoes += [$i => $pedido['venda_transacao']];
            $i++;
        endforeach;

//        LOOP PARA TORNAR NULL TODOS OS TIPO DE TRANSACAO QUE SE REPETEM
        for ($i = 0; $i < count($transacoes); $i++):
            for ($j = $i + 1; $j <= count($transacoes); $j++):

//                SE FOR O ULTIMO CICLO DO LOOP, ARRAY FINAL RECEBE O ULTIMO VALOR E SAI DO LACO PARA Q NAO DE ERRO
                if ($j == count($transacoes)):
                    $transacoesFinais[$i] = $transacoes[$i];
                    break;
                endif;

//                SE EXISTIR VALORES REPETIDOS, RECEBERA NULL È ADICIONADO NO ARRAY FINAL
//                CASO CONTRARIO, APENAS É ADICIONADO NO ARRAY FINAL;
                if ($transacoes[$i] == $transacoes[$j]):
                    $transacoes[$i] = null;
                    $transacoesFinais[$i] = $transacoes[$i];
                else:
                    $transacoesFinais[$i] = $transacoes[$i];
                endif;

            endfor;

        endfor;

        $j = 0;
        $indice = 0;
        foreach ($read->getResult() as $pedido):
            if ($transacoesFinais[$j] == $pedido['venda_transacao']):
                extract($pedido);
                ?>

                <div class="bg-body">
                    <div class="container linha pointer j_venda" id="<?= $venda_id; ?>" attr-status="<?= $venda_status; ?>">
                        <div class="content b-bottom">
                            <div class="col-20 coluna-codigo"><span>#<?= sprintf("%05d", $indice + 1); ?></span></div>
                            <div class="col-25"><span><?= date('d/m/Y H\h:i', strtotime($venda_date)); ?></span></div>
                            <div class="col-24"><span class="al-center">R$ <?= number_format($venda_total, 2, ',', '.'); ?></span></div>
                            <div class="col-30" style="<?= ($venda_status == '1' ? 'color:#E8A10F' : ($venda_status == '2' ? 'color:#E8A10F' : ($venda_status == '3' ? 'color:#046E5D' : ($venda_status == '7' ? 'color:#C94F3B' : '')))) ?>"><span class="font-bold"><?= strtoupper($venda_status == '1' ? 'Processando' : ($venda_status == '2' ? 'Em Análise' : ($venda_status == '3' ? 'Pago' : ($venda_status == '7' ? 'Cancelado' : 'Desconhecido')))); ?></span></div>
                            <div class="clear"></div>
                        </div>
                    </div>

                    <?php
                    $indice++;
                endif;


                $j++;
            endforeach;

        endif;
        ?>

        
        <div class="clear"></div>
    </div>
</article>
<!--ÚLTIMOS PEDIDOS-->