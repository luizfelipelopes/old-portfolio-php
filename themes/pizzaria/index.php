
<!--SLIDES-->
<section class="container m-top1">

    <div class="main_slides content-header no-padding-top">
        <h1 class="ds-none">Promoções e Ofertas</h1>

        <!--DESTAQUES-->

        <article class="promocoes">
            <h1 class="ds-none">Promoções</h1>
            <div class="js_promocoes">
                <img class="radius slide_item first" src="<?=INCLUDE_PATH;?>/Assets/Images/slides/destaque_14.jpg" title="Pizza Na Hora Delivery" alt="[Pizza Na Hora Delivery]" >
                <img class="radius slide_item" src="<?=INCLUDE_PATH;?>/Assets/Images/slides/destaque_138.jpg" title="Pizza Na Hora Delivery" alt="[Pizza Na Hora Delivery]" >
            </div>
        </article>

        <!--CATEGORIAS-->
        <article class="ofertas">
            <h1 class="ds-none">Ofertas</h1>
            <div class="js_ofertas">
                <div class="ofertas_item secundario_item first">
                    <img class="radius-top-left radius-top-right" src="<?=INCLUDE_PATH;?>/Assets/Images/slides/secao_65.jpg" title="Pizza Na Hora Delivery" alt="[Pizza Na Hora Delivery]" >
                    <!-- <div class="controle_categoria caps-lock al-center">Pizza</div> -->
                </div>


                <div class="ofertas_item secundario_item">
                    <img class="radius-top-left radius-top-right" src="<?=INCLUDE_PATH;?>/Assets/Images/slides/secao_66.jpg" title="Pizza Na Hora Delivery" alt="[Pizza Na Hora Delivery]" >
                    <div class="controle_categoria caps-lock al-center">Refrigerante</div>
                </div>

            </div>
            <div class="controle bg-yellow al-center">
                <div class="prev pointer bg-red radius"><</div>
                <div class="next pointer bg-red radius">></div>
            </div>    

            <div class="clear"></div>
        </article>

    </div>

</section>


<!--DESTAQUES-->
<section class="produtos container bg-light m-top3">
    <header class="header_index barra_categorias container bg-yellow m-bottom3">
        <h1 class="bg-body"><a href="#">Destaques</a></h1>
    </header>

    <div class="content">

        <?php
        foreach ($Produtos as $Produto):
            extract($Produto);
            ?>

            <!--PRODUTO-->
            <a class="box box-small-3" href="<?= HOME . '/shop/&theme=' . THEME; ?>">
                <article class="container">
                    <div class="content">
                        <div class="pizza">
                            <img src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . $produto_cover; ?>" title="<?= $produto_title; ?>" alt="[<?= $produto_title; ?>]">
                        </div>
                        <h1 class="nome"><?= $produto_title; ?></h1>
                        <span class="valor">R$<?= number_format($produto_valor_grande, 2, ',', '.'); ?></span>
                        <div class="clear"></div>
                    </div>
                </article>
            </a>

            <?php
        endforeach;
        ?>
            
        <div class="clear"></div>

    </div>
</section>


<!--DEPOIMENTOS-->
<section class="depoimentos container ds-none">

    <header class="sectiontitle-nomargin pd-left3">
        <h1>DEPOIMENTOS</h1>
    </header>

    <div class="content">
        <div class="clear"></div>
    </div>

</section>
