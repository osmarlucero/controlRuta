<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $users = $categoryController->getUsers();
   
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="StyleSheet" href="../CSS/colorFullUsers.css?v=0.0.2" />
    <link rel="StyleSheet" href="../CSS/uploadCSS.css?v=0.0.2" />
    <style>
        
    </style>
    <script src="../app/jquery-3.5.1.min.js"></script>
    <script>
        $(function(){
            $("#header").load("menu.php"); 
        });

        document.addEventListener('DOMContentLoaded', function () {
            const itemsPerPage = 10;
            const itemList = document.querySelector('.item-list');
            const paginationContainer = document.getElementById('pagination');

            const totalItems = itemList.children.length;
            const totalPages = Math.ceil(totalItems / itemsPerPage);

            // Generar botones de paginación
            for (let i = 1; i <= totalPages; i++) {
                const pageButton = document.createElement('li');
                pageButton.textContent = i;
                pageButton.addEventListener('click', function () {
                    showPage(i);
                });
                paginationContainer.appendChild(pageButton);
            }

            // Función para mostrar la página seleccionada
            function showPage(pageNumber) {
                const startIndex = (pageNumber - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                for (let i = 0; i < totalItems; i++) {
                    itemList.children[i].style.display = (i >= startIndex && i < endIndex) ? 'block' : 'none';
                }
            }

            // Mostrar la primera página al cargar la página
            showPage(1);
        });
    </script>
</head>

<body>

    <header id="header"></header>
    <!-- Formulario 1: Usuarios -->
    <main class="container d-flex align-items-center justify-content-center">
        <div class="mainContainer">
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">Usuarios Existentes</h2>
    <div>
        <a href="main.php" class="btn btn-secondary me-2">Regresar</a>
        <a href="createUser.php" class="btn btn-primary">Crear Usuario</a>
    </div>
</div>
            <ul class="ulMain item-list">
                <?php foreach ($users as $user): ?>
                <li><?= $user['id'] ?> | <?= $user['nombre'] ?> <?= $user['apellido'] ?> Rol:<?= $user['rol'] ?>
                    <a href="editUser.php?id=<?= $user['id'] ?>">Editar</a>
                </li>
                <?php endforeach ?>
                <!-- Agrega más elementos del formulario según sea necesario -->
            </ul>
        </div>
    </main>
    <div  class="pagination"><ul id="pagination"></ul></div>

</body>

</html>
