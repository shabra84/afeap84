<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
    
         <?php
        
           /**
            * Función que obtiene la fecha completa del último día del mes
            * @return array asociativo con la fecha final del mes
            */
           function diaFinalDelMes() { 
               
                //fechas almacenadas en un array asociativo
                $fecha["mes"] = date('m');
                $fecha["año"] = date('Y');
                $fecha["dia"] = date("d", mktime(0,0,0, $fecha["mes"]+1, 0, $fecha["año"]));
      
                return $fecha;
            };

            /**
             * Método que permite obtener el día, mes y año del final de mes actual
             * @return array asociativo que obtiene la fecha del final de mes
             */
            function diaPrincipioDelMes() {
 
                //fechas almacenadas en un array asociativo
                $fecha["mes"] = date('m');
                $fecha["año"] = date('Y');
                $fecha["dia"] = date("d", mktime(0,0,0, $fecha["mes"], 1, $fecha["año"]));
      
                return $fecha;
            }
            
            /**
             * Función que devuelve dia,mes y año actual
             **/
            function diaActual(){
                
                //dia actual de la semana
                $fechas["dia"] = date("d");
                
                //dia del mes actual
                $fechas["mes"] = date("m");
                
                //año actual
                $fechas["año"] = date("Y");
                
                //devuelve los datos en un array asociativo
                return $fechas;
            }
            
            /**
             * Método que devuelve la celda del calendario del dia
             */
            function celdaDiaActual($dia){
                   
                return $dia%7+2;    
                
            }
         
                
                //accedo a mysql
                $mysqli = new mysqli("127.0.0.1", "root", "", "afaepeventos");
                
                /* comprobar la conexión */
                if ($mysqli->connect_errno) {
                    printf("Falló la conexión: %s\n", $mysqli->connect_error);
                    exit();
                }


                /* consulta SELECT */
                $resultado = $mysqli->query("SELECT * FROM eventos");
                
                while($row = $resultado->fetch_assoc())
                {
                    echo "<div id='flotando' style='display:none;'><h5 style='margin:0 auto; display:table;color:#42a12c;'>".$row["nombre"]."</h5></div>";
                }
        
        
        ?>
 
</body>
</html>
