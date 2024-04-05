<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    /*if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }*/
    //#a44e2c
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MAIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
        crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/colorFull.css?v=0.0.2" />
    <link rel="stylesheet" href="../CSS/uploadCSS.css?v=0.0.2" />
    <style>
        .card-container:hover .card {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transform: translateY(-4px);
        }
        .card {
            border-radius: 10px;
            transition: box-shadow 0.3s, transform 0.3s;
        }
    </style>
    <script src="../app/jquery-3.5.1.min.js"></script>
    <script>
        $(function () {
            $("#header").load("menu.php");
        });
    </script>
</head>

<body>
    <header id="header"></header>

    <main class="container mt-5">
        <div class="row justify-content-center">

            <!-- Usuarios -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="usuarios.php" class="text-decoration-none card-container">
                    <div class="card h-100 bg-light shadow">
                        <img src="../images/users.jpg" class="card-img-top" alt="Usuarios">
                        <div class="card-body text-center">
                            <h5 class="card-title">Usuarios</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Tiendas -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="stores.php" class="text-decoration-none card-container">
                    <div class="card h-100 bg-light shadow">
                        <img src="../images/store.png" class="card-img-top" alt="Tiendas">
                        <div class="card-body text-center">
                            <h5 class="card-title">Tiendas</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Ventas -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="ventas.php" class="text-decoration-none card-container">
                    <div class="card h-100 bg-light shadow">
                        <img src="../images/sales.jpg" class="card-img-top" alt="Ventas">
                        <div class="card-body text-center">
                            <h5 class="card-title">Ventas</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Inventarios -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="inventarios.php" class="text-decoration-none card-container">
                    <div class="card h-100 bg-light shadow">
                        <img src="../images/stock.png" class="card-img-top" alt="Inventarios">
                        <div class="card-body text-center">
                            <h5 class="card-title">Inventarios</h5>
                        </div>
                    </div>
                </a>    
            </div>
            <!-- Inventarios -->
            <div class="col-lg-3 col-md-6 mb-4">
                <a href="incidentes.php" class="text-decoration-none card-container">
                    <div class="card h-100 bg-light shadow">
                        <img src="../images/inc.png" class="card-img-top" alt="Inventarios">
                        <div class="card-body text-center">
                            <h5 class="card-title">Incidentes</h5>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </main>

    <!-- JavaScript y Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eESmnR9on8Kc6G5jFK7M/n6Ux1xZeF+41iQZ10W9ROx5u6IcaRRiEu6VxlUww9D"
        crossorigin="anonymous"></script>
</body>

</html>
