<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $users = $categoryController->getStoresInfo($_GET['id']);
   
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
        <link rel="StyleSheet" href= "../CSS/colorFullStoresEdit.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Informacion De Tienda</title>
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
                <p class="">Datos De Tienda</p>
                <ul class="ulMain item-list">
                    <?php foreach ($users as $user): ?>
                    <li>
                         <ul class="mdm">
                            <li>ID</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled value=<?= $user['id_tienda'] ?>>
                            </li>
                        </ul>
                        <ul class="mdm">
                            <li>Nombre</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['nombre'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>nombre_responsable</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['nombre_responsable'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>direccion</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['direccion'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>correo</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['correo'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>RFC</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['RFC'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>telefono</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['telefono'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>fecha_creacion</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['fecha_creacion'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>fecha_ultima_visita</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['fecha_ultima_visita'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>vendedor</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['vendedor'] ?>>
                            </li>
                        </ul>
                         <ul class="mdm">
                            <li>precio</li>
                            <li>
                                <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" disabled  value=<?= $user['precio'] ?>>
                            </li>
                        </ul>

                    </li>        
                    <?php endforeach ?>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul>
            </div>
        </main>
    </body>
</html>