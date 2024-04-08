<div id="Read" class="tabcontent">
<?php
session_start();
if(isset($_SESSION['super_Admin'])){
$serveur = "localhost"; // adresse du serveur MySQL
$utilisateur = "root"; // nom d'utilisateur MySQL
$motdepasse = "Samed2047_"; // mot de passe MySQL
$base_de_donnees = "cassebrick_V3"; // nom de la base de données

// Connexion à la base de données
$mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

// Vérifier la connexion
if ($mysqli->connect_error) {
    die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
}

// Préparer la requête SQL pour récupérer les informations des utilisateurs
$requete = $mysqli->prepare("SELECT * FROM joueur");

// Exécuter la requête SQL
$requete->execute();
$resultat = $requete->get_result();

// Vérifier s'il y a des résultats
if ($resultat->num_rows > 0) {
    echo "<form action='super_delete.php' method='post'>"; // Ouvrez le formulaire ici
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>nom</th><th>mail</th><th>Admin</th><th>super Admin</th><th>Supprimer</th></tr>";
    while ($row = $resultat->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id_joueur"] . "</td>";
        echo "<td>" . $row["nom"] . "</td>";
        echo "<td>" . $row["mail"] . "</td>";
        echo "<td>" . $row["admin"] . "</td>";
        echo "<td>" . $row["super_Admin"] . "</td>";
        echo "<td><input type='checkbox' name='selected_ids[]' value='" . $row["id_joueur"] . "'></td>"; // Ajoutez une case à cocher dans chaque ligne pour sélectionner l'ID
        echo "</tr>";
    }
    echo "</table>";
    echo "<input type='submit' value='Soumettre'>"; // Ajoutez un bouton de soumission à l'extérieur du tableau
    echo "</form>"; // Fermez le formulaire ici
} else {
    echo "Aucun résultat trouvé.";
}



// Fermer la connexion à la base de données
$mysqli->close();
}else{ ?>
<a href="../index.php">nope</a><?php
}
