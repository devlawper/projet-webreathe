<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-operation';

// On récupère les infos du véhicule concernée en base de donnée
$query=$bdd->prepare(
    'SELECT date_debut,date_fin,sujet,description,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE gm_maintenance.id=?');
$query->execute(array($_GET['id']));
$operation=$query->fetch();

// On initialise les valeurs des formulaires avec les données que l'on a déjà
$date_debut=$operation['date_debut'];
$date_fin=$operation['date_fin'];
$sujet=$operation['sujet'];
$description=$operation['description'];
$marque=$operation['marque'];
$modele=$operation['modele'];


// Après soumission du formulaire on met à jour les données et redirige vers la liste des véhicules
if (isset($_POST['date_debut'])) {    
    $date_debut=$_POST['date_debut'];
    $date_fin=$_POST['date_fin'];
    $sujet=htmlspecialchars($_POST['sujet']);
    $description=htmlspecialchars($_POST['description']);

    $query=$bdd->prepare(
        "UPDATE gm_maintenance
        SET date_debut=?,date_fin=?,sujet=?,description=?
        WHERE id=?");
    $query->execute(array($date_debut,$date_fin,$sujet,$descritpion,$_GET['id']));

    header('location:ajout-pieces.php');    
}

include 'layout.phtml';