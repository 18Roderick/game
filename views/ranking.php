
<?php 

$ruta = $_SERVER["DOCUMENT_ROOT"]."/game/config/";
include_once($ruta.'root.php');

include_once( ROOT.'/header.php');

print('<link rel="stylesheet" type="text/css" href="'.PUBLIC_DIR.'/css/table.css">');


if ($_SESSION['usuario_validado']) {
?>


	<div class="container-table">
		<h4 class="header-title">Listado de los mejores 20 jugadores</h4>
		<div class="control">
			<input type="text" name="user" placeholder="nombre de usuario">
			<button>Buscar</button>
		</div>

		<table class="responsive-table">
			<thead class="cyan">
				<th>Posicion</th>
				<th>Usuario</th>
				<th>Puntaje</th>
			</thead>

			<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>
				<tr>
					<td>informacion</td>
					<td>informacion</td>
					<td>informacion</td>
				</tr>

	
		</table>
	</div>

<?php	
}else{
	header('Location: '.HOST.'/views/login.php?notLogged=true');
}

?>