<?php
/*
 * Módulo: Card Views Online (Usuários Online)
 * Author: Luiz Felipe C. Lopes
 * Date: 23/08/2018
 */
?>

<?php
$readUsersOnline = new Read;
$readUsersOnline->FullRead("SELECT count(online_id) AS TOTAL FROM " . SITEVIEWS_ONLINE . " WHERE online_endview >= NOW()");
$Online = 0;
if ($readUsersOnline->getResult()):
    $Online = $readUsersOnline->getResult()[0]['TOTAL'];
endif;
?> 

<div class="card card_border card_online <?=(SALES_ADMIN == '1' ? 'flex-4' : 'flex-3'); ?>">

    <h2 class="icon-globe">Online Agora</h2>

    <div class="card_info">
        <p class="icon-users"><?= $Online; ?></p>
    </div>

    <div class="card_link">
        <a title="<?= ($Online > 0 ? $Online . ' usuários online' : 'Nenhum usuário online'); ?>" href="#"><?= ($Online > 0 ? $Online . ' usuários online' : 'Nenhum usuário online'); ?></a>
        <!--<a title="Acompanhar usuários" href="#">Acompanhar Usuários</a>-->
    </div>

</div>