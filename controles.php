<?php 
	require_once("autoload.php");
	class Controles extends Conexion{
		private $strNombre;
		private $apaterno;
		private $amaterno;
		private $conexion; 

		public function __construct(){
			$this->conexion =new Conexion();
			$this->conexion=$this->conexion->conect();
		}
		public function getcontroless(){
			$sql="SELECT * FROM amigos";
			$execute=$this->conexion->query($sql);
			$request=$execute->fetchall(PDO::FETCH_ASSOC);
			return $request;
		}



		public function	getControles(){
				$sql="SELECT t1.name AS 'control',t2.name AS 'tipo',t3.name AS 'sucursal' FROM glpi_peripherals t1
				  INNER JOIN glpi_peripheraltypes t2 ON t1.peripheraltypes_id = t2.id
				  INNER JOIN glpi_locations t3 ON t1.locations_id = t3.id WHERE peripheraltypes_id IN 
				    (SELECT id FROM glpi_peripheraltypes WHERE NAME = 'Control Xbox One' ) 
				    AND  t1.locations_id IN (SELECT id FROM glpi_locations WHERE NAME LIKE 'centro') 
				    AND states_id IN (SELECT id  FROM glpi_states WHERE NAME NOT IN ('baja') 
                        AND NAME NOT IN('malo')) ORDER BY t1.name";
					$resultado=$this->conexion->query($sql);
					$controles=$resultado->fetchall(PDO::FETCH_ASSOC);
					return $controles;

			}
			/* Obtener una falla*/
			public function obtener(string $falla,string $control){
				$this->falla=$falla;
				$this->Ncontrol=$control;
	
				$sql="SELECT COUNT(gt.name) as total FROM glpi_tickets gt WHERE gt.name = ? AND gt.id IN
				(SELECT git.tickets_id FROM glpi_items_tickets git WHERE git.items_id= ANY
				  (SELECT gp1.id FROM glpi_peripherals gp1 WHERE gp1.name= ? ))";
				
				$arrWhere=array($this->falla,$this->Ncontrol);
				$query=$this->conexion->prepare($sql);
				 
				$query->execute($arrWhere);
				$request=$query->fetchall(PDO::FETCH_ASSOC);
				
				
				return $request;
				}
				/*obtener varias fallas */ 
				public function obtenerVarias(string $falla,string $control){
					$this->falla=$falla;
					$this->Ncontrol=$control;
					$sql="SELECT gt.name AS 'Falla' FROM glpi_tickets gt INNER JOIN glpi_items_tickets git ON git.tickets_id=gt.id 
					INNER JOIN glpi_peripherals gp ON gp.id =git.items_id WHERE gp.name = ? ";

					$arrWhere=array($this->Ncontrol);
					$query=$this->conexion->prepare($sql);
					
					$query->execute($arrWhere);
					$result=$query->fetchall(PDO::FETCH_ASSOC);
					$falla=0;
					if ($falla =='F08-F11'){
						foreach($result as $fila){
							if($fila['Falla']=='F08' or $fila['Falla']=='F09' or $fila['Falla']=='F10' or $fila['Falla']=='F11')
							{
								$falla=$falla+1;
								
							}
						}
					}elseif($falla =='F12-F15'){
						foreach($result as $fila){
							if($fila['Falla']=='F12' or $fila['Falla']=='F13' or $fila['Falla']=='F14' or $fila['Falla']=='F15')
							{
								$falla=$falla+1;
								
							}
					}
					}
					return $falla;
				}
				
		public function getFallas(string $falla, string $control){
				$this->falla=$falla;
				$this->Ncontrol=$control;

				$sql="SELECT COUNT(gt.name) FROM glpi_tickets gt WHERE gt.name = '?' AND gt.id IN
				(SELECT git.tickets_id FROM glpi_items_tickets git WHERE git.items_id=
  				(SELECT gp1.id FROM glpi_peripherals gp1 WHERE gp1.name='?' ))";
				
				$arrWhere=array($this->falla,$this->Ncontrol);
				$query=$this->conexion->prepare($sql);
				$query->execute($arrWhere);
				$request=$query->fetchall(PDO::FETCH_ASSOC);
				return $request;
				}
			public function getUser(int $id){
			$sql="select * from amigos where id=?";
			$arrWhere=array($id);
			$query=$this->conexion->prepare($sql);
			$query->execute($arrWhere);
			$request=$query->fetch(PDO::FETCH_ASSOC);
			return $request;

		}


		public function insertarUsuario(string $nombre,string $paterno,string $materno)
		{
			$this->strNombre=$nombre;
			$this->apaterno=$paterno;
			$this->amaterno=$materno;

			$sql="INSERT INTO amigos(nombres,apaterno,amaterno) VALUES(?,?,?)";
			$insert=$this->conexion->prepare($sql);
			$arrData=array($this->strNombre,$this->apaterno,$this->amaterno);
			$restInsert=$insert->execute($arrData);
			$idInsert=$this->conexion->lastInsertid();

			return $idInsert;
		}
		public function getUsuarios(){
			$sql="SELECT * FROM amigos";
			$execute=$this->conexion->query($sql);
			$request=$execute->fetchall(PDO::FETCH_ASSOC);
			return $request;
		}
		public function updateUsuario(int $id,string $nombre,string $paterno,string $materno)
		{	
			$this->id=$id;
			$this->strNombre=$nombre;
			$this->apaterno=$paterno;
			$this->amaterno=$materno;
			$sql="UPDATE amigos SET nombres=?, apaterno=?, amaterno=? where id=$id";
			$update=$this->conexion->prepare($sql);
			$arrData=array($this->strNombre,$this->apaterno,$this->amaterno);
			$resExcute=$update->execute($arrData);
			return $resExcute;

		}
		
		public function delUser(int $id)
		{
			$sql="DELETE FROM amigos WHERE id=?";
			$arrWhere=array($id);
			$delete=$this->conexion->prepare($sql);
			$del=$delete->execute($arrWhere);
			return $del;
		}

	}

	/*$controles=new Controles();
	$array_controles=$controles->obtenerVarias("F08-F11","M62");
	$falla=0;
	foreach($array_controles as $fila){
		
		if($fila['Falla']=='F08' or $fila['Falla']=='F09' or $fila['Falla']=='F10' or $fila['Falla']=='F11'){
			$falla=$falla+1;
			echo $fila['Falla']. "<br>";
		}
		
		
	};
	echo "suma de fallas = ".$falla;
	*/
 ?>