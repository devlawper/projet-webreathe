<?php
require 'config/functions.php';

if(!isset($_SESSION['administrateur'])){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='ajout-gestionnaire';

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

    header('location:index.php');
}


include 'layout.phtml';