<?php
require '../_app/Config.inc.php';
require '../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
spl_autoload_register('carregarClasses');

if (!isset($_SESSION)):
    session_start();
endif;

$_SESSION['clientelogin'] = [
    'cliente_name' => 'Luiz Felipe Cordeiro Lopes',
    'cliente_ddd' => '38',
    'cliente_telefone' => '988167371',
    'cliente_email' => (PAGSEGURO_ENV == 'sandbox' ? 'ctx@sandbox.pagseguro.com.br' : 'feleplopes_16@yahoo.com.br'),
    'cliente_cpf' => '10043770614',
    'cliente_endereco' => 'Rua Antônio Edílio Duarte',
    'cliente_numero' => '77',
    'cliente_bairro' => 'Rio Grande',
    'cliente_cidade' => 'Diamantina',
    'cliente_uf' => 'MG',
    'cliente_cep' => '39100000'
];

$_SESSION['carrinho'] = array(
    '0' => [
        'produto_id' => '001',
        'produto_descricao' => 'Ingresso Conferência Avante',
        'produto_quantidade' => '1',
        'produto_valor' => '2.00',
        'produto_total' => '2.00'
    ],
    '1' => [
        'produto_id' => '002',
        'produto_descricao' => 'Ingresso Diante do Trono',
        'produto_quantidade' => '1',
        'produto_valor' => '2.00',
        'produto_total' => '2.00'
        ]);

$TotalCarrinho = 0;
foreach ($_SESSION['carrinho'] as $produto):
    $TotalCarrinho += $produto['produto_total'];
endforeach;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Teste Chekout Transparente</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel="stylesheet">
        <!--<link rel="stylesheet" href="css/style.css" />-->
        <link rel="stylesheet" href="css/boot.css" />
        <link rel="total_carrinho" href="<?= $TotalCarrinho; ?>" />
    </head>

    <body>

        <header class="al-center m-top3 m-bottom3">
            <h1>Teste Checkout Transparente</h1>
        </header>

        <section class="container">

            <div class="content js_content_form">

                <div class="bloco_abas_checkout js_bloco_abas_checkout">
                    <div class="bg-red abas_checkout">
                        <div class="chekout_aba js_aba_cartao ds-inblock bg-body bd-bottom4 pd-total2 pointer">Cartão de Crédito:</div>
                        <div class="chekout_aba js_aba_boleto ds-inblock bg-body bd-bottom4 pd-total2 pointer">Boleto Bancário:</div>
                    </div>
                </div>

                <form action="" method="post" enctype="multipart/form-data" class="js_form_cartao">
                    <div class="trigger-box-suspenso"></div>
                    <input type="hidden" name="action" value="efetuarPagamentoCartao">
                    <input class="retornoTeste" type="hidden" name="carrinho_session_cartao">
                    <input class="hashPagSeguro" type="hidden" name="carrinho_hash_cartao">
                    <input class="tokenPagamentoCartao" type="hidden" name="tokenCartao_cartao">
                    <input id="valor_parcela" type="hidden" name="carrinho_valor_parcela_cartao">

                    <article class="form_responsavel js_responsavel container">

                        <div class="content">
                            <input type="hidden" name="carrinho_nome_cartao" value="<?= $_SESSION['clientelogin']['cliente_name']; ?>">
                            <input type="hidden" name="carrinho_ddd_cartao" value="<?= $_SESSION['clientelogin']['cliente_ddd']; ?>">
                            <input type="hidden" name="carrinho_telefone_cartao" value="<?= $_SESSION['clientelogin']['cliente_telefone']; ?>">
                            <input type="hidden" name="carrrinho_email_cartao" value="<?= $_SESSION['clientelogin']['cliente_email']; ?>">
                            <input id="cadCPF" type="hidden" name="carrinho_cpf_cartao" value="<?= $_SESSION['clientelogin']['cliente_cpf']; ?>">

                            <label class="form-field col-79 pos-relative">
                                <span class="form-legend pos-relative">Número Cartão<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input id="bin" type="text" name="carrinho_numero_cartao" placeholder="Número Cartao" required>
                                <div class="bandeira-cartao js_brand"></div>
                                <div class="input-erro js_erro_num_cartao"></div>
                            </label>

                            <label class="form-field col-10">
                                <span class="form-legend pos-relative">Mês<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input id="pagamentoMes" type="text" name="carrinho_mes_cartao" placeholder="MM" required>
                            </label>

                            <label class="form-field col-10">
                                <span class="form-legend pos-relative">Ano<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input id="pagamentoAno" type="text" name="carrinho_ano_cartao" placeholder="YYYY" required>
                                <span class="input-erro js_erro_ano_cartao"></span>
                            </label>

                            <label class="form-field col-79">
                                <span class="form-legend pos-relative">Nome Impresso no Cartão<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input type="text" name="carrinho_nome_titular_cartao" placeholder="Ex: JOSE C GUIMARAES" required>
                            </label>

                            <label class="form-field col-20">
                                <span class="form-legend pos-relative">CVV<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <input id="cvv" type="text" name="carrinho_cvv_cartao" placeholder="CVV" required>
                            </label>

                            <div class="bg-light container pd-total2 m-top1 m-bottom1">
                                <label class="form-field col-49">
                                    <span class="form-legend pos-relative">CPF Titular<span class="cl-red pos-absolute right-10">*</span>:</span>
                                    <input id="cpf" type="text" name="carrinho_cpf_titular_cartao" placeholder="CPF" required>
                                </label>

                                <label class="form-field col-49">
                                    <span class="form-legend pos-relative">Data Nascimento Titular<span class="cl-red pos-absolute right-10">*</span>:</span>
                                    <input id="calendario" type="text" name="carrinho_data_nascimento_titular_cartao" placeholder="Data Nascimento" required>
                                </label>
                            </div>                            


                            <label class="form-field col-49">
                                <span class="form-legend pos-relative">Parcelamento Cartão<span class="cl-red pos-absolute right-10">*</span>:</span>
                                <select disabled id="parcelamento" class="js_parcelamento" name="carrinho_parcelamento_cartao" required>
                                    <option selected="">Selecione</option>
                                </select>
                            </label>

                            <input type="hidden" name="carrinho_ddd_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_ddd']; ?>">
                            <input type="hidden" name="carrinho_telefone_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_telefone']; ?>">
                            <input type="hidden" name="carrinho_rua_titualr_cartao" value="<?= $_SESSION['clientelogin']['cliente_endereco']; ?>">
                            <input type="hidden" name="carrinho_numero_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_numero']; ?>">
                            <input type="hidden" name="carrinho_bairro_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_bairro']; ?>">
                            <input type="hidden" name="carrinho_cidade_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_cidade']; ?>">
                            <input type="hidden" name="carrinho_uf_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_uf']; ?>">
                            <input type="hidden" name="carrinho_cep_titular_cartao" value="<?= $_SESSION['clientelogin']['cliente_cep']; ?>">

                            <div class="clear"></div>
                        </div>
                    </article>

                    <button class="btn btn-green radius j_btn fl-right">Comprar Agora!</button>
                    <div title="Carregando" class="load fl-right" style="margin-top: 5px;"></div>

                </form>


                <form action="" method="post" enctype="multipart/form-data" class="js_form_boleto">

                    <input type="hidden" name="action" value="efetuarPagamentoBoleto">
                    <input class="retornoTeste" type="hidden" name="carrinho_session_boleto">
                    <input class="hashPagSeguro" type="hidden" name="carrinho_hash_boleto">

                    <article class="form_responsavel js_responsavel container">

                        <div class="content">
                            <input type="hidden" name="carrinho_nome_boleto" value="<?= $_SESSION['clientelogin']['cliente_name']; ?>">
                            <input type="hidden" name="carrinho_ddd_boleto" value="<?= $_SESSION['clientelogin']['cliente_ddd']; ?>">
                            <input type="hidden" name="carrinho_telefone_boleto" value="<?= $_SESSION['clientelogin']['cliente_telefone']; ?>">
                            <input type="hidden" name="carrrinho_email_boleto" value="<?= $_SESSION['clientelogin']['cliente_email']; ?>">
                            <input id="cadCPF" type="hidden" name="carrinho_cpf_boleto" value="<?= $_SESSION['clientelogin']['cliente_cpf']; ?>">

                            <label class="form-field container col-10">
                                <div class="icone-boleto"></div>
                            </label>
                            <label class="form-field col-49 m-top1">
                                <button class="btn btn-green radius j_btn fl-left" style="margin-right: 10px;">Comprar Agora!</button>
                                <div title="Carregando" class="load fl-left" style="margin-top: 5px;"></div>
                            </label>

                            <div class="clear"></div>
                        </div>
                    </article>

                </form>

                <div class="clear"></div>
            </div>
        </section>

    </body>

    <script src="https://stc.<?= (PAGSEGURO_ENV == 'sandbox' ? 'sandbox.' : ''); ?>pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="../_cdn/jquery.js"></script>
    <script src="../_cdn/jquery.form.js"></script>
    <script src="../_cdn/jquery.mask.js"></script>
    <script src="js/scripts.js"></script>

</html>