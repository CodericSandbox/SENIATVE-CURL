<?php 

	/*si no se ha presionado el boton enviar*/
	if (!isset($_POST["enviar"])) header("Location: index.php");
	
	require_once "Seniat.php";
	$seniat = new Seniat();
	$seniat->Consultar($_POST["captcha"], $_POST["rif"], $_POST["fileCaptcha"]);

	session_start();
	if (isset($_SESSION["consultaSeniat"]) && file_exists(dirname(__FILE__) . '/tmp/' .$_SESSION["consultaSeniat"].'.jpg') && file_exists(dirname(__FILE__) . '/tmp/' .$_SESSION["consultaSeniat"].'.txt')) {
		unlink(dirname(__FILE__) . '/tmp/' .$_SESSION["consultaSeniat"].'.jpg');
		unlink(dirname(__FILE__) . '/tmp/' .$_SESSION["consultaSeniat"].'.txt');
		session_destroy();	
	}

?>
