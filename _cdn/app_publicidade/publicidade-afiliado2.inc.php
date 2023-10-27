<div class="banner_social al-center container m-bottom3">
    <div class="banner_afiliado">
        <?php
        if (RAND_AFFILIATE_POST == '1'):
            $Indice = random_int(0, 2);
            ?>
            <a target = "_blank" href= "<?= $Afiliados[$Indice]['url_afiliado']; ?>"><img title = "<?= $Afiliados[$Indice]['nome_afiliado']; ?>" alt = "[<?= $Afiliados[$Indice]['nome_afiliado']; ?>]" src = "<?= $Afiliados[$Indice]['imagem_afiliado']; ?>" border= "0" width="100%" height= "250" /></a>
        <?php endif; ?>

        <?php
        if (LIST_AFFILIATE_POST == '1'):
            foreach ($Afiliados as $Key => $Value):
                ?>
                <a class="m-bottom3 container" target = "_blank" href= "<?= $Value['url_afiliado']; ?>"><img title = "<?= $Value['nome_afiliado']; ?>" alt = "[<?= $Value['nome_afiliado']; ?>]" src = "<?= $Value['imagem_afiliado']; ?>" border= "0" width="100%" height= "250" /></a>
                    <?php
                endforeach;
            endif;
            ?>

    </div>
</div>
