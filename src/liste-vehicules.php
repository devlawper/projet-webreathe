<?php
require 'config/functions.php';

// Si l'utilisateur n'est pas 'gestionnaire' ou 'technicien' on le renvoie au tableau de bord
if(!is_gestionnaire() && !is_technicien()){
	header('location:index.php');
}

$bdd=connectBdd();

$title='Base - Index';
$template='liste-vehicules';

$query=$bdd->prepare(
    'SELECT id,marque,modele,probleme
    FROM gm_vehicules');
$query->execute();
$vehicules=$query->fetchAll();

include 'layout.phtml';