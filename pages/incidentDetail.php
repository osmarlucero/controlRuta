<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $incidents = $categoryController->getIncidentsDetail($_GET['id']);
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
        function initMap() {
            // Array de ubicaciones de ejemplo
            //getStores();
            var locations = <?php echo json_encode($incidents); ?>;
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
                    content: location.id + '<br>' + link
                });

                marker.addListener('click', function () {
                    infoWindow.open(map, marker);
                });
            }
        }
    </script>
</head>
<body>

    <header id="header"></header>
    <!-- Formulario 1: Usuarios -->
    <main class="container d-flex align-items-center justify-content-center">
        <div class="mainContainer">
            <h2 class="mb-4">Datos De Tienda</h2>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" style="background-color: white;">
                    <?php foreach ($incidents as $incident): ?>
                        <tr>
                            <th style="width: 30%;">Nombre Tienda</th>
                            <td style="width: 70%;"><?= $incident['nombre_tienda'] ?></td>
                        </tr>
                        <tr>
                            <th>Descripcion</th>
                            <td><?= $incident['descripcion'] ?></td>
                        </tr>
                        <tr>
                            <th>Fecha Incidente</th>
                            <td><?= $incident['fecha'] ?></td>
                        </tr>
                         <tr>
                             <th colspan="2" class="text-center">Imagen Incidente</th>
                        </tr>
                        <tr>
                           <td colspan="2" style="text-align: center;">
    <img src="https://grupocoronador.com/conn/<?= $incident['ubi'] ?>" style="max-width: 400px; max-height: 400px; display: inline-block;">
</td>

                        </tr>
                        <tr>
                             <th colspan="2" class="text-center">Ubicacion</th>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="map" style="width: 100%; height: 300px;"></div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </table>
            </div>
        </div>
    </main>
</body>
</html>
