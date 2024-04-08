<?php
session_start();
// Vérifier si l'utilisateur est connecté en tant qu'administrateur (vous devez définir cette logique vous-même)
if (isset($_SESSION['super_Admin'])) { // Assurez-vous que la session a été démarrée avant de vérifier la variable de session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirection Admin</title>
</head>
<body>
    <h1>Choisissez où aller :</h1>
    <ul>
        <li><a href="super_dashboard_delete.php">Dashboard Super Admin</a></li>
        <li><a href="profil_user.php">Profil</a></li>
        <li><a href="../index.php">home</a></li>
    </ul>
</body>
</html>
<?php } else {
    // Si l'utilisateur n'est pas un super admin, redirigez-le ou affichez un message d'erreur
    header("Location: ../index.php"); // Redirection vers la page d'accueil
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
}
?>
