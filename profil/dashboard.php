<?php
session_start();

?>
<a href="../index.php">home</a>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    if (isset($_SESSION['admin'])) {
        ?>
        <!-- Onglets pour l'administration -->
        <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Create')">Create</button>
            <button class="tablinks" onclick="openTab(event, 'Read')">Read</button>
            <!-- Autres onglets ici -->
        </div>
        <?php
    } ?>
    <div class="tab">
            <button class="tablinks" onclick="openTab(event, 'Update')">Update</button>
            <button class="tablinks" onclick="openTab(event, 'Delete')">Delete</button>
            <!-- Autres onglets ici -->
    </div>
   

<div id="Create" class="tabcontent">
    <!-- Contenu de l'onglet de création -->
    <form action="inscription.php" method="post">
        <label for="username">Nom d'utilisateur:</label><br>
        <input type="text" id="username" name="username" required><br>
        <label for="login">login</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="email">email</label><br>
        <input type="email" id="email" name="email" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br>
        <input type="submit" value="Ajout Utilisateur">
    </form>
</div>

<div id="Read" class="tabcontent">
    <?php 
    $serveur = "localhost"; // adresse du serveur MySQL
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = "Samed2047_"; // mot de passe MySQL
    $base_de_donnees = "cassebrick_V3"; // nom de la base de données
    $superA = 1;
    // Connexion à la base de données
    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);
    
    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }
    
    // Préparer la requête SQL pour récupérer les informations des utilisateurs
    $requete = $mysqli->prepare("SELECT id_joueur, nom, mail, admin FROM joueur WHERE admin = 1");
    // Exécuter la requête SQL
    $requete->execute();
    $resultat = $requete->get_result();
    
    // Vérifier s'il y a des résultats
    if ($resultat->num_rows > 0) {
        // Afficher les informations de chaque utilisateur dans un tableau
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>nom</th><th>mail</th><th>Admin</th></tr>";
        while ($row = $resultat->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id_joueur"] . "</td>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . $row["mail"] . "</td>";
            echo "<td>" . $row["admin"] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Aucun résultat trouvé.";
    }
    
    // Fermer la connexion à la base de données
    $mysqli->close();
    ?>
</div>

<div id="Update" class="tabcontent">
    <!-- Contenu de l'onglet de mise à jour -->
    <form action="admin/update.php" method="post">
    <label for="nom">Nom :</label>
    <input type="text" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
    <label for="email">Email :</label>
    <input type="email" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
    <input type="submit" value="Mettre à jour">
    </form>
    <?php  ?>
</div>

<div id="Delete" class="tabcontent">
    <!-- Contenu de l'onglet de suppression -->
    <?php  
    // Start the session

    
    // Check if the user is logged in
    if(isset($_SESSION['username'])) {
        // Check if the user has confirmed the deletion
        if(isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
            // Perform logout by destroying the session
            session_destroy();
    
            // Connect to the database
            $conn = new mysqli("localhost", "username", "password", "database");
    
            // Check the database connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            echo "<script>
                    var confirmed = confirm('Are you sure you want to delete your account?');
                    if(confirmed) {
                        document.getElementById('confirmForm').submit();
                    } else {
                        // If not confirmed, redirect to another page or display a message
                        window.location.href = 'index.php'; // Redirect to index.php
                    }
                </script>";
            // Prepare and execute the query to delete the user account
            $userId = $_SESSION['id_joueur']; // Assuming you have the user ID in the session
            $sql = "DELETE FROM joueurs WHERE id_joueur = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId); // Assuming id_joueur is an integer
            $stmt->execute();
    
            // Check if the deletion was successful
            if ($stmt->affected_rows > 0) {
                echo "User account deleted successfully.";
            } else {
                echo "Failed to delete user account.";
            }
    
            // Close the database connection
            $conn->close();
        } else {
            // Ask for confirmation using JavaScript
            
        }
    } else {
        // Redirect the user to the login page if not logged in
        header("Location: login.php");
        exit();
    }
    ?>
    <form id="confirmForm" method="post">
        <input type="hidden" name="confirm" value="yes">
    </form>
    
    
</div>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>

</body>
</html>
