<?php

require_once('rsc/function.php');
require_once('controller/routeur.php');

use controller\Routeur;

$routeur = new Routeur();
$routeur->routerRequete();