'use strict';   // Mode strict du JavaScript
// Définition des variables
let button = $(".btnHamburger");
let icon = $('.btnHamburger i');
let deeper = $(".deeper");
let mainmenu = $("#mainmenu");

function dropdown_menu() {
  /* Modifier l'icône du hamburger */
  icon.toggleClass('fa-bars');
  icon.toggleClass('fa-times');
  /* Afficher / cacher le menu */
  mainmenu.toggleClass('hide');
}

function dropdown_deeper() { 
  /* Afficher le menu si il est masqué */ 
  if ($(this).children("ul").css("display") == "none") {
    $(this).children("ul").slideDown(500);
  }
}
function dropup_deeper() {
  /* Cacher le menu si il est affiché */
  $(this).children("ul").slideUp(500);
}

$(function(){  
  // Installation d'un gestionnaire d'évènement clic sur le bouton.
  button.on('click', dropdown_menu);
  // Installation d'un gestionnaire d'évènement hover.
  deeper.on('mouseenter', dropdown_deeper);
  deeper.on('mouseleave', dropup_deeper);
})