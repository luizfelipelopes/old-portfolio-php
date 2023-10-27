<?php
//LER SECOES DO SISTEMA
$readCategoria = new Read;
$readCategoria->FullRead("SELECT category_id, category_title, category_name, category_parent FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_segment = :segment ORDER BY category_id LIMIT 4", "segment=blog");

//SE EXISTIR MAIS DE 3 SECOES
if ($readCategoria->getResult() && $readCategoria->getRowCount() >= 4):

    $PostsCat = array();

//    VERIFICA SE EXISTE POSTS EM TODAS AS SECOES
    foreach ($readCategoria->getResult() as $categoria):

        extract($categoria);

        $readPost->FullRead("SELECT post_title, post_name, post_content, post_date, post_cover FROM " . POSTS . " WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC LIMIT 3", "categoria={$category_id}");

        $PostsCat[] = $readPost->getResult();

    endforeach;

//    var_dump($PostsCat);
//    die;
//    SE EXISTE POST EM TODAS AS SECOES
    if (!in_array(null, $PostsCat)):

//        EXIBE AS SECOES COM SEUS RESPECTIVOS POSTS
        foreach ($readCategoria->getResult() as $categoria):

            extract($categoria);

            $readPost->FullRead("SELECT post_title, post_name, post_content, post_date, post_cover, post_category FROM " . POSTS . " WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC LIMIT 3", "categoria={$category_id}");

            if ($readPost->getResult()):
                ?>

                <section class="container posts_categorias box box-small">


                    <div class="content">

                        <header>
                            <a title="<?= $category_title; ?>" href="<?= HOME . '/posts/' . $category_name; ?>"> <h1 class="title fontsize1"><?= $category_title; ?></h1></a>
                            <div class="form-barra"></div>
                        </header>
                        <div class="separator m-bottom3"></div>

                        <?php
                        $j = 0;
                        foreach ($readPost->getResult() as $post):
                            extract($post);
                            ?>

                            <article class="post_categoria_item <?= ($j == 0 ? 'principal' : 'demais'); ?>">

                                <span itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                                    <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                                    <meta itemprop="width" content="300" />
                                    <meta itemprop="height" content="180" />
                                </span>
                                <a title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>"><h1 class="m-bottom1" itemprop="name"><?= Check::Words($post_title, 7); ?></h1></a>

                                <?php $Categoria = BuscaRapida::buscarCategoria($post_category); ?>

                                <span class="container m-bottom1"><a class="categoria_link" title="" href="<?= HOME . '/posts/' . $Categoria['category_name']; ?>"> <span class="container fontsize1 m-bottom1 font-bold">>><?= $Categoria['category_title']; ?></span></a><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>

                                <p class="<?= ($j > 0 ? 'ds-none' : 'al-justify'); ?>" itemprop="description"><?= Check::Words($post_content, 20); ?></p>

                                <a class=" ds-none mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name; ?>">Ver mais...</a>

                            </article>

                            <?php
                            $j++;
                        endforeach;
                        ?>

                        <div class="clear"></div>
                    </div>

                </section>
                <?php
            endif;

        endforeach;
    endif;

endif;
?>