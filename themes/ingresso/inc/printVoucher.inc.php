<?php

/*
 * printVoucher.inc.php
 * Arquivo Responsável por Gerar HTML do Voucher Eletrônico Antes de Criar PDF
 */

$Venda = BuscaRapida::buscarVenda($registro);
$Cliente = BuscaRapida::buscarCliente($Venda['venda_cliente']);

extract($Venda);
extract($Cliente);

//var_dump($Venda, $Cliente);
//die;

$html .= '<div class="container bg-body">';

$html .= '<header class="titulo-principal-ficha bg-green-claro al-center">';
$html .= '<img width="200px" title="" alt="" src="' . INCLUDE_PATH . '/img/logo.png" />';
$html .= '<h1 class="col-90" style="font-size: 1.6em;">Comprovante de Pagamento (Voucher Eletrônico)</h1>';
$html .= '</header>';

$html .= '<div class="content">';
$html .= '<div class="j_dados_pessoais">';
$html .= '<h1 class="container dados-cabecalho" style="font-size: 1.5em;"><strong>Informações de Compra:</strong></h1>';
$html .= '<div class="info_cima fl-left">';

if ($cliente_tipo == 'menor'):
    $html .= '<div class="col-49"><span style="font-weight:bold;">Nome:</span> ' . $cliente_name . ' ' . $cliente_lastname . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Data de Nascimento:</span> ' . date('d/m/Y', strtotime($cliente_data_nascimento)) . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Categoria:</span> Menor de Idade</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Nome do Responsável:</span> ' . $cliente_name_responsavel . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">CPF do Responsável:</span> ' . $cliente_cpf . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Cidade:</span> ' . BuscaRapida::buscarCidade($cliente_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($cliente_cidade)[0]['cidade_uf'] . '</div>';

    if ($venda_categoria == 'isento'):
        $html .= '<div class="col-49"><span style="font-weight:bold;">Ingresso:</span> Gratuito</div>';
    elseif ($venda_categoria == 'meia'):
        $html .= '<div class="col-49"><span style="font-weight:bold;">Ingresso:</span> Meia Entrada</div>';
        $html .= '<div class="col-49"><span style="font-weight:bold;">Valor:</span> R$ ' . number_format(($venda_unidade / 2), 2, ',', '.') . '</div>';
        $html .= '<div class="col-49"><span style="font-weight:bold;">Transação:</span> ' . $venda_transacao . '</div>';
    else:
        $html .= '<div class="col-49"><span style="font-weight:bold;">Ingresso:</span> Inteira</div>';
        $html .= '<div class="col-49"><span style="font-weight:bold;">Valor:</span> R$ ' . number_format($venda_unidade, 2, ',', '.') . '</div>';
        $html .= '<div class="col-49"><span style="font-weight:bold;">Transação:</span> ' . $venda_transacao . '</div>';
    endif;



else:
    $html .= '<div class="col-49"><span style="font-weight:bold;">Nome:</span> ' . $cliente_name . ' ' . $cliente_lastname . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">CPF:</span> ' . $cliente_cpf . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Categoria:</span> Maior de Idade</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Cidade:</span> ' . BuscaRapida::buscarCidade($cliente_cidade)[0]['cidade_nome'] . ' - ' . BuscaRapida::buscarCidade($cliente_cidade)[0]['cidade_uf'] . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Ingresso:</span> Inteira</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Valor:</span> R$ ' . number_format($venda_unidade, 2, ',', '.') . '</div>';
    $html .= '<div class="col-49"><span style="font-weight:bold;">Transação:</span> ' . $venda_transacao . '</div>';

endif;

$html .= '<div class="col-49"><span style="font-weight:bold;">Registro:</span> ' . $venda_registro . '</div>';

if ($venda_categoria == 'isento'):
    $html .= '<div class="col-49"><span style="font-weight:bold;">Data da Compra:</span> ' . date('d/m/Y H:i:s', strtotime($venda_data)) . '</div>';
else:
    $html .= '<div class="col-49"><span style="font-weight:bold;">Data da Compra:</span> ' . date('d/m/Y H:i:s', strtotime($venda_atualizacao)) . '</div>';
endif;

$html .= '<div class="col-49 m-top1 al-right" style="font-weight: bold; color: red;">Atenção: Você deve comparecer ao evento com este Comprovante Eletrônico!</div>';

$html .= '</div>';
$html .= '</div>';

$html .= '</div>';
$html .= '</div>';
