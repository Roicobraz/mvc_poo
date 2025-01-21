<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title><?php echo($titre) ?></title>
		<?= script_css() ?>
	</head>
	<body>
	<header>
		<!-- navbar -->
	</header>
	<main class="container <?= $class_page?>">
		<div id="global" class="<?= $class_global?>">
			<div id="contenu">
				<?= $contenu ?>
			</div> <!-- #contenu -->
		</div> <!-- #global -->
	</main>
	<footer>
		
	</footer>
	<?= script_js()?>
	</body>
</html>