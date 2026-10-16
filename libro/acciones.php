<?php
require_once '../modelo/persona.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'] ?? '';
    $Titulo = $_POST['Titulo'] ?? '';
    $Autor = $_POST['Autor'] ?? '';
    $AnioPublicacion = $_POST['AnioPublicacion'] ?? '';
    $id = $_POST['id'] ?? '';
    $CantidadPaginas = $_POST['CantidadPaginas'] ?? '';

    if ($accion === 'agregar') {
        if (!Persona::agregar($Titulo, $Autor, $AnioPublicacion, $CantidadPaginas)) {
            http_response_code(500);
            exit('No se pudo agregar el libro. Revise los datos e intente nuevamente.');
        }
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'editar') {
        if (!Persona::editar($id, $nombre, $email, $edad, $profesion_id)) {
            http_response_code(500);
            exit('No se pudo editar la persona. Revise los datos e intente nuevamente.');
        }
        header('Location: vistas/listar.php');
        exit;
    }

    if ($accion === 'eliminar') {
        Persona::eliminar($id);
        header('Location: vistas/listar.php');
        exit;
    }
}
?>
