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

// On récupere la liste des véhicules
$query=$bdd->prepare(
    'SELECT id,marque,modele
    FROM gm_vehicules');
$query->execute();
$vehicules=$query->fetchAll();

// On initialise les valeurs des formulaires avec des champs vides
$date_debut='';
$date_fin='';
$sujet='';
$description='';

// On récupère les valeurs des champs après soumission du formulaire
if (isset($_POST['date_debut'])) {
    $vehicule=$_POST['vehicule'];
    $date_debut=$_POST['date_debut'];
    $date_fin=$_POST['date_fin'];
    $sujet=htmlspecialchars($_POST['sujet']);
    $description=htmlspecialchars($_POST['description']);

    $query=$bdd->prepare(
        "INSERT INTO gm_maintenance(date_debut,date_fin,sujet,description,vehicule_id)
        VALUES(?,?,?,?,?)");
    $query->execute(array($date_debut,$date_fin,$sujet,$description,$vehicule));
    
    header('location:ajout-pieces.php');
}

include 'layout.phtml';