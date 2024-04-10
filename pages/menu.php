<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
    //#a44e2c
?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <!-- Especifica el ícono de la pestaña del navegador -->
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
     <!-- Inicio manejo de notificaciones -->
    <script>
        let countNot=0;
        function consultarBaseDeDatos() {
            fetch('../app/notificationController.php') // Reemplaza 'ruta/a/tu/archivo.php' con la ruta correcta
                .then(response => response.text())
                .then(data => {
                    maker(data);
                    if(data>countNot)
                        consultarInfo(data); // Aquí puedes manejar la respuesta del archivo PHP
                })
                .catch(error => {
                    console.error('Hubo un error al llamar al archivo PHP:', error);
                });
        }
        function consultarInfo(data) {
            fetch('../app/notificationInfoController.php') // Reemplaza 'ruta/a/tu/archivo.php' con la ruta correcta
                .then(response => response.text())
                .then(data => {
                   crearNotificaciones(data);// Aquí puedes manejar la respuesta del archivo PHP
                })
                .catch(error => {
                    console.error('Hubo un error al llamar al archivo PHP:', error);
                });
                countNot=data;
        }
        /***********/
        function crearNotificaciones(data) {
            var notificaciones = JSON.parse(data); // Parsea el JSON recibido a un objeto JavaScript
            var dropdownMenu = document.getElementById("notiCount");

            // Elimina los elementos existentes dentro del dropdown-menu
            dropdownMenu.innerHTML = '';

            // Crea un enlace <a> por cada notificación y los agrega al dropdown-menu
            notificaciones.forEach(function(notificacion) {
                var enlace = document.createElement("a");
                enlace.classList.add("dropdown-item");
                enlace.textContent = "Factura a Tienda:" + notificacion.id_tienda;
                enlace.href = "seeFact.php?id="+notificacion.id_venta+"&idNot="+notificacion.id_noti+"&idTienda="+notificacion.id_tienda; // Aquí puedes establecer el enlace adecuado
                dropdownMenu.appendChild(enlace);
            });
        }

        /**************/
        function maker(num){
            // Paso 1: Seleccionar el elemento antiguo y eliminarlo
            var antiguoElemento = document.getElementById("texto");
              antiguoElemento.textContent = num;
            //alert(num);
            // Paso 3: Seleccionar el contenedor SVG y agregar el nuevo elemento
        } 
            // Llama a la función consultarBaseDeDatos() cada minuto (60000 milisegundos)
        setInterval(consultarBaseDeDatos, 10000);
        </script>
    <!-- Fin  manejo de notificaciones-->
</head>
<body>
    <header id="header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="main.php">
    <img src="../images/logo-removebg.png" alt="Logo" style="max-width: 15%;">
</a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <?php
                                $nombreUsuario=$_SESSION['nombre'];
                                echo '<span class="nav-link">Hola, ' . $nombreUsuario . '</span>'?>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="25" fill="currentColor" class="bi bi-bell" viewBox="0 0 16 16">
                                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4 4 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4 4 0 0 0-3.203-3.92zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5 5 0 0 1 13 6c0 .88.32 4.2 1.22 6"/>
                                    <!-- Número -->
                                    <text id="texto" x="10" y="8" font-size="10" fill="red"></text>
                                </svg>
                            </a>
                            <div id="notiCount" class="dropdown-menu" aria-labelledby="navbarDropdown">
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="main.php">Inicio</a>
                        </li>
                       <?php
                            if($_SESSION['rol']=="Admin"){
                                echo '<li class="nav-item dropdown">
                                    <a  onclick="consultarInfo()" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Insumos
                                    </a>
                                    <div  class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="insumos.php">Existencias</a>
                                        <a class="dropdown-item" href="setProducInfo.php">Categorias</a>
                                        <a class="dropdown-item" href="upload.php">Subir Producto</a>
                                    </div>
                                </li>';
                            }
                        ?>

                        <li class="nav-item">
                            <form action="../app/authController.php" method="POST">
                                <input type="hidden" name="access" value="logout">
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
