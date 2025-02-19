# MVC-POO

> [!NOTE]
> V0.2.1 -
> 19/02/2025 -
> Roicobraz \
> Dépendances : \
> php : **8.2.12**

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
Il est possible d'ajouter un script js ou css par page, via `css_files` et `js_files`. \
Il est également possible d'ajouter des script pour toutes les pages via les méthodes `script_css` et `script_js` de la classe *pagesController*.

Les scripts css et js sont doivent être leur dossiers respectifs dans le dossier `\public`.

## Ajout d'assets
Développement en cours

## Gestion des erreurs
Développement en cours