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
        define("sql" , "SELECT * FROM eventos where date_format(fecha_ini,'%m')=date_format(now(),'%m')");
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
        
        //posicion de la celda en la que empieza y final
        $diaSemana=date("w",mktime(0,0,0,$mes,1,$anio));
        $ultimoDiaMes=date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
        $last_cell=$diaSemana+$ultimoDiaMes;
        
        //conexión y extracción de datos en un array asociativo
        $conexion = conexionMysql(servidor_ip,usuario,password,nombrebase);       
        
        $day = 1;
        $m = 0;
        
        //extraemos datos y lo almacenamos 
        $fechas = consulta($conexion,sql);
        
        for($i=1;$i<=42;$i++){
 
            if($i>=$diaSemana && $i<$last_cell){
                
                if($m<count($fechas)){
                    $diaini = intval(date_format(new DateTime($fechas[$m]["fecha_ini"]),'d'));
                    $diafin = intval(date_format(new DateTime($fechas[$m]["fecha_fin"]),'d'));

                }
                
                
                echo mktime(0,0,0,$mes,$diaini,$ani);
                if(date("w",mktime(0,0,0,$mes,$diaini,$anio))>=$i && $i<=date("w",mktime(0,0,0,$mes,$diafin,$anio))){

                    $html.="<td style='background:red'>$day</td>";
                        
                    $m++;
                }
                else{
                    $html.="<td>$day</td>";
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
