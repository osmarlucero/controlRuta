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
        <link rel="StyleSheet" href= "../CSS/colorFull.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>MAIN</title>
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
               <a href="usuarios.php"> <ul class="ulMain">
                    <li><img src="../images/users.jpg" alt="Usuario"></li>
                    <li>Usuarios</li>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul>
            </a>
            </div>

            <!-- Formulario 2: Tiendas -->
            <div class="mainContainer">
                 <a href="stores.php"><ul class="ulMain">
                    <li><img src="../images/store.png" alt="Tienda"></li>
                    <li>Tiendas</li>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul></a>
            </div>
        </main>

        <!-- Formulario 3: Ventas -->
        <main class="container d-flex align-items-center justify-content-center">
            <div class="mainContainer">
                 <a href=""><ul class="ulMain">
                    <li><img src="../images/sales.jpg" alt="Ventas"></li>
                    <li>Ventas</li>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul></a>
            </div>

            <!-- Formulario 4: Inventarios -->
            <div class="mainContainer">
                 <a href=""><ul class="ulMain">
                    <li><img src="../images/stock.png" alt="Inventarios"></li>
                    <li>Inventarios</li>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul></a>
            </div>
        </main>



    </body>
</html>