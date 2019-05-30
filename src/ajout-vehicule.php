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

// On initialise les valeurs des formulaires avec des champs vides
$type='';
$marque='';
$modele='';
$date_achat='';

// On récupère les valeurs des champs après soumission du formulaire
if (isset($_POST['type'])) {
    $type=$_POST['type'];
    $marque=htmlspecialchars($_POST['marque']);
    $modele=htmlspecialchars($_POST['modele']);
    $date_achat=$_POST['date_achat'];

    $query=$bdd->prepare(
        "INSERT INTO gm_vehicules(type,marque,modele,date_achat)
        VALUES(?,?,?,?)");
    $query->execute(array($type,$marque,$modele,$date_achat));
    
    header('location:liste-vehicules.php');
}

include 'layout.phtml';