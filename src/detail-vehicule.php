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

$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_debut,date_fin,sujet,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE date_fin>=NOW() && date_debut<=NOW() && gm_vehicules.id=?');
$query->execute(array($_GET['id']));
$operation=$query->fetch();

$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_fin,sujet,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE date_fin<NOW() && gm_vehicules.id=?');    
$query->execute(array($_GET['id']));
$historique=$query->fetch();

$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_fin,sujet,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE date_fin>NOW() && gm_vehicules.id=?');    
$query->execute(array($_GET['id']));
$prevu=$query->fetch();

setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');

include 'layout.phtml';