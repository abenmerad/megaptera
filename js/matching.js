var carouselMatching = $('.carousel');
var nombreObservation = $('.carousel .carousel-item').length;
var matcher = $('#carouselMatcher').attr('value');
var matched = "";
var index = 0;
carouselMatching.carousel({
    interval: false
})


$('#matching').click(function(){
    carouselMatching.carousel('next');
});
$('#not_matching').click(function(){
    carouselMatching.carousel('next');
});

carouselMatching.on('slide.bs.carousel', function () {
    if(index < nombreObservation)
    {
        index++;
        matched = $('.carousel .active h5').text();
        if($(':focus').val() == "matching")
        {
            $.ajax({
                url : "index.php?uc=observation&action=ajouterMatching",
                data : { codeMatcher : matcher, codeMatched : matched}
            })
            .done(function(a, b, c){
                console.log(a);
            })
            .fail(function(a, b, c){
                console.log(c);
            });
        }
    }
    else
    {
        index = 0;
        $('#matcher').hide(250);
    }
})