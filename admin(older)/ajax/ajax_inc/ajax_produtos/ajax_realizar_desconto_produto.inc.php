<?php

/**
 * ajax_realizar_desconto_produto.inc.php - <b>REALIZAR DESCONTO PRODUTO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Desconto do Produto
 */

$adminProduto = new AdminProduto;
$Post['produto_valor_descontado'] = $adminProduto->ExeDesconto($Post['produto_valor'], $Post['produto_desconto']);
$jSon['produto_valor_descontado'] = number_format($Post['produto_valor_descontado'], 2, ',', '.');

//        var_dump($Post);