<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='detail-operation';

// On récupère toutes les informations concernant l'opérations de maintenance
$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_debut,date_fin,sujet,description,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE gm_maintenance.id=?');
$query->execute(array($_GET['id']));
$operation=$query->fetch();

// On définit le format de date français
setlocale(LC_ALL, 'fr_FR.UTF8', 'fr_FR','fr','fr','fra','fr_FR@euro');

// On récupère toutes les photos de l'opération de maintenance en question
$query=$bdd->prepare(
    'SELECT photo,titre
    FROM gm_photos
    INNER JOIN gm_maintenance
    ON gm_photos.maintenance_id=gm_maintenance.id
    WHERE gm_maintenance.id=?');
$query->execute(array($_GET['id']));
$photos=$query->fetchAll();

// On récupère toutes les notes de l'opération de maintenance en question
$query=$bdd->prepare(
    'SELECT note,prenom,nom
    FROM gm_notes
    INNER JOIN gm_maintenance
    ON gm_notes.maintenance_id=gm_maintenance.id
    INNER JOIN gm_users
    ON gm_notes.tech_id=gm_users.id    
    WHERE gm_maintenance.id=?');
$query->execute(array($_GET['id']));
$notes=$query->fetchAll();

// On récupère toutes les pieces de l'opération de maintenance en question
$query=$bdd->prepare(
    'SELECT nom,quantite
    FROM gm_pieces
    INNER JOIN gm_maintenance
    ON gm_pieces.maintenance_id=gm_maintenance.id  
    WHERE gm_maintenance.id=?');
$query->execute(array($_GET['id']));
$pieces=$query->fetchAll();


include 'layout.phtml';