<?php
require 'config/functions.php';

// Si l'utilisation n'est pas 'administrateur' on le renvoie au tableau de bord
if(!isset($_SESSION['administrateur'])){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-gestionnaire';

// On initialise les valeurs des formulaires avec des champs vides
$nom='';
$prenom='';
$email='';
$mdp='';

if (isset($_POST['nom'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $email=htmlspecialchars($_POST['email']);
    $mdp=password_hash(htmlspecialchars($_POST['mdp']),PASSWORD_DEFAULT);

    $query=$bdd->prepare(
        "INSERT INTO gm_users(nom,prenom,email,mdp,role_id)
        VALUES(?,?,?,?,2)");
    $query->execute(array($nom,$prenom,$email,$mdp));

    header('location:liste-gestionnaires.php');
}


include 'layout.phtml';