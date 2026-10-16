<?php
require_once '../modelo/libro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $Titulo = $_POST['Titulo'] ?? '';
    $Autor = $_POST['Autor'] ?? '';
    $AnioPublicacion = $_POST['AnioPublicacion'] ?? '';
    $Id = $_POST['Id'] ?? '';
    $CantidadPaginas = $_POST['CantidadPaginas'] ?? '';

    $edad = $_POST['edad'] ?? '';
    $id = $_POST['id'] ?? '';

    if ($accion === 'agregar') {
        Libro::agregar($Titulo, $Autor, $AnioPublicacion, $CantidadPaginas);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'editar') {
        Libro::editar($Id, $Titulo, $Autor, $AnioPublicacion, $CantidadPaginas);
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'eliminar') {
        Libro::eliminar($Id);
        header('Location: vistas/listar.php');
        exit;
    }
}
?>