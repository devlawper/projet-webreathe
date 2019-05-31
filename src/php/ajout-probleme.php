<?php
require "../config/functions.php";
$bdd=connectBdd();

// Ajout du problème après vérification des droits de technicien
if(is_technicien()){
    $id=$_POST['id'];
    $pb=$_POST['pb'];

    $query=$bdd->prepare(
        'UPDATE gm_vehicules
        SET probleme=?
        WHERE id=?');
    $query->execute(array($pb,$id));

    echo json_encode([$id,$pb]);
}