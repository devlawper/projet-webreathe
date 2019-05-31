<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'gestionnaire' ou 'technicien' on le renvoie au tableau de bord
if(!is_gestionnaire() && !is_technicien()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='detail-vehicule';

$query=$bdd->prepare(
    'SELECT *
    FROM gm_vehicules
    WHERE id=?');
$query->execute(array($_GET['id']));
$vehicule=$query->fetch();

setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');

include 'layout.phtml';