<?php
$titulo = '<span id="titulo"></span>';

//echo 'Titulo: ' . $titulo;
?>

<?php
$sobre = (($titulo !== 'Gabadi Online') ? HOME . DIRECTORY_SEPARATOR . 'sobre' : '#sobre');
$posts = (($titulo !== 'Gabadi Online') ? HOME . DIRECTORY_SEPARATOR . 'posts' : '#posts');
$videos = (($titulo !== 'Gabadi Online') ? HOME . DIRECTORY_SEPARATOR . 'videos' : '#videos');
$fotos = (($titulo !== 'Gabadi Online') ? HOME . DIRECTORY_SEPARATOR . 'fotos' : '#fotos');
?>

<nav class="main_nav bg-green">

    <div class="j_close close_nav fl-right font-bold">X</div>
    <span class="fontzero main_logo fl-left"><a title="<?= SITENAME; ?>" href="<?= HOME . '/&theme=' . THEME; ?>"><?= SITENAME; ?></a></span>

    <ul class="menu_ul">

        <li><a  title="Página Inicial da <?= SITENAME; ?>" href="<?= HOME . '/&theme=' . THEME; ?>">Início</a></li>

        <?php
        if (POSTS_APP == '1'):
            ?>
            <li><a  title="Posts da <?= SITENAME; ?>" href="<?= $posts . '/&theme=' . THEME; ?>">Posts</a>
                <?php if (SUBMENU == '1'): ?>
                    <ul>
                        <?php
                        $readSecao = new Read;
                        $readSecao->FullRead("SELECT category_id, category_title, category_name FROM " . CATEGORIAS . " WHERE category_parent IS NULL AND category_segment = :segment ORDER BY category_date DESC", "segment=blog");
                        if ($readSecao->getResult()):
                            foreach ($readSecao->getResult() as $secao):
                                extract($secao);
                                ?>

                                <li><a  title="<?= $category_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . $category_name . '/&theme=' . THEME; ?>"><?= $category_title ?></a>

                                    <?php if (SUBSUBMENU == '1'): ?>

                                        <ul>
                                            <?php
                                            $readCat = new Read;
                                            $readCat->FullRead("SELECT category_title, category_name FROM " . CATEGORIAS . " WHERE category_parent = :id AND category_parent IS NOT NULL ORDER BY category_date DESC", "id={$category_id}");
                                            if ($readCat->getResult()):
                                                foreach ($readCat->getResult() as $cat):
                                                    extract($cat);
                                                    ?>
                                                    <li><a  title="<?= $category_title; ?>" href="<?= HOME . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . $category_name . '/&theme=' . THEME; ?>"><?= $category_title ?></a></li>
                                                    <?php
                                                endforeach;
                                            endif;
                                            ?> 
                                        </ul>
                                    <?php endif; ?>
                                </li>

                                <?php
                            endforeach;
                        endif;
                        ?>

                    </ul>
                <?php endif; ?>

            </li>
            <?php
        endif;
        ?>

        <?php
        
        ?>

        <li><a title="Fale Conosco" href="#contatos">Contato</a></li>

    </ul>
</nav>