<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Registreren</title>
</head>

<body>
  <div class="box">
    <h1>Registratie</h1>
    <?php if (isset($_GET['error']) && $_GET['error'] === 'gebruikersnaam_bestaat'): ?>
    <p style="color: red; text-align: center;">Deze gebruikersnaam is al in gebruik. Kies een andere.</p>
<?php endif; ?>

    <form method="POST" action="../controllers/UserController.php" onsubmit="return validatePassword()">
      <div class="txt_field">
        <input type="text" required id="naam" name="naam" />
        <span></span>
        <label for="naam">Naam</label>
      </div>
      <div class="txt_field">
        <input type="text" required id="achternaam" name="achternaam" />
        <span></span>
        <label for="achternaam">Achternaam</label>
      </div>
      <div class="txt_field">
        <input type="email" required id="email" name="email" />
        <span></span>
        <label for="email">Email</label>
      </div>
      <div class="txt_field">
        <input type="text" required id="gebruikersnaam" name="gebruikersnaam" />
        <span></span>
        <label for="gebruikersnaam">Gebruikersnaam</label>
      </div>
      <div class="txt_field">
        <input type="password" required id="wachtwoord" name="wachtwoord" />
        <span></span>
        <label for="wachtwoord">Wachtwoord</label>
      </div>
      <p id="error-message" style="color: red; font-size: 14px; display: none;">Wachtwoord moet minimaal één hoofdletter, één cijfer en één speciaal teken bevatten.</p>
      <input type="submit" value="Registreren" name="register">
      <div class="signup_link">
        Al een account? <a href="login.php">Inloggen</a>
      </div>
    </form>
  </div>

  <script>
    function validatePassword() {
      const password = document.getElementById('wachtwoord').value;
      const errorMessage = document.getElementById('error-message');
      
      // Controleer op minstens één hoofdletter, één cijfer en één speciaal teken
      const passwordRegex = /^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

      if (!passwordRegex.test(password)) {
        errorMessage.style.display = 'block';
        return false;
      }

      errorMessage.style.display = 'none';
      return true;
    }
  </script>
</body>

</html>