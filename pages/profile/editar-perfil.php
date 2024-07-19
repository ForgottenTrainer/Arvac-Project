<?php require'./../../views/profile/editar-perfil.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar perfil</title>
    <?php require'../../components/boot-css.php' ?>
</head>

<style>
        .img-container {
            position: relative;
            width: 100%;
            max-height: 500px; /* Ajusta la altura máxima según tus necesidades */
            overflow: hidden;
        }
        .img-container img {
            width: 100%;
            height: auto;
        }
</style>

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
                        <li><a class="dropdown-item" href="./profile.php">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Salir</a></li>
                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <h1 class="text-center mt-3 mb-5">Editar perfil</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="card" style="width: 100%;">
                    <div class="card-body">
                        <h5 class="card-title">Editar perfil</h5>
                        <form id="EditarUsuarioForm" enctype="multipart/form-data" method="POST" action="/app-lana/controller/profile/editar-usuario.php">
                            <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>">
                            
                            <div class="mb-3">
                                <label for="inputName" class="form-label">Nombre</label>
                                <input type="text" name="nombre" id="inputName" class="form-control" placeholder="Pepito" required autofocus value="<?php echo htmlspecialchars($user['nombre']); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="inputEmail" class="form-label">Correo</label>
                                <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Hola@hola.com" required value="<?php echo htmlspecialchars($user['email']); ?>">
                            </div>
                            
                            <div class="mb-3">
                                <label for="inputPassword" class="form-label">Contraseña</label>
                                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="*****" required>
                            </div>

                            <div class="mb-3">
                                <label for="formFile" class="form-label">Editar foto de perfil</label>
                                <input class="form-control" name="profile_pic" type="file" id="formFile" accept="image/*">
                            </div>

                            <button class="btn btn-primary mt-3 btn-block" type="submit">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="img-container">
                    <img src="https://images.unsplash.com/photo-1517479149777-5f3b1511d5ad?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Imagen de ejemplo">
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./../../ajax/profile/editar-perfil.js"></script>
    <script src="./../../ajax/profile/logout.js"></script>

</body>
</html>