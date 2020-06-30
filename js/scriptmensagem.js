$(document).on("input", ".contador", function () {

    var caracteresDigitados = $(this).val().length;
    $(".caracteres").text(caracteresDigitados);
    
});

window.setTimeout(function () {
    $(".alert").fadeTo(500, 0).slideUp(500, function () {
        $(this).remove();
    });
}, 500);