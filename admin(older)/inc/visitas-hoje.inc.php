<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!--VISITAS HOJE-->
    <article class="visitas-hoje container widgets-acima">

        <header class="bg-blue">
            <div class="content">
                <h1 class="shorticon shorticon-visitas-hoje caps-lock font-bold">Visitas Hoje:</h1>
                <div class="clear"></div>
            </div>
        </header>

        <?php
        $usuarios = 0;
        $visitas = 0;
        $paginas = 0;
        $dataVisitas = date('Y-m-d');

        $readVisitasHoje = new Read;
        $readVisitasHoje->ExeRead(SITEVIEWS, "WHERE siteviews_date = :date", "date={$dataVisitas}");
        if ($readVisitasHoje->getResult()):

            $usuarios = $readVisitasHoje->getResult()[0]['siteviews_users'];
            $visitas = $readVisitasHoje->getResult()[0]['siteviews_views'];
            $paginas = $readVisitasHoje->getResult()[0]['siteviews_pages'];


        endif;
        ?>


        <div class="bg-body">
            <div class="content al-center">
                <span class="visitas-dados box box-medium"><span class="visitas-numero"><?= $usuarios; ?></span> Usuários</span>
                <span class="visitas-dados box box-medium"><span class="visitas-numero"><?= $visitas; ?></span> Visitas</span>
                <span class="visitas-dados box box-medium last"><span class="visitas-numero"><?= $paginas; ?></span> Páginas</span>

                <a class="shorticon shorticon-botao-visitas btn btn-light" title="" href="#"><?= ($paginas == 0 || $visitas == 0 ? '0' : substr($paginas / $visitas, 0, 4)); ?> Páginas Por Visitas</a>

                <div class="clear"></div>
            </div>
        </div>
    </article>
    <!--VISITAS HOJE-->
