<?php
// Démarre une nouvelle session ou reprend une session existante
session_start();

// Vérifie si l'utilisateur est connecté
if (isset($_SESSION['id_joueur'])) {
    $user_id = $_SESSION['id_joueur'];
    $username = $_SESSION['username'];

    echo "Utilisateur connecté. ID utilisateur : $user_id, Nom d'utilisateur : $username";
} else {
    echo "Utilisateur non connecté.";
}
?>