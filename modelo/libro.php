<?php
require_once __DIR__ . '/../core/Database.php';

class libro {
    private const NOMBRE_CLASE = 'Libro';
    
    public $Id;
    public $Titulo;
    public $Autor;
    public $AnioPublicacion;
    public $CantidadPaginas;

    public function __construct() {
        // Constructor vacío para que FETCH_CLASS funcione correctamente
    }

    // Consulta la relacion al navegarla y reutiliza el objeto mientras conserve el mismo ID.
    /**
     * Agregar un nuevo libro
     */

        public static function obtenerTodas() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT id, titulo, autor, anio_publicacion, cantidad_paginas FROM libros ORDER BY id DESC');
            $stmt->execute();
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
        } catch (PDOException $e) {
            error_log("Error al obtener libros: " . $e->getMessage());
            return [];
        }
    }

    /**
     * Obtener un libro por ID
     * Usando FETCH_CLASS para mapear automáticamente a objeto Libro (ORM)
     */
    public static function obtenerPorId($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT id, titulo, autor, anio_publicacion, cantidad_paginas FROM libros WHERE id = :id');
            $stmt->execute([':id' => $id]);
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener libro: " . $e->getMessage());
            return null;
        }
    }
    public static function agregar($titulo, $autor, $anio_publicacion, $cantidad_paginas) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO libros (titulo, autor, anio_publicacion, cantidad_paginas) VALUES (:titulo, :autor, :anio_publicacion, :cantidad_paginas)');
            
            return $stmt->execute([
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':anio_publicacion' => $anio_publicacion,
                ':cantidad_paginas' => $cantidad_paginas
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Editar un libro existente
     */
    public static function editar($id, $titulo, $autor, $anio_publicacion, $cantidad_paginas) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('UPDATE libros SET titulo = :titulo, autor = :autor, anio_publicacion = :anio_publicacion, cantidad_paginas = :cantidad_paginas WHERE id = :id');
            
            return $stmt->execute([
                ':id' => $id,
                ':titulo' => $titulo,
                ':autor' => $autor,
                ':anio_publicacion' => $anio_publicacion,
                ':cantidad_paginas' => $cantidad_paginas
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar un libro
     */
    public static function eliminar($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('DELETE FROM libros WHERE id = :id');
            
            return $stmt->execute([':id' => $id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar libro: " . $e->getMessage());
            return false;
        }
    }
}
?>
