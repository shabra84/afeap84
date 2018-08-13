<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <!-- HTML -->
        <table id="calendar">
	<caption></caption>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
        <?php
        //Constantes
        define("sql" , "SELECT * FROM eventos where date_format(fecha_ini,'%m')=date_format(now(),'%m') order by 3");
        define("servidor_ip" , "127.0.0.1");
        define("usuario" , "root");
        define("password" , "");
        define("nombrebase", "afaepeventos");
        
        //agragamos la libreria con funciones para la conexión a la base de datos
        include("librerias/funciones.php");
 
        $html = "";
        
        //fecha actual
        $mes=date("n");
        $anio=date("Y");
        $diaActual=date("j");
       
        //array diccionario con colores
        $colores = array("red","green","yellow","pink");
        
        //posicion de la celda en la que empieza y final
        $diaSemana=date("w",mktime(0,0,0,$mes,1,$anio));
        $ultimoDiaMes=date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
        $last_cell=$diaSemana+$ultimoDiaMes;

        //conexión y extracción de datos en un array asociativo
        $conexion = conexionMysql(servidor_ip,usuario,password,nombrebase);       
        
        $day = 1;
        $m = 0;
        $posicion = null;
        $indiceColor = 0;
        
        //extraemos datos y lo almacenamos 
        $fechas = consulta($conexion,sql);
        
        //$i es la posicion que empieza en el calendario (casilla)
        for($i=1;$i<=42;$i++){
            
            //almacenamos 0 si no hay eventos
                $diaini[$i-1] = 0;
                $diafin[$i-1] = 0;
                
                
 
            if($i>=$diaSemana && $i<$last_cell){
                        
                //calculamos la posicion actual en la que empieza el evento
                $posicionActual = ($diaSemana+($i-1)-2);
                
                //almacenamos eventos si estamos en el mismo mes
                if(($day>=intval(date_format(
                        new DateTime($fechas[$m]["fecha_ini"]),'d'))
                        &&
                        ($day<=intval(date_format(
                        new DateTime($fechas[$m]["fecha_fin"]),'d')
                        )))){
                    
                    
                    //almacenamos el dia inicial y final de los eventos a añadir
                    $diaini[$i-1] = intval(date_format(new DateTime($fechas[$m]["fecha_ini"]),'d'));
                    $diafin[$i-1] = intval(date_format(new DateTime($fechas[$m]["fecha_fin"]),'d'));
                    
                    //alamaceno la posicion final del evento
                    $ultimoDia = ($posicionActual+($diafin[$i-1]-$diaini[$i-1]));
                
                    //para que no se vaya de rango contamos elementos del array
                    if($m<count($fechas)-1){
                        $m++;
                    }
                }
                
                
                
                //si esta en un rango de dias lo señalo en color en el calendario
                if(($diaini!=0) && (isset($ultimoDia)) &&
                        ($i>=$posicionActual) && ($i<=$ultimoDia)){
       
                    
                    $html.="<td style='background:".$colores[$indiceColor]."'>$day</td>";
                    

                        
                }
                else{
                    $html.="<td>$day</td>";
                    
                    //indice de los colores
                    $indiceColor++;
                    
                    //si es mayor empiezo de nuevo
                    if($indiceColor>count($colores)-1)
                        $indiceColor = 0;
                }
                
                $day++;
            }
            else{
                $html.="<td></td>";
            }
            
            
            
            if($i%7==0){
                $html.="<tr></tr>";
            }
          
        }

        //incrustamos la tabla
        echo $html."</table>";
        ?>
    </body>
</html>
