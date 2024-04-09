<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);


    // Informations de connexion à la base de données
    $serveur = "localhost"; // adresse du serveur MySQL
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = "Samed2047_"; // mot de passe MySQL
    $base_de_donnees = "cassebrick_V3"; // nom de la base de données

    // Connexion à la base de données
    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }


    $requete_GET = $mysqli->prepare("SELECT nom FROM joueur WHERE nom = ?");
    $requete_GET->bind_param("s", $username);
    $requete_GET->execute();
    $resultat_GET = $requete_GET->get_result();
    if ($resultat_GET->num_rows == 1) {
        echo "<a class=error>ce nom d'utilisateur est déjà utilisé</a>";
        $requete_GET->close();
        $mysqli->close();
    } else{
    // Préparer la requête SQL pour insérer les données dans la base de données
    $requete_POST = $mysqli->prepare("INSERT INTO joueur (nom, motdepasse, mail) VALUES (?, ?, ?)");
    $requete_POST->bind_param("sss", $username, $password, $email);

    // Exécuter la requête SQL
    if ($requete_POST->execute()) {
        echo "Inscription réussie!";
        header('Location: connexion.php');
    } else {
        echo "Erreur lors de l'inscription : " . $requete_POST->error;
    }

    // Fermer la requête et la connexion à la base de données
    $requete_POST->close();
    $mysqli->close();
    
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/connexion.css">
    <title>Inscription</title>
</head>
<body class="light">
<a href="index.php">page d'accueil</a>
    <h2>Inscription</h2>
    <form action="inscription.php" method="post">
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="email">email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
<script src="theme.js"></script>