<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title>Réinitialisation du mot de passe</title>
</head>
<body class="light">
    <a href="index.php">page d'accueil</a>
    <h2>Réinitialisation du mot de passe</h2>
    <form action="envoi_mail.php" method="post">
        <label for="email">Entrez votre adresse e-mail:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <input type="submit" value="Envoyer un e-mail de réinitialisation">
    </form>
    <script src="theme.js"></script>
</body>
</html>