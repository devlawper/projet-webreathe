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

$(function(){
	$('.supprUser').on('click',supprUser);
	$('.supprVehicule').on('click',supprVehicule);

});