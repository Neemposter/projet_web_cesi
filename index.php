 <?php session_start();
$url = "profil/dashboardHandler.php" ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Jeux de Casse-Bricks</title>
    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <header>
        <h1>Jeux de Casse-Bricks</h1>
        <nav>
            <ul>
                <li><?php if(isset($_SESSION['username'])) echo "<a>Bonjour, ".$_SESSION['username'];echo "</a>"; ?></li>
                <li><a href="connexion.php">connexion</a></li>
                <li><?php if(isset($_SESSION['username'])) echo "<a href = $url>profil</a>"; ?></li>
                <li><?php if(isset($_SESSION['username'])) echo "<a class=logout onclick=confirmLogout()>Déconnexion</a>"; ?></li>
            </ul>
        </nav>
    </header>

    <?php
// Connexion à la base de données
$serveur = "localhost"; // Adresse du serveur MySQL
$utilisateur = "root"; // Nom d'utilisateur MySQL
$motdepasse = "Samed2047_"; // Mot de passe MySQL
$base_de_donnees = "cassebrick_V3"; // Nom de la base de données

$mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}

// Requête SQL pour récupérer les noms et descriptions de jeux avec les informations des créateurs
$requete = $mysqli->prepare( "SELECT jeux.nom AS nom_jeu, jeux.description AS description_jeu, joueur.nom AS nom_createur 
            FROM jeux 
            INNER JOIN joueur ON jeux.id_createur = joueur.id_joueur");
$requete->execute();
$resultat = $requete->get_result();

// Vérifier s'il y a des résultats
if ($resultat->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Nom du jeu</th><th>Description</th><th>Créateur</th></tr>";
    // Afficher les noms et descriptions des jeux dans un tableau
    while ($row = $resultat->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["nom_jeu"] . "</td>";
        echo "<td>" . $row["description_jeu"] . "</td>";
        echo "<td>" . $row["nom_createur"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Aucun jeu trouvé.";
}

// Fermer la connexion à la base de données
$mysqli->close();
?>

</body>
<script src = "script.js"></script>
</html>
