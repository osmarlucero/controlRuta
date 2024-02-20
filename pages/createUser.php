<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    /*if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Expires" content="0">
        <link rel="StyleSheet" href= "../CSS/colorFullUsersEdit.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Editar Usuarios</title>
       <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
              $("#header").load("menu.php"); 
            });
        </script> 
    </head>
    

    <body>

        <header id="header"></header>
        <!-- Formulario 1: Usuarios -->
        <main class="container d-flex align-items-center justify-content-center">
    <div class="mainContainer">
        <p class="">Edicion De Usuario</p>
        <ul class="ulMain item-list">
            <form action="../app/categoryController.php" method="POST" id="add_form" enctype="multipart/form-data">
                <li  class="center-button">
                    <ul class="mdm">
                        <li>ID</li>
                        <li>
                            <input type="number" id="id" name="id" placeholder="Ingresa tu ID">
                        </li>
                    </ul>
                    <ul class="mdm">
                        <li>Nombre</li>
                        <li>
                            <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                        </li>
                    </ul>
                    <ul class="mdm">
                        <li>Apellido</li>
                        <li>
                            <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu Apellido" required>
                        </li>
                    </ul>
                    <ul class="mdm">
                        <li>Rol</li>
                        <li>
                            <select id="rol" name="rol">
                                <option value="Administrador">Administrador</option>
                                <option value="Vendedor">Vendedor</option>
                                <option value="Encargado">Encargado</option>
                            </select>
                        </li>
                    </ul>
                    <button type="submit">Subir</button>
                    <input type="hidden" name="action" value="storeUser">
                </li>
            </form>
            <!-- Agrega más elementos del formulario según sea necesario -->

            <!-- Botón para subir -->
        </ul>
    </div>
</main>
    </body>
</html>