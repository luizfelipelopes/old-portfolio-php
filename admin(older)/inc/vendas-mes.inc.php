<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!--VENDAS MES-->
<?php
$todosMes = 0;
$aprovadosMes = 0;
$canceladosMes = 0;
$valorMes = 0;
$mesVenda = array();
$EsteMes = date('Y-m');

$i = 0;

$readVendasMes = new Read;
$readVendasMes->ExeRead(VENDAS, "WHERE venda_transacao IS NOT NULL");
if ($readVendasMes->getResult()):

    foreach ($readVendasMes->getResult() as $key => $value):

        if (substr($value['venda_date'], 0, 7) == $EsteMes):
            $mesVenda += [$key => $value];
        endif;

    endforeach;

//        var_dump($mesVenda);

    if (!empty($mesVenda)):


        $i = 0;
        $transacoes = array();
        $transacoesFinais = array();

//        CRIA UM ARRAY SÓ COM OS VALORES DE TRANSACAO
        foreach ($readVendasMes->getResult() as $pedido):
            if (substr($pedido['venda_date'], 0, 7) == $EsteMes):
                $transacoes += [$i => $pedido['venda_transacao']];
                $i++;
            endif;
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



        foreach ($mesVenda as $total) :

            

            if ($transacoesFinais[$j] == $total['venda_transacao']):

                

                $todosMes += 1;

                if ($total['venda_status'] == '3'):
                    $aprovadosMes += 1;
                    $valorMes += $total['venda_total'];
                endif;

                if ($total['venda_status'] == '7'):
                    $canceladosMes += 1;
                endif;

            endif;
            $j++;
        endforeach;

    endif;

endif;
?>


<!--VENDAS NO MÊS-->
<article class="container vendas-mes widgets-acima">

    <header class="bg-red">
        <div class="content">
            <h1 class="shorticon shorticon-vendas caps-lock font-bold">Vendas No Mês:</h1>
            <div class="clear"></div>
        </div>
    </header>
    <div class="bg-body">
        <div class="content al-center">
            <span class="visitas-dados box box-medium"><span class="visitas-numero"><?= $todosMes; ?></span> Todos</span>
            <span class="visitas-dados box box-medium"><span class="visitas-numero"><?= $aprovadosMes; ?></span> Aprovados</span>
            <span class="visitas-dados box box-medium last"><span class="visitas-numero"><?= $canceladosMes; ?></span> Cancelados</span>

            <a class="shorticon shorticon-botao-vendas btn btn-light" title="" href="?exe=pedidos">R$ <?= number_format($valorMes, 2, ',', '.'); ?> Em Vendas</a>

            <div class="clear"></div>
        </div>
    </div>
</article>
<!--VENDAS NO MÊS-->
