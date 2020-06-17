<?php

function mostrarError($errores, $campo) {
    $alerta = '';
    if(isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div';
    }
    return $alerta;
}

//PUEDE QUE EN ESTA FUNCION HAYA UN ERROR EN EL RETORNO!!!!
function borrarErrores() {
    $borrado = false;

    if(isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrado = true;
    }

    if(isset($_SESSION['errores_entrada'])) {
        $_SESSION['errores_entrada'] = null;
        $borrado = true;
    }

    if(isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrado = true;
    }
    return $borrado;
}

function conseguirCategorias($conexion) {
    $sql = 'SELECT * FROM categorias ORDER BY id ASC';
    $categorias = mysqli_query($conexion, $sql);

    $resultado = array();
    if($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }
    return $resultado;
}

function conseguirCategoria($conexion, $id) {
    $sql = "SELECT * FROM categorias WHERE id = $id";
    $categorias = mysqli_query($conexion, $sql);

    $resultado = array();
    if($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = mysqli_fetch_assoc($categorias);
    }
    return $resultado;
}

/*Llamando a esta funcion podriamos, ademas de conseguir las entradas, usarla tambien para realizar la busqueda
en el formulario del buscador*/
function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null) {
    $sql = "SELECT entradas.*, categorias.nombre AS 'categoria' FROM entradas
            INNER JOIN categorias ON entradas.categoria_id = categorias.id";

            if(!empty($busqueda)) {
                $sql .= " WHERE entradas.titulo LIKE '%$busqueda%' ";
            }

            if(!empty($categoria)) {
                $sql .= " WHERE entradas.categoria_id = $categoria";
            }

            $sql .= " ORDER BY entradas.id DESC ";

            if($limit) {
                //$sql = $sql." LIMIT 4";
                $sql .= " LIMIT 4";
            }

    $entradas = mysqli_query($conexion, $sql);

    $resultado = array();
    if($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }
    return $entradas;
}

function mostrarEntrada($conexion, $id) {
    $sql = "SELECT entradas.*, categorias.nombre AS 'categoria', CONCAT(usuarios.nombre, ' ', usuarios.apellidos) AS 'usuario'
            FROM entradas
            INNER JOIN categorias ON entradas.categoria_id = categorias.id
            INNER JOIN usuarios ON entradas.usuario_id = usuarios.id
            WHERE entradas.id = $id";

    $entrada = mysqli_query($conexion, $sql);

    $resultado = array();

    if($entrada && mysqli_num_rows($entrada) >= 1) {
        $resultado = mysqli_fetch_assoc($entrada);
    }
    return $resultado;
}
