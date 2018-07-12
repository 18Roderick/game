
<?php

$ruta = $_SERVER["DOCUMENT_ROOT"] . "/game/config/";
include_once $ruta . 'root.php';

include_once ROOT . '/header.php';

require_once ROOT.'/models/Usuario.php';

print('<title>Ranking</title>');

//print('<link rel="stylesheet" type="text/css" href="' . PUBLIC_DIR . '/css/table.css">');

if ($_SESSION['usuario_validado']) {

	$Ranking = new Usuario();

	$ranking = $Ranking->cargar_ranking();
	//echo var_dump($preguntas);
	$cont = 1;

    print('
		<div class="container">
		<h4  algin="center">Listado de los mejores 20 jugadores</h4>
		<div class="control input-field">
			<input type="text" name="user" id="user" placeholder="Escriba el nombre de usuario">
			<label for id="user"></label>
		</div>

		<table class="responsive-table highlight centered">
			<thead>
				<th>Posicion</th>
				<th>Usuario</th>
				<th>Puntaje</th>
			</thead>
	');


		if(count($ranking) > 0){
			foreach ($ranking as $key => $usuario) {
				print('
				<tr>
				<td>'.$cont.'</td>
				<td>'.$usuario['username'].'</td>
				<td>'.$usuario['puntaje'].'</td>
				</tr>
	
				');
				$cont++;
			}

			
		}


    print('
			</table>
		</div>
	');

} else {
    header('Location: ' . HOST . '/views/login.php?notLogged=true');
}

?>