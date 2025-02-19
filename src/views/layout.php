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
	 	<?= slink(array("link" => "politique-de-confidentialite", "content" => "Politique de confidentialit&eacute;"));	?>	 
		&nbsp;-&nbsp;
		<?= slink(array("link" => "mentions-legales", "content" => "Mentions l&eacute;gales"));	?>
	</footer>
    <?= $js_files ?>
</body>
</html>