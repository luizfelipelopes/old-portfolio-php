<?php

header("Access-Control-Allow-Origin: *");

date_default_timezone_set("America/Sao_Paulo");
require '../../../_app/Config.inc.php';
require '../../../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../../../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
spl_autoload_register('carregarClasses');

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

    case 'buy_service':

        /**
         * ajax_buy_service.php - <b>Realização da Compra do Serviço</b>
         * Arquivo de inclusão do ajax.php para armazenar o script de Realização de Compra do Serviço Prestado
         */
        // Atribui em um array os dados necessários para validar a oompra
        $meuArray = [
            "cliente_name" => $Post['name'],
            "cliente_cpf" => "null",
            "cliente_email" => $Post['mail'],
            "cliente_level" => "1",
            "cliente_senha" => "null"
        ];
        
        

        // Faz uma leitura do cliente pelo e-mail passado p/ verificar se seu cadastro já consta na Base de Dados
        $read = new Read;
        $read->FullRead("SELECT cliente_id FROM " . CLIENTES . " WHERE cliente_email = :email", "email={$meuArray['cliente_email']}");

        $adminCliente = new AdminCliente; // Instancia Classe que Gerencia Ações referentes ao cliente


        if ($read->getResult()): // Se o cliente jáconsta na base de dados, apenas atualiza seus dados
            $adminCliente->ExeUpdate($read->getResult()[0]['cliente_id'], $meuArray);
        else: // Se não consta na base de dados, ele é cadastrado no BD
            $adminCliente->ExeCreate($meuArray);
        endif;
        
//        var_dump($adminCliente);

        // Se o cadastro ou a atualização for bem sucedida
        if ($adminCliente->getResult()):

            // Atribui as credenciais no array "Acesso" p/ utilizar no login
            $Acesso = ["cliente_email" => $meuArray['cliente_email']];

            $login = new LoginCliente(1); // Instancia classe responsável por logar o cliente no sistema
            $login->ExeLogin($Acesso); // Cliente é logado com as credenciais do array "Acesso"

            if (!$login->getResult()): // Se o login não for bem sucedido
                $jSon['error'] = [$login->getError()[0], $login->getError()[1]]; // Uma mensagem de erro será exibida
            else: // Se logou corretamente

                $produto = new Carrinho(); // Instancia classe responsável por criar o carrinho
                $produto->setId(1); // Seta id do serviço como um
                $produto->adicionar(); // Adiciona serviço ao carrinho

                $ZerarSenha = ["cliente_senha" => 'null']; // A senha é atribuida como 'null' para que seja setada como null na base de dados, poisnão há necessidade de uso de senha para a compra de serviço 
                $adminCliente->ExeUpdate($adminCliente->getResult(), $ZerarSenha); // Atualiza no BD para setar a senha como null
//                $readCliente = new Read; // Instancia classe de leitura
//                $readCliente->ExeRead(CLIENTES, "WHERE cliente_email = :email", "email={$meuArray['cliente_email']}");

                $meuArray = null; // Seta como null o array para limpar a memória
//                $_SESSION['clientelogin']['venda_quantidade'] = 1; // Seta a quantidade de serviços comprados
//                $_SESSION['clientelogin']['venda_pacote'] = $Post['id']; // Seta o id do pacote de serviço

                if (!empty($_SESSION['clientelogin']['cliente_id'])): // Se existe sessão

                    $_SESSION['clientelogin']['venda_quantidade'] = 1; // Seta a quantidade de serviços comprados
                    $_SESSION['clientelogin']['venda_pacote'] = $Post['id']; // Seta o id do pacote de serviço
                    // SALVA CARRINHO E CRIA REGISTRO DA VENDA NA BD
                    $produto->ExeSalvar($_SESSION['carrinho']);
//                    
                    // DADOS DE TRANSAÇÂO SÂO ENVIADOS PARA O CHECKOUT DO PAGSEGURO
                    $adminPagSeguro = new CheckoutPagSeguro(); // Instancia classe responsável pelo checkout do pagseguro
                    $jSon['path'] = $adminPagSeguro->ExeTransacao($_SESSION['clientelogin'], null, (!empty($Post['interest']) ? $Post['interest'] : null)); // Recebe a url de direcionamento para a página de pagamento
//                    
                endif;

            endif;

        endif;

        $jSon['error'] = [$adminCliente->getError()[0], $adminCliente->getError()[1]]; // Exibe mensagem de erro referente ao cadastro ou atualização do cliente

        break;

    case 'auto_preencher':


        if (!empty($Post['cpf'])):


            $CPF = str_replace([".", "-", " "], "", $Post['cpf']);

            $read = new Read;
            $read->ExeRead(CLIENTES, "WHERE cliente_cpf = :cpf", "cpf={$CPF}");
            if ($read->getResult()):

                $jSon['comprador'] = $read->getResult()[0];

                $readCidade = new Read;
                $readCidade->ExeRead(CIDADES, "WHERE estado_id = :uf", "uf={$read->getResult()[0]['cliente_uf']}");
                if ($readCidade->getResult()):
                    $jSon['cidade'] = '';
                    foreach ($readCidade->getResult() as $cidade):
                        extract($cidade);

                        $jSon['cidade'] .= '<option ' . ($cidade_id == $read->getResult()[0]['cliente_cidade'] ? 'selected' : '') . ' value="' . $cidade_id . '"> ' . $cidade_nome . ' </option>';

                    endforeach;

                endif;

                $jSon['data_nascimento'] = date('d/m/Y', strtotime($read->getResult()[0]['cliente_data_nascimento']));

            endif;


        endif;


        break;


    case 'enviar_contato':

//        var_dump($Post);
//        die;
        $meuArray = Check::limparSubmit($Post);

        if (EmailMensseger::EmailMensagemContato($meuArray['contato_nome'], $meuArray['contato_email'], $meuArray['contato_mensagem'])):
            $jSon['error'] = ['Sua mensagem foi enviada com sucesso! Em breve, entraremos em contato!', WS_ACCEPT];
        else:
            $jSon['error'] = ['Desculpe, no momento não estamos recebendo mensagens! Em breve, voltaremos ao normal', WS_ERROR];
        endif;

        break;

    default:
        $jSon['error'] = 'Erro ao Escolher ação!';
        break;


endswitch;

echo json_encode($jSon);
