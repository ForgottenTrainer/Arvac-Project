<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ARVAC</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <?php require 'components/navbar.php' ?>

        <main role="main">
            <div class="jumbotron mt-5">
                <div class="container">
                <h1 class="display-3">ARVAC Sitio web que te ayuda a llevar el registro de ahorros</h1>
                <p>Acordamos hacer un plan de viaja internacional y es tiempo de ahorrar, lleva tus registros desde este sitio web.</p>
                <p><a class="btn btn-primary btn-lg" href="./pages/session/register.php" role="button">Registrate</a></p>
                </div>
            </div>

            <div class="container">
                <!-- Example row of columns -->
                <div class="row">
                    <div class="col-md-4">
                        <h2>Crear viaje</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-secondary" href="./pages/keep/tabla.php" role="button">Crear Viaje</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2>Unirte a un viaje</h2>
                        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
                        <p><a class="btn btn-secondary" href="./pages/room/unirse-sala.php" role="button">Unirme a un viaje</a></p>
                    </div>

                </div>

                <hr>

            </div> 
        </main>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>