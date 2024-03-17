
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="./stylesN.css" rel="stylesheet" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
</head>
<?php session_start(); ?>
<nav>
		<ul>
			<li onclick="changeClass()" id="ind"><a  href="index">Home</a></li>
			<li onclick="changeClass()" id="ne"><a  href="news.html">News</a></li>
			<li onclick="changeClass()" style="float:right" id="prop"><a  href="about.asp">About</a></li>
            <li><a href="session.php">session stats</a></li>
            <li style="float:right"><a  href="connexion.php">Connexion</a></li>
            <li><a href="leaderboard.php">leaderboard</a></li>
            <li><a><?php echo "Bonjour, ".$_SESSION['username']; ?></a></li>
		  </ul> 
</nav>

<body>
</html>