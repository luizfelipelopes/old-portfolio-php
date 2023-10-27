<?php require_once "../bibliotecas/PagSeguroLibrary/PagSeguroLibrary.php"; ?>





<?php

/*MÉTODOS DE INTEGRAÇÃO PARA O PAGSEGURO*/
		$paymentRequest = new PagSeguroPaymentRequest();
		$paymentRequest -> addItem(1, 'Tapete Smyrna', 2, 426.00);
		$paymentRequest -> setSender(
			'Analice da Silva',
			'cooperativaartesanal@yahoo.com.br',
			38,
			35315249

			);

		$paymentRequest -> setShippingAddress(

			'01452002',
			'Av. Brig. Faria Lima',
			'1384',
			'apto. 114',
			'Jardim Paulistano',
			'São Paulo',
			'SP',
			'BRA'

			);



		// Add checkout metadata information
        $paymentRequest->addMetadata('PASSENGER_CPF', '15600944276', 1);
        $paymentRequest->addMetadata('GAME_NAME', 'DOTA');
        $paymentRequest->addMetadata('PASSENGER_PASSPORT', '23456', 1);

		$paymentRequest -> setCurrency("BRL");
		$paymentRequest -> setShippingType(1);
		$paymentRequest -> setReference(1);

		$credentials = new PagSeguroAccountCredentials(
			'lfelipelopesti@gmail.com',
			'FCE16581F58F400FB2FE3062FC015A2A'
		);

		


		$url = $paymentRequest -> register($credentials);

		 header("Location: $url");

	

?>

	
