<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $insumos = $categoryController->getDetalleVenta($_GET['id']);
    $tiendaInfos = $categoryController->getStoresInfo($_GET['idTienda']);
    $ventas = $categoryController->getVentasDetail($_GET['id']);
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
        <link rel="StyleSheet" href= "../CSS/colorFullCrateInsumos.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Factura Pendiente</title>
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
        <main class="container d-flex align-items-center justify-content-center mb-2">
            <div class="mainContainer">
                <p class="">Pendiente De Factura</p>
                <ul class="ulMain item-list">
                   <table class="default">
                        <tr>
                            <th colspan="2" class="text-center">Tienda</th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">
                            <?php foreach ($tiendaInfos as $tiendaInfo): ?>
                                Nombrer Tienda: <?= $tiendaInfo['nombre'] ?><br>
                                Direccion:<?= $tiendaInfo['direccion'] ?><br>
                                Correo: <?= $tiendaInfo['correo'] ?><br>
                                Telefono: <?= $tiendaInfo['telefono'] ?><br>
                                R.F.C. <?= $tiendaInfo['RFC'] ?><br>
                                Precio Unitario: <?= $tiendaInfo['precio'] ?><br>
                            <?php endforeach ?>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="2" class="text-center">
                                <?php foreach ($ventas as $venta): ?>
                                    Forma De Pago <?= $venta['tipo_venta'] ?><br>
                                    Total Venta: <?= $venta['total_venta'] ?><br>
                                    Fecha De Venta:<?= $venta['fecha_venta'] ?><br>
                                    Cantidad De Piezas: <?= $venta['cantidad_piezas'] ?><br>
                                    Anotaciones: <?= $venta['anotaciones'] ?><br>
                                <?php endforeach ?>
                            </th>
                        </tr>
                        <tr>
                            <th>Articulo</th>
                            <th>Cantidad De Piezas</th>
                        </tr>
                        <?php foreach ($insumos as $insumo): ?>
                        <tr>
                            <th><?= $insumo['nombre_articulo'] ?></th>
                            <th><?= $insumo['cantidad'] ?></th>
                        </tr>
                        <?php endforeach ?>
                        <tr>
                            <form action="../app/categoryController.php" method="POST">
                                <th colspan="2" class="text-center">Factura Realizada
                                    <input type="checkbox" id="update" name="update">
                                    <input type="hidden" id="idNoti" name="id" value="<?php echo $_GET['idNot']; ?>">
                                    <input type="hidden" id="action" name="action" value="updateFact">
                                    <button class="btn btn-success">Hecho</button>
                                </th> 
                            </form>
                        </tr>
                    </table>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul>
            </div>
        </main>
    </body>
</html>