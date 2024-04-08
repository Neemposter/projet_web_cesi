<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {

    $serveur = "localhost"; // adresse du serveur MySQL
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = ""; // mot de passe MySQL
    $base_de_donnees = "cassebrick2"; // nom de la base de données
    $email = $_GET["email"];
    $token = $_GET["token"];
    $time;

    $requete_SELECT = $mysqli->prepare("SELECT (token_key, creation_date, expiration_date) FROM utilisateurs WHERE email = ?");

    $requete_SELECT->bind_param("ssii", $email, $token, $created, $expired);

    if ($requete->execute()) {
        if($time < $expired - $created){
            header("Location: modifPass.php");
            exit();
        }
    } else {
        echo "Erreur lors de l'insertion du token : " . $requete->error;
    }
    $requete->close();
    $mysqli->close();
    
    exit();
}