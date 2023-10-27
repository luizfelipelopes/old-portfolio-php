<?php

/**
 * ajax_paginator_post.php - <b>PAGINAÇÂO POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Paginação do Post em REAL-TIME
 */
//      var_dump($Post);

$read = new Read;
$readVendas = new Read;

//        $getPage = filter_input(INPUT_GET, 'pag', FILTER_DEFAULT);
$Pager = new Pager("dashboard.php?exe=posts/index&pag=");
$Pager->ExePager($Post['pagina'], 12);

$id = $Post['id_categoria'];
$sec = $Post['sec'];
$QueryPesquisa = (!empty($_SESSION['pesquisa']) ? "AND (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') " : '');
$PlacesPesquisa = (!empty($_SESSION['pesquisa']) ? "like={$_SESSION['pesquisa']}&" : '');

//var_dump($PlacesPesquisa);
//var_dump("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_cat_parent = :id " . $QueryPesquisa . "ORDER BY post_date DESC LIMIT :limit OFFSET :offset");

if (!empty($id)):

    if ($sec):
//                $read->ExeRead(POSTS, "WHERE post_cat_parent = :id ORDER BY post_date DESC", "id={$id}");
        $read->FullRead("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_cat_parent = :id " . $QueryPesquisa . "ORDER BY post_date DESC LIMIT :limit OFFSET :offset", $PlacesPesquisa . "id={$id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    else:
//                $read->ExeRead(POSTS, "WHERE post_category = :id ORDER BY post_date DESC", "id={$id}");
        $read->FullRead("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_category = :id " . $QueryPesquisa . "ORDER BY post_date DESC LIMIT :limit OFFSET :offset", $PlacesPesquisa . "id={$id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    endif;

else:

    $read->ExeRead(POSTS, "ORDER BY post_status ASC, post_date DESC LIMIT :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

endif;


//            $read->ExeRead(PRODUTOS, "ORDER BY produto_data DESC LIMIt :limit OFFSET :offset", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

if (!$read->getResult()):
    $jSon['error'] = ["Nehum post foi encontrado com esta pesquisa", "infor"];
else:
    $jSon['success'] = ["Foi encontrado {$read->getRowCount()} resultados para esta pesquisa.", "infor"];
    $jSon['total'] = $read->getRowCount();
    $jSon['result'] = array();
    $i = 0;

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

        $post['categoria_data'] = ($readCategoria->getResult() ? "<p class=\"posts-item-categoria\"> >> {$readCategoria->getResult()[0]['category_title']
                }" : "") . " - " . date('d/m/Y - H:i', strtotime($post_date)) . "</p>";
        $jSon['result'] += [$i => $View->returnView($post, $tpl_curso)];

        $i++;
    endforeach;

    if (!empty($id)):

        if ($sec):
            $Pager->ExePaginator(POSTS, 'WHERE post_cat_parent = :id ' . $QueryPesquisa . 'ORDER BY post_date DESC', $PlacesPesquisa . "id={$id}");

        else:

            $Pager->ExePaginator(POSTS, 'WHERE post_category = :id ' . $QueryPesquisa . ' ORDER BY post_date DESC', $PlacesPesquisa . "id={$id}");

        endif;

    else:
        $Pager->ExePaginator(POSTS, 'ORDER BY post_date DESC');
    endif;

    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_post"></div>';
    $jSon['paginator'] = $Pager->getPaginator();

        endif;
