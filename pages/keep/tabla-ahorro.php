<?php 
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../../index.php");
    exit();
}

if (!isset($_SESSION['user_id'])) {
    die("Usuario no autenticado.");
}

require'./../../controller/bd.php';

$ahorro_id = $_GET['id'] ?? null;

if (!$ahorro_id) {
    echo "ID de ahorro no proporcionado.";
    exit();
}


$stmt = $conn->prepare("SELECT SUM(amount) as total_ahorro FROM ingresos WHERE ahorro_id = :id");
$stmt->bindParam(':id', $ahorro_id, PDO::PARAM_INT);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$total_ahorro = $result['total_ahorro'] ?? 0;

$stmt = $conn->prepare("SELECT * FROM ahorros WHERE id = :id");
$stmt->bindParam(':id', $ahorro_id);
$stmt->execute();
$ahorro = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ahorro) {
    echo "Ahorro no encontrado.";
    exit();
}

// Obtener todos los ingresos para este ahorro específico
$stmt = $conn->prepare("SELECT * FROM ingresos WHERE ahorro_id = :ahorro_id");
$stmt->bindParam(':ahorro_id', $ahorro_id, PDO::PARAM_INT);
$stmt->execute();
$ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);

//Obtener el codigo de la sala
$stmt2 = $conn->prepare("SELECT * FROM salas WHERE ahorro_id = :ahorro_id");
$stmt2->bindParam(':ahorro_id', $ahorro_id, PDO::PARAM_INT);
$stmt2->execute();
$sala = $stmt2->fetch(PDO::FETCH_ASSOC);


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
        <h1 class="text-center mt-3 mb-3">Ingresos <?php echo htmlspecialchars($ahorro['name']); ?></h1>
        <p class="text-center"> <?php echo $ahorro['description']; ?> </p>
        <div class="container mt-5 mb-3">
            <div class="d-flex justify-content-between align-items-center w-100">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ahorroModal">
                    Ingresar ahorro
                </button>
                <div class="">
                    <p class="">Codigo de sala: </p> <?php echo $sala['codigo']; ?>
                </div>
                <div>
                    <b>Meta: </b>
                    <span id="totalAhorro">
                        <?php 
                            echo $ahorro['amount']; 

                            if($ahorro['amount'] >= $total_ahorro) {
                                echo ' 
                                
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 20px; color: red;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>

                                ';
                            } else {
                                echo ' 
                                

                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 20px; color: green;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                                </svg>

                                ';
                            }
                        ?>
                    </span>
                </div>
                <div>
                    <b>Ahorro total: </b>
                    <span id="totalAhorro"><?php echo ($total_ahorro); ?></span>
                </div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Monto</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($ingresos) > 0): ?>
                    <?php foreach ($ingresos as $ingreso): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($ingreso['amount']); ?></td>
                            <td><?php echo htmlspecialchars($ingreso['date']); ?></td>
                            <td><?php echo htmlspecialchars($ingreso['description']); ?></td>
                            <td class="flex">
                                <a href="./editar-ingreso.php/?id=<?php echo $ingreso['id'] ?>" class="btn btn-primary">
                                    Editar
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                <button type="button" class="btn btn-danger eliminar-btn" data-ingreso-id="<?php echo htmlspecialchars($ingreso['id']); ?>">
                                    Eliminar
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6" style="width: 20px;">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay ingresos registrados para este ahorro.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="ahorroModal" tabindex="-1" aria-labelledby="ahorroModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ahorroModalLabel">Registrar Ahorro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="ingresoForm">
                        <input type="hidden" name="ahorro_id" value="<?php echo $ahorro_id; ?>">
                        <div class="mb-3">
                            <label for="amount" class="form-label">Monto</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Ingreso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <script src="./../../ajax/ingresos.js"></script>
    <script src="./../../ajax/eliminar-meta.js"></script>
    <script src="./../../ajax/profile/logout.js"></script>

</body>
</html>