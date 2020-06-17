<?php

//Iniciar la sesion y la conexion a la BBDD
require_once 'includes/conexion.php';

if(isset($_POST)) {
    //Borrar error antiguo
    if(isset($_SESSION['error_login'])) {
        unset($_SESSION['error_login']);
    }

    //Recoger los datos del formulario
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    //Consulta para comprobar las credenciales del usuario
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1) {
        $usuario = mysqli_fetch_assoc($login);

        //Comprobar contraseña / cifrar de nuevo
        $pw_segura = password_hash($password, PASSWORD_BCRYPT, ['cost'=>4]);
        $verify = password_verify($password, $usuario['password']);

        if($verify) {
            //Utilizar una sesion para guardar los datos del usuario logeado
            $_SESSION['usuario'] = $usuario;

        } else {
            //Si algo falla enviar una sesion con el error
            $_SESSION['error_login'] = 'Login Incorrecto!!';
        }
    } else {
        //Mensaje de error
        $_SESSION['error_login'] = 'Login Incorrecto!!';
    }
}

//Redirigir al index.php
header('Location: index.php');
?>
