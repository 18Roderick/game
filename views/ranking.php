
<?php 
$ruta = $_SERVER["DOCUMENT_ROOT"]."/game/config/";
include_once($ruta.'root.php');

include_once( ROOT.'/header.php');

print('<link rel="stylesheet" type="text/css" href="'.PUBLIC_DIR.'/css/table.css">');


if ($_SESSION['usuario_validado']) {
?>


	<div class="container-table">
		<h1 class="header-title">Listado de los mejores 20 jugadores</h1>
		<div class="control">
			<input type="text" name="user" placeholder="nombre de usuario">
			<button>Buscar</button>
		</div>

		<table class="table">
			<tr>
				<th>Posicion</th>
				<th>Usuario</th>
				<th>Puntaje</th>
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
	header('Location: '.HOST.'/login.php?notLogged=true');
}

?>