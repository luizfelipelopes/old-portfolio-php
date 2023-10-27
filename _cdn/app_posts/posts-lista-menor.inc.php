<!--POSTS MAIS VISTOS-->
<section style="float: <?= (SIDEBAR_HOME_LEFT == '1' ? 'right' : (SIDEBAR_HOME_RIGHT == '1' ? 'left' : '')); ?>;" class="container posts-lista-menor">
    <div class="content">

        <div class="container">

            <?php
            $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
            $Pager = new Pager(HOME . '?pag=');
            $Pager->ExePager($getPage, 12);


            $readPost = new Read();
            $readPost->FullRead("SELECT post_title, post_content, post_category, post_date, post_name, post_cover FROM " . POSTS . " WHERE post_status = 1 ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
            if (!$readPost->getResult()):
                WSErro("Desculpe! Não Há Posts no Momento!", WS_INFOR);
            else:

                foreach ($readPost->getResult() as $post):
                    extract($post);
                    ?>

                    <article class="post-item-lista-menor">
                        <span  class="ds-none"itemprop="image" itemscope itemtype="https://schema.org/ImageObject">
                            <a class="link-img" title="<?= $post_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>"><img itemprop="name" title="<?= $post_title; ?>" alt="[<?= $post_title; ?>]" src="<?= HOME . DIRECTORY_SEPARATOR . 'uploads' . $post_cover; ?>" /></a>
                            <meta itemprop="width" content="300" />
                            <meta itemprop="height" content="180" />
                        </span>

                        <div class="content">
                            <span class="post-item-lista-menor-content">
                                <div class="content-link">
                                    <a title="" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">
                                        <h1 itemprop="name"><?= $post_title; ?></h1>
                                    </a>
                                    <?php
                                    $readCat = new Read;
                                    $readCat->FullRead("SELECT category_title FROM " . CATEGORIAS . " WHERE category_id = :id", "id={$post_category}");
                                    ?>
                                    <span><?= (!empty($readCat->getResult()[0]['category_title']) ? $readCat->getResult()[0]['category_title'] . ' >> ' : ''); ?><time datetime="<?= date('Y-m-d', strtotime($post_date)); ?>"><?= date('\e\m d/m/Y \à\s H:i \H\r\s', strtotime($post_date)); ?></time></span>
                                    <p itemprop="description"><?= str_replace("...", "", Check::Words($post_content, 20)); ?>

                                        <?php
                                        if (Check::countWords($post_content) > 30):
                                            ?>
                                            <a class="mais link" title="Ver Mais" href="<?= HOME . DIRECTORY_SEPARATOR . $post_name . '/&theme=' . THEME; ?>">Ver mais...</a>
                                            <?php
                                        endif;
                                        ?>
                                    </p>
                                </div>

                            </span>

                            <div class="post-item-lista-menor-author">
                                <div class="image">
                                    <img class="round" title="Nilma Nayara Neves" alt="[Nilma Nayara Neves]" src="<?= INCLUDE_PATH ?>/img/foto-novo-post.png"/>
                                </div>
                                <p>Nilma Nayara Neves</p>
                            </div>

                            <div class="clear"></div>
                        </div>

                        <div class="clear"></div>
                    </article>


                    <?php
                endforeach;
                $Pager->ExeFullPaginator("SELECT post_title, post_content, post_category, post_date, post_name, post_cover FROM " . POSTS . " WHERE post_status = 1 ORDER BY post_date DESC");
                ?>
                <div class="j_paginator" attr-action="paginator_post">
                    <?php
                    echo $Pager->getPaginator();
                endif;
                ?>

            </div>   
            <div class="clear"></div>
        </div>
</section>