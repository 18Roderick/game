<?php
require_once '../models/config.php';
class Create_database
{
	protected $pdo;
	
	public function __construct()
	{
		$this->pdo = new PDO("mysql:host=".DB_HOST.";", DB_USER , PASSWORD);
	}
	//creamos la base de datos y las tablas que necesitemos
	public function my_db()
	{
        //creamos la base de datos si no existe
		$crear_db = $this->pdo->prepare('CREATE DATABASE IF NOT EXISTS prueba COLLATE utf8_spanish_ci');							  
		$crear_db->execute();
		
		//decimos que queremos usar la tabla que acabamos de crear
		if($crear_db):
		$use_db = $this->pdo->prepare('USE prueba');						  
		$use_db->execute();
		endif;
		
		//si se ha creado la base de datos y estamos en uso de ella creamos las tablas
		if($use_db):
		//creamos la tabla usuarios
		$crear_tb_users = $this->pdo->prepare('
						CREATE TABLE IF NOT EXISTS users (
						id int(11) NOT NULL AUTO_INCREMENT,
						name varchar(100) COLLATE utf8_spanish_ci NOT NULL,
						lastname varchar(150) COLLATE utf8_spanish_ci NOT NULL,
						username varchar(100) COLLATE utf8_spanish_ci NOT NULL,
						password varchar(100) COLLATE utf8_spanish_ci NOT NULL,
						email varchar(100) COLLATE utf8_spanish_ci NOT NULL,
						registro date NOT NULL,
						fecha datetime NOT NULL,
						PRIMARY KEY (id)
					    )');							
		$crear_tb_users->execute();
		
		//creamos la tabla posts
		$crear_tb_posts = $this->pdo->prepare('
						CREATE TABLE IF NOT EXISTS posts (
						id int(11) NOT NULL AUTO_INCREMENT,
						id_user int(11) NOT NULL,
						titulo varchar(255) COLLATE utf8_spanish_ci NOT NULL,
						contenido text COLLATE utf8_spanish_ci NOT NULL,
						fecha_post datetime NOT NULL,
						PRIMARY KEY (id)
						)');							
		$crear_tb_posts->execute();
		endif;
		
	}
}
//ejecutamos la función my_db para crear nuestra bd y las tablas
$db = new Create_database();
$db->my_db();
?>
