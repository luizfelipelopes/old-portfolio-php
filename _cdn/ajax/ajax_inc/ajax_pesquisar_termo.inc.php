<?php

/**
 * ajax_pesquisar_termo.php - <b>Pesquisar Termo</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de Pesquisa de Termo
 */
if (!empty($Post['pesquisa'])):
    
    $jSon['caminho'] = HOME . '/pesquisa/' . $Post['pesquisa'] . '/&theme=' . $Post['current-theme'];
    
endif;