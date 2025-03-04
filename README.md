# MVC-POO

> [!NOTE]
> V0.2.1 -
> 19/02/2025 -
> Roicobraz \
> Dépendances : \
> php : **8.2.27**

Framework de site internet développé en PHP (en programmation orienté objet) sous l'architecture MVC.

## Ajout d'une page 
Pour Ajouter une page, il faut:
- Ajouter la route dans le `src/config/routes.php` \
  dans le format `"/nom_de_la_route" => "nom_du_fichier_controller.php"`
- Ajouter un controller dans le dossier `src/controllers` qui comporte une classe fille de *pagesController*. \
  Vous pouvez ici définir un fichier vue pour votre page ainsi que déclarer les paramètres de la page, comme :
  -  nav_active
  -  titre
  -  class_page
  -  class_global
  -  css_files
  -  js_files
- Ajouter une vue, avec le nom mentionné dans le controller, dans `src/views`.


## Ajout de script
Il est possible d'ajouter un script js ou CSS par page, via `css_files` et `js_files`.  
Il est également possible d'ajouter des script pour toutes les pages via les méthodes `script_css` et `script_js` de la classe *pagesController*.

Les scripts CSS et js sont doivent être leur dossiers respectifs dans le dossier `/public`.

## Ajout d'assets
Pour ajouter des assets, il faut les mettre dans le dossier `src/assets/`.  
Si votre asset contient du CSS et/ou du Javascript, il faut les mettre dans les dossiers assets des dossiers `/public/css` et `/public/js`.

Les assets sont ajouté automatiquement au site, vous pouvez toutefois désactivé à votre demande des assets.  
Pour cela, ajoutez le nom de du fichier dans le tableau **disabled**.  

⚠ Ne pas supprimer les éléments déjà présent dans le tableau au dessus du commentaire.

Si vous utilisez une certaines nomenclature de fichiers pour vos assets, n'hésitez pas à modifier aux lignes *24* et *26*.  
Le nom de fichier par défaut il est de `index.php` 

## Gestion des erreurs
Si le mode Dev est actif (constante **IN_DEV** index.php->L6) un suivi des erreurs s'ajoute par défaut en haut à droite.  
Il peut cependant être déplacer sur la L34 en donnant l'angle voulu (`top-right`, `top-left`, `bot-right` ou `bot-left`).