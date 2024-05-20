$(document).ready(function() {
$('#FormZgl').submit(function(){
    let idUzytkownika = $('input[name="id"]').val();
    let tresc = $('#tresc').val();

    //wysłanie
    $.post('insertzgloszenie.php',{id: idUzytkownika, tresc: tresc},function(data){  //obiekt java script przeksztalca sie na JSOn java script object notation
        // function(data) - funkcja zwrotna która wykona się po zakończeniu rządania POST, ma ona parametr DATA, który zawiera odpowiedź servera a odpowiedź jest generowana w pliku php
        if(data=="sukces"){
            alert('Zgłoszenie zostało dodane!');
        }
        else{
            alert('ERROR !!!');
        }
    });
});
});