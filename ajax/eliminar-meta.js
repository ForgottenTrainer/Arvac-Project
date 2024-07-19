$(document).ready(function() {
    // Cuando se hace clic en el botón "Eliminar"
    $('.eliminar-btn').on('click', function() {
        var ingresoId = $(this).data('ingreso-id');

        // Confirmación antes de eliminar
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
            if (result.isConfirmed) {
                // Imprime el id del ingreso en la consola
                console.log('Eliminar ingreso:', ingresoId);

                $.ajax({
                    url: '/app-lana/controller/keep/eliminar-ahorro.php',
                    method: 'POST',
                    data: { ingreso_id: ingresoId },
                    success: function(response) {
                        // Imprime la respuesta del servidor en la consola
                        console.log('Respuesta del servidor:', response);

                        if (response.status === 'success') {
                            Swal.fire({
                                title: 'Eliminado',
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
                        // Imprime el error en la consola
                        console.error('Error en AJAX:', xhr.responseText);

                        Swal.fire({
                            title: 'Error',
                            text: 'Hubo un problema al eliminar el ingreso',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});