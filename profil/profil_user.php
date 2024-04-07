<div id="Read" class="tabcontent">
<?php
session_start();
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
$requete = $mysqli->prepare("SELECT * FROM joueur WHERE nom=?");
$requete->bind_param("s", $_SESSION['username']);

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
    <form action="../profil/update.php" method="post">
        <label for="nom">Nom :</label>
        <input type="text" id="username" name="nom" value=<?php echo ($_SESSION['username']); ?>>
        <label for="mail">Email :</label>
        <input type="email" id="mail" name="mail" value=<?php echo ($_SESSION['mail']); ?>>
        <input type="submit" value="Mettre à jour">
    </form>
</div>
