<?php
session_start();

// Connexion à la base de donnée
function connectBdd(){
	require 'database.php';
	try{
		$bdd=new PDO("mysql:host=$server;dbname=$db;charset=utf8",$login,$password);
	}
	catch(Exception $e){
		die('Erreur: '.$e->getMessage());
	}
	return $bdd;
}

// Validation connexion utilisateur
function is_connect(){
	if(isset($_SESSION['user'])){
		return true;
	}
	else{
		return false;
	}
}