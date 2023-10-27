<?php

namespace tests\api\correios;

/**
 * [Model]
 * Class responsible for Correios' Api.	
 */
class Correios
{
	private $indicaCalculo;
	private $retorno;
	private $error;

	
	public function __construct()
	{
		$this->indicaCalculo = '3';
		$this->retorno = 'xml';
	}


	public function apiPost(string $mode, array $data)
	{
		switch ($mode) {
			
			case PRECO_PRAZO:

				if(!empty($data)){

					if(!empty($data['nCdEmpresa']) && empty($data['sDsSenha']) || empty($data['nCdEmpresa']) && !empty($data['sDsSenha'])){

						$this->error = 'Se há contrato com os correios, você deve informar o código e a senha!';

						return;
					}

					$url = CALC_PRECO_PRAZO_CORREIOS . 
					'?nCdEmpresa=' . $data['nCdEmpresa'] . 
					'&sDsSenha=' . $data['sDsSenha'] . 
					'&sCepOrigem=' . $data['sCepOrigem'] . 
					'&sCepDestino=' . $data['sCepDestino'] . 
					'&nVlPeso=' . floatval($data['nVlPeso']) . 
					'&nCdFormato=' . intval($data['nCdFormato']) . 
					'&nVlComprimento=' . floatval($data['nVlComprimento']) . 
					'&nVlAltura=' . floatval($data['nVlAltura']) . 
					'&nVlLargura=' . floatval($data['nVlLargura']) . 
					'&sCdMaoPropria=' . floatval($data['nVlValorDeclarado']) . 
					'&sCdAvisoRecebimento=' . $data['sCdAvisoRecebimento'] . 
					'&nCdServico=' . $data['nCdServico'] . 
					'&nVlDiametro=' . floatval($data['nVlDiametro']) . 
					'&StrRetorno=' . $this->retorno . 
					'&nIndicaCalculo=' . $this->indicaCalculo;

					$options = array(CURLOPT_RETURNTRANSFER => true, CURLOPT_SSL_VERIFYPEER => false);
					$xml = $this->execCurl($url, $options);
					$answer = simplexml_load_string($xml);

					return $answer;

				}else{
					$this->error = 'Preencha as informações necessárias';
				}	

				break;

			case PRECO:
				# não disponível na API dos correios
				return 'Método indisponível na API dos Correios';

				break;

			case PRAZO:
				# não disponível na API dos correios
				return 'Método indisponível na API dos Correios';

				break;
			
			default:
				
				$this->error = 'This mode does not exists!';

				return;

				break;
		}
	}


	private function execCurl($url, array $options)
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


}