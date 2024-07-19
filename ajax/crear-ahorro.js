$(document).ready(function() {
    $('#ahorroForm').on('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de la forma tradicional

        $.ajax({
            url: '/app-lana/controller/keep/ahorro.php', // Ruta al archivo PHP que maneja el guardado
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Ahorro Registrado',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        location.reload(); // Recarga la página para ver el nuevo registro
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
                console.error("Error en AJAX:", xhr.responseText); // Muestra el error en la consola
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al registrar el ahorro',
                    icon: 'error'
                });
            }
        });
    });
});