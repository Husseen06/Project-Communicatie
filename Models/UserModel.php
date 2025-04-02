<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel {

    /**
     * Controleert of een gebruikersnaam al bestaat
     */
    public static function usernameExists($gebruikersnaam) {
        $stmt = self::connect()->prepare("SELECT COUNT(*) FROM users WHERE gebruikersnaam = ?");
        $stmt->execute([$gebruikersnaam]);
        return $stmt->fetchColumn() > 0;
    }

    /**
     * Slaat een nieuwe gebruiker op of werkt een bestaande gebruiker bij
     */
    public static function save($data) {
        $conn = self::connect();

        // Controleer of de gebruikersnaam al bestaat
        if (self::usernameExists($data['gebruikersnaam'])) {
            return false; // Gebruikersnaam is al in gebruik
        }

        // Voeg nieuwe gebruiker toe
        $query = "INSERT INTO users (naam, achternaam, email, gebruikersnaam, wachtwoord) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        return $stmt->execute([$data['naam'], $data['achternaam'], $data['email'], $data['gebruikersnaam'], $data['wachtwoord']]);
    }

    /**
     * Haalt een gebruiker op op basis van zijn gebruikersnaam
     */
    public static function findByUsername($gebruikersnaam) {
        $stmt = self::connect()->prepare("SELECT * FROM users WHERE gebruikersnaam = ?");
        $stmt->execute([$gebruikersnaam]);
        return $stmt->fetch();
    }
}
?>
