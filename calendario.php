<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
 jQuery(function ($) {
 $.datepicker.regional['es'] = {
    closeText: 'Cerrar',
    currentText: 'Hoy',
    monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
    'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
    'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
    dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
    dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié;', 'Juv', 'Vie', 'Sáb'],
    dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
    weekHeader: 'Sm',
    dateFormat: 'dd/mm/yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['es']);
    
    $("#date").datepicker();
    });
  </script>
</head>
<body>
 
    <div id="date"></div>
    
         <?php
        
        
            /* AÑADO ESTE CODIGO =========================================*/
                
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
