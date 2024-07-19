$(document).ready(function() {
    $('#registroForm').on('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de la forma tradicional

        $.ajax({
            url: '/app-lana/controller/session/register.php', // Ruta correcta
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Mostrar un SweetAlert con la respuesta del servidor
                Swal.fire({
                    title: 'Registro Exitoso',
                    text: response.message,
                    icon: 'success'
                });
            },
            error: function(xhr, status, error) {
                // Manejar errores
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al registrar el usuario',
                    icon: 'error'
                });
            }
        });
    });
});