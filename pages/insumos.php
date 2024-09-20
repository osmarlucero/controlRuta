<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $insumos1 = $categoryController->getInsumos(1);
    $insumos2 = $categoryController->getInsumos(2);
    $insumos3 = $categoryController->getInsumos(3);
    $insumos4 = $categoryController->getInsumos(4);
    $insumos5 = $categoryController->getInsumos(5);
    $insumos6 = $categoryController->getInsumos(6);
    $insumos7 = $categoryController->getInsumos(7);
    $insumos8 = $categoryController->getInsumos(8);
    $insumos9 = $categoryController->getInsumos(9);
    $insumos10 = $categoryController->getInsumos(10);
    $insumos11 = $categoryController->getInsumos(12);
    $products = $categoryController->getProducts();

    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
        <meta http-equiv="Expires" content="0">
        <link rel="StyleSheet" href= "../CSS/colorFullUsers.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/colorFullCrateInsumos.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Inventarios</title>
        <style>
            body {
                background-color: #f5f5f5;
                font-family: Arial, sans-serif;
            }

            .mainContainer {
                background-color: #ffffff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                width: 80%;
                margin: 20px auto;
            }

            table.default {
                width: 100%;
                border-collapse: collapse;
                background-color: #f9f9f9;
                box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            }

            table.default th, table.default td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }

            table.default tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            table.default tr:hover {
                background-color: #e2e2e2;
            }

            header {
                margin-bottom: 20px;
            }

            .btn-secondary {
                background-color: #6c757d;
                border-color: #6c757d;
            }

            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }

            dialog {
                border: 1px solid #ccc;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                padding: 20px;
            }
        </style>
        <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
                $("#header").load("menu.php"); 
            });

            function mostrarFormularioModificar() {
                var dialog = document.getElementById("dialogoModificar");
                dialog.showModal();
            }

            function cerrarFormularioModificar() {
                var dialog = document.getElementById("dialogoModificar");
                dialog.close();
            }

            function mostrarFormularioAgregar() {
                var dialog = document.getElementById("dialogoAgregar");
                dialog.showModal();
            }

            function cerrarFormularioAgregar() {
                var dialog = document.getElementById("dialogoAgregar");
                dialog.close();
            }
        </script> 
    </head>
    
    <body>
        <header id="header"></header>
        <!-- Formulario 1: Usuarios -->
        <main class="container d-flex align-items-center justify-content-center">
            <div class="mainContainer">
                <p class="">Insumos Existentes 
                    <button class="btn btn-secondary" onclick="mostrarFormularioModificar()">Modificar</button>
                    <button class="btn btn-secondary" onclick="mostrarFormularioAgregar()">Agregar</button>
                </p>
                <ul class="ulMain item-list">
                   <table class="default">
                        <tr>
                            <td></td>
                            <td>Victor</td>
                            <td colspan="4">Ivan</td>
                            <td colspan="3">Manufactura</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Productos Terminados</td>
                            <td>Blister Negro</td>
                            <td>Sin Empaque</td>
                            <td>Blister Gris</td>
                            <td>En transito</td>
                            <td>Sin Empaque</td>
                            <td>Blister Negro</td>
                            <td>Blister Gris</td>
                        </tr>
                        <tr>
                            <td>Cable Tipo C</td>
                          <?php foreach ($insumos1 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cable V8</td>
                            <?php foreach ($insumos2 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cable iPhone</td>
                            <?php foreach ($insumos3 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cable Tipo C a Tipo C</td>
                            <?php foreach ($insumos4 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cable Tipo C a iPhone</td>
                            <?php foreach ($insumos5 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Audifonos</td>
                            <?php foreach ($insumos6 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cargador de Carro USB</td>
                            <?php foreach ($insumos7 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cargador de casa USB Y tipo C</td>
                            <?php foreach ($insumos8 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cargador de Carro Tipo C</td>
                            <?php foreach ($insumos9 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cargador de Casa Tipo C</td>
                            <?php foreach ($insumos10 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                        <tr>
                            <td>Cargador de casa doble</td>
                            <?php foreach ($insumos11 as $insumo): ?>
                            <td><?= $insumo['stock'] ?></td>
                        <?php endforeach ?>
                        </tr>
                    </table>
                </ul>
                <dialog id="dialogoModificar">
                    <form action="../app/categoryController.php" method="POST">
                        <div class="mb-3">
                            <label for="productoModificar" class="form-label">Producto</label>
                            <select id="productoModificar" class="form-select" name="producto">
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product['id_productos'] ?>"><?= $product['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estadoModificar" class="form-label">Estado</label>
                            <select id="estadoModificar" class="form-select" name="estado">
                                    <option value="terminado">Productos Terminados</option>
                                    <option value="Blister negro">Blister Negro</option>
                                    <option value="Blister Gris">Blister Gris</option>
                                    <option value="sin Empaque">Productos Sin Empaque</option>
                                    <option value="manufactura">En Proceso</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidadModificar" class="form-label">Cantidad a mover</label>
                            <input type="number" class="form-control" id="cantidadModificar" name="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="deModificar" class="form-label">De</label>
                            <select id="deModificar" class="form-select" name="de">
                                <option value="20193">Victor</option>
                                <option value="4141">Ivan</option>
                                <option value="7676">Chinos</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="aModificar" class="form-label">A</label>
                            <select id="aModificar" class="form-select" name="a">
                                <option value="20193">Victor</option>
                                <option value="4141">Ivan</option>
                                <option value="7676">Chinos</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="cerrarFormularioModificar()">Cancelar</button>
                        <input type="hidden" name="action" value="modificar">
                        <button type="submit" class="btn btn-primary">Mover</button>
                    </form>
                </dialog>
                <dialog id="dialogoAgregar">
                    <form action="../app/categoryController.php" method="POST">
                        <div class="mb-3">
                            <label for="productoAgregar" class="form-label">Producto</label>
                            <select id="productoAgregar" class="form-select" name="producto">
                                <?php foreach ($products as $product): ?>
                                    <option value="<?= $product['id_productos'] ?>"><?= $product['nombre'] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="estadoAgregar" class="form-label">Estado</label>
                            <select id="estadoAgregar" class="form-select" name="estado">
                                    <option value="terminado">Productos Terminados</option>
                                    <option value="Blister negro">Blister Negro</option>
                                    <option value="Blister Gris">Blister Gris</option>
                                    <option value="sin Empaque">Productos Sin Empaque</option>
                                    <option value="manufactura">En Proceso</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidadAgregar" class="form-label">Cantidad a agregar</label>
                            <input type="number" class="form-control" id="cantidadAgregar" name="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="personaAgregar" class="form-label">Persona a agregar</label>
                            <select id="personaAgregar" class="form-select" name="persona">
                                <option value="20193">Victor</option>
                                <option value="4141">Ivan</option>
                                <option value="7676">Chinos</option>
                            </select>
                        </div>
                        <input type="hidden" class="form-control" id="action" name="action" value="subirProducto">
                        <button type="button" class="btn btn-secondary" onclick="cerrarFormularioAgregar()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>
                    </form>
                </dialog>
            </div>
        </main>
    </body>
</html>
