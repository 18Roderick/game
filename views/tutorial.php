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
include_once './config.php';

if (isset($_SESSION['usuario_validado'])) {

		print('
		
			<div class="container" style="margin-top: 3%;">
			<video controls id="video" class="responsive-video" width="auto" height="480">
				<source src="' . HOST . '/public/videos/1. Configuración inicial de SQL y PHP.mp4" type="video/mp4">
			</video>
			</div>
	

	');
} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}
?>




</body>
</html>