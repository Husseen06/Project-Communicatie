<?php
session_start();

// Sample product data - in real app, fetch from database
$products = [
    ['id' => 1, 'name' => 'Pizza Margherita', 'image' => '../Afbeeldingen/pizzavb.jpg', 'price' => 8.99],
    ['id' => 2, 'name' => 'Sushi Set', 'image' => '../Afbeeldingen/sushivb.png', 'price' => 12.99],
    ['id' => 3, 'name' => 'Patat met', 'image' => '../Afbeeldingen/patatvb.png', 'price' => 4.99],
];

// Handle add to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $productId = intval($_POST['product_id']);
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$productId])) {
        $_SESSION['cart'][$productId]++;
    } else {
        $_SESSION['cart'][$productId] = 1;
    }
    header('Location: index.php');
    exit();
}

// Check if user is logged in
$isLoggedIn = isset($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Foodie's Delight - Menu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    
    <script>
        function checkLoginAndOrder() {
            var isLoggedIn = <?= $isLoggedIn ? 'true' : 'false' ?>;
            if (!isLoggedIn) {
                alert('Je moet inloggen om een bestelling te plaatsen.');
                return false;
            }
            return true;
        }
    </script>
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

<div id="hero">
    <div class="hero-content">
        <h1>Bestel je favoriete eten snel en eenvoudig</h1>
        <p>Restaurants en boodschappen in de buurt, direct bij jou thuisbezorgd</p>
    </div>
    <img src="../Afbeeldingen/logo.png" alt="logo" class="hero-img">
</div>

<section id="how-it-works">
    <h2>Hoe het werkt</h2>
    <div class="steps">
        <div class="step">
            <i class="fas fa-search"></i>
            <h3>Zoek je eten</h3>
            <p>Blader door ons uitgebreide menu en kies je favoriete gerechten.</p>
        </div>
        <div class="step">
            <i class="fas fa-shopping-cart"></i>
            <h3>Bestel eenvoudig</h3>
            <p>Voeg gerechten toe aan je winkelwagen en plaats je bestelling.</p>
        </div>
        <div class="step">
            <i class="fas fa-truck"></i>
            <h3>Snelle bezorging</h3>
            <p>Wij zorgen dat je eten snel en warm bij je wordt bezorgd.</p>
        </div>
    </div>
</section>

<section id="benefits">
    <h2>Waarom kiezen voor Foodie's Delight?</h2>
    <p>Snelle levering, ruime keuze en uitstekende service.</p>
</section>

<main>
    <section class="producten">
        <?php foreach ($products as $product): ?>
            <div class="product">
                <div class="image">
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                </div>
                <p><em><?= htmlspecialchars($product['name']) ?></em></p>
                <p>€<?= number_format($product['price'], 2) ?></p>
                <form method="POST" action="index.php">
                    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
                    <button type="submit">Toevoegen</button>
                </form>
            </div>
        <?php endforeach; ?>
    </section>
    <?php if (!empty($_SESSION['cart'])): ?>
        <form method="POST" action="../Controllers/OrderController.php" style="text-align: center;" onsubmit="return checkLoginAndOrder();">
            <button type="submit" class="order-button">Bestelling plaatsen</button>
        </form>
    <?php endif; ?>
</main>

<footer>
    <p><em>VOLG ONS</em></p>
    <div class="socials">
        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social"><i class="fab fa-twitter"></i></a>
