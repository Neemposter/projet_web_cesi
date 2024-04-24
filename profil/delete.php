

    <?php  
    // Start the session
    session_start();
    
    // Check if the user is logged in
    if(isset($_SESSION['id_joueur'])) {
            // Perform logout by destroying the session
            session_destroy();
            $serveur = "localhost"; 
            $utilisateur = "root"; // nom d'utilisateur MySQL
            $motdepasse = ""; // mot de passe MySQL
            $base_de_donnees = "cassebrick_V3";
            // Connect to the database
            $conn = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
    
            // Check the database connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Prepare and execute the query to delete the user account
            $id_joueur = $_SESSION['id_joueur']; // Assuming you have the user ID in the session
            $requete = $conn->prepare("DELETE FROM joueur WHERE id_joueur = ?");
            $requete->bind_param("i", $id_joueur);
            $requete->execute();
    
            // Check if the deletion was successful
            if ($requete->affected_rows > 0) {
                
                ?>
                <!DOCTYPE html>
                <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
    <link rel="stylesheet" href="../style/profil.css">
</head>
                <nav>
            <ul>
                <li><a href="../index.php">index</a></li>
            </ul>
                </nav>
                <h1>User account deleted successfully.<h1>


<?php
            } else {
                echo "Failed to delete user account.";
            }
    
            // Close the database connection
            $conn->close();
        } 