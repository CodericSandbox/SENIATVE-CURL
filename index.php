<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="container">
	
	<h1 class="text-center">Muestra de Formulario Clientes</h1>

	<form class="form-horizontal" id="form-clientes">

		<div class="form-group has-feedback" id="rif">
		<label for="rif" class="col-sm-2 control-label">RIF</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="rif" placeholder="J000000000 - V123456789" required autocomplete="off">
		</div>
		</div>
		<div class="form-group">
		<label for="sunagro" class="col-sm-2 control-label">Código Sunagro</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="sunagro" id="sunagro" placeholder="xxxxxxxx" autocomplete="off">
		</div>
		</div>
		<div class="form-group">
		<label for="nom" class="col-sm-2 control-label">Nombre</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="nom" id="nom" placeholder="" autocomplete="off">
		</div>
		</div>

		<?php
			session_start();

			require_once "seniat.ini.php";

			if(!isset($_SESSION['captchaId']) && empty($_SESSION['captchaId']))
			{
				$_SESSION["captchaId"] = $seniat->ObtenerCaptcha();
			}
		?>

		<div class="form-group">
			<label for="nom" class="col-sm-2 control-label">Captcha</label>
			<div class="col-sm-5">
				<img src=<?php echo 'tmp/'.$_SESSION["captchaId"].'.jpg';?> alt="captcha">
			</div>
			<div class="col-sm-5">
				<input type="text" class="form-control" name="captcha" id="captcha" autocomplete="off">
			</div>		
		</div>

		<div class="form-group has-feedback">
			<div class="col-sm-offset-2 col-sm-10">
				<button type="submit" class="btn btn-default">
					Enviar
				</button>	
			</div>
		</div>
	</form>
	
</div>


<!-- Modal -->
<div id="confirmWindow" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close confirmBtn">&times;</button>
        <h4 class="modal-title">RESULTADO</h4>
      </div>
      <div class="modal-body">
        <p id="confirmMsj">Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default confirmBtn">Aceptar</button>
      </div>
    </div>

  </div>
</div>
</body>
<script src="js/jquery-3.2.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/form-clientes.js"></script>
</html>