 <?php session_start();
$url = "profil\dashboardHandler.php" ?>
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
                <li><?php if(isset($_SESSION['username'])) echo "<a href=$url>profil</a>"; ?></li>
                <li><?php if(isset($_SESSION['username'])) echo "<a class=logout onclick=confirmLogout()>Déconnexion</a>"; ?></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero">
            <h2>Bienvenue sur notre site de jeux de casse-bricks</h2>
            <p>Découvre  z une sélection des meilleurs jeux de casse-bricks en ligne. Amusez-vous à détruire des briques et battez vos propres records!</p>
            <a href="#" >Découvrir nos jeux</a>
        </section>
        
        <section class="games">
            <!-- Insérez ici les vignettes des jeux -->
            <div class="game-thumbnail">
                <h3>Nom du Jeu 1</h3>
                <p>Description du jeu 1</p>
                <a href="#">Jouer</a>
            </div>
            <div class="game-thumbnail">
                <h3>Nom du Jeu 2</h3>
                <p>Description du jeu 2</p>
                <a href="#">Jouer</a>
            </div>
            <!-- Ajoutez plus de vignettes si nécessaire -->
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Jeux de Casse-Bricks. Tous droits réservés.</p>
    </footer>
</body>
<script src = "script.js"></script>
</html>
