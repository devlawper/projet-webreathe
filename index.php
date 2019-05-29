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
        ON gm_role.id=gm_users.role_id
        WHERE login=?");
	$query->execute(array($login));
	$user=$query->fetch();

	if($user){
		if(password_verify($_POST['mdp'],$user['mdp'])){
			$_SESSION['user']= $user['prenom'].' '.$user['nom'];
        }
        elseif($user['role'] == 'administrateur'){
            $_SESSION['admin'];
        }
        elseif($user['role'] == 'gestionnaire'){
            $_SESSION['gestionnaire'];
        }
        elseif($user['role'] == 'technicien'){
            $_SESSION['technicien'];
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
