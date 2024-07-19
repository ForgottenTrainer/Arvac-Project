$(document).ready(function() {
    $('#EditarUsuarioForm').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: '/app-lana/controller/profile/editar-usuario.php',
            method: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Perfil Actualizado',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload(); // Recarga la página para ver los cambios
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message,
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en AJAX:', xhr.responseText);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al actualizar el perfil',
                    icon: 'error'
                });
            }
        });
    });
});