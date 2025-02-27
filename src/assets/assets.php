<?php
/**
 * Fichier d'ajout des assets
 * Il est possible d'ajouter des fonctions ici mais également require des assets
 * Par défaut les assets sont ajouté mais chaque assets peut être désactivé 
 * les fichiers css et js doivent être dans les dossiers css et js dans le dossier public
 */

$array = [
    '.', '..', 'assets.php'
// Ajoutez les assets à désactiver
];

    foreach(scandir(ASSETS_PATH) as $file )
    {
        if(!in_array($file, $array))
        {
            if(is_dir(ASSETS_PATH . $file))
            {
                if(file_exists(ASSETS_PATH . "$file/$file.php"))
                {   
                    require(ASSETS_PATH . "$file/$file.php");
                }
                elseif(file_exists(ASSETS_PATH . "$file/index.php"))
                {
                    require(ASSETS_PATH . "$file/index.php");
                }
            }
        }
    }

/** ------------------------------------------------------------------- **\
|** ---------------------------- FONCTIONS ---------------------------- **|
\** ------------------------------------------------------------------- **/
    /**
     * Determine the age with the birthday and the currently date.
     * dateOfBirth need to be in format : d-m-Y
     */
    function age(string $dateOfBirth): string
    {
        $today = date("d-m-Y");
        $diff = date_diff(date_create($dateOfBirth), date_create($today));      
        $age = $diff->format("%Y");
        return($age);
    }