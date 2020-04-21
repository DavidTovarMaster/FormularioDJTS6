<?php
	class clasedb{
		private $db;
		public function conectar(){
			$this->db= new mysqli_connect("localhost","root","","programacion") or die ("no se pudo conectar con Mysql");
			return $this->db;
		}
	}

?>