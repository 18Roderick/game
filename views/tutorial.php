<?php
include_once './config.php';

print('<title>Tutorial</title>');

if (isset($_SESSION['usuario_validado'])) {

		print('
		
	

	');
} else {
    header('Location: ' . VIEWS . '/login.php?notLogged=true');
}
?>




