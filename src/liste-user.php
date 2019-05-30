<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'administrateur' on le renvoie au tableau de bord
if(!is_administrateur()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='liste-user';

// Si l'admin a cliqué sur le lien liste des gestionnaires on affiche les gestionnaires
if ($_GET['role']=='gestionnaire') {
    $query=$bdd->prepare(
        'SELECT gm_users.id,nom,prenom,email,role
        FROM gm_users
        INNER JOIN gm_roles
        ON gm_roles.id=gm_users.role_id
        WHERE role=?');
    $query->execute(array('gestionnaire'));
    $gestionnaires=$query->fetchAll();
}
// Si l'admin a cliqué sur le lien liste des techniciens on affiche les techniciens
elseif ($_GET['role']=='technicien') {
    $query=$bdd->prepare(
        'SELECT gm_users.id,nom,prenom,email,role
        FROM gm_users
        INNER JOIN gm_roles
        ON gm_roles.id=gm_users.role_id
        WHERE role=?');
    $query->execute(array('technicien'));
    $techniciens=$query->fetchAll();
}

include 'layout.phtml';