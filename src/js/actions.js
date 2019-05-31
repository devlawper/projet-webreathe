'use strict'

// Version AJAX de la suppresion d'un utilisateur du tableau
function supprUser(){
	if (confirm("Voulez-vous vraiment supprimer cet utilisateur ?")) {
		$.post("php/suppr_user.php",{id:$(this).data('id')},valideSup);
	}	
}
// Version AJAX de la suppresion d'un véhicule du tableau
function supprVehicule(){
	if (confirm("Voulez-vous vraiment supprimer ce véhicule ?")) {
		$.post("php/suppr_vehicule.php",{id:$(this).data('id')},valideSup);
	}	
}
function valideSup(reponse){
	$('.'+reponse).remove();
}

// Version AJAX de l'ajout d'un pb
function ajoutPb(){
	let pb=prompt('Signaler un problème :');
	$.post("php/ajout-probleme.php",{id:$(this).data('id'),pb:pb},validePb);
}
function validePb(reponse){
	reponse = JSON.parse(reponse);	
	$('.pb'+reponse[0]).text(reponse[1]);
}

// Version AJAX de la résolution d'un pb
function pbResolu(){
	if (confirm("Le problème est-il bien résolu ?")) {
		$.post("php/pb-resolu.php",{id:$(this).data('id')},valideResolu);
	}	
}
function valideResolu(reponse){	
	$('.pb'+reponse).text('Pas de problème');
	$('.actionPb').remove();
}

$(function(){
	$('.supprUser').on('click',supprUser);
	$('.supprVehicule').on('click',supprVehicule);
	$('.ajoutPb').on('click',ajoutPb);	
	$('.pbResolu').on('click',pbResolu);

});