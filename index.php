<?php 
	include "controles.php";
	$controles=new Controles();
	$array_controles=$controles->getControles();
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
 	<meta charset="UTF-8">
	 <title>Login</title>
	 <link rel="stylesheet" type="text/css" href="css/estilos.css?rnd=132">
	 <script type="text/css" src="js/reload.js"></script>
 </head>
 <body>
	 
	 <div class="contenedor"> 
	 <table>
		 <thead>
	 	
		 <th>num</th><th>Control</th><th>Tipo</th><th>Sucursal</th>
		 <th>F01</th>
		 <th>F02</th>
		 <th>F03</th>
		 <th>F04</th>
		 <th>F05</th>
		 <th>F06</th>
		 <th>F07</th>
		 <th>F08-F11</th>
		 <th>F12-F15</th>
		 <th><p>F16</p> <p>LS</p> </th>
		 <th><p>F17</p> <p>RS</p> </th>
		 <th><p>F18</p> <p>Boton Home</p></th>
		 <th><p>F19</p> <p>Sync up</p> </th>
		 <th>F20<p>Bumper Roto</p> </th>
		 <th><p>F41</p> <p>Jack 3.5</p> </th>
		 
		 </thead>
		 <?php 
		 $n=0;
	 	foreach($array_controles as $fila){
			$n++;
		echo "<tr><td>".$n."</td>
		<td>".$fila['control']."</td>
		<td>".$fila['tipo']."</td>
		<td>".$fila['sucursal']."</td>
			<td>";
			$res=$controles->obtener("F01",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}

			echo "</td><td>";
			$res=$controles->obtener("F02",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			
			echo"</td>";

			echo "<td>";
			$res=$controles->obtener("F03",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			
			echo"</td><td>";
			$res=$controles->obtener("F04",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			
			echo"</td>
			<td>";
			$res=$controles->obtener("F05",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			
			echo"</td><td>";
			$res=$controles->obtener("F06",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}

			echo"</td>
			<td>";
			$res=$controles->obtener("F07",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}

			echo"</td>
			<td>";
			echo $res=$controles->obtenerVarias("F08-F11",$fila['control']);			
			echo"</td>

			<td>";
			echo $res=$controles->obtenerVarias("F12-F15",$fila['control']);
			echo"</td>
			<td>";			
			$res=$controles->obtener("F16",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			echo"</td><td>";
			$res=$controles->obtener("F17",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			echo "</td><td>";
			$res=$controles->obtener("F18",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}	
			echo "</td><td>";
			$res=$controles->obtener("F19",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			echo "</td><td>";
			$res=$controles->obtener("F20",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			echo "</td><td>";
			$res=$controles->obtener("F41",$fila['control']);
			foreach($res as $dato){echo $dato['total'];}
			echo"</td></tr>";
		
													 }
			  ?>
			  </table>
	 </div>
 		
 	
 </body>
 </html>