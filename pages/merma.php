<?php
    include "../app/mermaController.php";
    $mermaController = new mermaController();
    $incidents = $mermaController->getMerma();
   
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Expires" content="0">
        <link rel="StyleSheet" href= "../CSS/colorFullUsers.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Merma</title>
       <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
              $("#header").load("menu.php"); 
            });

        </script> 
        <script>
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
                <p class="">Incidentes Existentes</p></a>
                <ul class="ulMain item-list">
                    <?php foreach ($incidents as $incident): ?>
                    <li><?= $incident['nombre_tienda'] ?> | <?= $incident['descripcion'] ?> | <?= $incident['fecha'] ?> | <a href="incidentDetail.php?id=<?= $incident['id'] ?>">Ver Detalle</a>                       
                    </li>        
                    <?php endforeach ?>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul>
            </div>
        </main>
        <div id="pagination" class="pagination"></div>
        
    </body>
</html>