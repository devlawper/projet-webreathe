<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='detail-operation';

$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_debut,date_fin,sujet,description,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE gm_maintenance.id=?');
$query->execute(array($_GET['id']));
$operation=$query->fetch();

setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');

include 'layout.phtml';