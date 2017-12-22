<?php

	session_start();

	if(!isset($_SESSION['captchaId'])) header("Location: index.php");

    if(!isset($_POST["rif"]) && empty($_POST["rif"])) header("Location: index.php");

	require_once "Seniat.php";
	$seniat = new Seniat();
    $dataSeniat = array();

    $dataSeniat['status'] = $seniat->Consultar($_POST["captcha"];, $_POST["rif"], $_SESSION['captchaId']);
    unlink('tmp/'.$_SESSION['captchaId'].'.jpg');
    unlink('tmp/'.$_SESSION['captchaId'].'.txt');
    session_destroy();
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($dataSeniat);
    exit();
?>
