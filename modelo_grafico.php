<?php
require_once("autoload.php");
	class Modelo_Grafico extends Conexion{
		

		public function __construct(){
			$this->conexion =new Conexion();
			$this->conexion=$this->conexion->conect();
		}
		public function TraerDatosGraficoBar(){
			$sql="SELECT gt.name AS 'Falla'  FROM glpi_tickets gt
            INNER JOIN glpi_items_tickets git ON git.tickets_id=gt.id 
            INNER JOIN glpi_peripherals gp ON gp.id =git.items_id WHERE gp.name ='M62'";
			$execute=$this->conexion->query($sql);
			$request=$execute->fetchall(PDO::FETCH_BOTH);
            return $request;
            
            
		}
		
			

	}

	/*$controles=new Modelo_Grafico();
	$array_controles=$controles->TraerDatosGraficoBar();
	
	foreach($array_controles as $fila){
		
		echo $fila['Falla']."<br>";
		
		
	};*/
	
	
 ?>