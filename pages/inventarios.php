<?php
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $items = $categoryController->getStocks($_SESSION['id']);
    $users = $categoryController->getUsers();
    $sellers = $categoryController->getSellers();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Expires" content="0">
        <link rel="StyleSheet" href= "../CSS/colorFullUsers.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>INSUMOS</title>
       <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
              $("#header").load("menu.php"); 
            });
        </script> 
        <style>
    /* Estilos para la tabla */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        font-size: 16px;
        text-align: left;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th {
        background-color: #f2f2f2;
        padding: 12px 16px;
        font-weight: bold;
        color: #333;
        border-bottom: 2px solid #ddd;
    }

    td {
        padding: 10px 16px;
        border-bottom: 1px solid #ddd;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    /* Estilos para el contenedor */
    .tabcontent {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    h2 {
        color: #333;
        border-bottom: 2px solid #e9e9e9;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
     .tab button {
        background-color: #007bff;
        color: white;
        padding: 14px 20px;
        margin: 0px 5px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .tab button:hover {
        background-color: #0056b3;
    }

    .tab button.active {
        background-color: #0056b3;
    }
</style>
    </head>
    

    <body>

        <header id="header"></header>
        <!-- Formulario 1: Usuarios -->
        <main class="container d-flex align-items-center justify-content-center">
            <div class="mainContainer">
                <div class="tab">
                    <button class="tablinks active" onclick="openTab(event, 'propio')">Propio</button>
                    <button class="tablinks" onclick="openTab(event, 'vendedores')">Vendedores</button>
                </div>

                
<div id="propio" class="tabcontent">
    <h2>Propio</h2>
    <table>
        <thead>
            <tr>
                <th>Artículo</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td><?= $item['nombre'] ?></td>
                    <td><?= $item['cantidad'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
                <div id="vendedores" class="tabcontent" style="display: none;">
                    <?php foreach ($sellers as $seller): ?>
    <h2><?= $seller['nombre'] ?></h2>
    <table>
        <tr>
            <th>Articulo</th>
            <th>Cantidad</th>
        </tr>
        <?php 
            // Llamada a la función getArticles() pasando el ID del vendedor
            $articles = $categoryController->getArticles($seller['id']); 
            foreach ($articles as $article): 
        ?>
            <tr>
                <td><?= $article['nombre'] ?></td>
                <td><?= $article['cantidad'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endforeach; ?>

                </div>

            </div>
        </main>

<script>
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
</script>
    </body>
</html>