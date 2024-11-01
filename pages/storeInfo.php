<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $users = $categoryController->getStoresInfo($_GET['id']);
    $sells = $categoryController->getStockPieces($_GET['id']);
    $subUs = $categoryController->getUsersControl($_SESSION['id']);
    if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }
    //echo $_SESSION['info'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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

        function generateBarcode(code) {
            JsBarcode("#barcode", code); 
        }

        window.onload = function() {
            var locations = <?php echo json_encode($users); ?>;
            for (var i = 0; i < locations.length; i++) {
                generateBarcode(locations[i].id_tienda);
            }
        };

        function initMap() {
    var locations = <?php echo json_encode($users); ?>;
    var lat = parseFloat(locations[0]?.lat);
    var lng = parseFloat(locations[0]?.lng);

    // Función para crear el mapa y marcador en una ubicación específica
    function setupMap(location) {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: location,
            zoom: 15
        });

        var marker = new google.maps.Marker({
            position: location,
            map: map,
            title: 'Ubicación',
            draggable: true 
        });

        document.getElementById('lat').value = location.lat;
        document.getElementById('lng').value = location.lng;

        google.maps.event.addListener(marker, 'dragend', function() {
            var lat = marker.getPosition().lat();
            var lng = marker.getPosition().lng();
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;
        });
    }

    // Verificar si las coordenadas son válidas; si no, obtener la ubicación actual del dispositivo
    if (!isNaN(lat) && !isNaN(lng)) {
        setupMap({lat: lat, lng: lng});
    } else {
        console.error("Coordenadas inválidas: lat o lng es NaN.");
        alert("Error: Coordenadas inválidas. Usando ubicación actual del dispositivo.");

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                var currentLocation = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };
                setupMap(currentLocation);
            }, function(error) {
                alert("No se pudo obtener la ubicación actual: " + error.message);
            });
        } else {
            alert("Geolocalización no soportada por este navegador.");
        }
    }
}



        function printl(){
            var sub = <?php echo json_encode($users); ?>;
            if(sub!=""){
                sessionStorage.setItem("code", sub[0].id_tienda);
                window.open("ticket.html", "_blank");
            } else {
                alert("Debe de haber datos cargados");
            }
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCek2wbl-E5DjBL9AtoM2J6RL209xmGj30&callback=initMap" ></script>
</head>
<body>
    <header id="header"></header>
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
                        <input type="hidden" name="id" value="<?= $user['id_tienda'] ?>">
                        <tr><th>Nombre</th><td><input type="text" name="nombre" value="<?= $user['nombre'] ?>"></td></tr>
                        <tr><th>Nombre Responsable</th><td><input type="text" name="nombre_responsable" value="<?= $user['nombre_responsable'] ?>"></td></tr>
                        <tr><th>Dirección</th><td><input type="text" name="direccion" value="<?= $user['direccion'] ?>"></td></tr>
                        <tr><th>Correo</th><td><input type="text" name="correo" value="<?= $user['correo'] ?>"></td></tr>
                        <tr><th>RFC</th><td><input type="text" name="RFC" value="<?= $user['RFC'] ?>"></td></tr>
                        <tr><th>Teléfono</th><td><input type="text" name="telefono" value="<?= $user['telefono'] ?>"></td></tr>
                        <tr><th>Fecha Creación</th><td><?= $user['fecha_creacion'] ?></td></tr>
                        <tr><th>Fecha Última Visita</th><td><?= $user['fecha_ultima_visita'] ?></td></tr>
                        <tr>
    <th>Vendedor</th>
    <td>
        <select name="vendedor">
            <?php 
            $vendedorActualPresente = false;
            foreach ($subUs as $subU): 
                if ($subU['id'] == $user['vendedor']) {
                    $vendedorActualPresente = true;
                }
            ?>
                <option value="<?= htmlspecialchars($subU['id']) ?>" <?= $subU['id'] == $user['vendedor'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($subU['id'] . ' - ' . $subU['nombre']) ?>
                </option>
            <?php endforeach; ?>

            <?php if (!$vendedorActualPresente): ?>
                <option value="<?= htmlspecialchars($user['vendedor']) ?>" selected>
                    <?= htmlspecialchars($user['vendedor'] . ' - ' . $user['vendedor']) ?>
                </option>
            <?php endif; ?>
        </select>
    </td>
</tr>

                        <tr><th>Precio</th><td><input type="text" name="precio" value="<?= $user['precio'] ?>"></td></tr>
                        <tr><th>Codigo</th><td><canvas id="barcode" onclick="printl();"></canvas></td></tr>
                        <tr><th colspan="2" class="text-center">Inventario Inicial</th></tr>
                        <tr>
                            <th colspan="2" class="text-center">
                                <table class="table">
                                    <thead><tr><th>Producto</th><th>Cantidad</th></tr></thead>
                                    <tbody>
                                        <?php 
                                        $total = 0;
                                        foreach ($sells as $sell): 
                                            $total += $sell['cantidad_piezas'];
                                        ?>
                                        <tr><td><?= $sell['nombre'] ?></td><td><?= $sell['cantidad_piezas'] ?></td></tr>
                                        <?php endforeach ?>
                                        <tr><td>Total</td><td><?= $total ?></td></tr>
                                    </tbody>
                                </table>
                            </th>
                        </tr>
                        <tr><th colspan="2" class="text-center">Imagen Tienda</th></tr>
                        <tr><td colspan="2" class="text-center"><img src="https://grupocoronador.com/conn/<?= $user['ubicacion_imagen'] ?>" style="max-width: 400px; max-height: 400px; display: inline-block;"></td></tr> 
                        <tr><th colspan="2" class="text-center">Ubicacion</th></tr>
                        <?php endforeach ?>
                        <tr>
                            <td colspan="2"><div id="map" style="width: 100%; height: 400px;"></div></td>
                        </tr>
                        <input type="hidden" id="lat" name="lat" value="">
                        <input type="hidden" id="lng" name="lng" value="">
                        <input type="hidden" name="action" value="editStore">
                    </table>
                </div>
            </div>
        </form>
    </main>
</body>
</html>
