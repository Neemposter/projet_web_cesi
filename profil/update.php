<?php
session_start();

// Vérifie si les données du formulaire ont été soumises
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifie si les champs obligatoires sont renseignés
    if (isset($_SESSION['nom']) || isset($_POST['username']) || isset($_POST['mail'])) {
        // Récupère les données du formulaire
        $id_joueur = $_SESSION['username'];
        $nom = $_POST['username'];
        $email = $_POST['mail'];

        // Connexion à la base de données
        $serveur = "localhost";
        $utilisateur = "root";
        $mot_de_passe = "Samed2047_";
        $base_de_donnees = "cassebrick_V3";

        $mysqli = new mysqli($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

        // Vérifie la connexion à la base de données
        if ($mysqli->connect_error) {
            die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
        }

        // Prépare la requête SQL pour mettre à jour le nom_joueur et l'email
        if(isset($_POST['username']) && isset($_POST['mail'])){
            $requete = $mysqli->prepare("UPDATE joueur SET nom = ?, email = ? WHERE id_joueur = ?");
            $requete->bind_param("ssi", $nom_joueur, $email, $id_joueur);
        }else if(isset($_POST['username'])){
            $requete = $mysqli->prepare("UPDATE joueurs SET nom = ? WHERE id_joueur = ?");
            $requete->bind_param("si", $nom, $id_joueur);
        }else if(isset($_POST['mail'])){
            $requete = $mysqli->prepare("UPDATE joueurs SET mail = ? WHERE id_joueur = ?");
            $requete->bind_param("si", $email, $id_joueur);
        }
        // Exécute la requête SQL
        if ($requete->execute()) {
            echo "Mise à jour effectuée avec succès.";
        } else {
            echo "Erreur lors de la mise à jour : " . $mysqli->error;
        }

        // Ferme la connexion à la base de données
        $requete->close();
        $mysqli->close();
    } else {
        echo "Tous les champs sont obligatoires.";
    }
}
?>
