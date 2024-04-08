<?php  
    // Start the session
    session_start();
    
    // Check if the user is logged in

        $selected_ids = $_POST['selected_ids'];
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
    
        // Préparer la requête SQL pour supprimer les utilisateurs avec les ID sélectionnés
        $requete = $mysqli->prepare("DELETE FROM joueur WHERE id_joueur = ?");
        foreach ($selected_ids as $id) {
            $requete->bind_param("i", $id);
            $requete->execute();
        }
    
        // Fermer la requête et la connexion à la base de données
        $requete->close();
        $mysqli->close();
    
        // Rediriger vers une autre page ou afficher un message de confirmation
    
?>
    <a href="../index.php">home</a>
    