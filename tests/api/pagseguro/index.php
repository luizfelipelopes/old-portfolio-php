<?php
	namespace tests\api\pagseguro;
	use api\Support\Payment;

	include 'config.inc.php';
	
	date_default_timezone_set("America/Sao_Paulo");
	header("access-control-allow-origin: " . API_PAYMENT_URL); 
	
	include 'api.class.php';
	include '../../api/Support/Payment.php';

	echo '<h1>Teste Pagseguro</h1>';	


	echo '<h2>Compra:</h2>';

	
	$pay = new Payment();
	$pay->createSession();
	var_dump($pay);

	// echo 'Token PagSeguro: ' . $api->getToken() . '<br>';
	// echo 'Email PagSeguro: ' . $api->getEmail() . '<br>';
	// echo 'Url PagSeguro: ' . $api->getUrl() . '<br>';
	echo 'Session: <span id="session">' . $pay->callback() . '</span><br>';
	//echo 'Hash: <span id="hash"></span><br>';
	
?>


<!--
	 <form method="post">

		<input type="text" name="action" value="boleto"><br>
		<input type="text" name="paymentMode" value="default"><br>
		<input type="text" name="paymentMethod" value="boleto"><br>
		<input type="text" name="receiverEmail" value="lfelipelopesti@gmail.com"><br>
		<input type="text" name="currency" value="BRL"><br>
		<input type="text" name="extraAmount" value="1.00"><br>
		<input type="text" name="itemId1" value="0001"><br>
		<input type="text" name="itemDescription1" value="NotebookPrata"><br>
		<input id="itemAmout" type="text" name="itemAmount1" value="24300.00"><br>
		<input type="text" name="itemQuantity1" value="1"><br>
		<input type="text" name="itemId2" value="0002"><br>
		<input type="text" name="itemDescription2" value="NotebookVermelho"><br>
		<input id="itemAmout2" type="text" name="itemAmount2" value="14300.00"><br>
		<input type="text" name="itemQuantity2" value="2"><br>
		<input type="text" name="reference" value="REF1234"><br>
		<input type="text" name="senderName" value="Jose Comprador"><br>
		<input type="text" name="senderCPF" value="22111944785"><br>
		<input type="text" name="senderAreaCode" value="11"><br>
		<input type="text" name="senderPhone" value="56273440"><br>
		<input type="text" name="senderEmail" value="c29430053830363582212@sandbox.pagseguro.com.br"><br>
		<input id="hash" type="text" name="senderHash" value=""><br>
		<input type="text" name="shippingAddressStreet" value="Av.Brig.FariaLima"><br>
		<input type="text" name="shippingAddressNumber" value="1384"><br>
		<input type="text" name="shippingAddressComplement" value="5oandar"><br>
		<input type="text" name="shippingAddressDistrict" value="JardimPaulistano"><br>
		<input type="text" name="shippingAddressPostalCode" value="01452002"><br>
		<input type="text" name="shippingAddressCity" value="SaoPaulo"><br>
		<input type="text" name="shippingAddressState" value="SP"><br>
		<input type="text" name="shippingAddressCountry" value="BRA"><br>
		<input type="text" name="shippingType" value="1"><br>
		<input id="shippingCost" type="text" name="shippingCost" value="1.00"><br>
		
		<button>Pagar</button>

	 </form>
-->
	
<!-- <form method="post">

		<input type="text" name="action" value="debito"><br>
		<input type="text" name="paymentMode" value="default"><br>
		<input type="text" name="paymentMethod" value="eft"><br>
		<input type="text" name="bankName" value="itau"><br>
		<input type="text" name="receiverEmail" value="lfelipelopesti@gmail.com"><br>
		<input type="text" name="currency" value="BRL"><br>
		<input type="text" name="extraAmount" value="1.00"><br>
		<input type="text" name="itemId1" value="0001"><br>
		<input type="text" name="itemDescription1" value="NotebookPrata"><br>
		<input id="itemAmout" type="text" name="itemAmount1" value="24300.00"><br>
		<input type="text" name="itemQuantity1" value="1"><br>
		<input type="text" name="itemId2" value="0002"><br>
		<input type="text" name="itemDescription2" value="NotebookVermelho"><br>
		<input id="itemAmout2" type="text" name="itemAmount2" value="14300.00"><br>
		<input type="text" name="itemQuantity2" value="2"><br>
		<input type="text" name="reference" value="REF1234"><br>
		<input type="text" name="senderName" value="Jose Comprador"><br>
		<input type="text" name="senderCPF" value="22111944785"><br>
		<input type="text" name="senderAreaCode" value="11"><br>
		<input type="text" name="senderPhone" value="56273440"><br>
		<input type="text" name="senderEmail" value="c29430053830363582212@sandbox.pagseguro.com.br"><br>
		<input id="hash" type="text" name="senderHash" value=""><br>
		<input type="text" name="shippingAddressStreet" value="Av.Brig.FariaLima"><br>
		<input type="text" name="shippingAddressNumber" value="1384"><br>
		<input type="text" name="shippingAddressComplement" value="5oandar"><br>
		<input type="text" name="shippingAddressDistrict" value="JardimPaulistano"><br>
		<input type="text" name="shippingAddressPostalCode" value="01452002"><br>
		<input type="text" name="shippingAddressCity" value="SaoPaulo"><br>
		<input type="text" name="shippingAddressState" value="SP"><br>
		<input type="text" name="shippingAddressCountry" value="BRA"><br>
		<input type="text" name="shippingType" value="1"><br>
		<input id="shippingCost" type="text" name="shippingCost" value="1.00"><br>
		
		<button>Pagar</button>

	</form>

 -->

	<!-- 

	<form method="post">

		<input type="text" name="action" value="creditCard"><br>
		<input type="text" name="paymentMode" value="default"><br>
		<input type="text" name="paymentMethod" value="creditCard"><br>
		<input type="text" name="receiverEmail" value="lfelipelopesti@gmail.com"><br>
		<input type="text" name="currency" value="BRL"><br>
		<input type="text" name="itemId1" value="0001"><br>
		<input type="text" name="itemDescription1" value="NotebookPrata"><br>
		<input id="itemAmout" type="text" name="itemAmount1" value="24300.00"><br>
		<input type="text" name="itemQuantity1" value="1"><br>
		<input type="text" name="itemId2" value="0002"><br>
		<input type="text" name="itemDescription2" value="NotebookVermelho"><br>
		<input id="itemAmout2" type="text" name="itemAmount2" value="14300.00"><br>
		<input type="text" name="itemQuantity2" value="2"><br>
		<input type="text" name="notificationURL" value="https://sualoja.com.br/notifica.html"><br>
		<input type="text" name="reference" value="REF1234"><br>
		<input type="text" name="senderName" value="Jose Comprador"><br>
		<input type="text" name="senderCPF" value="22111944785"><br>
		<input type="text" name="senderAreaCode" value="11"><br>
		<input type="text" name="senderPhone" value="56273440"><br>
		<input type="text" name="senderEmail" value="c29430053830363582212@sandbox.pagseguro.com.br"><br>
		<input id="hash" type="text" name="senderHash" value=""><br>
		<input type="text" name="shippingAddressStreet" value="Av.Brig.FariaLima"><br>
		<input type="text" name="shippingAddressNumber" value="1384"><br>
		<input type="text" name="shippingAddressComplement" value="5oandar"><br>
		<input type="text" name="shippingAddressDistrict" value="JardimPaulistano"><br>
		<input type="text" name="shippingAddressPostalCode" value="01452002"><br>
		<input type="text" name="shippingAddressCity" value="SaoPaulo"><br>
		<input type="text" name="shippingAddressState" value="SP"><br>
		<input type="text" name="shippingAddressCountry" value="BRA"><br>
		<input type="text" name="shippingType" value="1"><br>
		<input id="shippingCost" type="text" name="shippingCost" value="1.00"><br>
		<input id="tokenCard" type="text" name="creditCardToken" value=""><br>
		<input type="text" name="cardNumber" value="4111111111111111"><br>
		<input type="text" name="cvv" value="013"><br>
		<input type="text" name="expirationMonth" value="12"><br>
		<input type="text" name="expirationYear" value="2026"><br>
		<label>installmentQuantity: <input id="installmentQuantity" type="text" name="installmentQuantity" value="5"></label><br>
		<label>installmentValue: <input id="installmentValue" type="text" name="installmentValue" value=""></label><br>
		<label>noInterestInstallmentQuantity: <input id="noInterestInstallmentQuantity" type="text" name="noInterestInstallmentQuantity" value="2"></label><br>
		<label>totalAmount: <input id="totalCart" type="text" name="totalCart" value="52900.00"></label><br>
		<input type="text" name="creditCardHolderName" value="Jose Comprador"><br>
		<input type="text" name="creditCardHolderCPF" value="22111944785"><br>
		<input type="text" name="creditCardHolderBirthDate" value="27/10/1987"><br>
		<input type="text" name="creditCardHolderAreaCode" value="11"><br>
		<input type="text" name="creditCardHolderPhone" value="56273440"><br>
		<input type="text" name="billingAddressStreet" value="Av.Brig.FariaLima"><br>
		<input type="text" name="billingAddressNumber" value="1384"><br>
		<input type="text" name="billingAddressComplement" value="5oandar"><br>
		<input type="text" name="billingAddressDistrict" value="JardimPaulistano"><br>
		<input type="text" name="billingAddressPostalCode" value="01452002"><br>
		<input type="text" name="billingAddressCity" value="SaoPaulo"><br>
		<input type="text" name="billingAddressState" value="SP"><br>
		<input type="text" name="billingAddressCountry" value="BRA"><br>
		
		<button>Pagar</button>

	</form>
 -->


<?php

	/**

	 METODOS FALTANDO IMPLEMENTAR
	 -> Estorno Parcial
	 */
	

	// var_dump($api->postApi(TRANSACTIONS, $shopBoleto));
	//var_dump($api->getPost(TRANSACTIONS, $shopDebito));
	
	// $result = $api->postApi(CANCELS, 'E546C3B363D84427AE33A66B75FA8B41');
	// $result = $api->postApi(REFUNDS, '1AA2B06F1F744C4691BEF5E29729DE4F', '300.00');
	// var_dump($result);
	//$link = $result['paymentLink'];
	//echo '<a href="'. $link.'" target="_blank">'. $link.'</a>';

	
	// $result = $api->getReference('REF1234');
	// var_dump($result->transactions);
	
	// $result = $api->getTransaction('9AD2EB7C866243A68C553AA7889826CF');
	// var_dump($result);
	// var_dump($result);
	 // var_dump(date('Y-m-d', strtotime('now')));
	 // die;

	 //$date1 = new DateTime(date(DATE_W3C, strtotime('2019-07-10 09:46')));
	 //var_dump($date1->format(DATE_W3C));
	 //die;

	 // $result = $api->getTransactionsData(date('2019-10-16 00:00:00'), date('Y-m-d H:i:s'), 1, 1000);
	 // $result = $api->getTransactionsData(date('2019-10-16 00:00:00'), date('Y-m-d 07:i:s'), 1, 1000);
	 // $result = $api->getTransactionsData(date('Y-m-d H:i:s', strtotime('NOW')));
	 // $result = $api->getTransactionsData(date('2019-10-18 00:00:00'), null, 1, 1000);
	 // $result = $api->getTransactionsData();
	 // var_dump($result->transactions);
	 // var_dump($result);

	// $notificationCode = filter_input(INPUT_POST, 'notificationCode', FILTER_DEFAULT);
	//var_dump($_POST["notificationCode"]);

	// $result = $api->getNotification();
	// if($result){
		
	// 	$hoje = date("Y-m-d");
	//     $hour = date("H:i:s T");
	//     $data = "Log de Notificações e consulta\r\r\r\r\n";
	//     $data .= "Hora da consulta: {$hour}\r\r\r\r\n";
	//     $data .= "Código de Notificação: {$_POST['notificationCode']}\r\r\r\r\n";
	//     $data .= "Código de Transação: {$result->code}\r\r\r\r\n";
	//     $data .= "Status de Transação: {$result->status}\r\r\r\r\n";
	//     $data .= "-------------------------------------------------------------------------------------------------------------\r\n\n";

	//     file_put_contents("LogPagSeguro.{$hoje}.txt", $data, FILE_APPEND);

	// }
	
	 // var_dump($result);
	
	
/*
	var_dump(date(DATE_W3C));
	var_dump(date(DATE_W3C, strtotime('now')));
	var_dump(date(DATE_W3C, strtotime('now -6 month')));
	var_dump(date(DATE_W3C, strtotime('2019-07-10 09:46')));

	$date1 = new DateTime(date(DATE_W3C, strtotime('2019-07-10 09:46')));
	$date2 = new DateTime(date(DATE_W3C, strtotime('2019-06-10 09:46')));
	$interval = $date1->diff($date2);
	var_dump($date1, $date2, $interval, $interval->days);

	*/
	

?>

<script type="text/javascript" src="<?= URL_DIRECTPAYMENT_PAGSEGURO; ?>"></script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="scripts.js"></script>
