<?php
require_once __DIR__ . '/../core/Database.php';

class Libro {
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
            $stmt = $db->prepare('SELECT Id, Titulo, Autor, AnioPublicacion, CantidadPaginas FROM libros ORDER BY Id DESC');
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
    public static function obtenerPorId($Id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT Id, Titulo, Autor, AnioPublicacion, CantidadPaginas FROM libros WHERE Id = :id');
            $stmt->execute([':id' => $Id]);
            
            // PDO mapea automáticamente las columnas a las propiedades de la clase
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::NOMBRE_CLASE);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener libro: " . $e->getMessage());
            return null;
        }
    }
    public static function agregar($Titulo, $Autor, $AnioPublicacion, $CantidadPaginas) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('INSERT INTO libros (Titulo, Autor, AnioPublicacion, CantidadPaginas) VALUES (:titulo, :autor, :anioPublicacion, :cantidadPaginas)');
            
            return $stmt->execute([
                ':titulo' => $Titulo,
                ':autor' => $Autor,
                ':anioPublicacion' => $AnioPublicacion,
                ':cantidadPaginas' => $CantidadPaginas
            ]);
        } catch (PDOException $e) {
            error_log("Error al agregar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Editar un libro existente
     */
    public static function editar($Id, $Titulo, $Autor, $AnioPublicacion, $CantidadPaginas) {
    var_dump($Id, $Titulo, $Autor, $AnioPublicacion, $CantidadPaginas); // Debugging line    
    try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('UPDATE libros SET Titulo = :titulo, Autor = :autor, AnioPublicacion = :anioPublicacion, CantidadPaginas = :cantidadPaginas WHERE Id = :id');
            
            return $stmt->execute([
                ':id' => $Id,
                ':titulo' => $Titulo,
                ':autor' => $Autor,
                ':anioPublicacion' => $AnioPublicacion,
                ':cantidadPaginas' => $CantidadPaginas
            ]);
        } catch (PDOException $e) {
            error_log("Error al editar libro: " . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar un libro
     */
    public static function eliminar($Id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('DELETE FROM libros WHERE Id = :id');
            
            return $stmt->execute([':id' => $Id]);
        } catch (PDOException $e) {
            error_log("Error al eliminar libro: " . $e->getMessage());
            return false;
        }
    }
}
?>
