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

// Ouverture d'une session user pour chaque connexion et une session spécifique en fonction du role du user
	if($user){
		if(password_verify($_POST['mdp'],$user['mdp'])){
            $nom=$user['prenom'].' '.$user['nom'];
            $_SESSION['user']=$nom;
            if($user['role'] == 'administrateur'){
                $_SESSION['administrateur']=$user['email'];
            }
            if($user['role'] == 'gestionnaire'){
                $_SESSION['gestionnaire']=$user['email'];
            }
            if($user['role'] == 'technicien'){
                $_SESSION['technicien']=$user['email'];
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


// Selection des opérations en cours
$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_debut,date_fin,sujet,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE date_fin>=NOW() && date_debut<=NOW()');
$query->execute();
$operations=$query->fetchAll();

// Selection des opérations à venir
$query=$bdd->prepare(
    'SELECT gm_maintenance.id,date_fin,sujet,marque,modele
    FROM gm_maintenance
    INNER JOIN gm_vehicules
    ON gm_maintenance.vehicule_id=gm_vehicules.id
    WHERE date_fin>NOW()');    
$query->execute();
$prevus=$query->fetchAll();

// Selection des vehicules
$query=$bdd->prepare(
    'SELECT id,marque,modele,probleme
    FROM gm_vehicules');
$query->execute();
$vehicules=$query->fetchAll();

// Graphique
// Selection du nb d'intervention passées
$query=$bdd->prepare(
    'SELECT COUNT(id)
    FROM gm_maintenance
    WHERE date_fin<NOW()');
$query->execute();
$historique=$query->fetch();

// Selection du nb d'intervention en cours
$query=$bdd->prepare(
    'SELECT COUNT(id)
    FROM gm_maintenance
    WHERE date_debut<=NOW() && date_fin>=NOW()');
$query->execute();
$enCours=$query->fetch();

// Selection du nb d'intervention à venir
$query=$bdd->prepare(
    'SELECT COUNT(id)
    FROM gm_maintenance
    WHERE date_debut>NOW()');
$query->execute();
$prevu=$query->fetch();

// Création d'un tableau avec les données
$dataPoints = array(
	array("label"=> "Interventions en cours", "y"=> $enCours[0]),
	array("label"=> "Interventions passées", "y"=> $historique[0]),
	array("label"=> "Interventions à venir", "y"=> $prevu[0]),
);

include 'layout.phtml';
