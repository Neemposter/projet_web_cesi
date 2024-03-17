<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
<a href="index.php">page d'accueil</a>
    <h2>Inscription</h2>
    <form action="inscription.php" method="post">
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="login">login</label><br>
        <input type="login" id="login" name="login" required><br>
        <label for="email">email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
