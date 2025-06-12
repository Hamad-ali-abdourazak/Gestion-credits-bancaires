<?php
	define("db_host", "localhost");
	define("db_user", "root");
	define("db_pass", "");
	define("db_name", "db_lms");
	
	
	class db_connect{
		public $host = db_host;
		public $user = db_user;
		public $pass = db_pass;
		public $name = db_name;
		public $conn;
		public $error;
		
		
		public function connect(){
			$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
			
			if(!$this->conn){
				$this->error="ERREUR FATAL: impossible de se connecter a la base de données" . $this->connect->connect_error();
				return false;
			}
		}
		
	}
?>