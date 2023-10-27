<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$sec = filter_input(INPUT_GET, 'sec', FILTER_VALIDATE_BOOLEAN);

$read = new Read;

$getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager("dashboard.php?exe=posts/index&pag=");
$Pager->ExePager($getPage, 12);


if (!empty($id)):

    if ($sec):
//                $read->ExeRead(POSTS, "WHERE post_cat_parent = :id ORDER BY post_date DESC", "id={$id}");
        $read->FullRead("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_cat_parent = :id ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "id={$id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    else:
//                $read->ExeRead(POSTS, "WHERE post_category = :id ORDER BY post_date DESC", "id={$id}");
        $read->FullRead("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_category = :id ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "id={$id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    endif;

    $readCat = new Read;
    $readCat->FullRead("SELECT category_title FROM " . CATEGORIAS . " WHERE category_id = :id", "id={$id}");

else:

    $read->FullRead("SELECT post_id, post_title, post_name, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
//            var_dump($read->getResult());
//            die;
endif;
?>

<!--CAMINHO-->
<header class="container bg-body cabecalho sectiontitle sectiontitle-nomargin">
    <div class="content">
        <div class="titulo-caminho">
            <h1 class="shorticon shorticon-dashboard shorticon-minimo ds-inblock">Posts</h1>
            <p class="tagline"> >> Flow State / <b>Posts</b><?= (!empty($id) && $readCat->getResult() ? ' / <strong>' . $readCat->getResult()[0]['category_title'] . '</strong>' : ''); ?></p>
        </div>


        <a class="btn btn-blue btn-option-header radius" title="Novo Curso" href="<?= HOME . DIRECTORY_SEPARATOR . ADMIN; ?>/dashboard.php?exe=posts/create">Novo Post</a>
        <form class="form-search" method="post" action="">
            <input type="hidden" name="action" value="pesquisar" />
            <input type="text" name="s" title="Pesquisar Post" placeholder="Pesquisar Post" attr-pesquisa="pesquisar_post" class="j_pesquisar"/> 
            <button name="s_pesquisar" class="btn btn-green radius shorticon shorticon-search j_pesquisar"></button>
        </form>

        <div class="clear"></div>
    </div>
</header>
<!--CAMINHO-->


<div class="box-line"></div>


<div class="container main-conteudo posts js_paginator">    

    <div class="trigger-box m-bottom1 m-top1"></div>    

    <div class="content j_post_conteudo">



        <?php
        if (!$read->getResult()):
            WSErro("Nenhum Post Foi Escrito Ainda!", WS_INFOR);
        else:
            $View = new View();
            $tpl_curso = $View->Load('post');

            foreach ($read->getResult() as $post):
                extract($post);

                $post['imagem_post'] = HOME . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR;
                $post['HOME'] = HOME;
                $post['ADMIN'] = ADMIN;
                $post['views'] = (!empty($post_views) ? sprintf("%05d", intval($post_views)) : sprintf("%05d", 0));
                $post['botao_status'] = ($post_status == '1' ? '<a title="Publicado" attr-status="mudar_status" class="btn btn-green radius posts-item-status-post j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status" class="btn btn-yellow radius posts-item-status-post j_pendente shorticon shorticon-pendente"></a>');
                $post['post_title_resumido'] = Check::Words($post['post_title'], 5);

                $readCategoria = new Read;
                $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$post_category}");

                $post['categoria_data'] = ($readCategoria->getResult() ? "<p class=\"posts-item-categoria\"> >> {$readCategoria->getResult()[0]['category_title']}" : "") . " - " . $post_date . "</p>";
                $View->Show($post, $tpl_curso);

            endforeach;
        endif;
        ?>


        <?php
        if (!empty($id)):

            if ($sec):
                $Pager->ExePaginator(POSTS, 'WHERE post_cat_parent = :id ORDER BY post_date', "id={$id}");
//$Pager->ExePaginator(POSTS);
            else:

                $Pager->ExePaginator(POSTS, 'WHERE post_category = :id ORDER BY post_date DESC', "id={$id}");
//$Pager->ExePaginator(POSTS);
            endif;

        else:
            $Pager->ExePaginator(POSTS);
        endif;

        echo $Pager->getPaginator();
//        var_dump($Pager->getPaginator());
        ?>

        <div class="j_paginator" attr-action="paginator_post"></div>

        <div class="clear"></div>
    </div>
</div>