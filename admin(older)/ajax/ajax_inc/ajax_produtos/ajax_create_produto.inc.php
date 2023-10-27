<?php

/**
 * ajax_create_produto.php - <b>CREATE PRODUTO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Cadastro de Produto
 */
unset($Post['produto_id']);
//        $Post['produto_image'] = ($_FILES['produto_image']['tmp_name'] ? $_FILES['produto_image'] : null);
if (isset($_FILES['produto_image']['tmp_name'])):
    $Post['produto_image'] = $_FILES['produto_image'];
endif;

if (empty($Post['produto_desconto'])):
    unset($Post['produto_desconto'], $Post['produto_valor_descontado']);
endif;

$meuArray = array();

$Post['produto_descricao'] = $Conteudo;

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;

//        var_dump($meuArray);
//        var_dump($meuArray);
$adminProduto = new AdminProduto;
$adminProduto->ExeCreate($meuArray);

if (!empty($_FILES['gallery_covers']['tmp_name'])):
    $createGallery = new AdminProduto();
    $createGallery->gbSend($adminProduto->getResult(), $_FILES['gallery_covers']);
//            var_dump($_FILES['gallery_covers']);
endif;

if (!$adminProduto->getResult()):
    $jSon['id'] = 'id';
endif;

$jSon['error'] = $adminProduto->getError();
//        var_dump($adminProduto);