<?php
session_start();

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$products = [
    1 => ['name' => 'Pizza Margherita', 'price' => 8.99],
    2 => ['name' => 'Sushi Set', 'price' => 12.99],
    3 => ['name' => 'Patat met', 'price' => 4.99],
    4 => ['name' => 'Caesar Salad', 'price' => 6.99],
    5 => ['name' => 'Burger', 'price' => 9.99],
    6 => ['name' => 'Pasta Carbonara', 'price' => 10.99],
    7 => ['name' => 'Tacos', 'price' => 7.99],
    8 => ['name' => 'Ice Cream', 'price' => 3.99],
    9 => ['name' => 'Coffee', 'price' => 2.49],
    10 => ['name' => 'Lemonade', 'price' => 2.99],
    11 => ['name' => 'Veggie Burger', 'price' => 7.99],
    12 => ['name' => 'Fruit Salad', 'price' => 5.99],
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

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
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
  <div class="button-container">
    <a href="index.php"><button class="button">
      <svg
        class="icon"
        stroke="currentColor"
        fill="currentColor"
        stroke-width="0"
        viewBox="0 0 1024 1024"
        height="1em"
        width="1em"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M946.5 505L560.1 118.8l-25.9-25.9a31.5 31.5 0 0 0-44.4 0L77.5 505a63.9 63.9 0 0 0-18.8 46c.4 35.2 29.7 63.3 64.9 63.3h42.5V940h691.8V614.3h43.4c17.1 0 33.2-6.7 45.3-18.8a63.6 63.6 0 0 0 18.7-45.3c0-17-6.7-33.1-18.8-45.2zM568 868H456V664h112v204zm217.9-325.7V868H632V640c0-22.1-17.9-40-40-40H432c-22.1 0-40 17.9-40 40v228H238.1V542.3h-96l370-369.7 23.1 23.1L882 542.3h-96.1z"
        ></path>
      </svg>
    </button>
    </a>
    
   <a href="login.php"><button class="button">
      <svg
        class="icon"
        stroke="currentColor"
        fill="currentColor"
        stroke-width="0"
        viewBox="0 0 24 24"
        height="1em"
        width="1em"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          d="M12 2.5a5.5 5.5 0 0 1 3.096 10.047 9.005 9.005 0 0 1 5.9 8.181.75.75 0 1 1-1.499.044 7.5 7.5 0 0 0-14.993 0 .75.75 0 0 1-1.5-.045 9.005 9.005 0 0 1 5.9-8.18A5.5 5.5 0 0 1 12 2.5ZM8 8a4 4 0 1 0 8 0 4 4 0 0 0-8 0Z"
        ></path>
      </svg>
    </button>
    </a> 
    <a href="wagen.php"> <button class="button">
      <svg
        class="icon"
        stroke="currentColor"
        fill="none"
        stroke-width="2"
        viewBox="0 0 24 24"
        stroke-linecap="round"
        stroke-linejoin="round"
        height="1em"
        width="1em"
        xmlns="http://www.w3.org/2000/svg"
      >
        <circle cx="9" cy="21" r="1"></circle>
        <circle cx="20" cy="21" r="1"></circle>
        <path
          d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"
        ></path>
      </svg>
    </button>
    </a> 
  </div>
  <div class="auth-controls" style="color: white; margin-left: 20px;">
    <?php if ($isLoggedIn): ?>
      <span class="username">Welkom, <?= htmlspecialchars($_SESSION['username'] ?? 'Gebruiker') ?></span>
      <a href="../logout.php" class="auth-button" style="margin-left: 10px;">Uitloggen</a>
    <?php else: ?>
      <a href="login.php" class="auth-button" style="margin-left: 10px;">Inloggen</a>
    <?php endif; ?>
  </div>
</nav>

<header>
    <h1><em>Jouw Winkelwagen</em></h1>
</header>

<main>
    <h2>Producten</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
            <?php if (isset($products[$id])): ?>
                <li>
                    <?= htmlspecialchars($products[$id]['name']) ?> - €<?= number_format($products[$id]['price'], 2) ?> (Aantal: <?= $qty ?>)
                    <form method="POST" action="wagen.php" style="display:inline;">
                        <input type="hidden" name="remove_id" value="<?= $id ?>">
                        <button type="submit" class="remove-button">Verwijderen</button>
                    </form>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <?php if (empty($_SESSION['cart'])): ?>
        <p>Je winkelwagen is leeg.</p>
    <?php else: ?>
        <p><strong>Totaal: €<?= number_format($total, 2) ?></strong></p>
        <button disabled class="order-button">Bestelling plaatsen (nog niet geïmplementeerd)</button>
    <?php endif; ?>
</main>
</body>
</html>
