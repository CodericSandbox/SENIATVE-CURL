<?php
	/*==============================================
	|												|
	|		SENIAT cURL Libreria v1.0				|
	|										    	|
	|		Realizado por:							|
	|		[*] Edgar F. Marquez C. @OneBlaack		|
	|		[*] Bryan Bencomo						|
	|												|
	|		www.bitechstudio.es						|	
	|		Equipo de desarrollo de Bitech Studio   |
	|		2017									| 				
	|===============================================|*/	
class Seniat
{
	private $url_captcha = 'http://contribuyente.seniat.gob.ve/BuscaRif/Captcha.jpg';
	private $url_solicitud = 'http://contribuyente.seniat.gob.ve/BuscaRif/BuscaRif.jsp';

	public function ObtenerCaptcha()
	{
		$idFile = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
		$Conexion = curl_init($this->url_captcha);
		$Archivo = fopen('tmp/'.$idFile.'.jpg', 'wb');
		curl_setopt($Conexion, CURLOPT_FILE, $Archivo);
		curl_setopt($Conexion, CURLOPT_COOKIEJAR, dirname(__FILE__).'/tmp/'.$idFile.'.txt');
		curl_exec($Conexion);
		curl_close($Conexion);
		fclose($Archivo);
		return $idFile;
	}
	public function Consultar($codigo,$rif, $idFile)
	{
		$Conexion = curl_init($this->url_solicitud);
  		curl_setopt($Conexion, CURLOPT_POST, 1);
  		curl_setopt($Conexion, CURLOPT_POSTFIELDS,http_build_query(array(
		'codigo' => $codigo,//Captcha
  		'p_rif' => $rif //RIF
  		)));
  		curl_setopt($Conexion, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($Conexion, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/tmp/' .$idFile.'.txt');
  		$resultado = curl_exec($Conexion);
  		return $this->Comprobar($resultado);
	}
	public function Comprobar($html)
	{

		if(strpos($html,'No existe el contribuyente solicitado')){

			return 0;

		}else if(strpos($html,"digo no coincide con la imagen")){

			return -1;

		}else {
			/*existe*/			
			return 1;
		}


	}
}

?>
