<?php

$host = "localhost";
$user = "root";
$pass = "";
$bd = "libreria_bd";

$conexion = mysqli_connect($host, $user, $pass, $bd);

if (!$conexion) {
    die("Error de conexion " . mysqli_connect_error());
};
