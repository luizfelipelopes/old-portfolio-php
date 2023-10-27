<?php

/**
 * ajax_pesquisar_post.php - <b>PESQUISAR POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa do Post em REAL-TIME
 */
$read = new Read;
$Pager = new Pager("dashboard.php?exe=posts/index&pag=");
$Pager->ExePager(1, 12);

$id = $Post['id_categoria'];
$sec = $Post['sec'];
$_SESSION['pesquisa'] = $Post['s'];

//var_dump($pag, $id, $sec);

if (!empty($id)):

    if ($sec):
//                $read->ExeRead(POSTS, "WHERE post_cat_parent = :id ORDER BY post_date DESC", "id={$id}");
        $read->FullRead("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_cat_parent = :id AND (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&id={$id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    else:
//                $read->ExeRead(POSTS, "WHERE post_category = :id ORDER BY post_date DESC", "id={$id}");
        $read->FullRead("SELECT post_id, post_title, post_cover, DATE_FORMAT(post_date, '%d/%m/%Y as %H:%i:%s') AS post_date, post_category, post_status FROM " . POSTS . " WHERE post_category = :id AND (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') ORDER BY post_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&id={$id}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");
    endif;

else:

    $read->ExeRead(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') ORDER BY post_status ASC, post_date DESC LIMIT :limit OFFSET :offset", "like={$Post['s']}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

endif;


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
            
            $Pager->ExePaginator(POSTS, "WHERE post_cat_parent = :id AND (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') ORDER BY post_date DESC", "like={$Post['s']}&id={$id}");

        else:

            $Pager->ExePaginator(POSTS, "WHERE post_category = :id AND (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') ORDER BY post_date DESC", "like={$Post['s']}&id={$id}");

        endif;

    else:
        $Pager->ExePaginator(POSTS, "WHERE (post_title LIKE '%' :like '%' OR post_subtitle LIKE '%' :like '%') ORDER BY post_date DESC", "like={$Post['s']}");
    endif;

    $jSon['action_paginator'] = '<div class="j_paginator" attr-action="paginator_post"></div>';
    $jSon['paginator'] = $Pager->getPaginator();

        endif;
