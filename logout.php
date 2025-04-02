<?php
// Start de sessie
session_start();

// Vernietig de sessie om de gebruiker uit te loggen
session_destroy();

// Redirect naar de loginpagina
header('Location: login.php');
exit;
?>
