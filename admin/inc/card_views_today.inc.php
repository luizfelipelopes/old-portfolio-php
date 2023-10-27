<?php
/*
 * Módulo: Card Views Today (Visualizações de Páginas Hoje)
 * Author: Luiz Felipe C. Lopes
 * Date: 23/08/2018
 */
?>

<?php

$users = 0;
$views = 0;
$pages = 0;
$dateViews = date('Y-m-d');

$readViewsToday = new Read;
$readViewsToday->FullRead("SELECT siteviews_users, siteviews_views, siteviews_pages FROM " . SITEVIEWS . " WHERE siteviews_date = :today", "today={$dateViews}");

if ($readViewsToday->getResult()):
    extract($readViewsToday->getResult()[0]);
    $users = $siteviews_users;
    $views = $siteviews_views;
    $pages = $siteviews_pages;
endif;

?>

<div class="card card_border <?=(SALES_ADMIN == '1' ? 'flex-4' : 'flex-3'); ?>">

    <h2 class="icon-line-chart">Visitas Hoje</h2>
    <div class="card_info">
        <div class="card_info_item">
            <p class="card_info_item_number"><?= $users; ?></p>
            <p class="card_info_item_name">Usuários</p>
        </div>
        <div class="card_info_item">
            <p class="card_info_item_number"><?= $views; ?></p>
            <p class="card_info_item_name">Visitas</p>
        </div>
        <div class="card_info_item">
            <p class="card_info_item_number"><?= $pages; ?></p>
            <p class="card_info_item_name">Páginas</p>
        </div>
    </div>

    <div class="card_link">
        <a title="<?= ($pages == 0 || $views == 0 ? '0' : substr($pages / $views, 0, 4)); ?> Páginas Por Visita" href="#"><?= ($pages == 0 || $views == 0 ? '0' : substr($pages / $views, 0, 4)); ?> Páginas Por Visita</a>
    </div>

</div>