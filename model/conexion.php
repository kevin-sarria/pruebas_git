<?php 


function conectarDB() {
    $conexion = mysqli_connect('localhost', 'root', '', 'ambulancias_app');

    return $conexion;

}





