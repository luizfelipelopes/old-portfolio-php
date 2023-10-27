<?php

header("Access-Control-Allow-Origin: *");

date_default_timezone_set("America/Sao_Paulo");
require '../../_app/Config.inc.php';
require '../../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
spl_autoload_register('carregarClasses');

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (!empty($getPost['parcela'])):
    $Parcela = $getPost['parcela'];
    unset($getPost['parcela']);
endif;

$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);
$jSon = array();


if (!empty($_SESSION['theme'])):
    session_start();
endif;


if (!isset($_SESSION['preco_total']) || empty($_SESSION['preco_total'])):
    $_SESSION['preco_total'] = 0;
//    echo "PRECO TOTAL INICIADO";
endif;

if (isset($Post['action'])):
    $Action = $Post['action'];
    unset($Post['action']);
else:
    $Action = null;
endif;


switch ($Action):

    /**
     * ===================================================================================
     * ===================================PAGSEGURO=============================================
     * ===================================================================================
     */
    case 'iniciarPagamento': // inicia sessão de pagamento
        $checkout = new CheckoutTransparente();
        $checkout->gerarSession();
        $xml = $checkout->getResult();
        $idSessao = $xml->id;
        $jSon['idSessao'] = $idSessao;
        break;

    case 'efetuarPagamentoBoleto': // efetua pagamento via boleto bancário

        $jSon['naolimpar'] = true;

        $checkout = new CheckoutTransparente($Post);
        $checkout->inciarPagementoBoleto();
        $xml = $checkout->getResult();

        $boletoLink = $xml->paymentLink;
        $code = $xml->code;
        $date = $xml->date;

        //aqui eu ja trato o xml e pego o dado que eu quero, vc pode dar um var_dump no $xml e ver qual dado quer

        $retornoBoleto = array(
            'paymentLink' => $boletoLink,
            'date' => $date,
            'code' => $code
        );

        $jSon['retornoBoleto'] = $retornoBoleto;
        $jSon['xml'] = $xml;

        break;


    case 'carregar_parcelas': // carrega as parcelas no select de parcelamento de acordo com a bandeira do cartão

        $jSon['result'] = '<option selected>Selecione</option>';

        foreach ($Parcela as $key => $value):

            $jSon['result'] .= '<option value="' . ($key + 1) . '">' . $value['quantity'] . ' X de R$ ' . number_format($value['installmentAmount'], 2, ',', '.') . ' ' . ($value['interestFree'] != 'false' ? '(sem juros) ' : '') . '= R$ ' . number_format($value['totalAmount'], 2, ',', '.') . '</option>';

        endforeach;

        break;

    case 'efetuarPagamentoCartao': // efetua o pagamento via cartão de crédito

        $jSon['naolimpar'] = true;

        if (!empty($Post['carrinho_valor_parcela_cartao'])):



            $checkout = new CheckoutTransparente($Post);
            $checkout->inciarPagementoCartao();
            $xml = $checkout->getResult();

            //echo $xml -> paymentLink;
            $code = $xml->code;
            $date = $xml->date;

            //aqui eu ja trato o xml e pego o dado que eu quero, vc pode dar um var_dump no $xml e ver qual dado quer

            $retornoCartao = array(
                'code' => $code,
                'date' => $date
            );

            $jSon['retornoCartao'] = $retornoCartao;
            $jSon['xml'] = $xml;

        else:

            $jSon['error'] = ['Selecione o número de parcelas!', WS_ALERT];

        endif;

        break;

    default:
        $jSon['error'] = 'Erro ao Escolher ação!';
        break;


endswitch;

echo json_encode($jSon);





