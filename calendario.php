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
        <?php
        //añadimos las librerias
        include("librerias/funciones.php");
       
        //variables necesarias
        //fecha actual
        $mes=date("n");
        $anio=date("Y");
        $diaActual=date("j");
 
        # Obtenemos el dia de la semana del primer dia
        # Devuelve 0 para domingo, 6 para sabado
        $diaSemana=date("w",mktime(0,0,0,$mes,1,$anio));

        # Obtenemos el ultimo dia del mes
        $ultimoDiaMes=date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));

        //diccionarios con los dias del mes y colores de las celdas
        $meses=array(1=>"Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio",
        "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        
        $colores = array("red","green","blue","yellow","orange");
        ?>
        <!-- HTML -->
        <table id="calendar">
	<caption><?php echo $meses[$mes]." ".$anio?></caption>
	<tr>
		<th>Lun</th><th>Mar</th><th>Mie</th><th>Jue</th>
		<th>Vie</th><th>Sab</th><th>Dom</th>
	</tr>
	<tr bgcolor="silver">
		<?php
                //creamos la conexion a mysql con la consulta
                $conexion = conexionMysql();
                $sql = "SELECT * FROM eventos where date_format(fecha_ini,'%m')=date_format(now(),'%m')";
                //extraemos datos y lo almacenamos 
                $fechas = consulta($conexion,$sql);
                $last_cell=$diaSemana+$ultimoDiaMes;
                
                $m = 0;
                $fechaini = intval(date_format(new DateTime($fechas[0]["fecha_ini"]),'d'));
                $fechafin = intval(date_format(new DateTime($fechas[0]["fecha_fin"]),'d'));
                $html = "";
                

                
		// hacemos un bucle hasta 42, que es el máximo de valores que puede
		// haber... 6 columnas de 7 dias
		for($i=1;$i<=42;$i++){
                        
			if($i==$diaSemana)
			{
				// determinamos en que dia empieza
				$day=1;
			}
			if($i<$diaSemana || $i>=$last_cell)
			{
				// celca vacia
				$html.="<td>&nbsp;</td>";
                                
                                
			}else{
                            
                            if(($fechaini>$m && $m<$fechafin) && $m<count($fechas)){
                                $fechaini = intval(date_format(new DateTime($fechas[$m]["fecha_ini"]),'d'));
                                $fechafin = intval(date_format(new DateTime($fechas[$m]["fecha_fin"]),'d'));
                                
                                if($m%7==0)
                                        $html.="<tr>";
                                
                                for($n=$fechaini ;$n<=$fechafin;$n++){
                                                                        
                                    $html.="<td  style='background-color:red;' onclick='mostrarOcultar($n);' id='evento$n' class='hoy'>$n</td>";

                                }
                                
                                if($m%7==0)
                                        $html.="</tr>";
                               
                                $m++;
                            }
                            else{
                            
                            $html.= "<td  onclick='mostrarOcultar($day);' id='evento$day'>$day</td>";
                            
                            $day++;
                            }
                        }
                        
                         /*
// cuando llega al final de la semana, iniciamos una columna nueva
			if($i%7==0)
			{
				$html.="</tr><tr>\n";
			}*/
                        
                        
                        
                        //pinto calendario
                        echo $html;
		
                }
	?>
	</tr>

        </div>
    </table>
    </body>
</html>
