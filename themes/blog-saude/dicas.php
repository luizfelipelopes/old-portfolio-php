<section class="container dobra_artigos">

    <header class="container">
        <div class="content">
            <h1>Dicas</h1>
            <p>Aqui você encontra as Dicas e opiniões da Nutricionista e Coach Nilma Nayara, sobre Emagrecimento e Saúde. Fique a vontade e deixa seu recado ou dúvida nos comentários.</p>
            <div class="clear"></div>
        </div>
    </header>

    <div class="content">

        <div class="artigos container">
            <div class="content flex">
                <?php
                if (!empty($_SESSION['theme'])):

                    $Dicas = [
                        [
                            "post_title" => "3 Motivos Para Você Amar Low Carb",
                            "post_cover" => "3-motivos-para-voce-amar-low-carb!.jpg",
                            "post_date" => date('d/m/Y H:i:s'),
                            "post_last_views" => date('d/m/Y H:i:s'),
                            "post_author" => "Luiz Felipe Lopes",
                            "post_author_cover" => "luiz-felipe.jpg",
                        ],
                        [
                            "post_title" => "3 Passos Para se Tornar Um Low Carb",
                            "post_cover" => "3-passos-para-se-tornar-um-low-carb!.jpg",
                            "post_date" => date('d/m/Y H:i:s'),
                            "post_last_views" => date('d/m/Y H:i:s'),
                            "post_author" => "Luiz Felipe Lopes",
                            "post_author_cover" => "luiz-felipe.jpg",
                        ],
                        [
                            "post_title" => "5 Dicas Para se Manter em Uma Dieta Low Carb",
                            "post_cover" => "5-dicas-para-te-manter-em-uma-dieta-low-carb!.jpg",
                            "post_date" => date('d/m/Y H:i:s'),
                            "post_last_views" => date('d/m/Y H:i:s'),
                            "post_author" => "Luiz Felipe Lopes",
                            "post_author_cover" => "luiz-felipe.jpg",
                        ],
                        [
                            "post_title" => "Alimente-se Bem!",
                            "post_cover" => "alimente-se-bem!.jpg",
                            "post_date" => date('d/m/Y H:i:s'),
                            "post_last_views" => date('d/m/Y H:i:s'),
                            "post_author" => "Luiz Felipe Lopes",
                            "post_author_cover" => "luiz-felipe.jpg",
                        ],
                        [
                            "post_title" => "Entre na Zona Low Carb",
                            "post_cover" => "entre-na-zona-low-carb!.jpg",
                            "post_date" => date('d/m/Y H:i:s'),
                            "post_last_views" => date('d/m/Y H:i:s'),
                            "post_author" => "Luiz Felipe Lopes",
                            "post_author_cover" => "luiz-felipe.jpg",
                        ],
                        [
                            "post_title" => "Muito Amor por Low Carb",
                            "post_cover" => "muito-amor-por-low-carb.jpg",
                            "post_date" => date('d/m/Y H:i:s'),
                            "post_last_views" => date('d/m/Y H:i:s'),
                            "post_author" => "Luiz Felipe Lopes",
                            "post_author_cover" => "luiz-felipe.jpg",
                        ],
                    ];

                    foreach ($Dicas as $dica):
                        extract($dica);
                        ?>

                        <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . '/&theme=' . THEME; ?>" class="flex-3">
                            <article class="artigo" itemscope itemtype="https://schema.org/Article">
                                <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/posts/' . $post_cover; ?>">
                                <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post'; ?>">
                                <meta itemprop="image" content="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/posts/' . $post_cover; ?>">
                                <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                                <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">
                                <span class="ds-none">
                                    <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                        Por: <span itemprop="name">Luiz Felipe Lopes</span>
                                        <meta itemprop="url" content="https://plus.google.com/109917751422031829028">
                                    </span>

                                    <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                                        via <span itemprop="name"><?= $post_author; ?></span>
                                        <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img itemprop="url" src="<?= INCLUDE_PATH . DIRECTORY_SEPARATOR . 'Assets/Images/users/' . $post_author_cover; ?>"></span>
                                    </span>
                                </span>
                                <div class="content">
                                    <h1 itemprop="headline"><?= $post_title; ?></h1>
                                    <p>Em <?= date('d/m/Y', strtotime($post_date)); ?></p>
                                    <div class="clear"></div>
                                </div>
                            </article>
                        </a>

                        <?php
                    endforeach;


                else:

                    $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
                    $Pager = new Pager(HOME . '/dicas&pag=');
                    $Pager->ExePager((!empty($getPage) ? $getPage : 1), 6);

                    $readCategory = new Read;
                    $readCategory->ExeRead(CATEGORIAS, "WHERE category_name = :categoria AND category_parent IS NULL", "categoria=dicas");
                    if ($readCategory->getResult()):
                        $IdCategoria = $readCategory->getResult()[0]['category_id'];
                        $readDicas = new Read;
                        $readDicas->ExeRead(POSTS, "WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "categoria={$IdCategoria}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//                var_dump($readDicas->getResult());
                        if ($readDicas->getResult()):
                            foreach ($readDicas->getResult() as $dica):
                                extract($dica);
                                ?>

                                <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>" class="flex-3">
                                    <article class="artigo" itemscope itemtype="https://schema.org/Article">
                                        <img title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                                        <meta itemprop="mainEntityOfPage" content="<?= HOME . DIRECTORY_SEPARATOR . 'post' . DIRECTORY_SEPARATOR . $post_name; ?>">
                                        <meta itemprop="image" content="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>">
                                        <meta itemprop="datePublished" content="<?= date('Y-m-d H:i:s', strtotime($post_date)); ?>">
                                        <meta itemprop="dateModified" content="<?= date('Y-m-d H:i:s', strtotime($post_last_views)); ?>">
                                        <span class="ds-none">
                                            <span itemprop="author" itemscope itemtype="https://schema.org/Person">
                                                Por: <span itemprop="name">Luiz Felipe Lopes</span>
                                                <meta itemprop="url" content="https://plus.google.com/109917751422031829028">
                                            </span>

                                            <span itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
                                                via <span itemprop="name"><?= BuscaRapida::buscarUsuario($post_author)['user_name'] . ' ' . BuscaRapida::buscarUsuario($post_author)['user_lastname']; ?></span>
                                                <span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject"><img itemprop="url" src="<?= (!empty(BuscaRapida::buscarUsuario($post_author)['user_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . BuscaRapida::buscarUsuario($post_author)['user_cover'] : INCLUDE_PATH . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR . 'logo.png'); ?>"></span>
                                            </span>
                                        </span>
                                        <div class="content">
                                            <h1 itemprop="headline"><?= $post_title; ?></h1>
                                            <p>Em <?= date('d/m/Y', strtotime($post_date)); ?></p>
                                            <div class="clear"></div>
                                        </div>
                                    </article>
                                </a>

                                <?php
                            endforeach;
                            ?>

                            <div class="container"></div>
                            <div class="bloco_paginator">

                                <?php
                                $Pager->ExePaginator(POSTS, "WHERE post_cat_parent = :categoria AND post_status = 1 ORDER BY post_date DESC", "categoria={$IdCategoria}");
                                echo $Pager->getPaginator();
                                ?>
                            </div>

                            <?php
                        endif;
                    endif;

                endif;
                ?>

                <div class="clear"></div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
</section>