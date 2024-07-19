$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Evita que el formulario se envíe de la forma tradicional
        
        $.ajax({
            url: '/app-lana/controller/session/login.php', // Ruta al archivo PHP que maneja el login
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    Swal.fire({
                        title: 'Login Exitoso',
                        text: response.message,
                        icon: 'success'
                    }).then(() => {
                        window.location.href = '/app-lana/pages/dashboard.php'; // Redirige a la página de dashboard
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
                    text: 'Hubo un problema al iniciar sesión',
                    icon: 'error'
                });
            }
        });
    });
});
