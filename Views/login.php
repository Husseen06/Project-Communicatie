<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Inloggen</title>
</head>
<body>
  <div class="box">
    <h1>Inloggen</h1>
    
    <?php if (isset($_GET['error']) && $_GET['error'] === 'invalid_login'): ?>
    <p style="color: red; text-align: center;">Ongeldige gebruikersnaam of wachtwoord.</p>
    <?php endif; ?>

    <form method="POST" action="../controllers/UserController.php" onsubmit="return validatePassword()">
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

      <input type="submit" value="Inloggen" name="login">
      <div class="signup_link">
        Nog geen account? <a href="register.php">Registreren</a>
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
