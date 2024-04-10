<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $items = $categoryController->getStocks($_SESSION['id']);
    $users = $categoryController->getUsers();
   
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

                <div id="propio" class="tabcontent" style="display: block;">
                    <h2>Propio</h2>
                    <table>
                        <tr>
                            <th>Artículo</th>
                            <th>Cantidad</th>
                        </tr>
                        <?php foreach ($items as $item): ?>
                            <tr>
                                <td><?= $item['nombre'] ?></td>
                                <td><?= $item['cantidad'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>

                <div id="vendedores" class="tabcontent" style="display: none;">
                    <h2>Vendedores</h2>
                    <table>
                        <tr>
                            <th>Vendedor 1</th>
                            <th>Cubo X Cantidad</th>
                            <th>Cable X Cantidad</th>
                        </tr>
                        <tr>
                            <td>Vendedor 1</td>
                            <td>10</td>
                            <td>5</td>
                        </tr>
                    </table>
                    <table>
                        <tr>
                            <th>Vendedor 2</th>
                            <th>Cubo X Cantidad</th>
                            <th>Cable X Cantidad</th>
                        </tr>
                        <tr>
                            <td>Vendedor 2</td>
                            <td>20</td>
                            <td>8</td>
                        </tr>
                    </table>
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