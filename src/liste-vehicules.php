<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'gestionnaire' on le renvoie au tableau de bord
if(!is_gestionnaire()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='liste-vehicules';

$query=$bdd->prepare(
    'SELECT *
    FROM gm_vehicules');
$query->execute();
$vehicules=$query->fetchAll();

setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');

include 'layout.phtml';