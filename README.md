# MVC-POO

> [!NOTE]
> V0.2.2 -
> 19/02/2025 -
> Roicobraz \
> Dépendances : \
> php : **8.2.27**

Framework de site internet développé en PHP (en programmation orienté objet) sous l'architecture MVC.

Pour utiliser ce framework, il suffit de récupérer le projet et le copier là où vous voulez.  

Ensuite afin de pouvoir accéder au site, vous de devez modifiez :
- le fichier [htaccess](./.htaccess).
  - le `{protocole}`, http ou https (https est fortement recommandé)
  - le `{nom_de_domaine}`, si votre site doit être accessible via un port spécifique alors il doit être mentionner ici sous la forme `{nom_de_domaine}:{port}` 
  - si le site est dans un dossier et non à la racine le nom du dossier doit être ajouter après le nom de domaine (sauf à la L5), avant la mention du dossier "public", fichier "index", ainsi qu'avant les différentes ressources du site dnas le `mod_headers`.
- et le fichier [index.php](./public/index.php)
  - à la L3, la constante URL doit être l'URL racine de votre site 

Une fois le site installé 
Pour pouvoir utiliser le framework vous avez un [Wiki](https://github.com/Roicobraz/mvc_poo/wiki)