<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Sample product data - should be consistent with eten.php
$products = [
    1 => ['name' => 'Pizza Margherita', 'price' => 8.99],
    2 => ['name' => 'Sushi Set', 'price' => 12.99],
    3 => ['name' => 'Patat met', 'price' => 4.99],
];

// Handle remove item
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_id'])) {
    $removeId = intval($_POST['remove_id']);
    if (isset($_SESSION['cart'][$removeId])) {
        unset($_SESSION['cart'][$removeId]);
    }
    header('Location: wagen.php');
    exit();
}

// Calculate total price
$total = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    if (isset($products[$id])) {
        $total += $products[$id]['price'] * $qty;
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Winkelwagen - Foodie's Delight</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<nav>
    <div class="nav-links">
        <a href="index.php">Home</a>
        <a href="wagen.php">Winkelwagen</a>
        <a href="login.php">Login</a>
    </div>
    <a href="login.php" class="auth-button">Inloggen</a>
</nav>

<header>
    <h1><em>Jouw Winkelwagen</em></h1>
</header>

<main>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Je winkelwagen is leeg.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Aantal</th>
                    <th>Prijs</th>
                    <th>Actie</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
                    <?php if (isset($products[$id])): ?>
                        <tr>
                            <td><?= htmlspecialchars($products[$id]['name']) ?></td>
                            <td><?= $qty ?></td>
                            <td>€<?= number_format($products[$id]['price'] * $qty, 2) ?></td>
                            <td>
                                <form method="POST" action="wagen.php">
                                    <input type="hidden" name="remove_id" value="<?= $id ?>">
                                    <button type="submit" class="remove-button">Verwijderen</button>
                                </form>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
        <p><strong>Totaal: €<?= number_format($total, 2) ?></strong></p>
        <button disabled class="order-button">Bestelling plaatsen (nog niet geïmplementeerd)</button>
    <?php endif; ?>
</main>
</body>
</html>
