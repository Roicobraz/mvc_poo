<?php 
    $error = $GLOBALS['critical_error'];
    $message = $error->getmessage();

    if(isset($error->getTrace()[0]["args"][0]))
    {
        $route = $error->getTrace()[0]["args"][0];
        if(isset($error->getTrace()[0]["args"][1]))
        {
            $controller = $error->getTrace()[0]["args"][1][$route];
        }
    }

    $file = $error->getFile();
    if(str_contains($file, '/var/www/html'))
    {
        $file = str_replace('/var/www/html', '', $error->getFile());
    }
?>
<div class='title'>
    <h1>Erreur Critique</h1>
</div>

<div class='error_content'>
    <div class='error_file'>L'erreur s'est produite à la ligne <?= $error->getline(); ?> du fichier <?= $file; ?></div> 
    <div class='error_msg'>
        <?php 
            if(str_contains($message, 'Controlleur'))
            {
                echo("Le controlleur $controller n'existe pas.");
            }
            elseif(str_contains($message, 'La classe'))
            {
                echo($message);
            }
            elseif(str_contains($message, 'Template'))
            {
                echo("Le fichier vue $route n'existe pas.");
            }
        ?>
    </div> 
    <p class='doc'>Voir la documentation, <a href="https://github.com/Roicobraz/mvc_poo/wiki" title="Wiki">ici</a>.</p>
</div>
