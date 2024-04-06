<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creación Usuarios</title>
    <link rel="icon" href="../images/logo-removebg.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/colorFullUsersEdit.css?v=0.0.2">
    <link rel="stylesheet" href="../CSS/uploadCSS.css?v=0.0.2">
</head>
<body>
    <!-- Header -->
    <header id="header"></header>

    <!-- Main content -->
    <main class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
        <div class="mainContainer">
            <h1 class="text-center mb-4">Creación de Usuario</h1>
            <form action="../app/categoryController.php" method="POST" id="add_form" enctype="multipart/form-data">
                <div class="mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="mac" name="mac" placeholder="M.A.C. (En caso de ser Vendedor)" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="rol" name="rol">
                        <?php if ($_SESSION['rol'] === 'Admin'): ?>
                            <option value="Administrador">Administrador</option>
                        <?php endif; ?>
                        <option value="Vendedor">Vendedor</option>
                        <option value="Encargado">Encargado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Subir</button>
                <input type="hidden" name="action" value="storeUser">
            </form>
        </div>
    </main>

    <!-- Scripts -->
    <script src="../app/jquery-3.5.1.min.js"></script>
    <script>
        $(function() {
            $("#header").load("menu.php");
        });
    </script>
</body>
</html>
