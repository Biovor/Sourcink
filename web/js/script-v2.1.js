$(document).ready(function () {
    $('.slider').slider({transition:250, interval:8716});
    $('.slider').slider('next');
});
$(document).ready(function () {

    $(".product-small").hide();
    $(".product-medium").hide();
    $(".product-large").hide();
    $(".product-premium").hide();


    $(".show-small").click(function () {
        $(".product-medium").hide("fast");
        $(".product-large").hide("fast");
        $(".product-small").show("fast");
    });
    $(".show-medium").click(function () {
        $(".product-small").hide("fast");
        $(".product-large").hide("fast");
        $(".product-medium").show("fast");
    });
    $(".show-large").click(function () {
        $(".product-medium").hide("fast");
        $(".product-small").hide("fast");
        $(".product-large").show("fast");
    });

    $(".show-premium").click(function () {
        $(".product-premium").show("fast");
    });
    $(".img").click(function () {
        $(".product-medium").hide("fast");
        $(".product-small").hide("fast");
        $(".product-large").hide("fast");
        $(".product-premium").hide("fast");
    });

});
$(".button-collapse").sideNav();
$(document).ready(function () {
    $('select').material_select();
});

$('#sendResumeButton').on('click', function (e) {
    e.preventDefault();
    $('.progress').removeClass('hiddendiv');
    var resume = $('#sendResumeFile').val();
    var formData = new FormData();
    formData.append('resume', $('input[type=file]')[0].files[0]);
    $.ajax({
        url: '/ajax/resume/send',
        type: 'POST',
        dataType: 'json',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
               $('.ajaxStatus').html('<div class="center"><p>Votre CV a été envoyé avec succès ! Vous' +
                   ' pouvez désormais passer nos tests de personnalité Big5 et Culture Fit, postuler à l\'une de nos ' +
                   'offres ou nous envoyer votre candidature spontanée.</p></div><div class="right">\n' +
                   '<a href="#!" id="done-cv" class="modal-action modal-close waves-effect waves-green btn-flat">' +
                   'Terminer</a> </div> ');
               $('#done-cv').attr("href", '/candidat/update/cv');
        },
        error: function () {
            $('.ajaxStatus').html('<div class="center"><p>Une erreur s\'est produite. Veuillez réessayer.</p></div>');
        }
    });
});

window.addEventListener("load", function(event) {
    lazyload();
});

$(document).ready(function () {
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
});
