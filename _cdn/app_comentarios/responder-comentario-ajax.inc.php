<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$html = '<form class="form_comentario_avaliacao fl-left js_form_resposta m-top3 m-left3 wd-80"  action="" method="post">';
$html .= '<div class="trigger-box-suspenso"></div>';
$html .= '<input type="hidden" name="action" value="create_comentario">';
$html .= (!empty($Post['comentario']) ? '<input type="hidden" name="comentario_resposta" value="' . $Post['comentario'] . '" />' : '');
$html .= '<input type="hidden" name="comentario_post" value="' . $Post['post_id'] . '" />';
$html .= '<input type="hidden" name="comentario_status" value="' . (MODERADOR == '0' ? '1' : '0') . '" />';
$html .= '<input type="hidden" name="comentario_type" value="post" />';

if (!isset($_SESSION['clientelogin']) && !isset($_SESSION['userlogin'])):

    if (!empty($_SESSION['usercomentario'])):

        $html .= '<input type="hidden" name="comentario_author" value="' . $_SESSION['usercomentario']['comentario_author'] . '" />';
        $html .= '<input type="hidden" name="comentario_email" value="' . $_SESSION['usercomentario']['comentario_email'] . '" />';
        $html .= '<input type="hidden" name="comentario_cover" value="' . $_SESSION['usercomentario']['comentario_cover'] . '" />';
        $html .= '<input type="hidden" name="comentario_cidade" value="' . $_SESSION['usercomentario']['comentario_cidade'] . '" />';
        $html .= '<input type="hidden" name="comentario_avaluation" value="' . $_SESSION['usercomentario']['comentario_avaluation'] . '" />';

    else:

        $html .= '<label class="' . (FORM_FOTO == '1' ? '' : 'ds-none') . '">';
        $html .= '<span>Foto:</span>';
        $html .= '<input type="file" name="comentario_cover" ' . (FORM_FOTO == '1' ? 'required' : '') . '/>';
        $html .= '</label>';
        $html .= '<label class="' . (FORM_NOME == '1' ? '' : 'ds-none') . '">';
        $html .= '<span>Nome:</span>';
        $html .= '<input type="text" name="comentario_author" ' . (FORM_NOME == '1' ? 'required' : '') . '/>';
        $html .= '</label>';
        $html .= '<label class="' . (FORM_EMAIL == '1' ? '' : 'ds-none') . '">';
        $html .= '<span>Email:</span>';
        $html .= '<input type="email" name="comentario_email" ' . (FORM_EMAIL == '1' ? 'required' : '') . '/>';
        $html .= '</label>';
        $html .= '<label class="' . (FORM_CIDADE == '1' ? '' : 'ds-none') . '">';
        $html .= '<span>Cidade:</span>';
        $html .= '<input type="text" placeholder="Ex: Diamantina - MG" name="comentario_cidade" ' . (FORM_CIDADE == '1' ? 'required' : '') . '/>';
        $html .= '</label>';

    endif;

else:

    $html .= '<input type="hidden" name="comentario_author" value="' . (isset($_SESSION['clientelogin']['cliente_name']) ? $_SESSION['clientelogin']['cliente_name'] . ' ' . $_SESSION['clientelogin']['cliente_lastname'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_name'] . ' ' . $_SESSION['userlogin']['user_lastname'] . ' - (Admin)' : '')) . '" />';
    $html .= '<input type="hidden" name="comentario_cover" value="' . (isset($_SESSION['clientelogin']['cliente_cover']) ? $_SESSION['clientelogin']['cliente_cover'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_foto'] : '')) . '" />';
    $html .= '<input type="hidden" name="comentario_email" value="' . (isset($_SESSION['clientelogin']['cliente_email']) ? $_SESSION['clientelogin']['cliente_email'] : (!empty($_SESSION['userlogin']) ? $_SESSION['userlogin']['user_email'] . ' - (Admin)' : '')) . '" />';
    $Cidade = BuscaRapida::buscarCidade((isset($_SESSION['clientelogin']['cliente_cidade']) ? $_SESSION['clientelogin']['cliente_cidade'] : ''));
    $html .= '<input type="hidden" name="comentario_cidade" value="' . ($Cidade ? $Cidade[0]['cidade_nome'] . ' - ' . $Cidade[0]['cidade_uf'] : null) . '" />';

endif;

$html .= '<label>';
$html .= '<span>Mensagem:</span>';
$html .= '<textarea type="text" name="comentario_content" rows="8" cols="30" required></textarea>';
$html .= '</label>';
$html .= '<div class="form-check ds-none">';
$html .= '<span class="form-field">Avalie Este Conteúdo</span>';
$html .= '<label class="ds-block"><input type="radio" name="comentario_avaluation" value="1">1</label>';
$html .= '<label class="ds-block"><input type="radio" name="comentario_avaluation" value="2">2</label>';
$html .= '<label class="ds-block"><input type="radio" name="comentario_avaluation" value="3">3</label>';
$html .= '<label class="ds-block"><input type="radio" name="comentario_avaluation" value="4">4</label>';
$html .= '<label class="ds-block"><input type="radio" name="comentario_avaluation" value="5">5</label>';
$html .= '</div>';
$html .= '<input class="btn btn-green" type="submit" value="Enviar" />';
$html .= '<div title="Carregando" class="load fl-right m-top1"></div>';
$html .= '</form>';

$jSon['textarea'] = $html;
