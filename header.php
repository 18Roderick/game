<?php
session_start();
//$_SESSION['usuario_validado'] = 'roderick';

$ruta = $_SERVER["DOCUMENT_ROOT"] . "/game/config/";
include_once $ruta . 'root.php';

$rutaPeticion = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//echo $_SERVER['REQUEST_URI'];

print('
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/index.css">
		<link rel="stylesheet" type="text/css" href="' . HOST . '/public/css/materialize.min.css">
		
		<script type="text/javascript" src="' . HOST . '/public/js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="' . HOST . '/public/js/materialize.min.js"></script>
		
		<script type="text/javascript" src="' . HOST . '/public/js/main.js"></script>
		<script src="' . HOST . '/public/js/sweetalert.min.js"></script>

		<div class="container-banner">
			<div class="banner ">
				<img src="' . HOST . '/public/images/fisc.png" class="left">
				<img src="' . HOST . '/public/images/logo_utp_1_300.jpg" class="right">
				<div class="game-title" id="kute">
					<h1 id="titulo"> DASLEARN</h1>
				</div>


			</div>
		</div>



');

if (isset($_SESSION['usuario_validado'])) {

    print('
		<div class="navbar-game">
			<!-- Dropdown Structure -->
			<ul id="dropdown1" class="dropdown-content">
				<li>
					<a href="javascript:void(0);">Perfil</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="' . HOST . '/views/logout.php">Cerrar sesion</a>
				</li>
		
			</ul>
			<nav>
				<div class="nav-wrapper  cyan flow-text">
						<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
						<ul id="nav-mobile" class="left hide-on-med-and-down">
								<li><a href="' . HOST . '/">Inicio</a></li>
								<li><a href="' . VIEWS . '/temas.php">Temas</a></li>
								<li><a href="' . VIEWS . '/tutorial.php">Tutorial</a></li>
								<li><a href="' . VIEWS . '/ranking.php">Ranking</a></li>
								<li><a href="' . VIEWS . '/jugar.php">Jugar</a></li>
								<li><a href="' . VIEWS . '/creditos.php"">Creditos</a></li>
						</ul>
					<ul class="right hide-on-med-and-down">
						<!-- Dropdown Trigger -->
						<li>
							<a class="dropdown-trigger " href="javascript:void(0);" data-target="dropdown1">'.$_COOKIE['user'].'
							
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<ul class="sidenav" id="mobile-demo">
					<li><a href="' . HOST . '/">Inicio</a></li>
					<li><a href="' . VIEWS . '/temas.php">Temas</a></li>
					<li><a href="' . VIEWS . '/tutorial.php">Tutorial</a></li>
					<li><a href="' . VIEWS . '/ranking.php">Ranking</a></li>
					<li><a href="' . VIEWS . '/jugar.php">Jugar</a></li>
					<li><a href="' . VIEWS . '/creditos.php"">Creditos</a></li>
					<li><a href="' . VIEWS . '/logout.php"">Cerra sesion</a></li>
				</ul>
			
		</div>

	');

} else if (isset($_SESSION['usuario_admin'])) {

    print('
		<div class="navbar-game">
			<!-- Dropdown Structure -->
			<ul id="dropdown1" class="dropdown-content">
				<li>
					<a href="javascript:void(0);">Perfil</a>
				</li>
				<li class="divider"></li>
				<li>
					<a href="' . HOST . '/views/logout.php">Cerrar sesion</a>
				</li>
		
			</ul>
			<nav>
				<div class="nav-wrapper  cyan flow-text">
						<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
						<ul id="nav-mobile" class="left hide-on-med-and-down">
								<li><a href="' . HOST . '/">Inicio</a></li>
								<li><a href="' . VIEWS . '/mantenimiento.php">Temas</a></li>
								<li><a href="' . VIEWS . '/tutorial.php">Tutorial</a></li>
						</ul>
					<ul class="right hide-on-med-and-down">
						<!-- Dropdown Trigger -->
						<li>
							<a class="dropdown-trigger " href="javascript:void(0);" data-target="dropdown1">Roderick Romero
							
							</a>
						</li>
					</ul>
				</div>
			</nav>
			<ul class="sidenav" id="mobile-demo">
					<li><a href="' . HOST . '/">Inicio</a></li>
					<li><a href="' . VIEWS . '/mantenimiento.php">Temas</a></li>
					<li><a href="' . VIEWS . '/tutorial.php">Tutorial</a></li>

				</ul>
			
		</div>

');

} else {
    print('
		<div class="navbar-game">
			<nav>
				<div class="nav-wrapper  cyan flow-text">
						<a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
						<ul id="nav-mobile" class="left hide-on-med-and-down">
								<li><a href="' . HOST . '/">Inicio</a></li>
								<li><a href="' . VIEWS . '/temas.php">Temas</a></li>
								<li><a href="' . VIEWS . '/tutorial.php">Tutorial</a></li>
								<li><a href="' . VIEWS . '/ranking.php">Ranking</a></li>
								<li><a href="' . VIEWS . '/jugar.php">Jugar</a></li>
								<li><a href="' . VIEWS . '/creditos.php"">Creditos</a></li>
						</ul>
				</div>
			</nav>
			<ul class="sidenav" id="mobile-demo">
					<li><a href="' . HOST . '/">Inicio</a></li>
					<li><a href="' . VIEWS . '/temas.php">Temas</a></li>
					<li><a href="' . VIEWS . '/tutorial.php">Tutorial</a></li>
					<li><a href="' . VIEWS . '/ranking.php">Ranking</a></li>
					<li><a href="' . VIEWS . '/jugar.php">Jugar</a></li>
					<li><a href="' . VIEWS . '/creditos.php"">Creditos</a></li>
				</ul>
			
		</div>
	
	');
}


?>