<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {



    // Récupérer l'e-mail soumis par l'utilisateur
    $serveur = "localhost"; // adresse du serveur MySQL
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = ""; // mot de passe MySQL
    $base_de_donnees = "cassebrick2"; // nom de la base de données

    $email = $_POST["email"]; //email du compte
    $token = bin2hex(random_bytes(32)); // Générer un token unique
    $creation_time = time(); // Get the current time
    $expiration_time = strtotime('+1 hour', $creation_time);



    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);


    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }
    
// Préparer les requête SQL
$requete_SELECT = $mysqli->prepare("SELECT id_joueur FROM joueurs WHERE email = ?");
$requete_INSERT = $mysqli->prepare("INSERT INTO password_recovery (id_joueur, token_key, creation_date, expiration_date) VALUES (?, ?, ?, ?)");

// Lier les paramètres
$requete_SELECT->bind_param("s", $id_joueur);
$requete_INSERT->bind_param("isii", $id_joueur, $token, $creation_date, $expiration_date);



if ($requete_SELECT->execute()) {
    $requete_SELECT->close();
    if ($requete_INSERT->execute()) {
    } else {
        echo "Erreur lors de l'insertion des données : " . $requete_INSERT->error;
    }
} else {
    echo "mauvaise adresse : " . $requete_SELECT->error;
}



    // Envoyer l'e-mail de réinitialisation
    $sujet = "Réinitialisation du mot de passe";
    $message = "Pour réinitialiser votre mot de passe, veuillez cliquer sur le lien suivant : http://localhost/projet_web_cesi/token_check.php?email=$email&token=$token";
    $headers = "From: webmaillara@gmail.com\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    if (mail($email, $sujet, $message)) {
        echo "Un e-mail de réinitialisation a été envoyé à votre adresse e-mail.";
    } else {
        echo "Erreur lors de l'envoi de l'e-mail de réinitialisation.";
    }
}
