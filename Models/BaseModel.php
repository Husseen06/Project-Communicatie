<?php
class BaseModel {
    protected static $conn;

    protected static function connect() {
        if (!self::$conn) {
            try {
                self::$conn = new PDO("mysql:host=localhost;dbname=foodiesdb", 'root', '', [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                error_log($e->getMessage());
                die("Databaseverbinding mislukt.");
            }
        }
        return self::$conn;
    }

    public static function findById($id) {
        $stmt = self::connect()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function findAll() {
        $stmt = self::connect()->query("SELECT * FROM users");
        return $stmt->fetchAll();
    }

    public static function delete($id) {
        return self::connect()->prepare("DELETE FROM users WHERE id = ?")->execute([$id]);
    }
}
?>
