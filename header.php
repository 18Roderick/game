<?php session_start();
$_SESSION['usuario_validado'] = 'roderick';


 ?>
<script type="text/javascript" src="public/js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="public/js/main.js"></script>
<script type="text/javascript" src='public/js/box.js'></script>
<link rel="stylesheet" type="text/css" href="public/css/bootstrap-grid.css">
<link rel="stylesheet" type="text/css" href="public/css/index.css">
<link rel="stylesheet" type="text/css" href="public/css/form.css">
<div class="container-banner">
	<div class="banner ">
		<img src="public/images/fisc.png" class="left">
		<img src="public/images/logo_utp_1_300.jpg" class="right">
		<h1 class="title">
			Desarrollo de Software Adaptativo
		</h1>
	</div>
</div>
<?php
	if (isset($_SESSION['usuario_validado'])) {
 ?>
	<nav class="header-nav back-skie">
		<div class="row">
			<div class="col-md-2 col-12">
				<a href="/game">Inicio</a>
			</div>
			<div class="col-md-2 col-12">
				<a href="">Documentacion</a>
			</div>
			<div class="col-md-2 col-12">
				<a href="">Jugar</a>
			</div>
			<div class="col-md-2 col-12">
				<a href="">Perfil</a>
			</div>
		</div>	
		
		
		
	</nav>

<?php

}else{
 ?>
	<nav class="header-nav back-red">
		<div class="row">
			<div class="col-sm-12 col-md-1">
				<a href="/game">Inicio</a>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-md-1">
				<a href="">Documentacion</a>
			</div>
		</div>
	</nav>

<?php
}
?>
