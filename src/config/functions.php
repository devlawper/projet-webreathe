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
// Validation connexion utilisateur
function is_administrateur(){
	if(isset($_SESSION['administrateur'])){
		return true;
	}
	else{
		return false;
	}
}
// Validation connexion utilisateur
function is_gestionnaire(){
	if(isset($_SESSION['gestionnaire'])){
		return true;
	}
	else{
		return false;
	}
}
// Validation connexion utilisateur
function is_technicien(){
	if(isset($_SESSION['technicien'])){
		return true;
	}
	else{
		return false;
	}
}