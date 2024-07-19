<?php require'./../../views/keep/editar-ahorro.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ahorro</title>
    <?php require'../../components/boot-css.php'; ?>
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
                            <li><a class="dropdown-item" href="./tabla.php">Registrar ahorro</a></li>
                            <li><a class="dropdown-item" href="./../profile/profile.php">Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#" id="logout">Salir</a></li> 

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="text-center mb-3 mt-3">Editar ahorro</h1>
        <div class="card mx-auto" style="width: 25rem;">
            <div class="card-body">
                <form id="EditarAhorroForm">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($ahorro['id']); ?>">
                    <input type="hidden" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>" name="user_id">
                    <div class="mb-3">
                        <label for="ahorro" class="form-label">Nombre del ahorro</label>
                        <input type="text" name="name" value="<?php echo htmlspecialchars($ahorro['name']); ?>" class="form-control" id="ahorro" required>
                    </div>
                    <div class="mb-3">
                        <label for="ingreso" class="form-label">Dinero a ahorrar</label>
                        <input type="number" name="amount" value="<?php echo htmlspecialchars($ahorro['amount']); ?>" class="form-control" id="ingreso" required>
                    </div>
                    <div class="mb-3">
                        <label for="Desc" class="form-label">Descripción</label>
                        <textarea name="description" class="form-control" id="Desc" rows="3" required><?php echo htmlspecialchars($ahorro['description']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Editar Ahorro</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./../../ajax/editar-ahorro.js"></script>
    <script src="./../../ajax/profile/logout.js"></script>

</body>
</html>
