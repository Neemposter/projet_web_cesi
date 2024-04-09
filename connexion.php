<?php

session_start();
$connecte = 0;
// Vérifier si le formulaire a été soumis

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);

    // Informations de connexion à la base de données
    $serveur = "localhost"; 
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = "Samed2047_"; // mot de passe MySQL
    $base_de_donnees = "cassebrick_V3"; 

    // Connexion à la base de données
    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    // Préparer la requête SQL pour vérifier les informations d'identification de l'utilisateur
    $requete = $mysqli->prepare("SELECT * FROM joueur WHERE nom = ? AND motdepasse = ?");
    $requete->bind_param("ss", $login, $password);

    // Exécuter la requête SQL
    $requete->execute();

    // Récupérer le résultat de la requête
    $resultat = $requete->get_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($resultat->num_rows == 1) {
        //L'utilisateur existe, connecte-le
        $utilisateur = $resultat->fetch_assoc();
        if ($utilisateur["super_Admin"] == 1){
            $_SESSION["super_Admin"] = true;
            $_SESSION["admin"] = true;
        }
        else if ($utilisateur["admin"] == 1){
            $_SESSION["admin"] = true;
        }
        $_SESSION["id_joueur"] = $utilisateur["id_joueur"];
        $_SESSION["mail"] = $utilisateur["mail"];
        $_SESSION["username"] = $utilisateur["nom"];
        
        header("Location: index.php");
        exit(); 
    } else {
        // L'utilisateur n'existe pas ou les informations d'identification sont incorrectes
        echo "Nom d'utilisateur ou mot de passe incorrect!";
    }

    // Ferme la requête et la connexion à la base de données
    $requete->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/connexion.css">

<body class="light">
<a href="index.php">page d'accueil</a>
    <h2>Connexion</h2>
    <form action="connexion.php" method="post">
        <label for="login">login</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Se connecter">
    </form>
    <a href="inscription.php">Vous n'avez pas de compte ?</a>
</body>
<script src="script.js"></script>

<?php
// Générer du code JavaScript pour afficher les données de session
echo "<script>";
echo "console.log('Données de session PHP : " . json_encode($_SESSION) . "');";
echo "</script>";
?>

<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    text-align: center;
}

.container {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
}

form {
    margin-top: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"],
input[type="email"] {
    width: 20%; /* Utilise la largeur totale sur les petits écrans */
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    text-align: center;
}

input[type="submit"] {
    width: 20%; /* Utilise la largeur totale sur les petits écrans */
    padding: 10px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
}

input[type="submit"]:hover {
    background-color: #0056b3;
}

a {
    display: block;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    color: #007bff;
}

a:hover {
    color: #0056b3;
}

/* Media queries pour les écrans plus petits */
@media screen and (max-width: 768px) {
    .container {
        width: 80%; /* Réduit la largeur du conteneur sur les petits écrans */
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="submit"] {
        width: 80%; /* Réduit la largeur des champs et du bouton sur les petits écrans */
    }
}
</style>
</html>


