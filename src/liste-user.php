<?php
require 'config/functions.php';

if(!isset($_SESSION['administrateur'])){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='liste-user';

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