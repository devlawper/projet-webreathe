<?php
require "../config/functions.php";
$bdd=connectBdd();

// Suppression de l'utilisateur après vérification des droits d'admin
if(is_administrateur()){
    $id=$_POST['id'];

    $query=$bdd->prepare('DELETE FROM gm_users WHERE id=?');
    $query->execute(array($id));

    echo $id;
}