<?php
require "../config/functions.php";
$bdd=connectBdd();

// Suppression du problème après vérification des droits de technicien
if(is_technicien()){
    $id=$_POST['id'];
    $pb=null;

    $query=$bdd->prepare(
        'UPDATE gm_vehicules
        SET probleme=?
        WHERE id=?');
    $query->execute(array($pb,$id));

    echo $id;
}