<?php

/**
 * ajax_delete_produto.php - <b>DELETE PRODUTO</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão do Produto
 */
$delete = new adminProduto();
$delete->ExeDelete($Post['id']);

$read = new Read;
$readVendas = new Read;

$read->ExeRead(PRODUTOS, "ORDER BY produto_data DESC");
if ($read->getRowCount() == 1):
    $jSon['error'] = ["Não há produtos cadastrados", "WS_INFOR"];
endif;

$jSon['total'] = $read->getRowCount();
$jSon['result'] = array();
$i = 0;

$View = new View();
$tpl_produto = $View->Load('produto_admin');

foreach ($read->getResult() as $produto):
    extract($produto);

    $readVendas->ExeRead(VENDAS, "WHERE venda_produto = :id AND venda_transacao IS NOT NULL AND venda_status = 3", "id={$produto_id}");

    $produto['produto_desconto'] = (!empty($produto['produto_desconto']) ? '<div class="bg-red posts-item-off">' . $produto['produto_desconto'] * 100 . ' % OFF</div>' : '');
    $produto['produto_valor'] = number_format($produto['produto_valor'], 2, ',', '.');
    if (!empty($produto['produto_desconto'])):
        $produto['produto_valor_descontado'] = number_format($produto['produto_valor_descontado'], 2, ',', '.');
    endif;
    $produto['produto_desconto_ativo'] = (!empty($produto['produto_desconto']) ? '<small class="valor_anterior"> De: <del>R$ ' . $produto['produto_valor'] . '</del> o m<sup>2</sup></small><h1 class="valor_atual"> Por: <span class="valor_atual_digitos">R$ ' . $produto['produto_valor_descontado'] . '</span> o m<sup>2</sup></h1>' : '<h1 class="valor_atual"><span class="valor_atual_digitos">R$ ' . $produto['produto_valor'] . '</span> o m<sup>2</sup></h1><div class="container m-top2"></div>');
    $produto['imagem_produto'] = HOME . DIRECTORY_SEPARATOR . 'uploads';
    $produto['HOME'] = HOME;
    $produto['vendas'] = (!empty($readVendas->getResult()) ? sprintf("%05d", intval($readVendas->getRowCount())) : sprintf("%05d", 0));
    $produto['views'] = (isset($produto_views) ? sprintf("%05d", intval($produto_views)) : sprintf("%05d", 0));
    $produto['botao_status'] = ($produto_status == '1' ? '<a title="Publicado" attr-status="mudar_status_produto" class="btn btn-green radius posts-item-status-post j_publicado shorticon shorticon-publicado"></a>' : '<a title="Pendente" attr-status="mudar_status_produto" class="btn btn-yellow radius posts-item-status-post j_pendente shorticon shorticon-pendente"></a>');
    $produto['botao_disponivel'] = ($produto_disponivel == '1' ? '<a title="Disponivel" attr-disponibilidade="mudar_disponibilidade_produto" class="btn btn-green radius produtos-item-disponibilidade j_disponivel shorticon shorticon-disponivel"></a>' : '<a title="Indisponível" attr-disponibilidade="mudar_disponibilidade_produto" class="btn btn-orange radius produtos-item-disponibilidade j_indisponivel shorticon shorticon-indisponivel"></a>');

    $readCategoria = new Read;
    $readCategoria->ExeRead(CATEGORIAS, "WHERE category_id = :id", "id={$produto_categoria
            }");

    $produto['categoria_data'] = ($readCategoria->getResult() ? "<p class=\"posts-item-categoria\"> >> {$readCategoria->getResult()[0]['category_title']
            }" : "") . " - " . date('d/m/Y - H:i', strtotime($produto_data)) . "</p>";
    $jSon['result'] += [$i => $View->returnView($produto, $tpl_produto)];

    $i++;
endforeach;
