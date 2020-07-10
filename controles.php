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
 ?>