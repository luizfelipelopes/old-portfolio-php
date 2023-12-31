<?php 

namespace api\Support;

/**
 * SUPPORT
 * Classe responsável pela manipulação de API's de Pagamento (ex: Pagseguro, Paypal)
 * Class responsible for handling Payments APIs (eg Pagseguro, Paypal)
 */
class Payment
{

	private $apiUrl;
	private $apiKey;
	private $endpoint;
	private $build;
	private $callback;
	
	/**
	* Inicializa Url e Credenciais da API.
	* Initializes API Url and Credentials.
	**/
	function __construct()
	{
		$this->apiUrl = API_PAYMENT_URL;
		$this->apiKey = API_PAYMENT_KEY;
	}

	/**
	* Gera a sessão da API de pagamento.
	* Generates the payment API session.
	**/
	public function createSession()
	{
		$this->endpoint = API_PAYMENT_ENDPOINT_SESSIONS;
		$this->post();
	}

	/**
	* Recupera os dados do cartão de crédito para salvar no BD.
	* Recovers credit card data for saving to BD.
	**/
	public function createCard()
	{

	}

	/**
	* Realiza pagamento via Cartão de Crédito.
	* Make payment via Credit Card.
	**/
	public function withCard(array $build)
	{

		$this->endpoint = API_PAYMENT_ENDPOINT_TRANSACTIONS;
		$this->build = $build;
		$this->post();
		
	}

	/**
	* Realiza pagamento via Débito Online.
	* Make payment via Online Debit.
	**/
	public function withOnlineDebit(array $build)
	{
		
		$this->endpoint = API_PAYMENT_ENDPOINT_TRANSACTIONS;
		$this->build = $build;
		$this->post();

	}

	/**
	* Realiza pagamento via Boleto Bancário.
	* MMake payment via bank slip.
	**/
	public function withBillet(array $build)
	{
		
		$this->endpoint = API_PAYMENT_ENDPOINT_TRANSACTIONS;
		$this->build = $build;
		$this->post();
		
	}

	/**
	* Método responsável pela comunicação e obtenção de dados da API.
	* Method responsible for communicating and obtaining API data.
	**/
	private function post()
	{

		$header = (!empty(HEADER_X) ? [HEADER_X] : []);	
		$data = (!empty($this->build) ? http_build_query($this->build) : '');
		$url = $this->apiUrl . $this->endpoint . '?' . http_build_query($this->apiKey);

		$channel = curl_init($url);
		curl_setopt($channel, CURLOPT_POST, true);
		curl_setopt($channel, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($channel, CURLOPT_POSTFIELDS, $data);
		curl_setopt($channel, CURLOPT_HTTPHEADER, $header);
		$this->callback = curl_exec($channel);
		curl_close($channel);

	}

	/**
	* Retorna o resultado da comunicação com a API.
	* Returns the result of communicating with the API.
	**/
	public function callback()
	{
		return $this->callback;
	}


}