<?php

require_once "./app/models/conexion.php";

function insert_new($table, $params = [])
{
    // STATEMENT
    $stmt = 'INSERT INTO ' . $table . ' 
    ' . get_column_names($params) . '
    VALUES ' . get_placeholders($params);

    // Ejecutamos el query y se inserta el registro
    return ($id = conexion::query_db($stmt, $params)) ? $id : false;
}
// USUARIOS VIDEOJUEGOS PLATAFORMAS GENEROS 50 100
// INSERT INTO tabla (COLUMNAS) VALUES (VALORES A INSERTAR);
function get_column_names($params)
{
    // (nombre,email,password,navbar_color,creado)
    $cols = '';
    if (empty($params)) {
        return false;
    }

    $cols .= '(';
    foreach ($params as $k => $v) {
        $cols .= $k . ',';
    }
    $cols = substr($cols, 0, -1);
    $cols .= ')';

    return $cols;
}

function get_placeholders($params)
{
    // (:nombre,:email,:password,:navbar_color,:creado)
    $placeholders = '';
    if (empty($params)) {
        return false;
    }

    $placeholders .= '(';
    foreach ($params as $k => $v) {
        $placeholders .= ':' . $k . ',';
    }
    $placeholders = substr($placeholders, 0, -1);
    $placeholders .= ')';

    return $placeholders;
}
function json_output($status = 200, $msg = '', $data = [])
{
    //http_response_code($status);
    $r =
        [
            'status' => $status,
            'msg'    => $msg,
            'data'   => $data
        ];
    echo json_encode($r);
    die;
}
function clean_string($string)
{
    $string = trim($string);
    $string = rtrim($string);
    $string = ltrim($string);
    return $string;
}
function generate_filename($lng = 8, $span = 2)
{
    if (!is_integer($lng)) {
        $lng = 8;
    }
    if (!is_integer($span)) {
        $span = 2;
    }
    $span = ($span > 5 ? 5 : $span);

    $filename = '';
    $min = '';
    $max = '';

    for ($i = 0; $i < $lng; $i++) {
        $min .= '1';
        $max .= '9';
    }

    for ($i = 0; $i < $span; $i++) {
        $filename .= rand((int) $min, (int) $max) . '_';
    }

    return substr($filename, 0, -1);
}

function update_record($table, $keys = [], $params = [])
{
    // UPDATE tabla SET columna=:placeholder, columna=:placeholder WHERE id=:id;
    $placeholders = '';
    $cols = '';

    foreach ($params as $k => $v) {
        $placeholders .= $k . '=:' . $k . ',';
    }
    $placeholders = substr($placeholders, 0, -1);

    $stmt = 'UPDATE ' . $table . ' SET ' . $placeholders;

    // Si hay keys pues vamos a agregarlas al query o statement
    if (!empty($keys)) {
        $stmt .= ' WHERE ';
        foreach ($keys as $k => $v) {
            $cols .= $k . '=:' . $k . ' AND';
        }
        $cols = substr($cols, 0, -3);
        $stmt .= $cols;
    }

    // Ejecutar el statement o el query
    return (conexion::query_db($stmt, array_merge($keys, $params))) ? true : false;
}

function delete_record($table, $keys = [])
{

    // Si hay keys pues vamos a agregarlas al query o statement
    if (empty($keys)) {
        return false;
    }

    $cols = '';
    $stmt = 'DELETE FROM ' . $table;
    $stmt .= ' WHERE ';
    foreach ($keys as $k => $v) {
        $cols .= $k . '=:' . $k . ' AND';
    }
    $cols = substr($cols, 0, -3);
    $stmt .= $cols . ' LIMIT 1';

    return (conexion::query_db($stmt, $keys, true)) ? true : false;
}

function get_by_id($table, $keys = [])
{
    // Si hay keys pues vamos a agregarlas al query o statement
    if (empty($keys)) {
        return false;
    }

    $cols = '';
    $stmt = 'SELECT * FROM ' . $table;
    $stmt .= ' WHERE ';
    foreach ($keys as $k => $v) {
        $cols .= $k . '=:' . $k . ' AND ';
    }
    $cols = substr($cols, 0, -4);
    $stmt .= $cols . ' LIMIT 1';

    return (conexion::query_db($stmt, $keys, true));
}
