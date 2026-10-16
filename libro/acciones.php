<?php
require_once '../modelo/libro.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $Titulo = $_POST['Titulo'] ?? '';
    $Autor = $_POST['Autor'] ?? '';
    $AnioPublicacion = $_POST['AnioPublicacion'] ?? '';
    $id = $_POST['id'] ?? '';
    $CantidadPaginas = $_POST['CantidadPaginas'] ?? '';

    if ($accion === 'agregar') {
        if (!Libro::agregar($Titulo, $Autor, $AnioPublicacion, $CantidadPaginas)) {
            http_response_code(500);
            exit('No se pudo agregar el libro. Revise los datos e intente nuevamente.');
        }
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'editar') {
        if (!Libro::editar($id, $Titulo, $Autor, $AnioPublicacion, $CantidadPaginas)) {
            http_response_code(500);
            exit('No se pudo editar el libro. Revise los datos e intente nuevamente.');
        }
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'eliminar') {
        Libro::eliminar($id);
        header('Location: vistas/listar.php');
        exit;
    }
}
?>
