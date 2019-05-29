

$(function() {
    console.log(window.navigator);
  $(window).scroll(function (event) {
    // A chaque fois que l'utilisateur va scroller (descendre la page)
    var y = $(this).scrollTop(); // On récupère la valeur du scroll vertical
    // Si cette valeur > à offset on ajoute la classe
    if (y > 0) {
        $('#mainmenu').addClass('container');
        $('.top').fadeIn('slow');
    } else {
        // sinon, on l'enlève
        $('#mainmenu').removeClass('container');
        $('.top').fadeOut('slow');
    }
  });
  let navHeight = $('nav').innerHeight();
  $('main').css("margin-top", navHeight);
});