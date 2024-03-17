<?php

session_start();
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit();
}
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Informations de connexion à la base de données
    $serveur = "localhost"; 
    $utilisateur = "root"; // nom d'utilisateur MySQL
    $motdepasse = ""; // mot de passe MySQL
    $base_de_donnees = "cassebrick2"; 

    // Connexion à la base de données
    $mysqli = new mysqli($serveur, $utilisateur, $motdepasse, $base_de_donnees);

    // Vérifier la connexion
    if ($mysqli->connect_error) {
        die("Erreur de connexion à la base de données : " . $mysqli->connect_error);
    }

    // Préparer la requête SQL pour vérifier les informations d'identification de l'utilisateur
    $requete = $mysqli->prepare("SELECT * FROM joueurs WHERE login = ? AND mot_de_passe = ?");
    $requete->bind_param("ss", $login, $password);

    // Exécuter la requête SQL
    $requete->execute();

    // Récupérer le résultat de la requête
    $resultat = $requete->get_result();

    // Vérifier si l'utilisateur existe dans la base de données
    if ($resultat->num_rows == 1) {
        //L'utilisateur existe, connecte-le
        $_SESSION["username"] = $nom_joueur;
        $_SESSION["id_joueur"] = $id_joueur;
        header("Location: user.php");
        exit(); 
    } else {
        // L'utilisateur n'existe pas ou les informations d'identification sont incorrectes
        echo "Nom d'utilisateur ou mot de passe incorrect!";
    }

    // Ferme la requête et la connexion à la base de données
    $requete->close();
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h2>Connexion</h2>
    <?php if (isset($error_message)) : ?>
        <p><?php echo $error_message; ?></p>
    <?php endif; ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="login"> Nom d'utilisateur:</label><br>
        <input type="text" id="login" name="login" required><br>
        <label for="password">Mot de passe:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Connexion">
    </form>
</body>
</html>
