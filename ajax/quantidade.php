<?php

/**
 * quantidade.php [ARQUIVO PARA CARRINHO DE COMPRAS]
 * Arquivo responsável por receber os dados via AJAX através do script quantidade.js
 */

// INICIA SESSÂO
session_start();

// RECEBE OS DADOS ENVIADOS VIA AJAX ATRAVÈS DO MÈTODO POST(ENVIADO POR 'quantidade.js')
$id = $_POST['item_id']; // ID DO PRODUTO
$preco = $_POST['item_preco']; // VALOR DO PRODUTO
$qtde = $_POST['item_quantidade']; // QUANTIDADE DE ITENS DE CADA PRODUTO
$total = $_POST['item_total']; // VALOR TOTAL DE PRODUTOS COMPRADOS

// CASO EXISTA UMA SESSÂO PARA O PRODUTO
if (isset($_SESSION['carrinho'][$id])):
    
    // PRODUTO RECEBE A QUANTIDADE ITENS QUE FOI ADICIONADO EM TEMPO REAL
    $_SESSION['carrinho'][$id] = $qtde;

    // EXIBE O VALOR DO TOTAL DE M2 DE CADA PRODUTO ADICIONADO AO CARRINHO EM FORMATO REAL
    echo 'R$ ' . number_format($preco * $qtde, 2, ',', '.');

    // ARMAZENA O TOTAL DO CARRINHO NA SESSÂO PARA QUE POSSA SER EXIBIDO
    // NOS DEVIDOS LUGARES NO SISTEMA 
    if (isset($total)):
        $_SESSION['preco_total'] = $total;
    endif;

endif;
