<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!--ONLINE AGORA-->
<article class="online-agora container widgets-acima">

    <header class="bg-green-claro">
        <div class="content">
            <h1 class="shorticon shorticon-online caps-lock font-bold">Online Agora:</h1>
            <div class="clear"></div>
        </div>    
    </header>    

    <div class="bg-body">
        <div class="content al-center">

            <?php
            
            $online = 0;
            $dateHoje = date('Y-m-d H:i:s');
            
            $read = new Read;
            $read->ExeRead(SITEVIEWS_ONLINE, "WHERE online_endview >= :date", "date={$dateHoje}");
            if ($read->getResult()):
                $online = $read->getRowCount();
            endif;
            ?>

            <span class="shorticon shorticon-usuarios shorticon-botao ds-inblock m-bottom1"><?= $online; ?></span>
            <a class="shorticon shorticon-acompanhar-usuarios btn btn-light" title="" href="<?= HOME; ?>flowstate_admin/dashboard.php?exe=acompanhar-usuarios">Acompanhar Usuários</a>
            <div class="clear"></div>
        </div>
    </div>

</article>
<!--ONLINE AGORA-->
