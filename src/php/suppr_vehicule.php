<?php
require "../config/functions.php";
$bdd=connectBdd();

// Suppression de l'utilisateur après vérification des droits de gestionnaire
if(is_gestionnaire()){
    $id=$_POST['id'];

    $query=$bdd->prepare('DELETE FROM gm_vehicules WHERE id=?');
    $query->execute(array($id));

    echo $id;
}