<?php
session_start();
// Récupérer les données du formulaire
$nom = $_POST['nom'];
$description = $_POST['description'];
$id_createur = $_SESSION['id_joueur'];

// Vérifier si les données sont valides
if (empty($nom) || empty($description)) {
    // Redirection vers la page de création avec un message d'erreur si des champs sont vides
    header("Location: creation_jeu.php?erreur=Veuillez remplir tous les champs.");
    exit();
}

// Informations de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$motdepasse = "";
$base_de_donnees = "cassebrick_V3";

// Connexion à la base de données
$mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}

// Préparer la requête SQL pour insérer les données du jeu
$requete = $mysqli->prepare("INSERT INTO jeux (nom, id_createur, description) VALUES (?, ?, ?)");
$requete->bind_param("sis", $nom, $id_createur, $description);

// Exécuter la requête SQL
if ($requete->execute()) {
    // Redirection vers la page de création avec un message de succès si l'insertion a réussi
    header("Location: ../index.php");
    exit();
} else {
    // Redirection vers la page de création avec un message d'erreur si l'insertion a échoué
    header("Location: profil_user.php");
    exit();
}

// Fermer la connexion à la base de données
$requete->close();
$mysqli->close();
?>
