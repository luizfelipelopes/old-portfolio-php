<?php
session_start();
require '../_app/Config.inc.php';

// SE A SESSÂO NÂO TIVER SIDO ATRIBUÍDA COM UM ARRAY 
//if (!isset($_SESSION['carrinho'])):
//    session_start();
//    $_SESSION['carrinho'] = array();
//endif;
//$produtoid = filter_input(INPUT_GET, 'produtoid', FILTER_VALIDATE_INT);
//$action = filter_input(INPUT_GET, 'action', FILTER_DEFAULT);
//$name = filter_input(INPUT_GET, 'name', FILTER_DEFAULT);
//$prodqnt = filter_input(INPUT_GET, 'prodqnt', FILTER_VALIDATE_INT);
//var_dump($produtoid);
//var_dump($action);
//var_dump($name);
//var_dump($prodqnt);
?>

<?php
$PrecoTotal = number_format(floatval(0), 2, ',', '');
$PrecoTotal = floatval($PrecoTotal);



//$carregar_itens = filter_input_array(INPUT_POST, 'load_cart_items', FILTER_DEFAULT);

var_dump($_POST['load_cart_items'], $_SESSION['carrinho']);

if (isset($_POST['load_cart_items']) && $_POST['load_cart_items'] == true):


    if (!count($_SESSION['carrinho']) > 0):
        if (empty($action)):
            echo 'Você ainda não adicionou nenhum produto ao seu carrinho';
//                WSErro("Você ainda não adicionou nenhum produto ao seu carrinho", WS_INFOR);
        endif;

    else:
        ?>    

        <table class="produtos">


            <tr>
                <th></th>
                <th>
                    Produto
                </th>
                <th>Preço
                </th>
                <th class="quantidade_carrinho_titulo">
                    <p> Quantidade (por m<sup>2</sup>)</p>
                </th>
                <th>
                    Total</th>
            </tr>


           
            
        <?php
        
        
        var_dump($_SESSION['carrinho']['indice']['info_produto']); 
        
        $ids = null;
        foreach ($_SESSION['carrinho'] as $id => $Value):
            $ids = $ids . $id . ',';
        endforeach;

        $ids = rtrim($ids, ',');
        $ids = explode(',', $ids);
        var_dump($ids);
        $read = new Read();

        

        for ($i = 0; $i < count($ids); $i++):

            $read->ExeRead("cardi_produtos", "WHERE produto_id = :ids ORDER BY produto_name", "ids={$ids[$i]}");
            if ($read->getResult()):
                foreach ($read->getResult() as $cart):
                    extract($cart);
                    ?>

                        <tr>
                            <td>

                                <a href="<?= HOME; ?>Carrinho&action=excluir&name=<?= $produto_name; ?>&produtoid=<?= $produto_id; ?>" title="Excluir tapete do carrinho">
                                    <img class="excluir" alt="Excluir tapete do carrinho" title="Excluir tapete do carrinho" src="<?= REQUIRE_PATH; ?>/images/excluir.jpg" />
                                </a>
                                <img class="tapete_carrinho" alt="Tapete adicionado ao carrinho" title="Tapete adicionado ao carrinho" src="<?= HOME . DIRECTORY_SEPARATOR ?>uploads/<?= $produto_image; ?>" />

                            </td>
                            <td class="produto_carrinho"><?= $produto_title; ?></td>
                            <td class="preco_carrinho">R$ <?= number_format($produto_valor, '2', ',', ''); ?></td>
                            <td class='itemInCartDisplay'>
                                <a href='#' class='subtruct_itm_qty quantity_change' item_id="<?php $_SESSION['carrinho'][$ids[$i]]; ?>">-</a>  
                    <?php echo "<span class='quantity'>" . $_SESSION['carrinho'][$ids[$i]]['produto_quantidade'] . "</span>"; ?>    
                                <a href='#' class='add_itm_qty quantity_change' item_id="<?php $_SESSION['carrinho'][$ids[$i]]; ?>">+</a>        
                            </td>
                            <td class="preco_carrinho">R$ <?= number_format(floatval($_SESSION['carrinho'][$ids[$i]]['produto_quantidade'] * $produto_valor), 2, ',', ''); ?></td>

                        </tr>
                    <?php
                endforeach;
                $PrecoTotal += floatval($_SESSION['carrinho'][$ids[$i]]['produto_quantidade'] * $produto_valor);
            endif;
        endfor;
    endif;

    echo '</table>';
endif;
$_SESSION['carrinho']['preco_total'] = $PrecoTotal;
?>    




<div class="confirmar_compra">

    <h1 class="titulo_total_carrinho">Total no carrinho</h1>	
    <table class="total">

        <tr>
            <td class="titulo_subtotal">Subtotal</td>
            <td class="preco_subtotal">R$ <?= number_format((float) $PrecoTotal, 2, ",", ""); ?></td>
        </tr>	

        <tr>
            <td class="titulo_total">Total</td>
            <td class="preco_total">R$ <?= number_format((float) $PrecoTotal, 2, ",", ""); ?></td>
        </tr>	

    </table>

    <a href="redirect_pagseguro.php">
        <div class="btn_confirmar_compra">

            <script type="text/javascript"
                    src="https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js">
            </script>	

            <div class="txt_confirmar_compra">
                Finalizar Compra
            </div>
            <img alt="" title="" src="<?= REQUIRE_PATH; ?>/images/seta_botao_confirmar.png" />
        </div>
    </a>


</div>
