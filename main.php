<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BINGO</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
    
<body>
<?php

function casilla($num, $numeros )
{
	
	$final = end($numeros);
	
	if($final == $num){
		echo "<td class=ultimo >" . $num . "</td>";
	}else{

		if (in_array($num, $numeros)) {
			echo "<td class=marcado >" . $num . "</td>";
		}
		else{
			echo "<td>" . $num . "</td>";
		}
	}
}



session_start();
    
 if (isset($_POST['numero'])) {
          



     if (!isset($_SESSION['count'])) {

         $_SESSION['count'] = 0;
         $valores = array();
		$fuera= array();
         for($i=0;$i<90;$i++)
         {

             $valores[$i]=$i+1;
         }

         shuffle($valores);
         $_SESSION['valores']=$valores;
		 array_push($fuera,$valores[$_SESSION['count']] );
		 $_SESSION['fuera']=$fuera;

     } else {
		 $valores=$_SESSION['valores'];
		 $fuera =$_SESSION['fuera'];
         $_SESSION['count']++;
		 array_push($fuera,$valores[$_SESSION['count']] );
		 $_SESSION['fuera']=$fuera;
     }

     

     
     echo "<h1>".$valores[$_SESSION['count']]."</h1>";
    //echo var_dump($fuera);



 } else if (isset($_POST['nuevo'])) {
     session_destroy();
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
				casilla($i, $fuera );
				//echo "<td>" . $i . "</td>";
			}
		}

			if($i==10){
				if($x==8){
					casilla($res, $fuera );
					//echo "<td>" . $res . "</td>";
				}
				else
			echo "<td></td>";
			}
			else
				casilla($res, $fuera );
		//echo "<td>" . $res . "</td>";

    }
    echo "</tr>";
	
	
	
}
echo "</table>";

echo "<form action=main.php method=post>";
	if(count($fuera)==90){
		echo "<input type=submit name=numero value='Obtener Número' disabled=true/>";
	}
	else{
		echo "<input type=submit name=numero value='Obtener Número'/>";
	}
	
	print "<input type=submit name=nuevo value='Juego Nuevo'/>";
	echo "</form>";
?>


  
</body>
</html>


