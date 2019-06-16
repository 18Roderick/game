<?php
include_once './config.php';

print('<title>Tutorial</title>');

if (isset($_SESSION['usuario_validado'])) {

		print('
		
		<video class="responsive-video" controls width="853" height="480" style="margin:auto">
    	<source src="../public/videos/tutorial ppt.mp4" type="video/mp4">
  	</video>

	');
} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}
?>




