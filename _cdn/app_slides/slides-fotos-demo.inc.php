<div class="slide_controll">
    <div class="slide_nav back round"><</div>
    <div class="slide_nav go round">></div>
</div>

<?php
$Destaques = ["destaque1", "destaque2", "destaque3", "destaque4"];

$i = 0;
//
foreach ($Destaques as $destaque):
//    extract($destaque);
    ?>
    <div class="slide_item <?= ($i == 0 ? 'first' : ''); ?>">
        <picture alt="<?= SITENAME; ?>">
            <img class="lazy" title="<?= SITENAME; ?>" alt="<?= SITENAME; ?>" src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/destaques' . DIRECTORY_SEPARATOR. $destaque . ".png"; ?>" />
        </picture>
    </div>    


    <?php
    $i++;
endforeach;
?>


