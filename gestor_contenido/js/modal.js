// modal.js

$(document).ready(function() {
    // Cuando se hace clic en una carpeta
    $('.open-modal').click(function(e) {
        e.preventDefault();
        var carpetaId = $(this).data('carpeta-id');
        
        // Obtener los archivos de la carpeta mediante una solicitud AJAX
        $.ajax({
            url: '../includes/get_archivos.php',
            type: 'POST',
            data: {carpeta_id: carpetaId},
            success: function(response) {
                $('#modal-body').html(response);
                $('#modal').css('display', 'block');
            }
        });
    });

    // Cuando se hace clic en el botón de cerrar
    $('.close').click(function() {
        $('#modal').css('display', 'none');
    });

    // Cuando se hace clic fuera de la ventana modal
    $(window).click(function(event) {
        if (event.target == $('#modal')[0]) {
            $('#modal').css('display', 'none');
        }
    });
});
