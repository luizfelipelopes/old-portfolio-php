<?php

/**
 * ajax_create_category.php - <b>CREATE CATEGORIA</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Categoria de um Post
 */
if ($Post['category_parent'] == '0'):
    $Post['category_parent'] = null;
endif;

unset($Post['category_id']);

$meuArray = Check::limparSubmit($Post);

$createCategory = new adminCategoria();
$createCategory->ExeCreate($meuArray);

// Recupera a lista de seções cadastradas
$readSections = new Read;
$readSections->ExeRead(CATEGORIAS, "WHERE category_parent IS NULL AND category_segment = :segment ORDER BY category_date DESC", "segment={$Post['category_segment']}");

if ($readSections->getResult()):
    $html = '<option selected value="0">Esta é uma seção</option>';
    foreach ($readSections->getResult() as $section):
        extract($section);
        $html .= '<option value="' . $category_id . '">' . $category_title . '</option>';
    endforeach;
endif;

if (!$createCategory->getResult()):
    $jSon['noclear'] = true;
else:
    $jSon['sections'] = $html;
endif;

$jSon['error'] = $createCategory->getError();
