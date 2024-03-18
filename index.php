
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="styleNavMobile.css" >
</head>
<?php session_start(); ?>
<body class="light">
<div class="sidebar">
  <ul class="menu">
    <li><?php if(isset($_SESSION['username'])) echo "<a>Bonjour, ".$_SESSION['username'];echo "</a>"; ?></li>
    <li><a href="index.php">Home</a></li>
    <li><a href="connexion.php">Connexion</a></li>
    <li><?php if(isset($_SESSION['username'])) echo "<a onclick=confirmLogout()>Déconnexion</a>"; ?></li>
    <li><a href="inscription.php">s'inscrire</a></li>
    <li><a href="leaderboard.php">leaderboard</a></li>
    
  </ul>
</div>
<div class="menu-toggle">
  <span></span>
  <span></span>
  <span></span>
</div>
<button id="myButton">Dark</button>

<script src="script.js"></script>


</body>

