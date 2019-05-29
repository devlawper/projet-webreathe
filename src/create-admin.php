<?php
$nom='PICHON';
$prenom='Laurent';
$email='contact@devlawper.com';
$mdp='webreathe';
$role_id=1;

include "config/functions.php";
$bdd=connectBdd();
$query=$bdd->prepare(
  'INSERT INTO gm_users(nom,prenom,email,mdp,role_id)
  VALUES (?,?,?,?,?)');
$query->execute(array($nom,$prenom,$email,password_hash($mdp, PASSWORD_DEFAULT),$role_id));