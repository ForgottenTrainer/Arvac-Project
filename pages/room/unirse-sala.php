<?php require'./../../views/profile/editar-perfil.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi perfil</title>
    <?php require'../../components/boot-css.php' ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">ARVAC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./../../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./../dashboard.php">Panel de control</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mas opciones
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./../keep/tabla.php">Registrar ahorro</a></li>
                        <li><a class="dropdown-item" href="#">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" id="logout">Salir</a></li> 

                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="container">
        <h1 class="text-center mb-3 mt-5">Unirse a Sala</h1>
        <form action="unirse_sala.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Ingresa el codigo de sala</label>
                <input  type="text" id="codigo_sala" name="codigo_sala" class="form-control" required>
                <div id="emailHelp" class="form-text">El codigo es que el que te da un amigo tuyo</div>
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./../../ajax/profile/logout.js"></script>

</body>
</html>