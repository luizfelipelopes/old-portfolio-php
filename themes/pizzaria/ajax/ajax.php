<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);
$jSon = array();

if (isset($Post['action'])):
    $Action = $Post['action'];
    unset($Post['action']);
    require '../../../_app/Config.inc.php';
    spl_autoload_register('carregarClasses');
    // if(!isset($_SESSION)):
        session_start();
    // endif;
    $Filtro = new Filtros($_SESSION['estoque']);
else:
    $Action = null;
endif;

switch ($Action):

    /**
     * FILTRAR PRODUTOS POR CATEGORIA 
     */
    case 'filtrar_produtos':

        $ProdutosTipo = null;
        if (!empty($_SESSION['filtro']['tipo'])):
            $ProdutosTipo = $Filtro->filtrarTipo($_SESSION['filtro']['tipo']);
        endif;

        $ArrayProdutos = (!empty($ProdutosTipo) ? $ProdutosTipo : $_SESSION['estoque']);

        $html = $Filtro->filtrarCategoria($ArrayProdutos, $Post['categoria']);
        
//        var_dump($html);
//        die;

        $jSon['produtos'] = $html;
        $jSon['inteira'] = $_SESSION['pizza_inteira'];

        break;

    /**
     * FILTRAR PRODUTOS POR TAMANHO 
     */
    case 'filtrar_tamanho':

        $_SESSION['filtro']['tamanho'] = $Post['tamanho'];

        $Tamanho = ($Post['tamanho'] == 'grande' ? 'produto_valor_grande' : ($Post['tamanho'] == 'media' ? 'produto_valor_media' : ''));

        $jSon['tamanho'] = $Tamanho;
        $jSon['produtos'] = $Filtro->filtrarTamanho($_SESSION['estoque'], $Tamanho);

        break;

    /**
     * FILTRAR PRODUTOS POR ORDEM ALFABÉTICA OU PREÇO 
     */
    case 'filtrar_ordem_preco':

        $_SESSION['filtro']['tipo'] = $Post['tipo'];

        $Categoria = (!empty($_SESSION['filtro']['categoria']) ? $_SESSION['filtro']['categoria'] : null);

        $ProdutosTipo = $Filtro->filtrarTipo($Post['tipo']);
        $html = $Filtro->filtrarCategoria($ProdutosTipo, $Categoria);

        $jSon['produtos'] = $html;
        $jSon['inteira'] = (!empty($_SESSION['pizza_inteira']) ? $_SESSION['pizza_inteira'] : null);

        break;

    /**
     * FILTRAR PRODUTOS POR PESQUISA 
     */
    case 'filtrar_pesquisa':

        $_SESSION['filtro']['pesquisa'] = $Post['pesquisa'];

        $jSon['produtos'] = $Filtro->filtrarPesquisa($_SESSION['estoque'], $Post['pesquisa']);
        $jSon['inteira'] = $_SESSION['pizza_inteira'];

        break;


    case 'escolher_sabor':


        $jSon['cardapio'] = $Filtro->codeIngredientes($_SESSION['estoque'], $Post['id'], $Post['imagem'], $Post['sabor'], $Post['valor'], 'inteira');

        $_SESSION['total_montado'] = $Post['valor'];

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        break;

    case 'escolher_sabor1':

        $jSon['cardapio'] = $Filtro->codeIngredientes($_SESSION['estoque'], $Post['id'], $Post['imagem'], $Post['sabor'], $Post['valor1'], 'metade1');

        $_SESSION['total_montado'] = (!empty($Post['valor2']) && $Post['valor1'] < $Post['valor2'] ? $Post['valor2'] : $Post['valor1']);

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        break;

    case 'escolher_sabor2':

        $jSon['cardapio'] = $Filtro->codeIngredientes($_SESSION['estoque'], $Post['id'], $Post['imagem'], $Post['sabor'], $Post['valor2'], 'metade2');

        $_SESSION['total_montado'] = (!empty($Post['valor1']) && $Post['valor2'] < $Post['valor1'] ? $Post['valor1'] : $Post['valor2']);

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        break;

    case 'adicionar_ingredientes':

//        var_dump($Post['quantidade']);
//        die;

        $_SESSION['total_montado'] += $Post['acrescimo'];
        $_SESSION['acrescimo'] += $Post['acrescimo'];


        if ($_SESSION['pizza_inteira']):

            $_SESSION['ingredientes']['pizza_inteira'][] = [
                "pizza_id" => $Post['id_pizza'],
                "ingrediente_id" => $Post['acrescimo_id'],
                "ingrediente_quantidade" => $Post['quantidade']
            ];

            var_dump($_SESSION['ingredientes']['pizza_inteira']);

        endif;

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        break;

    case 'retirar_ingredientes':

        $_SESSION['total_montado'] -= $Post['acrescimo'];

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

//        var_dump($_SESSION['total_montado']);

        break;


    case 'retirar_valor':

        $_SESSION['total_montado'] = 0;

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        break;


    case 'retirar_valor_metade1':


        $_SESSION['total_montado'] = (!empty($Post['valor2']) ? $Post['valor2'] : 0);

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');


        break;

    case 'retirar_valor_metade2':

        $_SESSION['total_montado'] = (!empty($Post['valor1']) ? $Post['valor1'] : 0);

        $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        break;

    case 'cancelar_item':

        if (!empty($_SESSION['total_montado'])):

            $_SESSION['total_montado'] = 0;
            $jSon['valor'] = number_format($_SESSION['total_montado'], 2, ',', '.');

        endif;

        break;


    case 'adicionar_carrinho':

        // Parei em Ingredientes    
        $Quantidade = 0;
        $Existe = false;

        if (!empty($Post['id_inteiro'])): // SE É PIZZA INTEIRA

            foreach ($_SESSION['carrinho']['pizza_inteira'] as $Key => $Value):

                if ($Post['id_inteiro'] == $Value['id'] && $_SESSION['filtro']['tamanho'] == $Value['tamanho']):
                    $_SESSION['carrinho']['pizza_inteira'][$Key]['quantidade'] += 1;
                    $_SESSION['carrinho']['pizza_inteira'][$Key]['valor'] = (($_SESSION['filtro']['tamanho'] == 'grande' ? $_SESSION['estoque'][$Post['id_inteiro']]['produto_valor_grande'] : $_SESSION['estoque'][$Post['id_inteiro']]['produto_valor_media']) * $_SESSION['carrinho']['pizza_inteira'][$Key]['quantidade']) + (isset($_SESSION['acrescimo']) ? $_SESSION['acrescimo'] : 0);
                    $Existe = true;
                endif;

            endforeach;

            if (!$Existe):

                $_SESSION['carrinho']['pizza_inteira'][] = [
                    "id" => $Post['id_inteiro'],
                    "name" => $_SESSION['estoque'][$Post['id_inteiro']]['produto_title'] . ' (' . ucfirst($_SESSION['filtro']['tamanho']) . ')',
                    "tamanho" => $_SESSION['filtro']['tamanho'],
                    "valor" => ($_SESSION['filtro']['tamanho'] == 'grande' ? $_SESSION['estoque'][$Post['id_inteiro']]['produto_valor_grande'] : $_SESSION['estoque'][$Post['id_inteiro']]['produto_valor_media']) + (isset($_SESSION['acrescimo']) ? $_SESSION['acrescimo'] : 0),
                    "quantidade" => 1,
                    "ingredientes" => $_SESSION['estoque'][$Post['id_inteiro']]['produto_ingredientes']
                ];

//                var_dump($_SESSION['carrinho']['pizza_inteira']);

            endif;



//            $_SESSION['carrinho']['pedido'][] = $_SESSION['carrinho']['inteira'];

        elseif (!empty($Post['id_sabor1']) && !empty($Post['id_sabor2'])): // SE É PIZZA METADE

            foreach ($_SESSION['carrinho']['pizza_metade'] as $Key => $Value):

                if (($Post['id_sabor1'] == $Value['id_metade1']) && ($Post['id_sabor2'] == $Value['id_metade2']) && ($_SESSION['filtro']['tamanho'] == $Value['tamanho'])):
                    $_SESSION['carrinho']['pizza_metade'][$Key]['quantidade'] += 1;
                    $_SESSION['carrinho']['pizza_metade'][$Key]['valor'] = ($_SESSION['filtro']['tamanho'] == 'grande' ? ($_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_grande'] > $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_grande'] ? $_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_grande'] : $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_grande']) : ($_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_media'] > $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_media'] ? $_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_media'] : $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_media'])) * $_SESSION['carrinho']['pizza_metade'][$Key]['quantidade'];
                    $Existe = true;
                endif;

            endforeach;


            if (!$Existe):

                $_SESSION['carrinho']['pizza_metade'][] = [
                    "id_metade1" => $Post['id_sabor1'],
                    "id_metade2" => $Post['id_sabor2'],
                    "name_metade" => $_SESSION['estoque'][$Post['id_sabor1']]['produto_title'] . ' + ' . $_SESSION['estoque'][$Post['id_sabor2']]['produto_title'] . ' (' . ucfirst($_SESSION['filtro']['tamanho']) . ')',
                    "tamanho" => $_SESSION['filtro']['tamanho'],
                    "valor" => ($_SESSION['filtro']['tamanho'] == 'grande' ? ($_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_grande'] > $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_grande'] ? $_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_grande'] : $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_grande']) : ($_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_media'] > $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_media'] ? $_SESSION['estoque'][$Post['id_sabor2']]['produto_valor_media'] : $_SESSION['estoque'][$Post['id_sabor1']]['produto_valor_media'])),
                    "quantidade" => 1
                ];

            endif;
//            $_SESSION['carrinho']['pedido'][] = $_SESSION['carrinho']['metade'];
        endif;

//        var_dump($_SESSION['carrinho']);

        break;


    case 'setar_secao_inteira':

        $_SESSION['pizza_inteira'] = true;
        $_SESSION['pizza_metade'] = false;

        break;

    case 'setar_secao_metade':

        $_SESSION['pizza_inteira'] = false;
        $_SESSION['pizza_metade'] = true;

        break;


    default:
        break;

endswitch;

echo json_encode($jSon);
