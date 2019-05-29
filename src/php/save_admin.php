<?php 

require("../config/functions.php");
$bdd=connectBdd();

$login='admin';
$password='admin';
$mail='contact@devlawper.com';

$query=$bdd->prepare('INSERT INTO admin(login,password,mail) VALUES (?,?,?)');
$query->execute(array($login,password_hash($password, PASSWORD_DEFAULT),$mail));
