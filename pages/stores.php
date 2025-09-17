<?php
include "../app/categoryController.php";
$categoryController = new categoryController();
$users = $categoryController->getLocations();
$locationsMap = $categoryController->getLocationsMap();
if (isset($_SESSION) == false || $_SESSION['id'] == false) {
    header("Location:../");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tiendas</title>
    <link rel="stylesheet" href="../CSS/colorFullUsers.css?v=0.0.2" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
      crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" 
        crossorigin="anonymous"></script>
    <script src="../app/jquery-3.5.1.min.js"></script>

    <script>
        $(function () {
            $("#header").load("menu.php");
        });

        var markers = []; // Guardaremos todos los marcadores aquí
        var map; // Referencia global al mapa

        function remvMap() {
            var mainContainer = document.getElementById('mainContainer');
            var mapContainer = document.getElementById('map');
            mainContainer.classList.add('d-flex');
            mainContainer.classList.remove('d-none');
            mapContainer.classList.remove('d-flex');
            mapContainer.classList.add('d-none');
        }

        function remvList() {
            var mainContainer = document.getElementById('mainContainer');
            var mapContainer = document.getElementById('map');
            mapContainer.classList.add('d-flex');
            mapContainer.classList.remove('d-none');
            mainContainer.classList.remove('d-flex');
            mainContainer.classList.add('d-none');
        }

        function initMap() {
            var locations = <?php echo json_encode($locationsMap); ?>;
            console.log(locations);

            for (var i = 0; i < locations.length; i++) {
                locations[i].lat = parseFloat(locations[i].lat);
                locations[i].lng = parseFloat(locations[i].lng);
            }

            if (locations.length > 0) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: locations[0],
                    zoom: 10
                });

                for (var i = 0; i < locations.length; i++) {
                    addMarker(locations[i], map, locations[i].id_tienda);
                }

                // 👉 Agregar botón de contar tiendas visibles
                var controlDiv = document.createElement('div');
                var controlUI = document.createElement('button');
                controlUI.className = "btn btn-primary m-2";
                controlUI.innerText = "Contar tiendas visibles";
                controlUI.addEventListener("click", function() {
                    countVisibleStores(map);
                });
                controlDiv.appendChild(controlUI);
                map.controls[google.maps.ControlPosition.TOP_CENTER].push(controlDiv);
            }
        }

        function addMarker(location, map, id) {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Ubicación'
            });

            markers.push(marker); // 👉 Guardamos cada marcador en el array global

            var link = '<a href="storeInfo.php?id=' + id + '">Informacion de tienda</a>';

            var infoWindow = new google.maps.InfoWindow({
                content: location.nombre + '<br>' + link
            });

            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });
        }

        // 👉 Función que cuenta las tiendas visibles en el área del mapa
        function countVisibleStores(map) {
            var bounds = map.getBounds();
            var count = 0;

            markers.forEach(function(marker) {
                if (bounds.contains(marker.getPosition())) {
                    count++;
                }
            });

            alert("Tiendas visibles en el área: " + count);
        }

        // Función para buscar en la lista
        function searchStores() {
            var input = document.getElementById('searchInput').value.toLowerCase();
            var itemList = document.querySelectorAll('.item-list li');

            itemList.forEach(function (item) {
                var text = item.textContent.toLowerCase();
                item.style.display = text.includes(input) ? 'block' : 'none';
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCMjCL0xIOHXoLDH4cahfqQPUlc9dF9Z24&callback=initMap"></script>
</head>

<body>
    <header id="header"></header>

    <main class="container mt-5">
        <div class="mainContainer">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-0">Tiendas Existentes</h2>
                <a href="main.php" class="btn btn-secondary">Regresar</a>
            </div>
            <div class="">
                <p onclick="remvMap()" class="btn btn-success">Listado</p>
                <p onclick="remvList()" class="btn btn-success">Mapa</p>
                <input type="text" id="searchInput" placeholder="Buscar tienda..." onkeyup="searchStores()" class="form-control d-inline-block" style="width: auto; display: inline-block; margin-left: 10px;">
            </div>
            <div style="width: 100%;">
                <div id="mainContainer">
                    <ul class="ulMain item-list">
                        <?php foreach ($users as $user): ?>
                        <li><?= $user['id_tienda'] ?> | <?= $user['nombre'] ?> || <?= $user['nombre_responsable'] ?> || Numero Telefono: <?= $user['telefono'] ?>
                            <a href="storeInfo.php?id=<?= $user['id_tienda'] ?>">Ver</a>
                        </li>
                        <?php endforeach ?>
                    </ul>
                </div>
            </div>
            <div id="map" style="width: 100%; height: 400px;" class="d-none"></div>
        </div>
    </main>
</body>

</html>
