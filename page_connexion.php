<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<body>
<a href="index.php">page d'accueil</a>
    <h2>Connexion</h2>
    <form action="connexion.php" method="post">
        <label for="login">login</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="text" id="password" name="password" required><br>
        <input type="submit" value="Se connecter">
    </form>
    <a href="page_inscription.php">Vous n'avez pas de compte ?</a>
    <a href="forgot_password.php">Vous avez oublié votre mot de passe</a>
</body>

</html>