<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='liste-operations';

$query=$bdd->prepare(
    'SELECT gm_maintenance.id,sujet,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id');
$query->execute();
$operations=$query->fetchAll();

include 'layout.phtml';