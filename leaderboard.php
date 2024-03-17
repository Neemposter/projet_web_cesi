<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./responsive_leaderboard.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <nav>
		<ul>
			<li onclick="changeClass()" id="ind"><a  href="index.php">Home</a></li>
		  </ul> 
</nav>
<?php
// Paramètres de connexion à la base de données
$serveur = "localhost"; // adresse du serveur MySQL
$utilisateur = "root"; // nom d'utilisateur MySQL
$motdepasse = ""; // mot de passe MySQL
$base_de_donnees = "cassebrick2"; // nom de la base de données

// Connexion à la base de données
$mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}

// Exécuter une requête SQL pour récupérer les données du leaderboard
$requete = "SELECT joueurs.nom_joueur, leaderboard.points
            FROM joueurs
            INNER JOIN leaderboard ON joueurs.id_joueur = leaderboard.id_joueur
            ORDER BY leaderboard.points DESC";
$resultat = $mysqli->query($requete);

// Vérifier s'il y a des résultats
if ($resultat->num_rows > 0) {
    // Afficher le tableau du leaderboard
    echo "<h2>Leaderboard</h2>";
    echo "<table>";
    echo "<tr><th>Rang</th><th>Nom du joueur</th><th>Points</th></tr>";

    // Initialisation du classement
    $classement = 1;

    // Parcourir les résultats et afficher chaque ligne dans le tableau
    while ($row = $resultat->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $classement . "</td>";
        echo "<td>" . $row['nom_joueur'] . "</td>";
        echo "<td>" . $row['points'] . "</td>";
        echo "</tr>";
        $classement++; // Incrémenter le classement
    }

    echo "</table>";
} else {
    echo "Aucun résultat trouvé.";
}

// Fermer la connexion à la base de données
$mysqli->close();
?>

