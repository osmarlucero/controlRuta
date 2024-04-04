<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../CSS/menu.css?v=0.0.2">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos adicionales */
        .navbar-brand {
            font-weight: bold;
        }
        .navbar-nav .nav-link {
            font-weight: bold;
        }
        .dropdown-menu {
            border: none;
            border-radius: 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .dropdown-menu a {
            color: #333;
        }
        .dropdown-menu a:hover {
            background-color: #f8f9fa !important;
        }
        #logout-btn {
            color: #fff;
            background-color: #dc3545;
            border: none;
            border-radius: 3px;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        #logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="#">+WIRED</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="main.php">Inicio</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Insumos
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="insumos.php">Existencias</a>
                                <a class="dropdown-item" href="setProducInfo.php">Categorias</a>
                                <a class="dropdown-item" href="upload.php">Subir Producto</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <form action="../app/reportController.php" method="POST">
                                <input type="hidden" name="action" value="logout">
                                <button id="logout-btn" type="submit" class="btn btn-sm">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
