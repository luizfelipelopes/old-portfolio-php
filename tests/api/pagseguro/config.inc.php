<?php 

	define ('ENV_PAGSEGURO', 'sandbox'); // Ambiente

	if (ENV_PAGSEGURO == 'sandbox') {
		define ('API_PAYMENT_URL', 'https://ws.sandbox.pagseguro.uol.com.br/');
		define ('EMAIL_PAGSEGURO', 'lfelipelopesti@gmail.com');
		define ('TOKEN_PAGSEGURO', 'A1341A9E7F7F48979BDFD8666D9FDBBE');
		define ('URL_DIRECTPAYMENT_PAGSEGURO', 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js');

		/*			
		define ('URL_HEADER_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br');
		define ('URL_SESSION_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/v2/sessions');
		define ('URL_TRANSACTION_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions');
		define ('URL_TRANSACTION_PAGSEGURO_V3', 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions');
		define ('URL_CANCELS_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/cancels');
		define ('URL_REFUNDS_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/v2/transactions/refunds');
		define ('URL_NOTIFICATIONS_PAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications');
		*/
		
	}else{
		define ('API_PAYMENT_URL', 'https://ws.pagseguro.uol.com.br/');
		define ('EMAIL_PAGSEGURO', 'lfelipelopesti@gmail.com');
		define ('TOKEN_PAGSEGURO', 'FCE16581F58F400FB2FE3062FC015A2A');
		define ('URL_DIRECTPAYMENT_PAGSEGURO', 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js');

		/*
		define ('URL_HEADER_PAGSEGURO', 'https://ws.pagseguro.uol.com.br');
		define ('URL_SESSION_PAGSEGURO', 'https://ws.pagseguro.uol.com.br/v2/sessions');
		define ('URL_TRANSACTION_PAGSEGURO', 'https://ws.pagseguro.uol.com.br/v2/transactions');
		define ('URL_TRANSACTION_PAGSEGURO_V3', 'https://ws.pagseguro.uol.com.br/v3/transactions');
		define ('URL_CANCELS_PAGSEGURO', 'https://ws.pagseguro.uol.com.br/v2/transactions/cancels');
		define ('URL_REFUNDS_PAGSEGURO', 'https://ws.pagseguro.uol.com.br/v2/transactions/refunds');
		define ('URL_NOTIFICATIONS_PAGSEGURO', 'https://ws.pagseguro.uol.com.br/v3/transactions/notifications');
		*/
		
	}

	/** Headers **/
	define ('HEADER_X', 'Content-Type: application/x-www-form-urlencoded; charset=ISO-8859-1');
	define ('HEADER_XML', 'Content-Type: application/xml; charset=ISO-8859-1');

	/** Keys **/
	define ('API_PAYMENT_KEY', ['email' => EMAIL_PAGSEGURO, 'token' => TOKEN_PAGSEGURO]);

	/** Endpoints **/	
	define ('API_PAYMENT_ENDPOINT_SESSIONS', 'v2/sessions');
	define ('API_PAYMENT_ENDPOINT_TRANSACTIONS', 'v2/transactions');
	define ('API_PAYMENT_ENDPOINT_TRANSACTIONS_V3', 'v3/transactions');
	define ('API_PAYMENT_ENDPOINT_CANCELS', 'v2/transactions/cancels');
	define ('API_PAYMENT_ENDPOINT_REFUNDS', 'v2/transactions/refunds');
	define ('API_PAYMENT_ENDPOINT_NOTIFICATIONS', 'v3/transactions/notifications');

	/*
	define ('SESSIONS', 'sessions');
	define ('TRANSACTIONS', 'transactions');
	define ('CANCELS', 'cancels');
	define ('REFUNDS', 'refunds');
	*/

?>