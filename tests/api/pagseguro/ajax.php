<?php 

	use api\Support\Payment;

	include 'config.inc.php';
	include 'api.class.php';
	include '../../api/Support/Payment.php';

	$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);
	$setPost = array_map('strip_tags', $getPost);
	$Post = array_map('trim', $setPost);
	$jSon = array();


	if(isset($Post)){
		$action = $Post['action'];
		unset($Post['action']);
	}


	switch ($action) {
				
				case 'boleto':

					$pay = new Payment();
					$result = $pay->withBillet($Post);
					var_dump($pay);
					die;

				case 'debito':

					$pay = new Payment();
					$result = $pay->withOnlineDebit($Post);
					var_dump($pay);
					die;

				break;

				case 'creditCard':

					$pay = new Payment();
					$result = $pay->withCard($Post);
					var_dump($pay);
					die;

				break;
				
				
				default:
					$jSon['error'] = 'nenhuma ação válida';
					break;
			}		





	echo json_encode($jSon);

?>