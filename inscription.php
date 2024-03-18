<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = $_POST["username"];
    $password = $_POST["password"];
    $login = $_POST["login"];
    $email = $_POST["email"];
    

    // Informations de connexion à la base de données
    $serveur = "localhost"; // adresse du serveur MySQL
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = ""; // mot de passe MySQL
    $base_de_donnees = "cassebrick2"; // nom de la base de données

    // Connexion à la base de données
    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    // Préparer la requête SQL pour insérer les données dans la base de données
    $requete = $mysqli->prepare("INSERT INTO joueurs (nom_joueur, mot_de_passe, login, email) VALUES (?, ?, ?, ?)");
    $requete->bind_param("ssss", $username, $password, $login, $email);

    // Exécuter la requête SQL
    if ($requete->execute()) {
        echo "Inscription réussie!";
        header('Location: page_connexion.php');
    } else {
        echo "Erreur lors de l'inscription : " . $requete->error;
    }

    // Fermer la requête et la connexion à la base de données
    $requete->close();
    $mysqli->close();
    
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="connexion.css">
    <title>Inscription</title>
</head>
<body class="light">
<a href="index.php">page d'accueil</a>
    <h2>Inscription</h2>
    <form action="inscription.php" method="post">
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="login">login</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="email">email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
<script src="theme.js"></script>