<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-pieces';

$query=$bdd->prepare(
    'SELECT MAX(id) as id
    FROM gm_maintenance');
$query->execute();
$maintenance_id=$query->fetch();

// On récupère les valeurs des champs après soumission du formulaire
if (isset($_POST['nom'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $quantite=htmlspecialchars($_POST['quantite']);

    $query=$bdd->prepare(
        "INSERT INTO gm_pieces(nom,quantite,maintenance_id)
        VALUES(?,?,?)");
    $query->execute(array($nom,$quantite,$maintenance_id['id']));
    
    header('location:ajout-photos.php');
}

include 'layout.phtml';