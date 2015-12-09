<!DOCTYPE HTML>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>BINGO</title>
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
</head>
    
<body>
<?php
session_start();
function casilla($num, $numeros)
{
	$final = end($numeros);//sacamos el último ya que el que coincida con este llevara otra clase(css)
	//Dependiendo de si es el último o otro se le asigna una clase(css) u otra
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
$totalJugados= 0;
$repetidos=0;
$contadorAcertados=0;
$comprobarLinea=0;
///comprobamos los numeros si estan repetidos o si no son 15 saltara error
 if (isset($_POST['comprobar'])){
	  $fuera =$_SESSION['fuera'];
	 //$num= $_POST['1_1'];
     $jugados= array(); 
	 
	  //echo $num;
	   for ($i = 1; $i <= 3; $i++) {
		   $contadorLinea=0;
            for ($j = 1; $j <= 9; $j++) {
                //se comprueba si es distinto de 0 y si esta dentro del array para comprobar si estan repetidos
				
				if($_POST[$i."_".$j]!=0){
					if(in_array($_POST[$i."_".$j],$jugados))$repetidos++;
					if(in_array($_POST[$i."_".$j],$fuera))$contadorAcertados++;
					if(in_array($_POST[$i."_".$j],$fuera))$contadorLinea++;
				}
				if($contadorLinea==5){
					$comprobarLinea =1;
				}
				
				array_push($jugados,$_POST[$i."_".$j] );
				if($_POST[$i."_".$j] != 0)$totalJugados++;
				
			}
            
        }
		$_SESSION['jugados']=$jugados;
	   //var_dump($jugados);
 }

 if (isset($_POST['numero'])) {
 
     if (!isset($_SESSION['count'])) {

         $_SESSION['count'] = 0;
         $valores = array();
		$fuera= array();
         for($i=0;$i<90;$i++)
         {

             $valores[$i]=$i+1;
         }
		//solo generamos los aletorios la primera vez y los mezclamos
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
		 //$fuera guarda solo los numeros que han ido saliendo se utiliza tambien para comprobar cuando se recorren los inputs 
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
//generamos la tabla con la funcion casilla solo para los casos de números que hayan salido anteriormente
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
		if($contadorAcertados!=15){
			echo "<input type=submit name=numero value='Obtener Número'/>";
		}
	}
	
	print "<input type=submit name=nuevo value='Juego Nuevo'/>";
	echo "<br><div id=carton>";
	$cnt=0;
	for ($i = 1; $i <= 3; $i++) {
            for ($j = 1; $j <= 9; $j++) {
				
				if (!isset($_SESSION['jugados'])){
					print  "<input type=text name='".$i."_".$j."'/>";
				}
				
				else{
					$jugados=$_SESSION['jugados'];
					if($jugados[$cnt]==0 ){
						print  "<input type=text name='".$i."_".$j."'/>";
						$cnt++;
					}else
					{
						print  "<input type=text name='".$i."_".$j."' value=".$jugados[$cnt]."   />";
						$cnt++;
					}
				}
				
			}
            echo "<br/>";
        }
		echo "</div>";
		if($contadorAcertados!=15){
			print "<input type=submit name=comprobar value='Comprobar'/>";
		}	
	echo "</form>";
	
	if($totalJugados!=15 and isset($_SESSION['jugados']) )echo "<h3>Te faltan o te sobran números</h3>"; 
	if($repetidos!=0 and isset($_SESSION['jugados']))echo "<h3>Has repetido números revisa tu cartón</h3>";
	if($contadorAcertados==15)	echo "<h1>BINGOOOO HAS GANADO</h1>";
	if($contadorAcertados!=15 and $comprobarLinea == 1)	echo "<h1>LINEAAAA</h1>";
	//echo $repetidos;
?>


  
</body>
</html>


