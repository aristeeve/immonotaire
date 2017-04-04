$(function () {

    $(".del").click(function () {
        $(this).parent().fadeOut();
        id = $(this).parent().attr('id');
        // alert(annonceId);
        switch (id)
        {
            case 'f':
                $(".file").val("");

                break;
            case 'f1':
                $(".file1").val("");

                break;
            case 'f2':
                $(".file2").val("");

                break;
            case 'f3':
                $(".file3").val("");

                break;
            case 'f4':
                $(".file4").val("");

                break;
            default:
                break;
        }

    });
    
//    var media = {'file': $(".f0").attr('title'),
//        'file1': $(".f1").attr('title'),
//        'file2': $(".f2").attr('title'),
//        'file3': $(".f3").attr('title'),
//        'file4': $(".f4").attr('title')};


//    var annonceId = $(".annonceId").text();


//
//
////Routing.generate('immo_upload', {id: annonceId}, {file: media["file"]}, {file1: media["file1"]}, {file2: media["file2"]}, {file3: media["file3"]}, {file4: media["file4"]}),
//    $('#submit').click(function () {
//
//        $.ajax({
//            type: "get",
//            url: Routing.generate('immo_upload', {media: media["file"] + " " + media["file1"] + " " + media["file2"] + " " + media["file3"] + " " + media["file4"] + " " + annonceId}),
//            beforeSend: function () {
//                //alert('on y va');
//            },
//            success: function () {
//                //alert("c ok !");
//            }
//        });
//
//    });

    function dump(obj) {
        var out = '';
        for (var i in obj) {
            out += i + ": " + obj[i] + "\n";
        }
        alert(out);
    }

































    //formulaire de rechercher(cacher et afficher certain elt)
    $(".TypeBien").change(function () {
        var type = $(this).val();

        switch (type) {
            case 'Appartement':
                $('form .appart').css('display', 'block');
                $('form .piece').css('display', 'block');
                $('form .superficie').css('display', 'block');
                $('form .superficie').addClass('beds');
                $('form .prix').css('display', 'block');
                $('form .terrain').css('display', 'none');
                $('form .maison').css('display', 'none');
                $('form .local').css('display', 'none');
                $('form .terrain').val('');
                $('form .maison').val('');
                $('form .local').val('');
                break;
            case 'Terrain':
                $('form .terrain').css('display', 'block');
                $('form .superficie').css('display', 'block');
                $('form .superficie').removeClass('beds');
                $('form .prix').css('display', 'block');
                $('form .piece').css('display', 'none');
                $('form .appart').css('display', 'none');
                $('form .maison').css('display', 'none');
                $('form .local').css('display', 'none');
                $('form .appart').val('');
                $('form .maison').val('');
                $('form .local').val('');

                break;
            case 'Maison':
                $('form .maison').css('display', 'block');
                $('form .piece').css('display', 'block');
                $('form .superficie').css('display', 'block');
                $('form .superficie').addClass('beds');
                $('form .prix').css('display', 'block');
                $('form .appart').css('display', 'none');
                $('form .terrain').css('display', 'none');
                $('form .local').css('display', 'none');
                $('form .terrain').val('');
                $('form .appart').val('');
                $('form .local').val('');

                break;
            case 'Local Commercial':
                $('form .local').css('display', 'block');
                $('form .piece').css('display', 'block');
                $('form .superficie').css('display', 'block');
                $('form .superficie').addClass('beds');
                $('form .prix').css('display', 'block');
                $('form .appart').css('display', 'none');
                $('form .terrain').css('display', 'none');
                $('form .maison').css('display', 'none');
                $('form .terrain').val('');
                $('form .maison').val('');
                $('form .appart').val('');
                break;
            default:
                $('form .local').css('display', 'none');
                $('form .appart').css('display', 'none');
                $('form .terrain').css('display', 'none');
                $('form .maison').css('display', 'none');
                $('form .piece').css('display', 'none');
                $('form .superficie').css('display', 'none');
                $('form .prix').css('display', 'none');
                $('form .terrain').val('');
                $('form .maison').val('');
                $('form .appart').val('');
                $('form .local').val('');
                break;
        }


    });


    // l'upload de fichier dans les formaulaire de poste d'annonce.
    $(".file1").change(function () {
        var valeur = $(this).val();
        if (valeur !== null) {
            $('.photo2').css('display', 'block');
        }
    });
    $(".file2").change(function () {
        var valeur = $(this).val();
        if (valeur !== null) {
            $('.photo3').css('display', 'block');
        }
    });
    $(".file3").change(function () {
        var valeur = $(this).val();
        if (valeur !== null) {
            $('.photo4').css('display', 'block');
        }
    });
    $(".file4").change(function () {
        var valeur = $(this).val();
        if (valeur !== null) {
            $('.photo5').css('display', 'block');
        }
    });


    // fonction qui aide pour supprimer une annonce

    $(".sup").click(function () {
        var x = $(this).text();
        //alert(x.lastIndexOf(' '));
        y = x.substring(x.lastIndexOf(' ') + 1);

        $('.annonceId').val(y);
    });






});