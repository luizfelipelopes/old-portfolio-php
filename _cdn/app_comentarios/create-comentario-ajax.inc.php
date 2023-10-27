<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (FORM_FOTO == '0'):
    unset($Post['comentario_cover']);
endif;

if (FORM_NOME == '0'):
    unset($Post['comentario_author']);
endif;

if (FORM_EMAIL == '0'):
    unset($Post['comentario_email']);
endif;

if (FORM_CIDADE == '0'):
    unset($Post['comentario_cidade']);
endif;

if (AVALIACAO == '0'):
    unset($Post['comentario_avaluation']);
endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

if (!empty($_FILES['comentario_cover']['tmp_name'])):
    $meuArray['comentario_cover'] = $_FILES['comentario_cover'];
endif;

$adminComentario = new adminComentario;
$adminComentario->ExeCreate($meuArray);

$totalComentario = new Read;
$totalComentario->FullRead("SELECT comentario_id FROM " . COMENTARIOS . " WHERE comentario_status = 1 AND comentario_type = :type AND comentario_post = :post", "type=post&post={$Post['comentario_post']}");
$jSon['total_comentarios'] = $totalComentario->getRowCount() . ($totalComentario->getRowCount() > 1 ? ' Comentários' : ' Comentário');

$readComentario = new Read;
$readComentario->FullRead("SELECT comentario_author, comentario_email, comentario_cover, comentario_content, comentario_avaluation, comentario_date FROM " . COMENTARIOS . " WHERE comentario_id = :id", "id={$adminComentario->getResult()}");

if (!isset($Post['comentario_resposta'])):

    $_SESSION['usercomentario'] = [
        "comentario_author" => (!empty($readComentario->getResult()[0]['comentario_author']) && FORM_NOME == '1' ? $readComentario->getResult()[0]['comentario_author'] : null),
        "comentario_email" => (!empty($readComentario->getResult()[0]['comentario_email']) && FORM_EMAIL == '1' ? $readComentario->getResult()[0]['comentario_email'] : null),
        "comentario_cover" => (!empty($readComentario->getResult()[0]['comentario_cover']) && FORM_FOTO == '1' ? $readComentario->getResult()[0]['comentario_cover'] : null),
        "comentario_cidade" => (!empty($readComentario->getResult()[0]['comentario_cidade']) && FORM_CIDADE == '1' ? $readComentario->getResult()[0]['comentario_cidade'] : null),
        "comentario_avaluation" => (!empty($readComentario->getResult()[0]['comentario_avaluation']) && AVALIACAO == '1' ? $readComentario->getResult()[0]['comentario_avaluation'] : null)
    ];

endif;

if (MODERADOR == '0'):

    $html = '<article id="' . $adminComentario->getResult() . '" ' . (!empty($Post['comentario_resposta']) ? 'attr-pai="' . $Post['comentario_resposta'] . '"' : '') . ' attr-post="' . $Post['comentario_post'] . '" class="' . (!empty($Post['comentario_resposta']) ? 'pd-left3 comentario-resposta' : '') . ' recado_item box comentario" itemprop="review" itemscope itemtype="https://schema.org/Review">';
    $html .= '<div class="content_comentario js_content_form">';
    $html .= ((AVATAR == '1' && FORM_FOTO == '1') || ((AVATAR == '1' && FORM_FOTO == '0')) ? '<img class="avatar" title="" alt="" src="' . (!empty($readComentario->getResult()[0]['comentario_cover']) ? HOME . DIRECTORY_SEPARATOR . 'uploads' . $readComentario->getResult()[0]['comentario_cover'] : INCLUDE_PATH . '/img/perfil-avatar.png') . '" />' : '');
    $html .= '<div class="comment">';
    $html .= (FORM_NOME == '1' ? '<h1 class="nome_comentario" itemprop="author">' . $readComentario->getResult()[0]['comentario_author'] . '</h1>' : '<div class="m-bottom1"></div>');
    $html .= '<p itemprop="reviewBody">' . $readComentario->getResult()[0]['comentario_content'] . '</p>';
    $html .= (AVALIACAO == '1' && !isset($Post['comentario_resposta']) ? (!empty($meuArray['comentario_avaluation']) && $meuArray['comentario_avaluation'] == '1' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/1-estrela.png" />' : (!empty($meuArray['comentario_avaluation']) && $meuArray['comentario_avaluation'] == '2' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/2-estrelas.png" />' : (!empty($meuArray['comentario_avaluation']) && $meuArray['comentario_avaluation'] == '3' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/3-estrelas.png" />' : (!empty($meuArray['comentario_avaluation']) && $meuArray['comentario_avaluation'] == '4' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/4-estrelas.png" />' : (!empty($meuArray['comentario_avaluation']) && $meuArray['comentario_avaluation'] == '5' ? '<img class="avaliacao" title="" alt="" src="' . INCLUDE_PATH . '/img/5-estrelas.png" />' : ''))))) : '');
    $html .= '<span class="data_comentario">Em <time datetime="' . date('Y-m-d') . '" itemprop="dataPublished">' . date('d/m/Y \à\s H:i', strtotime($readComentario->getResult()[0]['comentario_date'])) . '</time></span>';
    $html .= '<!--<span class="like">2 Gostei :)</span>-->';
    $html .= ((FORM_RESPOSTA_PAI == '1' && FORM_RESPOSTA_FILHO == '1') ? '<span class="resposta pointer js_responder">Responder</span>' : (FORM_RESPOSTA_PAI == '1' && FORM_RESPOSTA_FILHO == '0' ? '<span class="resposta pointer js_responder ' . (!empty($Post['comentario_resposta']) ? 'ds-none' : '') . '">Responder</span>' : (FORM_RESPOSTA_PAI == '0' && FORM_RESPOSTA_FILHO == '1') ? '<span class="resposta pointer js_responder ' . (!empty($Post['comentario_resposta']) ? 'ds-none' : '') . '">Responder</span>' : ''));
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</article>';
    $html .= (!empty($Post['comentario_resposta']) ? '' : '<div class="m-bottom1 container"></div>');
    $html .= '<div class = "js_append_resposta"></div>';
    $html .= '<div class = "js_append_form_comentario"></div >';
    $html .= (!empty($Post['comentario_resposta']) ? '' : '<div class = "js_barra_bottom bd-bottom1 m-bottom3 container"></div >');
    $jSon['comentario_item'] = $html;
endif;

if (!empty($Post['comentario_resposta'])):
    $jSon['resposta'] = $Post['comentario_resposta'];

endif;
$jSon['error'] = $adminComentario->getError();
