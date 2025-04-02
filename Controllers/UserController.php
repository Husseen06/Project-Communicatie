<?php
require_once '../models/UserModel.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['register'])) {
    $data = [
        'naam' => $_POST['naam'],
        'achternaam' => $_POST['achternaam'],
        'email' => $_POST['email'],
        'gebruikersnaam' => $_POST['gebruikersnaam'],
        'wachtwoord' => password_hash($_POST['wachtwoord'], PASSWORD_DEFAULT) // Hash het wachtwoord
    ];

    if (!UserModel::save($data)) {
        // Gebruikersnaam bestaat al, stuur de foutmelding door naar het registratieformulier
        header("Location: ../views/register.php?error=gebruikersnaam_bestaat");
        exit;
    }

    // Succesvol geregistreerd, stuur door naar loginpagina
    header("Location: ../views/login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['login'])) {
    $gebruikersnaam = $_POST['gebruikersnaam'];
    $wachtwoord = $_POST['wachtwoord'];

    $user = UserModel::findByUsername($gebruikersnaam);

    if ($user && password_verify($wachtwoord, $user['wachtwoord'])) {
        // Succesvol ingelogd
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header("Location: ../views/home.php");
        exit;
    } else {
        // Foutmelding bij inloggen
        header("Location: ../views/login.php?error=ongeldige_inloggegevens");
        exit;
    }
}
?>
