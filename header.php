<?php session_start();
$_SESSION['usuario_validado'] = 'roderick';
 ?>
<script type="text/javascript" src="public/js/jquery-3.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="public/css/bootstrap-grid.css">
<link rel="stylesheet" type="text/css" href="public/css/index.css">

<div class="banner ">
	<img src="public/images/fisc.png">
	<img src="public/images/logo_utp_1_300.jpg">
</div>
<?php
	if (isset($_SESSION['usuario_validado'])) {
 ?>
	<nav class="header-nav back-red">
		<div class="row">
			<div class="col-md-2 col-12">
				<a href="">Inicio</a>
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
				<a href="">Inicio</a>
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
