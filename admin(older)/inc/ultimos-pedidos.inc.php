<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="j_detalhes_pedido"></div>

<!--ÚLTIMOS PEDIDOS-->
<article class="container ultimos-pedidos widgets-abaixo m-bottom3 bg-body">

    <header class="bg-green-claro">
        <div class="content">
            <h1 class="shorticon shorticon-pedidos caps-lock font-bold">Últimos Pedidos</h1>
            <div class="clear"></div>
        </div>    
    </header>


    <?php
//        $transacao = new TransacoesPagSeguro();
//        $response = new TransacoesPagSeguro;
//        $transacao->getTransacoesPorData('2016-08-27', date('Y-m-d'));

    $read = new Read();
    $read->ExeRead(VENDAS, "WHERE venda_transacao IS NOT NULL ORDER BY venda_date DESC LIMIT 4");


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

//        LOOP PARA TORNAR NULL TODOS OS TIPOS DE TRANSACAO QUE SE REPETEM
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

//            SO VAI EXIBIR ELEMENOTS QUE NÃO POSSUEM NULL, OU SEJA, ELEMENTOS Q NAO SAO REPETIDOS
            if ($transacoesFinais[$j] == $pedido['venda_transacao']):
                extract($pedido);
                ?>

                <div class="bg-body">
                    <div class="container linha pointer j_venda" id="<?= $venda_id; ?>">
                        <div class="content b-bottom">
                            <div class="col-20 coluna-codigo"><span>#<?= sprintf("%05d", $indice + 1); ?></span></div>
                            <div class="col-25"><span><?= date('d/m/Y', strtotime($venda_date)); ?></span></div>
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


//            var_dump($contador);
            ?>
            <a href="?exe=pedidos" class="m-bottom1 fl-left ver-mais"><p>Ver todos...</p></a>            
        <?php
        endif;
        ?>

        <div class="clear"></div>
    </div>
</article>
<!--ÚLTIMOS PEDIDOS-->
