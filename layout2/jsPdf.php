<?php
ob_start();
require '../_app/Config.inc.php';
spl_autoload_register('carregarClasses');

$query  = filter_input_array(INPUT_GET, FILTER_DEFAULT);
var_dump($query);

//echo 'TESTE';

ob_end_flush();