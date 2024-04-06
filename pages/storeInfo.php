<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $users = $categoryController->getStoresInfo($_GET['id']);
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCek2wbl-E5DjBL9AtoM2J6RL209xmGj30&callback=initMap" async defer></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Expires" content="0">
    <link rel="StyleSheet" href="../CSS/colorFullStoresEdit.css?v=0.0.2" />
    <link rel="StyleSheet" href="../CSS/uploadCSS.css?v=0.0.2" />
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Informacion De Tienda</title>
        <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    <script src="../app/jquery-3.5.1.min.js"></script>
    <script>
        $(function(){
            $("#header").load("menu.php"); 
            
        });
    </script> 
    <script>
     // Función para generar el código de barras
    function generateBarcode(code) {
        JsBarcode("#barcode", code); // Genera el código de barras en el canvas con el ID "barcode" y el código especificado
    }

    // Llamamos a la función para generar el código de barras con un código de ejemplo
    window.onload = function() {
        var locations = <?php echo json_encode($users); ?>;
        for (var i = 0; i < locations.length; i++) {
            generateBarcode(locations[i].id_tienda);
        }
    };
</script>

    <script>
        function initMap() {
            // Array de ubicaciones de ejemplo
            //getStores();
            var locations = <?php echo json_encode($users); ?>;
            for (var i = 0; i < locations.length; i++) {
                locations[i].lat = parseFloat(locations[i].lat);
                locations[i].lng = parseFloat(locations[i].lng);
            }

            // Crea un nuevo mapa y centra en la primera ubicación si hay al menos una ubicación
            if (locations.length > 0) {
                var map = new google.maps.Map(document.getElementById('map'), {
                    center: locations[0],
                    zoom: 12
                });

                // Agrega marcadores e infoWindows para cada ubicación en el array
                for (var i = 0; i < locations.length; i++) {
                    addMarker(locations[i], map, locations[i].id_tienda);
                }
            }

            function addMarker(location, map, id) {
                var marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: 'Ubicación'
                });

                // Crea un enlace dentro del cuadro de diálogo
                var link = 'Informacion de tienda';

                var infoWindow = new google.maps.InfoWindow({
                    content: location.nombre + '<br>' + link
                });

                marker.addListener('click', function () {
                    infoWindow.open(map, marker);
                });
            }
        }
       function printl(){
                var sub = <?php echo json_encode($users); ?>;
                if(sub!=""){
                    var code = "Shrek";
                    sessionStorage.setItem("code", sub[0].id_tienda);
                    window.open("ticket.html", "_blank");
                }else
                    alert("Debe de haber datos cargados");
        
            }
    </script>
</head>
<body>
    <header id="header"></header>
    <!-- Formulario 1: Usuarios -->
    <main class="container d-flex align-items-center justify-content-center">
        <form class="mainContainer" action="../app/categoryController.php" method="POST">
        <div class="">
        <div class="row">
            <div class="col-6">
                <h2 class="mb-4">Datos De Tienda</h2>
            </div>
            <div class="col-6">
                <button type="submit" class="text-center btn btn-secondary">Actualizar</button>
            </div>
        </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" style="background-color: white;">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <th style="width: 30%;">ID</th>
                                <td style="width: 70%;"><?= $user['id_tienda'] ?></td>
                                <input type="hidden" name="id" value="<?= $user['id_tienda'] ?>">
                            </tr>
                            <tr>
                                <th>Nombre</th>
                                <td><input type="text" name="nombre" value="<?= $user['nombre'] ?>"></td>
                            </tr>
                            <tr>
                                <th>Nombre Responsable</th>
                                <td><input type="text" name="nombre_responsable" value="<?= $user['nombre_responsable'] ?>"></td>
                            </tr>
                            <tr>
                                <th>Dirección</th>
                                <td><input type="text" name="direccion" value="<?= $user['direccion'] ?>"></td>
                            </tr>
                            <tr>
                                <th>Correo</th>
                                <td><input type="text" name="correo" value="<?= $user['correo'] ?>"></td>
                            </tr>
                            <tr>
                                <th>RFC</th>
                                <td><input type="text" name="RFC" value="<?= $user['RFC'] ?>"></td>
                            </tr>
                            <tr>
                                <th>Teléfono</th>
                                <td><input type="text" name="telefono" value="<?= $user['telefono'] ?>"></td>
                            </tr>
                            <tr>
                                <th>Fecha Creación</th>
                                <td><?= $user['fecha_creacion'] ?></td>
                            </tr>
                            <tr>
                                <th>Fecha Última Visita</th>
                                <td><?= $user['fecha_ultima_visita'] ?></td>
                            </tr>
                            <tr>
                                <th>Vendedor</th>
                                <td><input type="text" name="vendedor" value="<?= $user['vendedor'] ?>"></td>
                            </tr>
                            <tr>
                                <th>Precio</th>
                                <td><input type="text" name="precio" value="<?= $user['precio'] ?>"></td>
                            </tr> 
                            <tr>
                                <th>Codigo</th>
                                <td><canvas id="barcode" onclick="printl();"></canvas></td>
                            </tr> 
                            <tr>
                                 <th colspan="2" class="text-center">Ubicacion</th>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="map" style="width: 100%; height: 400px;"></div>
                                </td>
                            </tr>
                            <input type="hidden" name="action" value="editStore">
                        <?php endforeach ?>
                    </table>
                </div>
        </div>
        </form>
    </main>
</body>
</html>
