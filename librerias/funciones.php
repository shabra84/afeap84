<?php

/*
 * 
 * Contiene las funciones del calendario.
 * 
 */

/**
 * Método para realizar una conexión a la base de datos afaepeventos
 */
function conexionMysql($servidorip,$usuario,$password,$basenombre){
   
    $mysqli = new mysqli($servidorip, $usuario, $password, $basenombre);
    
    if ($mysqli->connect_errno) {
        echo "<h2>Error al conectarse con la base de datos.</h2>";
    }
    
    return $mysqli;
    
}

/***
 * Método que realiza una consulta extrayendo los eventos
 */
function consulta($con,$sql,$primero){
    
        $resultado = null;
        $aux = null;
       
        
        //extraemos datos
        if ($fila = $con->query($sql)) {

            while($datos = $fila->fetch_assoc()) {
                
                $resultado[] = $datos;
                    
            }
        
    
        
        for($j=0;$j<count($resultado);$j++){
            
            
            //almacenamos el dia inicial y final de los eventos a añadir
            $diaini[$j] = intval(date_format(new DateTime($resultado[$j]["fecha_ini"]),'d'));
            $diafin[$j] = intval(date_format(new DateTime($resultado[$j]["fecha_fin"]),'d'));
            
            
            for($k=1;$k<=42;$k++){ 
                             
                //posicion inicial y final con variables con nombre significativo 
                $posiciondeldiauno = $primero + $diaini[$j]-1;   
                $posiciondeldiadadofin = ($diafin[$j]-$diaini[$j])+$posiciondeldiauno;
                $posiciondeldiadadoini = $posiciondeldiadadofin - ($diafin[$j]-$diaini[$j]);
               
                
                //si el dia esta en el rango de evento lo asignamos
                if($k>=$posiciondeldiadadoini && $k<=$posiciondeldiadadofin){
                    $aux[$k-1] = $resultado[$j];     
                }
                       
            }
        }
        
  
    }
        
    //cerramos conexión a bbdd
    $con->close();
          
    //devolvemos los eventos en un array
    return $aux;
}
