$(document).ready(function(){
    $("select").select2();

    // Liste déroulante type de bioagresseurs
    $('#types').on('change', function () {
        $('.form').addClass('d-none');
        $('#' + $(this).val()).removeClass('d-none');
    });
});

    