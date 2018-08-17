<!DOCTYPE html>
<!--
Hecho por Fernando Mangas
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script type="text/javascript" src="libreriasjs/eventos.js"></script>
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
        //datos de conexion a la base de datos
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
        $colores = array("#42a12c");
        
        //posicion de la celda en la que empieza y final
        $diaSemana=date("w",mktime(0,0,0,$mes,1,$anio));
        $ultimoDiaMes=date("d",(mktime(0,0,0,$mes+1,1,$anio)-1));
        $last_cell=$diaSemana+$ultimoDiaMes;   

        //controla el cambio de color
        $cambiar = false;
        
        //importante para ver si es el mismo evento
        $ant = "";
        
        //indice de los eventos a presentar en html
        $k = 0;
        
        //extraemos datos y lo almacenamos 
        $fechas = consulta($conexion,sql,$i-1);
        
        //$i es la posicion que empieza en el calendario (casilla)
        for($i=1;$i<=42;$i++){
           

        }
   
        //asignamos el html del evento a todo el codigo html
        $html.=$htmleventos;
        
        //pintamos la web
        echo $html;
        
        ?>
    </body>
</html>
