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
	 	<?php 
	 	foreach($array_controles as $fila){

		echo "<table><tr> <td>".
			$fila['control']."</td><td>".
			$fila['tipo']."</td><td>".
			$fila['sucursal']."<td></tr></table>"."<br>"."<br>";
													 }
			  ?>
	 </div>
 		
 	
 </body>
 </html>