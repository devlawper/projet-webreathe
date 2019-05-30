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

// On initialise les valeurs des formulaires avec des champs vides
$nom='';
$prenom='';
$email='';
$mdp='';

// On récupère les valeurs des champs après soumission du formulaire
if (isset($_POST['nom'])) {   
    $nom=htmlspecialchars($_POST['nom']);
    $prenom=htmlspecialchars($_POST['prenom']);
    $email=htmlspecialchars($_POST['email']);
    $mdp=password_hash(htmlspecialchars($_POST['mdp']),PASSWORD_DEFAULT);

// Requète et redirection si on agit sur un gestionnaire
    if ($_GET['role']=='gestionnaire') {  
        $query=$bdd->prepare(
            "INSERT INTO gm_users(nom,prenom,email,mdp,role_id)
            VALUES(?,?,?,?,2)");
        $query->execute(array($nom,$prenom,$email,$mdp));
    
        header('location:liste-user.php?role=gestionnaire');
    }
    
// Requète et redirection si on agit sur un technicien
    elseif ($_GET['role']=='technicien') {        
        $query=$bdd->prepare(
            "INSERT INTO gm_users(nom,prenom,email,mdp,role_id)
            VALUES(?,?,?,?,3)");
        $query->execute(array($nom,$prenom,$email,$mdp));
    
        header('location:liste-user.php?role=technicien');
    }
}

include 'layout.phtml';