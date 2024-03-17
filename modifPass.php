<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Mot de Passe</title>
</head>
<body>
    <h2>Nouveau Mot de Passe</h2>
    <form action="traitement_nouveau_mot_de_passe.php" method="post">
        <label for="password">Nouveau Mot de Passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <label for="confirm_password">Confirmer le Mot de Passe:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>
        <input type="submit" value="Enregistrer">
    </form>
</body>
</html>