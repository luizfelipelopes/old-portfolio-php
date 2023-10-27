<?php 

/**
 * [MODEL]
 * api.class
 * Class test for get api's
 */

namespace tests\api\pagseguro;

class api {
	
	private $post;
	private $get;
	private $token;
	private $email;
	private $url;
	private $session;
	private $error;


	public function __construct()
	{

		$this->token = TOKEN_PAGSEGURO;
		$this->email = EMAIL_PAGSEGURO;
	}

	public function postApi($mode, $data = null, $value = null)
	{
		
		switch ($mode) {
			
			case SESSIONS:
			
				$url = URL_SESSION_PAGSEGURO.'?email='.$this->email.'&token='.$this->token;
				$options = array(CURLOPT_POST => 1, CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);
				$answer = $this->exeCurl($url, $options);

			break;	

			case TRANSACTIONS:

				$data = http_build_query($data);
				$headers = array(HEADER_X);
				$url = URL_TRANSACTION_PAGSEGURO.'?email='.$this->email.'&token='.$this->token;
				$options = array(CURLOPT_POST => true, CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER => true, 
					CURLOPT_SSL_VERIFYPEER => false, CURLOPT_POSTFIELDS => $data, CURLOPT_HEADER => false);
				$answer = $this->exeCurl($url, $options);
				$answer = json_decode(json_encode(simplexml_load_string($answer)), true);

			break;

			case CANCELS:

				if(!empty($data)){
					
					$headers = array(HEADER_X);
					$url = URL_CANCELS_PAGSEGURO.'?email='.$this->email.'&token='.$this->token . '&transactionCode='. $data;
					$options = array(CURLOPT_POST => 1, CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER => true, 
						CURLOPT_SSL_VERIFYPEER => false);				
					$answer = $this->exeCurl($url, $options);

				}else{
					$this->error = "Transaction Code doesn't exists!";
					$answer = null;
				}
				

			break;

			case REFUNDS:
				// Estorno Parcial não funciona em sandbox. Descobrir por que!
				if(!empty($data)){
					
					$partial  = (!empty($value) ? '&refundValue=' . $value : '');
					$headers = array(HEADER_X);
					$url = URL_REFUNDS_PAGSEGURO.'?email='.$this->email.'&token='.$this->token . '&transactionCode='. $data . $partial;
					$options = array(CURLOPT_POST => 1, CURLOPT_HTTPHEADER => $headers, CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);
					$answer = $this->exeCurl($url, $options);					

				}else{
					$this->error = "Transaction Code doesn't exists!";
					$answer = null;
				}
				

			break;
			
			default:
				$this->error = 'This mode does not exist';
				$answer = null;
			break;
		}
		
		

		return $answer;
	}



	public function getNotification()
	{
		if(isset($_POST['notificationCode']) && $_POST['notificationType'] == 'transaction'){
			
			$url = URL_NOTIFICATIONS_PAGSEGURO. '/' . $_POST['notificationCode'] . '?email='.$this->email.'&token='.$this->token;
			$options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);
			$answer = $this->exeCurl($url, $options);
			$answer = simplexml_load_string($answer);

		return $answer;	

		}else{
			$this->error = 'No one notificationCode available';
			return;
		}
	}

	public function getReference($reference)
	{
		if(!empty($reference)){
			
			$url = URL_TRANSACTION_PAGSEGURO. '?email='.$this->email.'&token='.$this->token . '&reference=' . $reference;
			$options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);	
			$answer = $this->exeCurl($url, $options);
			$answer = simplexml_load_string($answer);

		return $answer;	
		
		}else{

			$this->error = 'No one reference founded!';
			return;
		}
	}

	public function getTransaction($transaction)
	{
		if(!empty($transaction)){
			
			$url = URL_TRANSACTION_PAGSEGURO_V3. '/' . $transaction .  '?email='.$this->email.'&token='.$this->token;
			$options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);	
			$answer = $this->exeCurl($url, $options);
			$answer = simplexml_load_string($answer);

		return $answer;	
		
		}else{
			$this->error = 'No one transaction founded!';
			return;
		}
	}

	public function getTransactionsData($initialDate = null, $finalDate=null, $page=null, $maxPageResults=null)
	{
		
		$initialDate = (!empty($initialDate) ? new DateTime(date(DATE_W3C, strtotime($initialDate))) : null);
		$finalDate = (!empty($finalDate) ? new DateTime(date(DATE_W3C, strtotime($finalDate))) : null);
		$page = (!empty($page) ? '&page=' . $page : '');
		$maxPageResults = (!empty($maxPageResults) ? '&maxPageResults=' . $maxPageResults : '');

		if(!empty($initialDate) && !empty($finalDate)){

			$interval = $initialDate->diff($finalDate);
			$sixMonths = new DateTime(date(DATE_W3C, strtotime('- 6 month +2 days')));

			if($initialDate < $sixMonths){
				$this->error = 'more than 6 months';
				return;
			}

			if($interval->days > 30){
				$this->error = 'more than 30 days interval';
				return;
			}

			$initialDate = $initialDate->format(DATE_W3C);
			$finalDate = $finalDate->format(DATE_W3C);

			$url = URL_TRANSACTION_PAGSEGURO .  '?email='. $this->email .'&token='. $this->token . '&initialDate=' . $initialDate . '&finalDate='. $finalDate . $page . $maxPageResults;
			$options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);	
			$answer = $this->exeCurl($url, $options);
			$answer = simplexml_load_string($answer);

		return $answer;	
		
		}elseif(!empty($initialDate) && empty($finalDate)){

			$sixMonths = new DateTime(date(DATE_W3C, strtotime('- 6 month +2 days')));

			if($initialDate < $sixMonths){
				$this->error = 'more than 6 months';
				return;
			}

			$initialDate = $initialDate->format(DATE_W3C);

			$url = URL_TRANSACTION_PAGSEGURO . '?email='. $this->email .'&token='. $this->token . '&initialDate=' . $initialDate . $page . $maxPageResults;
			$options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);	
			$answer = $this->exeCurl($url, $options);
			$answer = simplexml_load_string($answer);

			return $answer;

		}else{
			$this->error = 'Initial Data is required!';
			return;
		}

	}

	private function exeCurl($url, $options = [])
	{
		$curl = curl_init($url);
		curl_setopt_array($curl, $options);
		$answer = curl_exec($curl);
		curl_close($curl);

		return $answer;
	}

	public function error()
	{
		return $this->error;
	}

	public function getToken()
	{
		return $this->token;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getUrl()
	{
		return $this->url;
	}

	public function getSession()
	{
		return $this->session;
	}


}