<div class="slide_controll">
    <div class="slide_nav back round"><</div>
    <div class="slide_nav go round">></div>
</div>

<?php
$read = new Read;
$read->ExeRead(DESTAQUES, "WHERE destaque_type = :tipo AND destaque_status = 1 ORDER BY destaque_order ASC LIMIT :limit", "tipo=foto&limit=6");
//
if ($read->getResult()):
    $i = 0;
//
    foreach ($read->getResult() as $destaque):
        extract($destaque);
        ?>
        <div class="slide_item <?= ($i == 0 ? 'first' : ''); ?>">
            <picture alt="<?= SITENAME; ?>">
                <!--<source class="lazy" media="(min-width: 1600px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=20&h=11" data-src="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1920&h=952" data-srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1920&h=952" />-->
                <!--<source data-src="1600" media="(min-width: 1600px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=2000&h=600" />-->
                <!--<source class="lazy" media="(min-width: 1366px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=20&h=11" data-src="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1600&h=820" data-srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1600&h=820" />-->
                <!--<source class="lazy" media="(min-width: 1280px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1366&h=720" />-->
                <!--<source class="lazy" media="(min-width: 960px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1280&h=620" />-->
                <!--<source class="lazy" media="(min-width: 768px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=20&h=11" data-src="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=960&h=470" data-srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=960&h=470" />-->
                <!--<source class="lazy" media="(min-width: 480px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=800&h=370" />-->
                <!--<source class="lazy" media="(min-width: 1px)" srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=480&h=250" />-->

                        <!--<img title="<?= SITENAME; ?>" alt="<?= SITENAME; ?>" src="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=20&h=11" data-src="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>&w=1920&h=952" data-srcset="tim.php?src=<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>"/>-->
                <img class="lazy" title="<?= SITENAME; ?>" alt="<?= SITENAME; ?>" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $destaque_cover; ?>" />
            </picture>
        </div>    


        <?php
        $i++;
    endforeach;

endif;
?>


