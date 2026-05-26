<?php

require_once __DIR__ . '/../datos_bd.php';

$conexion = mysqli_connect($host, $user, $pass, $bd);

if (!$conexion) {
    die("Error de conexion " . mysqli_connect_error());
};

mysqli_set_charset($conexion, "utf8mb4");
