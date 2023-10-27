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

    case 'cadastrar':

        /**
         * ajax_cadastrar.php - <b>Cadastro Antes da Compra</b>
         * Arquivo de inclusão do ajax.php para armazenar o script de Exclusão de Extintor
         */
        unset($Post['cliente_cover']);


        $meuArray = Check::limparSubmit($Post);
        $meuArray['cliente_senha'] = 'null';

//        var_dump($meuArray);
//        die;
//        var_dump($_SESSION['clientelogin']);
//        die;

        if ($meuArray['cliente_tipo'] == 'menor'):
            $meuArray['cliente_declaracao'] = (!empty($_FILES['cliente_declaracao']['tmp_name']) ? $_FILES['cliente_declaracao'] : null);

            if (!empty($meuArray['cliente_data_nascimento'])):
                $meuArray['cliente_data_nascimento'] = date('Y-d-m', strtotime($meuArray['cliente_data_nascimento']));
            endif;

        endif;

        $CPF = str_replace([".", "-", " "], "", $meuArray['cliente_cpf']);




//        var_dump($DataNascimento);
//        die;
        $read = new Read;
        $read->ExeRead(CLIENTES, "WHERE cliente_cpf = :cpf", "cpf={$CPF}");
        $adminCliente = new AdminCliente;
        if ($read->getResult()):
            $adminCliente->ExeUpdate($read->getResult()[0]['cliente_id'], $meuArray);
        else:
            $adminCliente->ExeCreate($meuArray);
        endif;

        if ($adminCliente->getResult()):

            $Acesso = [
                "cliente_email" => $meuArray['cliente_email'],
            ];

            $login = new LoginCliente(1);
            $login->ExeLogin($Acesso);

            if (!$login->getResult()):
                $jSon['error'] = [$login->getError()[0], $login->getError()[1]];

            else:

                $produto = new Carrinho();
                $produto->setId(1);
                $produto->adicionar();

                $ZerarSenha = ["cliente_senha" => 'null'];
                $adminCliente->ExeUpdate($adminCliente->getResult(), $ZerarSenha);

                $readCliente = new Read;
                $readCliente->ExeRead(CLIENTES, "WHERE cliente_cpf = :cpf", "cpf={$CPF}");
                $Cliente = BuscaRapida::buscarCliente($readCliente->getResult()[0]['cliente_id']);

                EmailMensseger::EmailAvisoInscrito($Cliente);

                $meuArray = null;

//                var_dump($adminCliente);

                if (!empty($_SESSION['clientelogin']['cliente_id'])):

                    $_SESSION['clientelogin']['venda_quantidade'] = 1;

                    // SALVA CARRINHO E CRIA REGISTRO DA VENDA NA BD
                    $produto->ExeSalvar($_SESSION['carrinho']);

                    if ($_SESSION['clientelogin']['venda_categoria'] != 'isento'):

                        $jSon['email_enviado'] = EmailMensseger::EmailAvisoInscricaoComprador($_SESSION['clientelogin']);

//                        var_dump($_SESSION['clientelogin']['venda_categoria']);
//                        die;
                        // DADOS DE TRANSAÇÂO SÂO ENVIADOS PARA O CHECKOUT DO PAGSEGURO
                        $adminPagSeguro = new CheckoutPagSeguro();
                        $jSon['logado'] = true;
                        $jSon['caminho'] = $adminPagSeguro->ExeTransacao($_SESSION['clientelogin']);
                    else:
                        $jSon['idade'] = Check::calcularIdade($_SESSION['clientelogin']['cliente_data_nascimento']);
                        EmailMensseger::EmailAvisoPagamentoAprovadoComprador($_SESSION['clientelogin']);
                        $jSon['logado'] = true;
                        $jSon['caminho'] = HOME . DIRECTORY_SEPARATOR . 'comprovante-pagamento&registro=' . $_SESSION['clientelogin']['venda_registro'] . '&tipo=voucher-eletronico';
                    endif;


                endif;

            endif;

        else:

            $jSon['id'] = 'id';

        endif;

        $jSon['error'] = [$adminCliente->getError()[0], $adminCliente->getError()[1]];


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
