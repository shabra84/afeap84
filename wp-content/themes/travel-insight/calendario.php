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
                    echo "<h5 style='margin:0 auto; display:table;color:#42a12c;'>".$row["nombre"]."</h5>";
                }
        
        
        ?>
    </body>
</html>
