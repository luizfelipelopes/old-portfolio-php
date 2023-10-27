<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<!--VISITAS NO MÊS-->
    <article class="container visitas-no-mes widgets-acima">
        <header class="bg-orange">
            <div class="content">
                <h1 class="shorticon shorticon-visitas-mes caps-lock font-bold">Visitas No Mês:</h1>
                <div class="clear"></div>
            </div>
        </header>

        <?php
        $usuariosMes = 0;
        $visitasMes = 0;
        $paginasMes = 0;
        $mes = array();
        $EsteMes = date('Y-m');

        $i = 0;

        $readVisitasMes = new Read;
        $readVisitasMes->ExeRead(SITEVIEWS);
        if ($readVisitasMes->getResult()):

            foreach ($readVisitasMes->getResult() as $key => $value) :

                if (substr($value['siteviews_date'], 0, 7) == $EsteMes):
                    $mes += [$key => $value];
                endif;

            endforeach;

            if (!empty($mes)):

                foreach ($mes as $total) :

                    $usuariosMes += $total['siteviews_users'];
                    $visitasMes += $total['siteviews_views'];
                    $paginasMes += $total['siteviews_pages'];

                endforeach;

            endif;

        endif;
        ?>


        <div class="bg-body al-center">
            <div class="content">
                <span class="visitas-dados box box-medium"><span class="visitas-numero"><?= $usuariosMes; ?></span> Usuários</span>
                <span class="visitas-dados box box-medium"><span class="visitas-numero"><?= $visitasMes; ?></span> Visitas</span>
                <span class="visitas-dados box box-medium last"><span class="visitas-numero"><?= $paginasMes; ?></span> Páginas</span>
                <a class="shorticon shorticon-botao-visitas btn btn-light" title="" href="#"><?= ($paginasMes == 0 || $visitasMes == 0 ? '0' : substr($paginasMes / $visitasMes, 0, 4)); ?> Páginas Por Visitas</a>
                <div class="clear"></div>
            </div>
        </div>
    </article>
    <!--VISITAS NO MÊS-->
