<?php 

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../../index.php"); // Redirige al dashboard o a la página principal
    exit();
}

require'./../../controller/bd.php';

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM ahorros WHERE user_id = :user_id");
$stmt->bindParam(':user_id', $user_id);
$stmt->execute();
$ahorros = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARVAC - Mis ahorros</title>
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
                        <li><a class="dropdown-item" href="#">Registrar ahorro</a></li>
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
        <h1 class="text-center mt-3 mb-3">Registro de mis ahorros</h1>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ahorroModal">
            Agregar Ahorro
        </button>
        <div class="mt-5">
            <h3 class="mb-3">Tus ahorros</h3>
            <ul class="list-group">
                
            <?php foreach ($ahorros as $ahorro): ?>
                <li class="list-group-item">
                    <a href="./tabla-ahorro.php?id=<?php echo $ahorro['id']; ?> "class="" >
                        <?php echo htmlspecialchars($ahorro['name']); ?>
                    </a>
                    <div class="flex">
                        <a href="./editar-ahorro.php?id=<?php echo $ahorro['id']; ?>" class="btn btn-primary">
                            Editar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="" style="width: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        <button type="button" class="btn btn-danger eliminar-btn" data-ingreso-id="<?php echo $ahorro['id']; ?>">
                            Eliminar
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 20px;">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="ahorroModal" tabindex="-1" aria-labelledby="ahorroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ahorroModalLabel">Registrar Ahorro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ahorroForm">
                        <input type="hidden" value="<?php echo $_SESSION['user_id']; ?>" name="id_user">
                        <div class="mb-3">
                            <label for="ahorro" class="form-label">Nombre del ahorro</label>
                            <input type="text" name="name" class="form-control" id="ahorro" required>
                        </div>
                        <div class="mb-3">
                            <label for="ingreso" class="form-label">Dinero a ahorrar</label>
                            <input type="number" name="amount" class="form-control" id="ingreso" required>
                        </div>
                        <div class="mb-3">
                            <label for="Desc" class="form-label">Descripción</label>
                            <input type="text" name="description" class="form-control" id="Desc" >
                        </div>
                        <button type="submit" class="btn btn-primary">Aceptar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

      
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="./../../ajax/crear-ahorro.js"></script>
    <script src="./../../ajax/eliminar-ahorro.js"></script>
    <script src="./../../ajax/profile/logout.js"></script>


</body>
</html>