<?php

require '../../../_app/Config.inc.php';
spl_autoload_register('carregarClasses');

session_start(); // INICIA SESSÃO
// SE NÃO EXISTIR SESSÃO E ESTIVER VAZIO
if (!isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):
    $_SESSION['preco_total'] = 0;
//    echo "SESSAO INICIADA";
endif;

if (!isset($_SESSION['preco_total']) || empty($_SESSION['preco_total'])):
    $_SESSION['preco_total'] = 0;
//    echo "PRECO TOTAL INICIADO";
endif;

if (empty($_SESSION['carrinho'])):
//    $_SESSION['carrinho'] = 0;
endif;



$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);
//$carrinho = filter_input(INPUT_GET, 'carrinho', FILTER_DEFAULT);

$Action = $Post['action'];
$jSon = array();
unset($Post['action']);




//sleep(1);



if ($Action):
    require '../_models/LoginCliente.class.php';
    require '../_models/AdminCliente.php';
    require '../../../flowstate_admin/_models/adminComentario.class.php';
    require '../../../_app/Models/Email.class.php';

//    require '../../../_app/Config.inc.php';
//    $read = new Read();
//    $update = new Update();
//    $create = new Create();
//    $delete = new Delete();
endif;


switch ($Action):

    case 'iniciarPixelCheckout':

        if (isset($_SESSION['carrinho']) && !empty($_SESSION['carrinho'])):

            if (isset($_SESSION['clientelogin']) && !empty($_SESSION['clientelogin'])):

                $jSon['caminho'] = HOME . "Carrinho&action=salvar";
//                header("Location: " . HOME . 'Carrinho#carrinho');
            else:
                $jSon['caminho'] = HOME . "Entrar&carrinho=true#entrar";
//                header("Location: " . HOME);
            endif;
        endif;

        break;


    case 'adicionarCarrinho':

        $produto = new Carrinho();
        $produto->setId((int) $Post['produto_id']);
        $produto->adicionar();
        $_SESSION['preco_total'] += $Post['valor_produto'];

        $jSon['result'] = 'R$ ' . number_format($_SESSION['preco_total'], 2, ",", ".");
        $jSon['success'] = "Valor adicionado com sucesso!";
        break;


    case 'capturardetalhes':

        if (array_key_exists($Post['detalhes_id'], $_SESSION['carrinho'])):
            $_SESSION['carrinho'][$Post['detalhes_id']] += $Post['detalhes_quantidade'];
        else:
            $_SESSION['carrinho'][$Post['detalhes_id']] = $Post['detalhes_quantidade'];
        endif;

        $_SESSION['preco_total'] += $Post['detalhes_quantidade'] * $Post['detalhes_valor'];

        $jSon['carrinho'] = $_SESSION['carrinho'];
        $jSon['detalhes_quantidade'] = $Post['detalhes_quantidade'];
        $jSon['result'] = 'R$ ' . number_format($_SESSION['preco_total'], 2, ",", ".");
        $json['success'] = "Id e Quantidade capturados com sucesso!";
        break;


    // SE AÇÃO FOR PARA EXCLUIR PRODUTO
    case 'excluir':
        $adminCarrinho = new Carrinho(); // INSTANCIA A CLASSE CARRINHO
        $adminCarrinho->setId($Post['produto_id']); // SETO O ID DO PRODUTO A SER EXCLUÍDO


        $adminCarrinho->excluirPedido(); // EXCLUI PEDIDO


        $_SESSION['preco_total'] = 0; // ZERA O PRECO TOTAL PARA SER RECALCULADO


        $read = new Read();

        // RECALCULA O PRECO TOTAL PERCORRENDO TODOS OS PRODUTOS DO CARRINHO
        foreach ($_SESSION['carrinho'] as $prod => $qnt) :

            $read->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$prod}");
            if ($read->getResult()):
                $_SESSION['preco_total'] += $read->getResult()[0]['produto_valor'] * $qnt;
            endif;

        endforeach;

        // CASO SESSÃO CARRINHO ESTEJA VAZIA (OU SEJA, SE TODOS OS PRODUTOS TIVEREM SIDO EXCLUIDOS)
        if (empty($_SESSION["carrinho"])):
            // PREÇO TOTAL NA SESSÃO RECEBE NULL PARA ZERAR O VALOR TOTAL DO CARRINHO
            $_SESSION["preco_total"] = null;
            $jSon['vazio'] = "Sessão Vazia";
        endif;

        $jSon['result'] = 'R$ ' . number_format($_SESSION['preco_total'], 2, ",", ".");
        $jSon['result2'] = 'R$ ' . number_format($_SESSION['preco_total'] + $Post['frete'], 2, ",", ".");
        $jSon['success'] = "Tapete excluído do Carrinho com sucesso!";

        break;

    case 'alterarquantidade':

        $_SESSION['preco_total'] = 0;

        if (empty($Post['produto_quantidade'])):
            $Post['produto_quantidade'] = 1;
        endif;

        $_SESSION['carrinho'][$Post['produto_id']] = (int) $Post['produto_quantidade'];

        $read = new Read;

        foreach ($_SESSION['carrinho'] as $produto => $quantidade):

            $read->ExeRead(PRODUTOS, "WHERE produto_id = :id", "id={$produto}");
            if ($read->getResult()):
                $_SESSION['preco_total'] += (!empty($read->getResult()[0]['produto_desconto']) && $read->getResult()[0]['produto_desconto'] > 0 ? $read->getResult()[0]['produto_valor_descontado'] : $read->getResult()[0]['produto_valor']) * $quantidade;
            endif;

        endforeach;

        $jSon['carrinho'] = $_SESSION['carrinho'];

        $jSon['preco_total'] = $_SESSION['preco_total'];

        $jSon['result'] = 'R$ ' . number_format($Post['produto_preco'] * $Post['produto_quantidade'], 2, ",", ".");
        $jSon['result2'] = 'R$ ' . number_format($_SESSION['preco_total'], 2, ",", ".");
        $jSon['result3'] = 'R$ ' . number_format($_SESSION['preco_total'] + $Post['frete'], 2, ",", ".");
        $jSon['result_bruto'] = $_SESSION['preco_total'];
        $jSon['result_descontado_bruto'] = $_SESSION['preco_total'] - ($_SESSION['preco_total'] * 0.1);
        if (isset($_SESSION['cupom'])):
            $jSon['result_cupom_bruto'] = $_SESSION['preco_total'] - ($_SESSION['preco_total'] * $_SESSION['cupom']['desconto']);
            $jSon['result_cupom_formatado'] = 'R$ ' . number_format($jSon['result_cupom_bruto'], 2, ',', '.');
            $jSon['result_cupom_formatado_frete'] = 'R$ ' . number_format($jSon['result_cupom_bruto'] + $Post['frete'], 2, ',', '.');
        endif;

        $jSon['result_descontado_formatado'] = 'R$ ' . number_format($jSon['result_descontado_bruto'], 2, ',', '.');
        $jSon['result_descontado_formatado_frete'] = 'R$ ' . number_format($jSon['result_descontado_bruto'] + $Post['frete'], 2, ',', '.');

        if (!empty($jSon['result_cupom_bruto'])):
            $jSon['result_somatorio'] = $_SESSION['preco_total'] - (($_SESSION['preco_total'] * 0.1) + ($_SESSION['preco_total'] * $_SESSION['cupom']['desconto']));
            $jSon['result_somatorio_formatado'] = 'R$ ' . number_format($jSon['result_somatorio'], 2, ',', '.');
            $jSon['result_somatorio_formatado_frete'] = 'R$ ' . number_format($jSon['result_somatorio'] + $Post['frete'], 2, ',', '.');
        endif;

        $jSon['success'] = 'quantidade alterada com sucesso';

        break;

    case 'descontar_cupom':

//        var_dump($Post);
//        unset($_SESSION['clientelogin']['cupom']);
//        var_dump($_SESSION['clientelogin']['cupom']);

        if (!isset($_SESSION['cupom'])):

            $readCupom = new Read;
            $readCupom->ExeRead(CUPONS, "WHERE cupom_codigo = :codigo AND cupom_status = 1 AND cupom_validade >= :validade", "codigo={$Post['codigo_cupom']}&validade=" . date("Y-m-d H:i:s") . "");
            if (!$readCupom->getResult()):
                $jSon['error'] = "Opps! Não há cupons com este código ou a p/romoção já se encerrou";
            else:
                $_SESSION['cupom']['desconto'] = $readCupom->getResult()[0]['cupom_desconto'];
                $_SESSION['cupom']['codigo'] = $readCupom->getResult()[0]['cupom_codigo'];


                if ($_SESSION['preco_total'] > 20000):
                    $jSon['desconto_cupom'] = $_SESSION['preco_total'] - ($_SESSION['preco_total'] * (0.1 + $readCupom->getResult()[0]['cupom_desconto']));
                else:
                    $jSon['desconto_cupom'] = $_SESSION['preco_total'] - ($_SESSION['preco_total'] * $readCupom->getResult()[0]['cupom_desconto']);
                endif;

                $jSon['desconto_cupom_formatado'] = 'R$ ' . number_format($jSon['desconto_cupom'], 2, ",", ".");
                $jSon['desconto_cupom_formatado_frete'] = 'R$ ' . number_format($jSon['desconto_cupom'] + $Post['frete'], 2, ",", ".");
            endif;



        else:
            $jSon['error'] = "Opps! Você já inseriu um cupom promocional";

        endif;






        break;

    case 'entrar':

        $carrinho = null;
        if (isset($Post['carrinho'])):
            $carrinho = $Post['carrinho'];
            unset($Post['carrinho']);
        endif;
//        var_dump($carrinho);


        $login = new LoginCliente();

        if ($login->CheckLogin()):
            $jSon['caminho'] = HOME;
        endif;

        $login->ExeLogin($Post);

        if (!$login->getResult()):
            $jSon['error'] = $login->getError();
            $jSon['id'] = 'id';
        else:

            if (isset($carrinho) && $carrinho == 'true'):
                $jSon['caminho'] = HOME . "Carrinho&action=salvar";
//                header("Location: " . HOME . 'Carrinho#carrinho');
            else:
                $jSon['caminho'] = HOME;
//                header("Location: " . HOME);
            endif;


        endif;

        break;


    case 'cadastrar':

        $carrinho = null;
        if (isset($Post['carrinho'])):
            $carrinho = $Post['carrinho'];
            unset($Post['carrinho']);
        endif;
//        var_dump($carrinho);

        $adminCliente = new AdminCliente;
        $adminCliente->ExeCreate($Post);


        if ($adminCliente->getResult()):


            $readEmail = new Read;
            $readEmail->ExeRead(EMAILS, "WHERE email_type = :type", "type=pos-cadastro");


            $Post['Assunto'] = $readEmail->getResult()[0]['email_title'];
            $Post['DestinoNome'] = "{$Post['cliente_name']}";
            $Post['DestinoEmail'] = "{$Post['cliente_email']}";
            $Post['Mensagem'] = $readEmail->getResult()[0]['email_saudacao'] . ' ' .
                    $Post['cliente_name'] . ",<br>" . $readEmail->getResult()[0]['email_content'] .
                    "e-mail: {$Post['cliente_email']}" . "<br> senha: {$Post['cliente_senha']}" . "<br>" .
                    $readEmail->getResult()[0]['email_assinatura'];

            $email = new Email();
            $email->Enviar($Post);
//                            if ($email->getError()):
//                                WSErro($email->getError()[0], $email->getError()[1]);
//                            endif;

            $Acesso = [
                "cliente_email" => $Post['cliente_email'],
                "cliente_senha" => $Post['cliente_senha']
            ];

            $login = new LoginCliente();
            $login->ExeLogin($Acesso);

            $Post = null;


            if (!$login->getResult()):
                $jSon['error'] = [$login->getError()[0], $login->getError()[1]];

//                unset($_SESSION['carrinho']);
            else:
                $jSon['logado'] = true;
                if (isset($carrinho) && $carrinho == 'true'):
                    $jSon['caminho'] = HOME . "Carrinho&action=salvar";
//                header("Location: " . HOME . 'Carrinho#carrinho');
                else:
                    $jSon['caminho'] = HOME . "&cadastro=true";
//                header("Location: " . HOME);
                endif;
            endif;


        else:
            $jSon['id'] = 'id'; // Para não limpar form
        endif;

//        $jSon['error'] = "Testando";
        $jSon['error'] = [$adminCliente->getError()[0], $adminCliente->getError()[1]];
        break;

    case 'create_comentario':

//        unset($Post['modulo_id']);
//        $Post['post_cover'] = ($_FILES['post_cover']['tmp_name'] ? $_FILES['post_cover'] : null);

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

//        var_dump($meuArray);

        $adminComentario = new adminComentario;
        $adminComentario->ExeCreate($meuArray);
//        var_dump($adminComentario);


        $jSon['error'] = $adminComentario->getError();

//        var_dump($meuArray);

        break;



    default :
        $jSon['error'] = "Erro ao selecionar ação!";
endswitch;

echo json_encode($jSon);

