<?php
/**
 * Método para realizar una conexión a la base de datos afaepeventos
 */
function conexionMysql(){
   
    $mysqli = new mysqli('127.0.0.1', 'root', '', 'afaepeventos');
    
    if ($mysqli->connect_errno) {
        echo "<h2>Error al conectarse con la base de datos.</h2>";
    }
    
    return $mysqli;
    
}

/***
 * Método que realiza una consulta extrayendo los eventos
 */
function consulta($con,$sql){

    $resultado = null;
    
    if ($fila = $con->query($sql)) {
        while ($datos = $fila->fetch_assoc()) {
            $resultado[] = $datos;
        }
    }
    else{
        echo "<h2>Error al extraer de la base de datos</h2>";
    }
                      
    //cerramos conexión a bbdd
    $con->close();
                    
    //devolvemos los eventos en un array
    return $resultado;
}



# definimos los valores iniciales para nuestro calendario
$month=date("n");
$year=date("Y");
$diaActual=date("j");
 
# Obtenemos el dia de la semana del primer dia
# Devuelve 0 para domingo, 6 para sabado
$diaSemana=date("w",mktime(0,0,0,$month,1,$year));

# Obtenemos el ultimo dia del mes
$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
 
$meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
"Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
$colores = array("red","green","blue","yellow","orange");
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
	<!--http://www.lawebdelprogramador.com-->
	<title>Eventos</title>
	<meta charset="utf-8">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
        <script>
        
           var cambiar = true;
           
           function mostrarOcultar(i){
               
               $("#eventos"+i).show();
               
               if(!cambiar)
                    $("#eventos"+i).hide();
                
                cambiar = !cambiar;
   
           }
        
        </script>
	<style>

                div{
                    display:none;
                }
		#calendar {
			font-family:Arial;
			font-size:12px;
		}
		#calendar caption {
			text-align:left;
			padding:5px 10px;
			background-color:#003366;
			color:#fff;
			font-weight:bold;
		}
		#calendar th {
			background-color:#006699;
			color:#fff;
			width:40px;
		}
		#calendar td {
			text-align:right;
			padding:2px 5px;
			background-color:silver;
		}
		#calendar .hoy {
			background-color:red;
		}
	</style>
</head>
 
<body>
<table id="calendar">
	<caption><?php echo $meses[$month]." ".$year?></caption>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
	<tr bgcolor="silver">
		<?php
                $conexion = conexionMysql();
                $sql = "SELECT * FROM eventos";
                $fechas = consulta($conexion,$sql);
                $last_cell=$diaSemana+$ultimoDiaMes;
                $k = 0;
                $m = 0;
                $esPrimero = false;
                
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++){
                   
                    if($k<count($fechas)){
                        
                   
                        //obtenemos mes y dia de los eventos pertenecientes a este
                        //mes
                       $mesActualEventos = $month==date("m", 
                               strtotime($fechas[$k]["fecha_ini"]))?0:$month; 
                       
                       $diaActualEventosIni[$k] = date("d",strtotime($fechas[$k]["fecha_ini"]));
                       $diaActualEventosFin[$k] = date("d",strtotime($fechas[$k]["fecha_fin"])); 

                       
                       
                       if($mesActualEventos==0){
                           
                           //si el indice es 0 queda en 0 sino le quitamos 1.
                           $indice = $k<=0?0:$k-1;
                           
                           $mesActualEventos = date("m", 
                               strtotime($fechas[$indice]["fecha_ini"]));
                            $diaActualEventosIni[$indice] = date("d",strtotime($fechas[$k-1]["fecha_ini"]));
                            $diaActualEventosFin[$indice] = date("d",strtotime($fechas[$k-1]["fecha_fin"]));
                            
                            $k = count($fechas);
                       }
                           
                       $k++;
                       
                    }
			if($i==$diaSemana)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				// celca vacia
				echo "<td>&nbsp;</td>";
                                
                                
			}else{
                            
                            $colorNum = 0;
                            
                            if($month==$mesActualEventos){ 
                                if($m<=count($diaActualEventosIni)){
                                    echo $diaActualEventosIni[$m];
                                    echo $diaActualEventosFin[$m];
                                    $m++;
                                }
                                if($diaActualEventosIni>=$day && $day<=$diaActualEventosFin){
                                    echo "<td  style='background-color:".$colores[$colorNum]."' onclick='mostrarOcultar($day);' id='evento$day' class='hoy'>$day</td>";
                                }
                                else{
                                    echo "<td  onclick='mostrarOcultar($day);' id='evento$day'>$day</td>";
                                }
                                
                                $day++;
                                $m++;
                            }
                            
			}
			// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				echo "</tr><tr>\n";
			}
		
                }
	?>
	</tr>

        </div>
</table>
</body>
</html>
