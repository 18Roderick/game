<link rel="stylesheet" type="text/css" href="../public/css/index.css">
<?php 
include('header.php');
if ($_SESSION['usuario_validado']) {
?>
	<h1 class="header-title">Ranking</h1>
	<div class="search">
		<input type="text" name="user" placeholder="nombre de usuario">
		<button>Buscar</button>
	</div>

	<div class="ranking-table">
		<table>
			<tr>
				<th>Posicion</th>
				<th>Usuario</th>
				<th>Puntaje</th>
			</tr>
		</table>
	</div>

<?php	
}

?>