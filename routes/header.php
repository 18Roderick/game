<?php session_start();
$_SESSION['usuario_validado'] = 'roderick';
 ?>

<link rel="stylesheet" type="text/css" href="public/css/index.css">
<div class="banner">
	
</div>
<?php
	if (isset($_SESSION['usuario_validado'])) {
 ?>
	<nav class="header-nav back-red">
		<a href="">Inicio</a>
		<a href="">Documentacion</a>
		<a href="">Jugar</a>
		<a href="">Perfil</a>
	</nav>

<?php

}else{
 ?>
	<nav class="header-nav back-red">
		<a href="">Inicio</a>
		<a href="">Documentacion</a>
	</nav>

<?php
}
?>
