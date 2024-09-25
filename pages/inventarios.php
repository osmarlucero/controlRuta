<?php
include "../app/categoryController.php";
if (!isset($_SESSION) || $_SESSION['id'] == false) {
    header("Location:../");
}
$categoryController = new categoryController();
$items = $categoryController->getStocks($_SESSION['id']);
$users = $categoryController->getUsers();
$sellers = $categoryController->getSellers();
$manager = $categoryController->getTerminated();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Expires" content="0">
    <link rel="StyleSheet" href="../CSS/colorFullUsers.css?v=0.0.2" />
    <link rel="StyleSheet" href="../CSS/uploadCSS.css?v=0.0.2" />
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Inventario Vendedores</title>
    <script src="../app/jquery-3.5.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
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

        /* Ajustes responsivos */
        @media (max-width: 768px) {
            .mainContainer {
                width: 100%;
                padding: 0 10px;
            }

            table {
                font-size: 14px;
            }
        }

        @media (max-width: 375px) {
            th, td {
                font-size: 12px;
                padding: 8px;
            }

            .tab button {
                padding: 10px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

<header id="header"></header>
<main class="container d-flex align-items-center justify-content-center">
    <div class="mainContainer">
        <div class="tab">
            <button class="tablinks active" onclick="openTab(event, 'propio')">Propio</button>
            <button class="tablinks" onclick="openTab(event, 'vendedores')">Vendedores</button>
        </div>

        <!-- Propio Tab -->
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

        <!-- Vendedores Tab -->
        <div id="vendedores" class="tabcontent" style="display: none;">
            <?php foreach ($sellers as $seller): ?>
                <h2><?= $seller['nombre'] ?> <?= $seller['id'] ?>
                    <button class="btn btn-primary btn-sm" onclick="openForm('form-<?= $seller['id'] ?>')">Añadir</button>
                </h2>
                <table>
                    <tr>
                        <th>Articulo</th>
                        <th>Cantidad</th>
                    </tr>
                    <?php 
                        $articles = $categoryController->getArticles($seller['id']); 
                        foreach ($articles as $article): 
                    ?>
                        <tr>
                            <td><?= $article['nombre'] ?></td>
                            <td><?= $article['cantidad'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>

                <!-- Formulario para añadir artículos -->
                <div id="form-<?= $seller['id'] ?>" class="form-popup modal fade" tabindex="-1" role="dialog" aria-labelledby="formLabel-<?= $seller['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="formLabel-<?= $seller['id'] ?>">Añadir Artículo</h5>
                                <button type="button" class="close" onclick="closeForm('form-<?= $seller['id'] ?>')" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <form action="../app/categoryController.php" method="POST">
                                    <div class="form-group">
                                        <label for="article"><b>Artículo</b></label>
                                        <select name="article" class="form-control" required>
                                            <?php foreach ($manager as $article): ?>
                                                <option value="<?= $article['id'] ?>"><?= $article['nombre'] ?> | <?= $article['cantidad'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="cantidad"><b>Cantidad</b></label>
                                        <input type="number" class="form-control" placeholder="Ingrese cantidad" name="cantidad" required>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" class="form-control" value="<?= $seller['id'] ?>" name="id">
                                        <input type="hidden" class="form-control" value="traspasoStock" name="action">

                                        <button type="button" class="btn btn-secondary" onclick="closeForm('form-<?= $seller['id'] ?>')">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Añadir</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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

    function openForm(formId) {
        $('#' + formId).modal('show');
    }

    function closeForm(formId) {
        $('#' + formId).modal('hide');
    }
</script>
</body>
</html>
