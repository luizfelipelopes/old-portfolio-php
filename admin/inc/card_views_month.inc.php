<?php
/*
 * Módulo: Card Viewa Month (Visualizações de Páginas no Mês)
 * Author: Luiz Felipe C. Lopes
 * Date: 23/08/2018
 */
?>

<?php
$users = 0;
$views = 0;
$pages = 0;
$dateViews = date('d');

$Sql = " WHERE " . ($dateViews == '1' ? 'siteviews_date <= NOW() AND siteviews_date > NOW() - INTERVAL 24 HOURS' : 'siteviews_date <= NOW() AND siteviews_date > NOW() - INTERVAL ' . $dateViews . ' DAY');

$readViewsToday = new Read;
$readViewsToday->FullRead("SELECT sum(siteviews_users) AS USERS, sum(siteviews_views) AS VIEWS, sum(siteviews_pages) AS PAGES FROM " . SITEVIEWS . $Sql);

if ($readViewsToday->getResult()):
    $users = $readViewsToday->getResult()[0]['USERS'];
    $views = $readViewsToday->getResult()[0]['VIEWS'];
    $pages = $readViewsToday->getResult()[0]['PAGES'];
    ;
endif;
?>


<div class="card card_border <?= (SALES_ADMIN == '1' ? 'flex-4' : 'flex-3'); ?>">

    <h2 class="icon-line-chart">Visitas Mensais</h2>
    <div class="card_info">
        <div class="card_info_item">
            <p class="card_info_item_number"><?= (!empty($users) ? $users : 0); ?></p>
            <p class="card_info_item_name">Usuários</p>
        </div>
        <div class="card_info_item">
            <p class="card_info_item_number"><?= (!empty($views) ? $views : 0); ?></p>
            <p class="card_info_item_name">Visitas</p>
        </div>
        <div class="card_info_item">
            <p class="card_info_item_number"><?= (!empty($pages) ? $pages : 0); ?></p>
            <p class="card_info_item_name">Páginas</p>
        </div>
    </div>

    <div class="card_link">
        <a title="<?= ($pages == 0 || $views == 0 ? '0' : substr($pages / $views, 0, 4)); ?> Páginas Por Visita" href="#"><?= ($pages == 0 || $views == 0 ? '0' : substr($pages / $views, 0, 4)); ?> Páginas Por Visita</a>
    </div>

</div>