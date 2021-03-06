<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'administrateur' on le renvoie au tableau de bord
if(!is_administrateur()){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-user';

// On récupère les infos de la personne concernée en base de donnée
$query=$bdd->prepare(
    'SELECT nom,prenom,email
    FROM gm_users
    WHERE id=?');
$query->execute(array($_GET['id']));
$user=$query->fetch();

// On initialise les valeurs des formulaires avec les données que l'on a déjà sauf le mdp
$nom=$user['nom'];
$prenom=$user['prenom'];
$email=$user['email'];
$mdp='';

// Après soumission du formulaire on met à jour les données et redirige vers la liste des gestionnaires ou des techniciens en fonction de la modif
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
    
    if ($_GET['role']=='gestionnaire') {
        header('location:liste-user.php?role=gestionnaire');
    }
    elseif ($_GET['role']=='technicien') {
        header('location:liste-user.php?role=technicien');
    }
    
}


include 'layout.phtml';