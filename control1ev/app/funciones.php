<?php
require_once('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk(string $login, string $clave): bool
{
    global $usuarios;

    foreach ($usuarios as $loginuser => $datosuser) {
        if ($login == $loginuser && $clave == $datosuser[1]) {
            return true;
        }
    }

    return false;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol(string $login)
{
    global $usuarios;

    return $usuarios[$login][2];
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo): String
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;

    $msg .= " Bienvenido/a alumno/a: " . $usuarios[$codigo][0];
    $NotaAlumno = $notas[$codigo];

    $msg .= "<table>";
    // Completar
    $msg .= "<th> Módulo </th><th> Notas </th>";

    for ($i = 0; $i < count($nombreModulos); $i++) {
        $msg .= "<tr>";
        $msg .= "<td>" . $nombreModulos[$i] . "</td>";
        $msg .= "<td>" . $NotaAlumno[$i] . "</td>";
        $msg .= "</tr>";
    }

    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas($codigo): String
{
    $msg = "";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $msg .= " Bienvenido Profesor: " . $usuarios[$codigo][0];

    $msg .= "<table>";
    $msg .= "<th> Nombre </th>";

    foreach ($nombreModulos as $modulosCurso) {
        $msg .= "<td>" . $modulosCurso . "</td>";
    }

    foreach ($notas as $codigoAlumno => $NotasAlumnos) {
        $msg .= "<tr>";
        $msg .= "<td>" . $usuarios[$codigoAlumno][0] . "</td>";

        foreach ($NotasAlumnos as $notaModulo) {
            $msg .= "<td>" . $notaModulo . "</td>";
        }
        
        $msg .= "</tr>";
    }

    $msg .= "</table>";
    return $msg;
}
