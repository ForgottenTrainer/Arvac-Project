$(document).ready(function() {
    $('#logout').on('click', function(event) {
        event.preventDefault();
        
        $.ajax({
            url: '/app-lana/controller/profile/logout.php',
            method: 'POST',
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Desconectado',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '/app-lana/pages/session/login.php'; // Redirige a la página de inicio de sesión
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Hubo un problema al cerrar la sesión',
                        icon: 'error'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error('Error en AJAX:', xhr.responseText);
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un problema al cerrar la sesión',
                    icon: 'error'
                });
            }
        });
    });
});