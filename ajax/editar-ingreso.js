$(document).ready(function() {
    $('#ingresoForm').on('submit', function(event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '/app-lana/controller/keep/editar-ingreso.php',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Ahorro Actualizado',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '/app-lana/pages/keep/tabla.php'; // Redirige a la página de lista de ahorros
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
                    text: 'Hubo un problema al actualizar el ahorro',
                    icon: 'error'
                });
            }
        });
    });
});
