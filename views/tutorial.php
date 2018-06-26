<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Tutorial</title>
</head>
<body>
	

<?php 
include_once('./config.php');

if(isset($_SESSION['usuario_validado'])){

	print('
		<link rel="stylesheet" type="text/css" href="'.HOST.'/public/css/video.css">

		<div class="video">
			<video controls id="video">
				<source src="'.HOST.'/public/videos/1. Configuración inicial de SQL y PHP.mp4" type="video/mp4">
			</video>
		</div>
		
		<script type="text/javascript">
		
		</script>
	');
}else{
	header('Location: '.VIEWS.'/login.php?notLogged=true');
}
?>




</body>
</html>