<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'technicien' on le renvoie au tableau de bord
if(!is_technicien()){
	header('location:index.php');
}

// Connexion à la base de donnée
$bdd=connectBdd();

$title='Base - Index';
$template='ajout-photos';

$query=$bdd->prepare(
    'SELECT MAX(id) as id
    FROM gm_maintenance');
$query->execute();
$maintenance_id=$query->fetch();

// On récupère les valeurs des champs après soumission du formulaire
if (isset($_POST['photo'])) {    
	$photo = htmlspecialchars($_FILES['image']['name']);
	$image = move_uploaded_file($_FILES['image']['tmp_name'], "img/".basename($photo_chargee));
    $titre=htmlspecialchars($_POST['titre']);

    $query=$bdd->prepare(
        "INSERT INTO gm_photos(photo,titre,maintenance_id)
        VALUES(?,?,?)");
    $query->execute(array($photo,$titre,$maintenance_id['id']));
    
    header('location:ajout-notes.php');
}

include 'layout.phtml';