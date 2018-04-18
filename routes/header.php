<?php session_start(); ?>



<?php 
	if (isset($_SESSION['usuario_validado'])) {
 ?> 
	<nav class="header-nav back-red">
		<a href=""></a>
		<a href=""></a>
		<a href=""></a>
		<a href=""></a>
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