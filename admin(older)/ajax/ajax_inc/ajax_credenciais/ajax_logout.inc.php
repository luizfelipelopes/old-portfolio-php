<?php

/**
 * ajax_logout.php - <b>Logout do Sistema</b>
 * Arquivo de inclusão do ajax.php para armazenar o script de logout no sistema
 */
unset($_SESSION['userlogin']);
$jSon['caminho'] = 'index.php?exe=logoff';
