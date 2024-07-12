// clientes.js

$(document).ready(function() {
    $('.carpeta h5').on('click', function() {
        $(this).next('.archivos').slideToggle();
    });
});
