<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BINGO</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
    
<body>
<?php

    
 if (isset($_POST['numero'])) {
          Echo "Se ha pulsado numero";
     } else if (isset($_POST['nuevo'])) {
          Echo "Se ha nuevo";
     }

/**
 * Created by PhpStorm.
 * User: alumno
 * Date: 18/11/15
 * Time: 13:22
 */
 
echo "BINGO";
echo "<table border='3'>";
for($i=0 ;$i<=10 ;$i++){
echo "<tr>";

    for($x=1 ;$x<=8 ;$x++){
		$res=($x * 10 + $i);
		
        if($x==1){
			if($i==0 or $i==10){
				echo "<td></td>";
			}
			else{
				echo "<td>" . $i . "</td>";
			}
		}
			
				
			
		
			if($i==10){
				if($x==8){
					
					echo "<td>" . $res . "</td>";

				}
				else
			echo "<td></td>";
			}
			else
			echo "<td>" . $res . "</td>";

    }
    echo "</tr>";
}


echo "</table>";
?>
<form action="main.php" method="post">
<input type="submit" name="numero" value="Obtener Número"/>
<input type="submit" name="nuevo" value="Juego Nuevo"/>    
</body>
</html>


