<div id="Read" class="tabcontent">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>profil</title>
    <link rel="stylesheet" href="../style/profil.css">
</head>
<script src = "../script.js"></script>
<nav>
            <ul>
                <li><a href="../index.php">index</a></li>
                <li><a class=logout onclick=confirmLogout()>Déconnexion</a></li>
            </ul>
</nav>
<?php
session_start();
if(isset($_SESSION['id_joueur'])){
$serveur = "localhost"; // adresse du serveur MySQL
$utilisateur = "root"; // nom d'utilisateur MySQL
$motdepasse = ""; // mot de passe MySQL
$base_de_donnees = "cassebrick_V3"; // nom de la base de données
$superA = 1;
// Connexion à la base de données
$mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}

// Préparer la requête SQL pour récupérer les informations des utilisateurs
$requete = $mysqli->prepare("SELECT * FROM joueur WHERE nom=?");
$requete->bind_param("s", $_SESSION['username']);

// Exécuter la requête SQL
$requete->execute();
$resultat = $requete->get_result();

// Vérifier s'il y a des résultats
if ($resultat->num_rows > 0) {
    // Afficher les informations de chaque utilisateur dans un tableau
    echo "<table border='1'>";
    if(isset($_SESSION['admin']) == true){
        echo "<tr><th>ID</th><th>nom</th><th>mail</th><th>Admin</th></tr>";
    }else if(isset($_SESSION['super_admin']) == true){
        echo "<tr><th>ID</th><th>nom</th><th>mail</th><th>super Admin</th></tr>";
    }else{
        echo "<tr><th>ID</th><th>nom</th><th>mail</th>";
    }
    while ($row = $resultat->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_joueur"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["mail"] . "</td>";
        if(isset($_SESSION['admin']) == true){
            echo "<td>" . $row["admin"] . "</td>";
        }
        if(isset($_SESSION['super_Admin']) == true){
            echo "<td>" . $row["super_Admin"] . "</td>";
        }
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
    <form action="../profil/update.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="username" name="username" value=<?php echo ($_SESSION['username']); ?>>
        <label for="nom">mail :</label>
        <input type="text" id="username" name="mail" value=<?php echo ($_SESSION['mail']); ?>>
        <input type="submit" value="Mettre à jour">
    </form>
</div>

<div>
</head>
<body>
    <h1>Création de jeu</h1>
    <form action="../profil/create_game.php" method="post">
        <label for="nom">Nom du jeu :</label><br>
        <input type="text" id="nom" name="nom" required><br>
        <label for="description">Description (250 caractères max) :</label><br>
        <textarea id="description" name="description" maxlength="250" required></textarea><br>
        <input type="submit" value="Créer">
    </form>
</body>
</div>

<div>
<form action="../profil/delete.php" method="post">
    <button onclick=confirmDeletion()>suppression de compte</a>
</div>



<?php
} else{?>
    <a href="../index.php">bien essayé</a><?php
}