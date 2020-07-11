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
	 <link rel="stylesheet" type="text/css" href="css/estilos.css">
 </head>
 <body>
	 
	 <div class="tabla"> 
	 <table>
	 	
		 <th>num</th><th>Control</th><th>tipo</th><th>sucursal</th>
		 <th>F01</th>
		 <th>F02</th>
		 <th>F03</th>
		 <th>F04</th>
		 <th>F05</th>
		 <th>F06</th>
		 <th>F07</th>
		 <th>F08-F11</th>
		 <th>F12-F15</th>
		 <th>F16</th>
		 <th>F17</th>
		 <th>F06</th>
		 <th>F06</th>
		 <th>F06</th>

		 <?php 
		 $n=0;
	 	foreach($array_controles as $fila){
			$n++;
		echo "	
		

		
							<tr> <td>".$n."</td><td>".
							
			$fila['control']."</td><td>".
			$fila['tipo']."</td><td>".
			$fila['sucursal']."</td><td>".getFallas("F01","C100")."</td></tr>";
													 }
			  ?>
			  </table>
	 </div>
 		
 	
 </body>
 </html>