<?php

header("Access-Control-Allow-Origin: *");

date_default_timezone_set("America/Sao_Paulo");
require '../../_app/Config.inc.php';
require '../../_app/Library/PagSeguroLibrary/Config.inc.php';
require '../../_app/Library/PagSeguroLibrary/PagSeguroLibrary.php';
spl_autoload_register('carregarClasses');

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($getPost['ccsc'])):
    $ccsc = $getPost['ccsc'];
    unset($getPost['ccsc']);
endif;

$setPost = array_map('strip_tags', $getPost);
$Post = array_map('trim', $setPost);
$jSon = array();


if (!empty($_SESSION['theme'])):
    session_start();
elseif (!isset($_SESSION)):
    session_start();
elseif (!PHP_SESSION_ACTIVE):
    session_start();
endif;

if (isset($Post['action'])):
    $Action = $Post['action'];
    unset($Post['action']);
else:
    $Action = null;
endif;


switch ($Action):

    case 'gerar_pdf':

//        session_start();
//        var_dump($_SESSION);
        var_dump($_SESSION['enclosure']);
//        var_dump($_SESSION['padmounted']);
        var_dump($ccsc);

        break;

    default:
        $jSon['error'] = 'Erro ao Escolher ação!';
        break;

endswitch;

echo json_encode($jSon);





