<?php 
class Conexion{
	private $host="localhost:3307";
	private $user="root";
	private $password="123456";
	private $db="cubox02";
	private $conect;	

	public function __construct(){
		$connectionString="mysql:host=".$this->host.";dbname=".$this->db.";charset=utf8";
		;
		try {
				$this->conect=new PDO($connectionString,$this->user,$this->password);
				$this->conect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
				


			} catch (Exception $e) {
				$this->conect="algo esta mal";
				echo "La falla es en ".$e->getMessage();
				
			}	
		




 }
 public function conect(){
 	return $this->conect;
 }
}


?>