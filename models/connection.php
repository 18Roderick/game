<?php 
	include 'config.php';
	/**
	* 
	*/
	class Connection 
	{
		protected $db;
		function __construct()
		{
			$this->db = new mysqli(DB_HOST, DB_USER, PASSWORD, DB_NAME);
			if ($this->db->connect_errno) {
				echo "Fallo al conectar la base de datos".$this->db->connect_errno;
			}
			
		}
	}
 ?>