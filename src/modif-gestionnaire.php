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

// On récupère les infos du gestionnaire concerné en base de donnée
$query=$bdd->prepare(
    'SELECT nom,prenom,email
    FROM gm_users
    WHERE id=?');
$query->execute(array($_GET['id']));
$gestionnaire=$query->fetch();

// On initialise les valeurs des formulaires avec les données que l'ont a déjà sauf le mdp
$nom=$gestionnaire['nom'];
$prenom=$gestionnaire['prenom'];
$email=$gestionnaire['email'];
$mdp='';

if (isset($_POST['nom'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $email=htmlspecialchars($_POST['email']);
    $mdp=password_hash(htmlspecialchars($_POST['mdp']),PASSWORD_DEFAULT);

    $query=$bdd->prepare(
        "UPDATE gm_users 
        SET nom=?,prenom=?,email=?,mdp=? 
        WHERE id=?");
    $query->execute(array($nom,$prenom,$email,$mdp,$_GET['id']));
    
    header('location:liste-gestionnaires.php');
}


include 'layout.phtml';