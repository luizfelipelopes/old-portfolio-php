<?php

header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Credentials: true");
//header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
//header('Access-Control-Request-Headers: x-requested-with');
//header('Access-Control-Max-Age: 1000');
//header('Access-Control-Allow-Headers: Accept,Authorization,Cache-Control,Content-Type,DNT,If-Modified-Since,Keep-Alive,Origin,User-Agent,X-Requested-With');
//header('Content-Type: application/json; charset=UTF-8');

date_default_timezone_set("America/Sao_Paulo");
require '../../_app/Config.inc.php';
require '../../_app/Config-Empresa.inc.php';
require '../../_app/Config-Mail.inc.php';
require '../../_app/Config-Post.inc.php';
require '../../_app/Config-Ecommerce.inc.php';
spl_autoload_register('carregarClasses');
//require '../_app/Library/PHPMailer/phpmailer.class.php';
//require '../_app/Library/PHPMailer/smtp.class.php';
//require '../' . ADMIN . '/_models/AdminCliente.php';
//require '../' . ADMIN . '/_models/LoginCliente.class.php';


$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
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
     * ===================================LOGIN/LOGOFF=============================================
     * ===================================================================================
     */
    case 'logar':

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $Login = new Login(1);

        $Login->ExeLogin($meuArray);

        if (!$Login->getResult()):

            $jSon['error'] = [$Login->getError()[0], $Login->getError()[1]];

        else:

            $jSon['caminho'] = HOME . ADMIN . '/dashboard.php';
        endif;

        var_dump($jSon['caminho']);

        break;

    case 'logoff':
        $_SESSION['clientelogin']['cliente_saida'] = date('Y-m-d H:i:s');

        $Horarios = [
            "cliente_entrada" => $_SESSION['clientelogin']['cliente_entrada'],
            "cliente_saida" => $_SESSION['clientelogin']['cliente_saida']
        ];

        $adminCliente = new AdminCliente;
        $adminCliente->ExeUpdate($_SESSION['clientelogin']['cliente_id'], $Horarios);
//        var_dump($adminCliente);
        unset($_SESSION['clientelogin']);

        $jSon['caminho'] = HOME . '/login&exe=logoff';
        break;

    /**
     * ===================================================================================
     * ===================================PESQUISAR=============================================
     * ===================================================================================
     */
    case 'pesquisar_termo':

        include './ajax_inc/ajax_pesquisar_termo.inc.php';

        break;

    /**
     * ===================================================================================
     * ===================================LEADS=============================================
     * ===================================================================================
     */
    case 'create_lead':

        include './ajax_inc/ajax_leads/ajax_create_lead.inc.php';

        break;

    /**
     * ===================================================================================
     * ===================================CONTATO=============================================
     * ===================================================================================
     */
    case 'receber_email_contato':

        include './ajax_inc/ajax_leads/ajax_receber_email_contato.inc.php';

        break;
    
    /**
     * ===================================================================================
     * ===================================RECEBER SUGESTÃO=============================================
     * ===================================================================================
     */
    case 'receber_sugestao':

        include './ajax_inc/ajax_leads/ajax_receber_sugestao.inc.php';

        break;

    /**
     * ===================================================================================
     * ===================================EAD=============================================
     * ===================================================================================
     */
    case 'comprar':

        $produto = new Carrinho();
        $produto->setId((int) $Post['produto_id']);
        $produto->adicionar();
        $_SESSION['preco_total'] += $Post['produto_valor'];

        if (isset($_SESSION['clientelogin'])):

            $jSon['logado'] = true;
            $jSon['caminho'] = HOME . '/curso&action=salvar';
        endif;

//            var_dump($_SESSION['carrinho']);

        break;

    case 'entrar':

        $login = new LoginCliente(1);

        if ($login->CheckLogin()):
            $jSon['logado'] = true;
        endif;

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $login->ExeLogin($meuArray);

//            var_dump($login);

        if (!$login->getResult()):
            $jSon['error'] = [$login->getError()[0], $login->getError()[1]];
//            unset($_SESSION['carrinho']);

        else:
            $jSon['logado'] = true;
            $jSon['caminho'] = HOME . '/curso&action=salvar';
        endif;


        break;

    case 'entrar_plataforma':

        $login = new LoginCliente(2);

        if ($login->CheckLogin()):
            $jSon['logado'] = true;
        endif;

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $login->ExeLogin($meuArray);

//            var_dump($login);

        if (!$login->getResult()):
            $jSon['error'] = [$login->getError()[0], $login->getError()[1]];
//            unset($_SESSION['carrinho']);

        else:
            $jSon['logado'] = true;
            $jSon['caminho'] = HOME . '/plataforma';
        endif;


        break;


    case 'recuperar_senha':

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $read = new Read;
        $read->ExeRead(CLIENTES, "WHERE cliente_email = :email", "email={$meuArray['cliente_email']}");
        if ($read->getResult()):

            extract($read->getResult()[0]);

            $senha = rand(1000, 10000);

            $Arr = ["cliente_senha" => substr(md5($senha), 0, 16)];

            $update = new Update;
            $update->ExeUpdate(CLIENTES, $Arr, "WHERE cliente_id = :id", "id={$cliente_id}");
            if ($update->getResult()):

                $meuArray['Assunto'] = "CET-RHEMA - Suas Credenciais de Acesso";
                $meuArray['DestinoNome'] = $cliente_name;
                $meuArray['DestinoEmail'] = $cliente_email;
                $meuArray['Mensagem'] = "Olá {$cliente_name}! <br> Suas credenciais estão logo abaixo:<br><br> e-mail: {$cliente_email} <br> nova senha: {$senha}<br><br>Você pode alterar a senha novamente no seu perfil!<br><br>Deus Abençõe!,<br> CET-RHEMA";

                $email = new Email();
                $email->Enviar($meuArray);
                var_dump($email);

                $jSon['caminho'] = 'login?exe=recover';

            endif;
        endif;

        break;

    case 'recuperar_senha_admin':

//        var_dump($Post);
//        die;

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $read = new Read;
        $read->ExeRead(USUARIOS, "WHERE user_email = :email", "email={$meuArray['user_email']}");
        if ($read->getResult()):

            extract($read->getResult()[0]);

            $senha = rand(1000, 10000);

            $Arr = ["user_password" => substr(md5($senha), 0, 16)];

            $update = new Update;
            $update->ExeUpdate(USUARIOS, $Arr, "WHERE user_id = :id", "id={$user_id}");
            if ($update->getResult()):

                $meuArray['Assunto'] = SITENAME . " - Suas Credenciais de Acesso";
                $meuArray['DestinoNome'] = $user_name;
                $meuArray['DestinoEmail'] = $user_email;
                $meuArray['Mensagem'] = "Olá {$user_name}! <br> Suas credenciais estão logo abaixo:<br><br> e-mail: {$user_email} <br> nova senha: {$senha}<br><br>Você pode alterar a senha novamente no seu perfil!<br><br>Deus Abençõe!,<br>" . SITENAME;

                $email = new Email();
                $email->Enviar($meuArray);

                $jSon['caminho'] = HOME . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'index.php?exe=recover';

            endif;
        endif;

        break;


    case 'cadastrar':


        unset($Post['cliente_cover']);

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;


        $adminCliente = new AdminCliente;
        $adminCliente->ExeCreate($meuArray);
//            var_dump($adminCliente);

        if ($adminCliente->getResult()):


            $meuArray['Assunto'] = "CET-RHEMA - Suas Credenciais de Acesso";
            $meuArray['DestinoNome'] = "{$meuArray['cliente_name']}";
            $meuArray['DestinoEmail'] = "{$meuArray['cliente_email']}";
            $meuArray['Mensagem'] = "Olá {$meuArray['cliente_name']}! <br> Seu cadastro foi relizado com sucesso!  Suas credenciais estão logo abaixo:<br><br> e-mail: {$meuArray['cliente_email']} <br> senha: {$meuArray['cliente_senha']}<br><br>Deus Abençõe!,<br> CET-RHEMA";

            $email = new Email();
            $email->Enviar($meuArray);

            $Acesso = [
                "cliente_email" => $meuArray['cliente_email'],
                "cliente_senha" => $meuArray['cliente_senha']
            ];

            $login = new LoginCliente(1);
            $login->ExeLogin($Acesso);
            $meuArray = null;

//            var_dump($login);

            if (!$login->getResult()):
                $jSon['error'] = [$login->getError()[0], $login->getError()[1]];

//                unset($_SESSION['carrinho']);
            else:

                $jSon['logado'] = true;
                $jSon['caminho'] = HOME . '/curso&action=salvar';
            endif;

        endif;

        $jSon['error'] = [$adminCliente->getError()[0], $adminCliente->getError()[1]];

        break;

    /**
     * ===================================================================================
     * ==============================ECOMMERCE============================================
     * ===================================================================================
     */
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


    /**
     * ===================================================================================
     * ==============================COMENTÁRIOS============================================
     * ===================================================================================
     */
    case 'recados_nutrilowcarb':

//            $Post['comentario_cover'] = ($_FILES['comentario_cover']['tmp_name'] ? $_FILES['comentario_cover'] : null);
        $Post['comentario_status'] = 0;
        $Post['comentario_type'] = 'recados';
        $Post['comentario_date'] = date('Y-m-d H:i:s');

        $meuArray = array();

        foreach ($Post as $key => $value) :
            if (!is_numeric($key)):
                $meuArray += [$key => $value];
            endif;
        endforeach;

        $adminComentario = new adminComentario;
        $adminComentario->ExeCreate($meuArray);

        $jSon['error'] = [$adminComentario->getError()[0], $adminComentario->getError()[1]];

        break;


    case 'create_comentario':

        include '../app_comentarios/create-comentario-ajax.inc.php';

        break;

    case 'responder_comentario':

        include '../app_comentarios/responder-comentario-ajax.inc.php';

        break;


    case 'atualizar_status_post_realtime':

        include './ajax_inc/ajax_atualizar_status_post_realtime.inc.php';

        break;

    default:
        $jSon['error'] = 'Erro ao Escolher ação!';
        break;


endswitch;




echo json_encode($jSon);





