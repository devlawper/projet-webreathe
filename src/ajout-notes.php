<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-notes';

$query=$bdd->prepare(
    'SELECT MAX(id) as id
    FROM gm_maintenance');
$query->execute();
$maintenance_id=$query->fetch();

// On récupère les valeurs des champs après soumission du formulaire
if (isset($_POST['note'])) {    
    $note=htmlspecialchars($_POST['note']);
    $tech=$_SESSION['technicien'];
    var_dump($tech);

    $query=$bdd->prepare(
        "SELECT id 
        FROM gm_users
        WHERE email=?");
    $query->execute(array($tech));
    $tech_id=$query->fetch();

    $query=$bdd->prepare(
        "INSERT INTO gm_notes(tech_id,note,maintenance_id)
        VALUES(?,?,?)");
    $query->execute(array($tech_id['id'],$note,$maintenance_id['id']));
    
    header('location:liste-operations.php');
}

include 'layout.phtml';