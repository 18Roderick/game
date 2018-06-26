<?php session_start();
//$_SESSION['usuario_validado'] = 'roderick';

$ruta = $_SERVER["DOCUMENT_ROOT"]."/game/config/";
include_once($ruta.'root.php');


print('
		<link rel="stylesheet" type="text/css" href="'.HOST.'/public/css/bootstrap-grid.css">
		<link rel="stylesheet" type="text/css" href="'.HOST.'/public/css/index.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<div class="container-banner">
			<div class="banner ">
				<img src="'.HOST.'/public/images/fisc.png" class="left">
				<img src="'.HOST.'/public/images/logo_utp_1_300.jpg" class="right">
				<div class="game-title" id="kute">
					<h1 id="titulo"> DASLEARN</h1>
				</div>


			</div>
		</div>



');

if (isset($_SESSION['usuario_validado'])) {

    print('
		<div class="topnav back-skie" id="myTopnav">
			<a href="'.HOST.'/">Inicio</a>
			<a href="'.VIEWS.'/temas.php">Temas</a>
			<a href="'.VIEWS.'/jugar.php">Jugar</a>
			<a href="'.VIEWS.'/tutorial.php">Tutorial</a>
			<a href="#">Creditos</a>
			<a href="'.HOST.'/views/logout.php">Logout</a>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>

	');

} else {
    print('
		<div class="topnav back-skie" id="myTopnav">
			<a href="'.HOST.'/">Inicio</a>
			<a href="'.VIEWS.'/temas.php">Temas</a>
			<a href="'.VIEWS.'/jugar.php">Jugar</a>
			<a href="'.VIEWS.'/tutorial.php">Tutorial</a>
			<a href="'.VIEWS.'/creditos.php">Creditos</a>
			<a href="javascript:void(0);" class="icon" onclick="myFunction()">
				<i class="fa fa-bars"></i>
			</a>
		</div>

	');
}

?>