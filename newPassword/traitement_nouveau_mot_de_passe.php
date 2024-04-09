<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serveur = "localhost"; // adresse du serveur MySQL
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = ""; // mot de passe MySQL
    $base_de_donnees = "cassebrick2"; // nom de la base de données

    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    $requete_INSERT = $mysqli->prepare("INSERT INTO joueurs (mot_de_passe) VALUES (?)");

    $requete_INSERT->bind_param("s", $mot_de_passe);
    

    if ($password !== $confirm_password) {
        echo "Les mots de passe ne correspondent pas.";
    }   else{
        if ($requete->execute()) {
            echo "mot de passe modifié !";
        }
        else{
            echo "erreur";
        }
    }
    $requete->close();
    $mysqli->close();
    
    exit();
}