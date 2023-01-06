var $doc = $('html, body');
$('.logo-marvolt').click(function() {
    $doc.animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
    return false;
});
$('.logo-marvolt').css({
    'display': 'block'
});


$('.logo-marvolt-top-1').click(function() {
    $doc.animate({
        scrollTop: $($.attr(this, 'href')).offset().top
    }, 500);
    return false;
});
$('.logo-marvolt-top-1').css({
    'display': 'none'
});


$(window).scroll(function() {

    if ($(window).scrollTop() == 0 | $(window).scrollTop() == "") {
        $('.logo-marvolt').css({
            'display': 'block',
        });

        $('.logo-marvolt-top-1').css({

            'display': 'none',
            'transition': 'opacity 50ms ease-in'

        });




    } else {
        $('.logo-marvolt').css({

            'display': 'none',
            'transition': 'opacity 50ms ease-in'

        });

        $('.logo-marvolt-top-1').css({

            'display': 'block',
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
        nav: false,
        responsive: {
            0: {
                items: 1
            },
            390:{
                items: 2
            },
            440: {
                items: 3
            },
            700: {
                items: 4
            },
            1000: {
                items: 4
            }
        }


    });


});

$(document).ready(function() {
    $("#categoria-apresentacao-1").owlCarousel({
        items: 6,
        loop: true,
        margin: 20,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            390:{
                items: 2
            },
            440: {
                items: 3
            },
            700: {
                items: 4
            },
            1000: {
                items: 4
            }
        }


    });
    $("#categoria-apresentacao-2").owlCarousel({
        items: 6,
        loop: true,
        margin: 20,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            390:{
                items: 2
            },
            440: {
                items: 3
            },
            700: {
                items: 4
            },
            1000: {
                items: 4
            }
        }


    });


});

$(document).ready(function() {
    $("#categoria-apresentacao-3").owlCarousel({
        items: 6,
        loop: true,
        margin: 20,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            390:{
                items: 2
            },
            440: {
                items: 3
            },
            700: {
                items: 4
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
            440: {
                items: 3
            },
            700: {
                items: 4
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
        margin: 10,
        autoplay: true,
        responsive: {
            0: {
                items: 1
            },
            360: {
                items: 1

            },
            390:{
                items: 2
            },
            500: {
                items: 3
            },
            900: {
                items: 4
            },
            1000: {
                items: 5
            }
        }


    });


});

function loading(){
    document.getElementsByClassName("loader")[0].style.display = "none"
 }





$("#mostrar_senha").click(function() {
    var senha = document.getElementById("senha");
    if (senha.type == "password") {
        senha.type = "text";

    } else {
        senha.type = "password";
    }
})



