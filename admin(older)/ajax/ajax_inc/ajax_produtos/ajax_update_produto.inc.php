<?php

/**
 * ajax_update_produto.php - <b>UPDATE POST</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Update de Produto
 */
$id = $Post['produto_id'];
unset($Post['produto_id']);
$jSon['naolimpar'] = $id;

$adminProduto = new AdminProduto;
$read = new Read;
$read->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$id}");

//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : 'null');

if (isset($_FILES['produto_image']) && $_FILES['produto_image']['tmp_name']):
    $Post['produto_image'] = $_FILES['produto_image'];
else:

    if ($read->getResult()):
        $Post['produto_image'] = $read->getResult()[0]['produto_image'];
    else:
        $Post['produto_image'] = null;
    endif;
endif;

if (isset($_FILES['gallery_covers']) && $_FILES['gallery_covers']['tmp_name']):

    $adminProduto->gbSend($id, $_FILES['gallery_covers']);

endif;

if (empty($Post['produto_desconto'])):
    unset($Post['produto_desconto'], $Post['produto_valor_descontado']);
endif;

if (isset($Post['pic']) && empty($Post['pic'])):
    unset($Post['pic']);
endif;


$Post['produto_descricao'] = $Conteudo;

//        if(!empty($Post['produto_desconto'])):
//            $Post['produto_desconto'] = $Post['produto_desconto'] / 100;
//        endif;

$meuArray = array();

foreach ($Post as $key => $value) :
    if (!is_numeric($key)):
        $meuArray += [$key => $value];
    endif;
endforeach;


//        var_dump($meuArray);

$adminProduto->ExeUpdate($id, $meuArray);
//
$jSon['error'] = $adminProduto->getError();

//        var_dump($adminProduto);