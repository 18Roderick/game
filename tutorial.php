<?php 
include('header.php');
if(isset($_SESSION['usuario_validado'])){

?>

<link rel="stylesheet" type="text/css" href="public/css/video.css">

<div class="video">
	<video controls id="video">
		<source src="public/videos/1. Configuración inicial de SQL y PHP.mp4" type="video/mp4">
	</video>
</div>

<script type="text/javascript">

</script>

<?php
}else{
	header('Location: http://localhost/game/login.php?notLogged=true');
}
?>