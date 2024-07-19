<?php 

session_start();
require'./../views/keep/dashboard-view.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: ./../index.php"); // Redirige al dashboard o a la página principal
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de control</title>
    <?php require'../components/boot-css.php' ?>
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
                <a class="nav-link active" aria-current="page" href="./../index.php">Inicio</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="">Panel de control</a>
                </li>
                <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Mas opciones
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./keep/tabla.php">Registrar ahorro</a></li>
                    <li><a class="dropdown-item" href="./profile/profile.php">Perfil</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="#" id="logout">Salir</a></li> 

                </ul>
                </li>
            </ul>
            </div>
        </div>
    </nav>


    <h1 class="text-center">Panel de control</h1>
    <div class="row container mx-auto mt-3">
        <p class="mb-3"> <b>Grupo: </b> 
        <?php if (isset($ahorro['nombre']) && $ahorro['nombre'] != null): ?>
            <p><?php echo htmlspecialchars($ahorro['nombre']); ?></p>
        <?php else: ?>
            <p>Crea tu primer ahorro</p>
        <?php endif; ?>
        </p>

        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Dinero a ahorrar</p>
                                <h5 class="font-weight-bolder">
                                    <?php if ($ingreso): ?>
                                        <p>Cantidad: <?php echo htmlspecialchars($ahorro['amount']); ?></p>
                                    <?php else: ?>
                                        <p>Cantidad: 0</p>
                                    <?php endif; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingreso reciente</p>
                                <h5 class="font-weight-bolder">
                                <?php if ($ingreso): ?>
                                    <p>Cantidad: <?php echo htmlspecialchars($ingreso['amount']); ?></p>
                                <?php else: ?>
                                    <p>Cantidad: 0</p>
                                <?php endif; ?>
                                </h5>

                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-uppercase font-weight-bold">Grupo de viaje</p>
                                <h5 class="font-weight-bolder">
                                    <a href="" class="">Ver mas</a>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="row mt-4">
	<div class="col-lg-7 mb-lg-0 mb-4">
		<div class="card">
			<div class="card-body p-3">
				<div class="row">
					<div class="col-lg-6">
						<div class="d-flex flex-column h-100">
							<p class="mb-1 pt-2 text-bold">Checar progreso de mis colegas</p>
							<h5 class="font-weight-bolder">Si te gusta el chisme checa el ingreso de tus colegas</h5>
							<p class="mb-5">Puedes checar que tanto han ahorrado pero ese tan ansiado viaje que esperan.</p>
							<a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="./keep/tabla.php">
                                Chisme
                                <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                            </a>
						</div>
					</div>
					<div class="col-lg-5 ms-auto text-center mt-5 mt-lg-0">
						<div class="bg-gradient-primary border-radius-lg h-100">
							<img src="https://images.unsplash.com/photo-1618397746666-63405ce5d015?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" class="position-absolute h-100 top-0 d-lg-block d-none" style="width: 18.6em;" alt="waves">
							<div class="position-relative d-flex align-items-center justify-content-center h-100">
								<img class="w-100 position-relative z-index-2 pt-4" src="../img/amigos.png" alt="rocket">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-5">
		<div class="card h-100 p-3">
			<div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('https://images.unsplash.com/photo-1530789253388-582c481c54b0?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
				<span class="mask bg-gradient-dark"></span>
				<div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
					<h5 class="text-white font-weight-bolder mb-4 pt-2">El trabajo duro es la recomensa del mañana</h5>
					<p class="text-white">Aun que aveces sea dificil no olvides que todo esfuerzo trae recompensas.</p>

				</div>
		    </div>
	    </div>
    </div>
</div>


    <?php require'../components/boot-js.php' ?>
    <script src="./../ajax/profile/logout.js"></script>

</body>
</html>