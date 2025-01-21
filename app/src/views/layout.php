<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Application</title>
    <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/@picocss/pico@2/css/pico.min.css"
>
</head>
<body>
    <header>
    <nav>
        <ul>
            <li><strong>Bonjour test</strong></li>
        </ul>
        <ul>
            <li><a href="./accueil">Accueil</a></li>
            <li><a href="./deconnexion">Déconnexion</a></li>
            <li><a href="./inscription">Inscription</a></li>
            <li><a href="./connexion">Connexion</a></li>
        </ul>
    </nav>

    <?php 
        // printf($errors); 
    ?>

    </header>
    <main class="container" style="background:#959595; padding: 10px; border-radius:15px">
        <?php  include $contentView ?>
    </main>
</body>
</html>