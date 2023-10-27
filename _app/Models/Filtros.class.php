<?php

/**
 * Filtros.class [ TIPO ]
 * Classe Responsável pelos Filtros dos Produtos da Pizzaria
 * @copyright (c) 2017, Luiz Felipe C. Lopes [FLOWSTATE]
 */
class Filtros {

    private $Produtos;
    private $Error;
    private $Result;

    public function __construct($Produtos) {
        $this->Produtos = $Produtos;
    }

    public function filtrarCategoria(array $ProdutosTipo, $Categoria) {

        $_SESSION['filtro']['categoria'] = (!empty($Categoria) ? $Categoria : $_SESSION['filtro']['categoria']);

        $Array = array();
        $html = '';
        $i = 1;

        foreach ($ProdutosTipo as $Produto):

            if ($Categoria !== 'todos' && $Produto['produto_category'] == $Categoria && $Produto['produto_parent_category'] == 'pizza'):

                $Array += [$i => $Produto];

                $html .= $this->codePizza($i, $Produto['produto_id'], $Produto['produto_title'], $Produto['produto_valor_grande'], $Produto['produto_valor_media'], $Produto['produto_cover']);

                $i++;

            elseif (($Categoria == 'todos' && $Produto['produto_parent_category'] == 'pizza') || !isset($Categoria)):

                $Array += [$i => $Produto];

                $html .= $this->codePizza($i, $Produto['produto_id'], $Produto['produto_title'], $Produto['produto_valor_grande'], $Produto['produto_valor_media'], $Produto['produto_cover']);

                $i++;

            endif;

        endforeach;

        return $html;
    }

    public function filtrarTipo($Tipo) {

        $sortArray = array();

        foreach ($this->Produtos as $Key => $Value):

            if ($Value['produto_parent_category'] != 'pizza'):
                unset($this->Produtos[$Key]);

            else:

                foreach ($this->Produtos[$Key] as $Key => $Value):

                    if (!isset($sortArray[$Key])):

                        $sortArray[$Key] = array();

                    endif;

                    $sortArray[$Key][] = $Value;

                endforeach;

            endif;

        endforeach;

        $ValorTamanho = (!empty($_SESSION['filtro']['tamanho']) && $_SESSION['filtro']['tamanho'] == 'media' ? 'produto_valor_media' : 'produto_valor_grande');
        $orderBy = ($Tipo == 'ordem_alfabetica' ? 'produto_title' : ($Tipo == 'ordem_preco' ? $ValorTamanho : ''));

        array_multisort($sortArray[$orderBy], SORT_ASC, $this->Produtos);

        return $this->Produtos;
    }

    public function filtrarTamanho(array $Produtos, $Tamanho) {

        $Array = array();
        $i = 1;

        foreach ($Produtos as $Produto):

            if ($Produto['produto_parent_category'] == 'pizza'):

                if (!empty($_SESSION['filtro']['categoria']) && $_SESSION['filtro']['categoria'] == $Produto['produto_category']):

                    $Array += [$Produto['produto_id'] => number_format($Produto[$Tamanho], 2, ',', '.')];
                    $i++;

                elseif (!isset($_SESSION['filtro']['categoria']) || (!empty($_SESSION['filtro']['categoria']) && $_SESSION['filtro']['categoria'] == 'todos')):

                    $Array += [$Produto['produto_id'] => number_format($Produto[$Tamanho], 2, ',', '.')];
                    $i++;

                endif;
            endif;

        endforeach;

        return $Array;
    }

    public function filtrarPesquisa(array $Produtos, $Pesquisa) {

        $Array = array();
        $i = 1;
        $html = '';

        foreach ($Produtos as $Produto):

            if (!empty($Pesquisa) && strpos(strtolower($Produto['produto_title']), strtolower($Pesquisa)) !== false):
                $Array += [$i => $Produto];

                $html .= $this->codePizza($i, $Produto['produto_id'], $Produto['produto_title'], $Produto['produto_valor_grande'], $Produto['produto_valor_media'], $Produto['produto_cover']);

                $i++;

            elseif (empty($Pesquisa) || $Pesquisa == ''):

                if ($Produto['produto_parent_category'] == 'pizza'):

                    $Array += [$i => $Produto];

                    $html .= $this->codePizza($i, $Produto['produto_id'], $Produto['produto_title'], $Produto['produto_valor_grande'], $Produto['produto_valor_media'], $Produto['produto_cover']);

                    $i++;

                endif;

            endif;

        endforeach;

        return $html;
    }

    public function codeIngredientes(array $Produtos, $Id, $Imagem, $Sabor, $Valor, $Modelo) {

        $html = '<div class = "cardapio_ingredientes ' . ($Modelo == 'metade1' ? 'js_cardapio_sabor1' : ($Modelo == 'metade2' ? 'js_cardapio_sabor2' : 'js_cardapio_sabor')) . ' " attr-imagem="' . $Imagem . '" attr-sabor="' . $Sabor . '" attr-valor="' . $Valor . '" id="' . $Id . '">';
        $html .= '<div class = "cardapio_sabor js_set_sabor1">' . $Sabor . '</div>';
        $html .= '<div class = "titulo_ingredientes">Ingredientes</div>';
        $html .= '<div class = "titulo_ingredientes_close">x</div>';
        $html .= '<div id="' . $Id . '" class = "cardapio_itens">';

        $i = 0;
        foreach ($Produtos[$Id]["produto_ingredientes"] as $Key => $Ingrediente):

            $html .= '<div class = "cardapio_item ' . ($i % 2 == 0 ? 'par' : '') . ' "><span class = "item">' . $Ingrediente['ingrediente_title'] . '</span> <span class = "acrescimo">+ R$ <span class = "valor_acrescimo" attr-id="' . $Key . '" attr-acrescimo="' . $Ingrediente['ingrediente_acrescimo'] . '">' . number_format($Ingrediente['ingrediente_acrescimo'], 2, ',', '.') . '</span></span> <span class = "quantidade">1</span> <span class = "mais">+</span> <span class = "menos">-</span> </div>';
            $i++;
        endforeach;

        $html .= '</div>';
        $html .= '</div >';

        return $html;
    }

    private function codePizza($i, $Id, $Title, $ValorGrande, $ValorMedia, $Cover) {

        $html = '';
        $html .= '<article class="container box box-small-3 js_produto_item">';
        $html .= '<div class="content">';
        $html .= '<div class="pizza">';
        $html .= '<div id="' . $i . '" class="selecao_pizza_inteira js_hover_inteiro" attr-id="' . $Id . '" attr-sabor="' . $Title . '" attr-valor="' . (!empty($_SESSION['filtro']['tamanho']) && $_SESSION['filtro']['tamanho'] == 'grande' ? $ValorGrande : $ValorMedia) . '" attr-imagem="' . INCLUDE_PATH . '/' . $Cover . '""></div>';
        $html .= '<div class="selecao_pizza_metades js_hover_metade">';
        $html .= '<div class="metade_1" id="' . $i . '" attr-sabor="' . $Title . '" attr-valor="' . (!empty($_SESSION['filtro']['tamanho']) && $_SESSION['filtro']['tamanho'] == 'grande' ? $ValorGrande : $ValorMedia) . '" attr-imagem="' . INCLUDE_PATH . '/' . $Cover . '"></div>';
        $html .= '<div class="metade_2" id="' . $i . '" attr-sabor="' . $Title . '" attr-valor="' . (!empty($_SESSION['filtro']['tamanho']) && $_SESSION['filtro']['tamanho'] == 'grande' ? $ValorGrande : $ValorMedia) . '" attr-imagem="' . INCLUDE_PATH . '/' . $Cover . '"></div>';
        $html .= '</div>';
        $html .= '<img src="' . INCLUDE_PATH . '/' . $Cover . '" title="' . $Title . '" alt="[' . $Title . ']">';
        $html .= '</div>';
        $html .= '<h1 class="nome">' . $Title . '</h1>';
        $html .= '<div class="js_valores">';
        $html .= '<span id="' . $Id . '" class="valor js_filtro_valor">R$ ' . number_format((!empty($_SESSION['filtro']['tamanho']) && $_SESSION['filtro']['tamanho'] == 'grande' ? $ValorGrande : $ValorMedia), 2, ',', '.') . '</span>';
        $html .= '</div>';
        $html .= '<div class="clear"></div>';
        $html .= '</div>';
        $html .= '</article>';

        return $html;
    }

}
