<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" Referrer-Policy="same-origin">
	<title><?= $titre ?></title>
	<?= $css_files ?>
</head>
<body>
    <header>
    <nav>
        <ul>
            <li><a href="./">Accueil</a></li>
        </ul>
    </nav>

    </header>
    <main class="container">
        <?= $contentView ?>
    </main>
	
	<footer>
        <a href="<?= URL?>/politique-de-confidentialite">Politique de confidentialit&eacute;</a>
		&nbsp;-&nbsp;
        <a href="<?= URL?>/mentions-legales">Mentions l&eacute;gales</a>
	</footer>
    <?= $js_files ?>
</body>
</html>