$(document).ready(function() {
  console.log("test");
  $(".fav").on("click", function() {
  const akapit = $(this);
  $.post("changeFav.php", { idSpolki: "'" + akapit.data("spolka") + "'"}, function(data) {
  if (data == "sukces") {
    akapit.text((akapit.text() == "img/like1.png") ? "img/dislike1.png" : "img/like1.png");
  }
  });
  });
 });

   $( "#FormZgl" ).submit(function( event ) {
  
    event.preventDefault();

    let $form = $( this ),
      term = $form.find( "textarea[name='tresc']" ).val();

    $.post( "insertzgloszenie.php", { tresc: term } );
  });
/*Po pobraniu strony I przekształceniu jej do obiektów DOM-u, dodajemy obsługę zdarzenia
kliknięcia na elementach z atrybutem class o wartości fav. W ramach tej obsługi, wysyłamy
asynchroniczne żądanie do serwera (nie powoduje przeładowania całej strony) za pomocą
funkcji $.post(). Jako jej argumenty przekazujemy: nazwę skryptu changeFav.php, parametry
(w naszym przypadku identyfikator dzbana pobrany z atrybutu data-dzban za pomocą funkcji
data()), oraz funkcję, która ma zostać wykonana po odebraniu odpowiedzi. W funkcji tej
zamieniamy tekst będący zawartością paragrafu na przeciwny, jeżeli w odpowiedzi otrzymaliśmy
komunikat „sukces”.
 */

function moneyIsAdded() {
  alert("Dodano pieniądze do portfela");
}
