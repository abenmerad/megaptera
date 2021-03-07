$("#matching").click(function(){

    $.ajax({
        url : "modele/ajax.php",
        method : 'POST',
        data : { ajax : "1" }
    })
    .done(function(response, textStatus, jqXHR){
        console.log(textStatus);
    })
    .fail(function(jqXHR, textStatus, errorThrown){
        console.log(jqXHR);
    })
});