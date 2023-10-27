<?php 

namespace api\correios;
use api\Support\Shipping;

include 'Config.inc.php';
include 'Correios.class.php';
include '../../api/Support/Shipping.php';

$data = [

	"nCdServico" => "04014,04510",
	"sCepOrigem" => "21921840",
	"sCepDestino" => "39100000",
	"nVlPeso" => "1",
	"nCdFormato" => 3,
	"nVlComprimento" => 20.5,
	"nVlAltura" => 20,
	"nVlLargura" => 20,
	"nVlDiametro" => 0,
	"sCdMaoPropria" => "n",
	"nVlValorDeclarado" => 0,
	"sCdAvisoRecebimento" => "n",
	"StrRetorno" => "xml",
	"nIndicaCalculo" => 3

];



$api = new Shipping();
$api->byPriceDeadline($data);
var_dump($api->callback());


// $api = new Correios();
// $result = $api->apiPost(PRECO_PRAZO, $data);
// $result = $api->apiPost(PRECO, $data);
// var_dump($result);
// var_dump($api->error());