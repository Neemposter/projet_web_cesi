
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./stylesN.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<?php session_start(); ?>
<bod>
<nav>
	<ul>
		<li onclick="changeClass()" id="ind"><a  href="index">Home</a></li>
        <li><a href="session.php">session stats</a></li>
        <li style="float:right"><a  href="connexion.php">Connexion</a></li>
        <li><a href="leaderboard.php">leaderboard</a></li>
        <li><?php if(isset($_SESSION['username'])) echo "<a>Bonjour, ".$_SESSION['username'];echo "</a>"; ?></li>
    </ul> 
</nav>
</body>
</html>
