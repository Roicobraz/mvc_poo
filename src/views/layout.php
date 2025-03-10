<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8" Referrer-Policy="same-origin">
	<title><?= $titre ?></title>
	<?= $css_files ?>
</head>
<body>
    <header>
    <?php if($nav_active) { ?>
    <nav>
        <ul>
            <li><a href="./">Accueil</a></li>
        </ul>
    </nav>
    <?php } ?>
    </header>
    <main class="<?= $class_page ?>">
        <?= $contentView ?>
    </main>

    <?php if($footer_active) { ?>
	<footer>
        <a href="<?= URL?>/politique-de-confidentialite">Politique de confidentialit&eacute;</a>
		&nbsp;-&nbsp;
        <a href="<?= URL?>/mentions-legales">Mentions l&eacute;gales</a>
	</footer>
    <?php } ?>

    <?= $js_files ?>
</body>
</html>