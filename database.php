<?php
// Verbind met de MySQL-server
try {
    // Verbinding maken zonder een specifieke database
    $conn = new PDO("mysql:host=localhost", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    // Maak de database foodiesdb aan indien deze niet bestaat
    $conn->exec("CREATE DATABASE IF NOT EXISTS foodiesdb");
    
    // Verbind opnieuw, maar nu met de foodiesdb database
    $conn = new PDO("mysql:host=localhost;dbname=foodiesdb", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    // Maak de tabel users aan indien deze niet bestaat
    $createTableQuery = "
    CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        naam VARCHAR(100),
        achternaam VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        gebruikersnaam VARCHAR(100) UNIQUE,
        wachtwoord VARCHAR(255)
    )";
    
    // Voer de query uit om de tabel te maken
    $conn->exec($createTableQuery);
    echo "Database en tabel succesvol aangemaakt!";
} catch (PDOException $e) {
    echo "Fout: " . $e->getMessage();
}
?>
