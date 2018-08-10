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
