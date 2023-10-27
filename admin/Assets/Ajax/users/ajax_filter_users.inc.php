<?php

/**
 * ajax_filter_users.inc.php - <b>FILTRAR USUÁRIOS</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Filtro de Usuários
 */
if (!empty($Post)):

    if (isset($Post['search'])):
        $SqlSearch = (empty($Post['search']) ? '' : "user_name LIKE '%" . $Post['search'] . "%'");
        $Sql = $SqlSearch . (empty($Post['search']) ? '' : ' AND');
    else:
        $Sql = '';
    endif;

//    var_dump($Sql);
//    die;

    $Own = (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_id'] : '1');
    $Pager = new Pager("?exe=users/index&pag=");
    $Pager->ExePager(1, 12);
    $readUsers = new Read();
    $readUsers->FullRead('SELECT user_id, user_foto, user_name, user_lastname, user_level, user_email, user_registration FROM ' . USUARIOS . ' WHERE ' . $Sql . ' user_id != :own ORDER BY user_registration DESC LIMIT :limit OFFSET :offset', "own={$Own}&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}");

    if ($readUsers->getResult()):
        $jSon['users'] = '';

        foreach ($readUsers->getResult() as $user):

            extract($user);

            $jSon['users'] .= '<article id="' . $user_id . '" class="users_item js_item">';
            $jSon['users'] .= '<img title="' . $user_name . ' ' . $user_lastname . '" alt="" src="' . (!empty($user_foto) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $user_foto : '') . '">';

            $jSon['users'] .= '<div class="users_item_info">';
            $jSon['users'] .= '<h3>' . Check::Words($user_name . ' ' . $user_lastname, 5) . '</h3>';
            $jSon['users'] .= '<span class="users_item_info_level">' . ($user_level == '3' ? 'Programador(a)' : ($user_level == '2' ? 'Administrador(a)' : 'Editor(a)')) . '</span>';
            $jSon['users'] .= '<span class="users_item_info_mail icon-mail dont-break-out">' . $user_email . '</span>';
            $jSon['users'] .= '<span class="users_item_info_date icon-clock">Desde ' . date('d/m/Y \à\s H:i \h', strtotime($user_registration)) . '</span>';

            $jSon['users'] .= '<div class="users_item_info_buttons">';
            $jSon['users'] .= '<a title="Editar Usuário" href="?exe=users/create&id=' . $user_id . '" class="icon-edit btn btn-small btn-blue radius">Editar</a> ';
            $jSon['users'] .= '<a id="' . $user_id . '" attr-action="delete_user" title="Excluir Usuário" href="#" class="icon-delete-circle btn-small btn btn-red radius js_btn_delete">Excluir</a>';
            $jSon['users'] .= '</div>';
            $jSon['users'] .= '</div>';
            $jSon['users'] .= '</article>';

        endforeach;

    endif;

    $Pager->ExeFullPaginator("SELECT user_id, user_foto, user_name, user_lastname, user_level, user_email, user_registration FROM " . USUARIOS . " WHERE " . $Sql . " user_id != :own ORDER BY user_registration DESC", "own={$Own}");
    $jSon['paginator'] = '<div class="js_paginator" attr-action="paginator_users">';
    $jSon['paginator'] .= (!empty($Pager->getPaginator()) ? '<div class="paginator_container">' . $Pager->getPaginator() . '</div>' : '');
    $jSon['paginator'] .= '</div>';

endif;
