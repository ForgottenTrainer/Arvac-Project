<?php 

session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: ./../dashboard.php"); // Redirige al dashboard o a la página principal
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro ARVAC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body class="text-center">
    <div class="card mx-auto mt-5" style="width: 18rem;">
        <div class="card-body">
            <form class="form-signin" id="registroForm">
                
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="" style="width: 80px; height: 80px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>


                <h1 class="h3 mb-3 font-weight-normal">Registrate</h1>
                
                <label for="inputEmail" class="sr-only">Nombre</label>
                <input type="text" name="nombre" id="inputName" class="form-control" placeholder="Pepito" required="" autofocus="">
                
                <label for="inputEmail" class="sr-only">Correo</label>
                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Hola@hola.com" required="" autofocus="">
                
                <label for="inputPassword" class="sr-only">Contraseña</label>
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="*****" required="">

                <button class="btn btn-primary mt-3 btn-block" type="submit">Registrate</button>
                <a href="./../../index.php" class="btn btn-secondary mt-3 btn-block">Regresar</a>
                <p class="mt-5 mb-3 text-muted">© ARVAC 2024-2025</p>
            </form>
        </div>
    </div>
  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="../../ajax/register.js"></script>
</body>
</html>