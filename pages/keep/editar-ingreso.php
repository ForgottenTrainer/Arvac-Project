<?php 

session_start();

require'./../../controller/bd.php';

$ingreso_id = $_GET['id'];

if (!$ingreso_id) {
    echo "ID de ahorro no proporcionado.";
    exit();
}


$stmt = $conn->prepare("SELECT * FROM ingresos WHERE id = :id");
$stmt->bindParam(':id', $ingreso_id);
$stmt->execute();
$ingreso= $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Ingreso</title>
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
                    <a class="nav-link active" aria-current="page" href="./../../../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./../../dashboard.php">Panel de control</a>
                    </li>
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Mas opciones
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./../tabla.php">Registrar ahorro</a></li>
                        <li><a class="dropdown-item" href="./../../profile/profile.php">Perfil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" id="logout">Salir</a></li> 

                    </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <h3 class="text-center mt-3 mb-3">Editar Ingreso</h3>
        <div class="card">
            <div class="card-body">
                <form id="ingresoForm">
                    <input type="hidden" name="ingreso_id" value="<?php echo $ingreso['id'] ?>">
                    <div class="mb-3">
                        <label for="amount" class="form-label">Monto</label>
                        <input type="number" class="form-control" id="amount" name="amount" value="<?php echo $ingreso['amount'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo $ingreso['description'] ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar Ingreso</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="./../../../ajax/editar-ingreso.js"></script>
    <script src="./../../../ajax/profile/logout.js"></script>

</body>
</html>