<?php
require 'config/functions.php';
$bdd=connectBdd();

$title='Base - Index';
$template='index';

// Soumission du formulaire de connexion
if(isset($_POST['login'])){

    $login=htmlspecialchars($_POST['login']);

	$query=$bdd->prepare(
        "SELECT nom, prenom, email, mdp, role
        FROM gm_users 
        INNER JOIN gm_roles
        ON gm_roles.id=gm_users.role_id
        WHERE email=?");
	$query->execute(array($login));
	$user=$query->fetch();

	if($user){
		if(password_verify($_POST['mdp'],$user['mdp'])){
            $nom=$user['prenom'].' '.$user['nom'];
            $_SESSION['user']=$nom;
            if($user['role'] == 'administrateur'){
                $_SESSION['administrateur']=$nom;
            }
            if($user['role'] == 'gestionnaire'){
                $_SESSION['gestionnaire']=$nom;
            }
            if($user['role'] == 'technicien'){
                $_SESSION['technicien']=$nom;
            }
        }        
        else{
			$message="Mauvais mot de passe";
		}        
	}
	else{
		$message="Identifiant inconnnu";
	}	
}

include 'layout.phtml';
