var $doc = $('html, body');
$('.logo-marvolt').click(function() {
    $doc.animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
    return false;
});
$('.logo-marvolt').css({
    'opacity': '1'
});


$('.logo-marvolt-top-1').click(function() {
    $doc.animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
    return false;
});
$('.logo-marvolt-top-1').css({
    'opacity': '0'
});



$(window).scroll(function() {

    if ($(window).scrollTop() == 0 | $(window).scrollTop() == "") {
        $('.logo-marvolt').css({
            'opacity': '1',
        });

        $('.logo-marvolt-top-1').css({

            'opacity': '0',
            'transition': 'opacity 50ms ease-in'

        });
    } else {
        $('.logo-marvolt').css({

            'opacity': '0',
            'transition': 'opacity 50ms ease-in'

        });

        $('.logo-marvolt-top-1').css({

            'opacity': '1',
            'transition': 'opacity 50ms ease-in'

        });
    }
});

$(document).ready(function() {
    $("#destaques_carousel").owlCarousel({
        items: 6,
        loop: true,
        margin: 20,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            360: {
                items: 1

            },
            400: {
                items: 2
            },
            1000: {
                items: 4
            }
        }


    });


});

$(document).ready(function() {
    $("#fornecedor_carousel").owlCarousel({
        items: 10,
        loop: true,
        margin: 0,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            360: {
                items: 2
            },
            1000: {
                items: 5
            }
        }


    });



});



$(document).ready(function() {
    $("#carousel-prod").owlCarousel({
        items: 6,
        loop: true,
        margin: 20,

        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            360: {
                items: 1

            },
            400: {
                items: 2
            },
            1000: {
                items: 5
            }
        }


    });


});