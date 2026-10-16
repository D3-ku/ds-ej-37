<?php
require_once __DIR__ . '/../core/Database.php';

class Profesion {
    public $id;
    public $nombre;

    public static function obtenerTodas() {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query('SELECT id, nombre FROM profesiones ORDER BY nombre');
            return $stmt->fetchAll(PDO::FETCH_CLASS, self::class);
        } catch (PDOException $e) {
            error_log("Error al obtener profesiones: " . $e->getMessage());
            throw $e;
        }
    }

    public static function obtenerPorId($id) {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare('SELECT id, nombre FROM profesiones WHERE id = :id');
            $stmt->execute([':id' => $id]);
            $stmt->setFetchMode(PDO::FETCH_CLASS, self::class);
            return $stmt->fetch();
        } catch (PDOException $e) {
            error_log("Error al obtener profesion: " . $e->getMessage());
            throw $e;
        }
    }
}
