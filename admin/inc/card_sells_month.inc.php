<?php
/*
 * Módulo: Card Sells Month (Vendas no Mês)
 * Author: Luiz Felipe C. Lopes
 * Date: 23/08/2018
 */
?>
<?php
$sales = 0;
$salesCheck = 0;
$salesChargeBack = 0;
$dateViews = date('d');

$Sql = " WHERE " . ($dateViews == '1' ? 'venda_date <= NOW() AND venda_date > NOW() - INTERVAL 24 HOURS' : 'venda_date <= NOW() AND venda_date > NOW() - INTERVAL ' . $dateViews . ' DAY');

$readSales = new Read;
$readSales->FullRead("SELECT count(venda_id) AS TOTAL, sum(CASE WHEN venda_status = 3 THEN venda_total ELSE 0 END) AS VENDAS, sum(CASE WHEN venda_status = 3 THEN 1 ELSE 0 END) AS APROVADO, sum(CASE WHEN venda_status = 7 THEN 1 ELSE 0 END) AS CANCELADO FROM " . VENDAS . $Sql);
if ($readSales->getResult()):

    $sales = (!empty($readSales->getResult()[0]['TOTAL']) ? $readSales->getResult()[0]['TOTAL'] : 0);
    $salesCheck = (!empty($readSales->getResult()[0]['APROVADO']) ? $readSales->getResult()[0]['APROVADO'] : 0);
    $salesChargeBack = (!empty($readSales->getResult()[0]['CANCELADO']) ? $readSales->getResult()[0]['CANCELADO'] : 0);
    $total = (!empty($readSales->getResult()[0]['VENDAS']) ? $readSales->getResult()[0]['VENDAS'] : 0);

endif;
?>

<div class="card card_border card_sells flex-4">

    <h2 class="icon-dollar">Vendas Mensais</h2>
    <div class="card_info">
        <div class="card_info_item">
            <p class="card_info_item_number"><?= $sales; ?></p>
            <p class="card_info_item_name">Todos</p>
        </div>
        <div class="card_info_item">
            <p class="card_info_item_number"><?= $salesCheck; ?></p>
            <p class="card_info_item_name">Aprovados</p>
        </div>
        <div class="card_info_item">
            <p class="card_info_item_number"><?= $salesChargeBack; ?></p>
            <p class="card_info_item_name">Cancelados</p>
        </div>
    </div>

    <div class="card_link">
        <a title="R$ <?= number_format($total, 2, ',', '.'); ?> Em Vendas" href="#">R$ <?= number_format($total, 2, ',', '.'); ?> Em Vendas</a>
    </div>

</div>
