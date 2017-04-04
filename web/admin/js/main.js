$(function () {
    //$('.content').prepend(' <div id="notification" class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> <p>je veux</p></div>');

    $('#nombreNotif').click(function () {
        $('#nombreNotif').removeClass('badge');
    });

    function compteur()
    {
        $.ajax({
            type: 'GET',
            url: Routing.generate('nouvelle_notification'),
            beforeSend: function () {

            },
            success: function (data) {
                if (data.nombre > 0) {
                    $('#nombreNotif').addClass('badge');
                    $('#nombreNotif').text(data.nombre);
                }

            }

        });
    }

    setInterval(compteur, 60000);


    // fonction qui permet de mettre la class active sur le champ cliqué
    var x = $('.sujet').text();

    if (x == "utilisateur") {
        $('li').removeClass("active");
        $("#user").parent().addClass("active");
    }
    if (x == "newsletter") {
        $('li').removeClass("active");
        $("#newsletter").parent().addClass("active");
    }

    if (x == "dashboard") {
        $('li').removeClass("active");
        $("#bord").parent().addClass("active");
    }

    if (x == "annonce") {
        $('li').removeClass("active");
        $("#annonce").parent().addClass("active");
    }

    if (x == "partenaire") {
        $('li').removeClass("active");
        $("#partenaire").parent().addClass("active");
    }
    if (x == "notification") {
        $('li').removeClass("active");
        $("#notif").parent().addClass("active");

    }
     if (x == "galerie") {
        $('li').removeClass("active");
        $("#galerie").parent().addClass("active");
    }
     if (x == "publicite") {
        $('li').removeClass("active");
        $("#publicite").parent().addClass("active");
    }
    ;


});


