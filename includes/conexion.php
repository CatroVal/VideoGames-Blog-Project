<?php
/*CONEXION*/
$server = 'localhost';
$username = 'admin';
$password = 'admin';
$database = 'BLOG_MASTER';
$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf-8'");

//Iniciar sesión
if(!isset($_SESSION)) {
    session_start();
}
