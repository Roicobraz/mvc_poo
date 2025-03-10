<?php 

namespace mvc_poo\Core;

class pagesController {
    public bool $nav_active = true;
    public bool $footer_active = true;

    public string $titre = '';
    public string $class_page = '';
    
    public array $css_files = [];
    public array $js_files = [];

    public string $fichier;

    /**
     * Désignation du fichier Vue de la page
     */
    public function setTemplate(string $action): string|false {
        $file = VIEW_PATH . $action . '.php';
        try{     
            if(file_exists($file))
            {
                $this->fichier = $file; 
            }
            else {    
                $this->fichier = VIEW_PATH . 'error.php';
                throw new \Exception("Template introuvable");
            }
        }        
        catch (\Exception $e)
        {
            $GLOBALS['critical_error'] = $e;
        }
        return($this->fichier);
    }

    /**
     * Génère et affiche la vue
     */
    public function generer(array $donnees): false|string {
        // Génération de la partie spécifique de la vue
        gettype($this->fichier);
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier(VIEW_PATH . "layout.php",
                array(
                    'titre' => $this->titre, 
                    "class_page" => $this->class_page, 
                    'contentView' => $contenu,
                    'css_files' =>  $this->script_css($this->css_files),
                    'js_files' =>  $this->script_js($this->js_files),
                    'nav_active' =>  $this->nav_active,
                    'footer_active' =>  $this->footer_active
                ));
        // Renvoi de la vue au navigateur
        return $vue;
    }

    /**
     * Génère un fichier vue et renvoie le résultat produit
     */ 
    private function genererFichier(string $fichier, array $donnees): string {
        // Rend les éléments du tableau $donnees accessibles dans la vue
        extract($donnees);
        // Démarrage de la temporisation de sortie
        ob_start();
        // Inclut le fichier vue
        // Son résultat est placé dans le tampon de sortie
        require $fichier;
        // Arrêt de la temporisation et renvoi du tampon de sortie
        return ob_get_clean();
    }

    /**
     * Appel css pour toute les pages
     * @param array $add_css nom des fichiers css à ajouter
     */
	public function script_css(array $add_css = array("")): string {
        // fichier css appelé pour toutes les pages
		$script = '';

        array_push($add_css, 'style');
        array_push($add_css, 'framework/error');

        try{
            // si add_css est vide
            if(!empty($add_css))
            {
                foreach($add_css as $css_link)
                {
                    if($css_link != "")
                    {
                        $link = URL."/css/$css_link";
                        $path = ROOT_PATH."/public/css/$css_link";

                        if(!str_contains($link, ".css"))
                        {
                            $link .= ".css";
                            $path .= ".css";
                        }
                        

                        // ajout du lien si le fichier existe
                        if (file_exists($path))
                        {
                            $script .= '<link type=text/css rel="stylesheet" href="'.$link.'" crossorigin="anonymous">';
                        }
                        else 
                        {
                            throw new \Exception('Lien du fichier CSS inconnu.');
                        }
                    }
                }
            }
        }
        catch (\Exception $e)
        {
            $GLOBALS['error']->addError($e);
        }

		return($script);
	}

    /**
     * Appel js pour toute les pages
     * @param array $add_js nom des fichiers js à ajouter
     */
	public function script_js(array $add_js = array("", "")): string {		
        // fichier js appelé pour toutes les pages 
        $script = '';
        
        array_push($add_js, array("text/javascript", "script"));

        try{
            // si add_js est vide
            if(!empty($add_js))
            {
                foreach($add_js as $js_link)
                { 
                    $type = "type=text/javascript";
                    $link = URL."/js/{$js_link[1]}";
                    $path = ROOT_PATH."/public/js/{$js_link[1]}";

                    if($js_link[0] != '')
                    {
                        $type = "type=".$js_link[0];
                    }

                    if(!str_contains($link, ".js"))
                    {
                        $link .= ".js";
                        $path .= ".js";
                    }

                    // ajout du lien si le fichier existe
                    if(file_exists($path))
                    {
                        $script .= '<script '.$type.' src="'.$link.'" crossorigin="anonymous"></script>';
                    }
                    else 
                    {
                        throw new \Exception('Lien du fichier Javascript inconnu.');
                    }
                }
            }
        }
        catch (\Exception $e)
        {
            $GLOBALS['error']->addError($e);
        }

        return($script);
	}
}