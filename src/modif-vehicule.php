<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'gestionnaire' on le renvoie au tableau de bord
if(!is_gestionnaire()){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-vehicule';

// On récupère les infos de la personne concernée en base de donnée
$query=$bdd->prepare(
    'SELECT type,marque,modele,date_achat
    FROM gm_vehicules
    WHERE id=?');
$query->execute(array($_GET['id']));
$vehicule=$query->fetch();

// On initialise les valeurs des formulaires avec les données que l'on a déjà sauf le mdp
$type=$vehicule['type'];
$marque=$vehicule['marque'];
$modele=$vehicule['modele'];
$date_achat=$vehicule['date_achat'];

// Après soumission du formulaire on met à jour les données et redirige vers la liste des gestionnaires ou des techniciens en fonction de la modif
if (isset($_POST['type'])) {
    $type=htmlspecialchars($_POST['type']);
    $marque=htmlspecialchars($_POST['marque']);
    $modele=htmlspecialchars($_POST['modele']);
    $date_achat=$_POST['date_achat'];

    $query=$bdd->prepare(
        "UPDATE gm_vehicules 
        SET type=?,marque=?,modele=?,date_achat=?
        WHERE id=?");
    $query->execute(array($type,$marque,$modele,$date_achat,$_GET['id']));

    header('location:liste-vehicules.php');    
}

include 'layout.phtml';