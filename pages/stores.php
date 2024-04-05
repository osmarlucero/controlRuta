    <?php
        include "../app/categoryController.php";
        $categoryController = new categoryController();
        $users = $categoryController->getLocations();
        /*if(isset($_SESSION)==false  || $_SESSION['id']==false){
            header("Location:../");
        }*/
    ?>
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Tiendas</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous">
        <link rel="stylesheet" href="../CSS/colorFullUsers.css?v=0.0.2" />
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCek2wbl-E5DjBL9AtoM2J6RL209xmGj30&callback=initMap" async defer></script>
        <script src="../app/jquery-3.5.1.min.js"></script>
        <!-- JavaScript y Bootstrap Bundle con Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-eESmnR9on8Kc6G5jFK7M/n6Ux1xZeF+41iQZ10W9ROx5u6IcaRRiEu6VxlUww9D"
            crossorigin="anonymous"></script>
        <script>
            $(function () {
                $("#header").load("menu.php");
            });
        </script>
        <script type="text/javascript">
            function remvMap(){
                var mainContainer = document.getElementById('mainContainer');
                var mapContainer = document.getElementById('map');
                mainContainer.classList.add('d-flex');
                mainContainer.classList.remove('d-none');
                mapContainer.classList.remove('d-flex');
                mapContainer.classList.add('d-none');
            }
            function remvList(){
                var mainContainer = document.getElementById('mainContainer');
                var mapContainer = document.getElementById('map');
                mapContainer.classList.add('d-flex');
                mapContainer.classList.remove('d-none');
                mainContainer.classList.remove('d-flex');
                mainContainer.classList.add('d-none');
            }
        </script>
        <script>
            function initMap() {
                // Array de ubicaciones de ejemplo
                //getStores();
                var locations = <?php echo json_encode($users); ?>;
                console.log(locations);

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
                    var link = '<a href="storeInfo.php?id=' + id + '">Informacion de tienda</a>';

                    var infoWindow = new google.maps.InfoWindow({
                        content: location.nombre + '<br>' + link
                    });

                    marker.addListener('click', function () {
                        infoWindow.open(map, marker);
                    });
                }
            }
        </script>
        <script>        
            document.addEventListener('DOMContentLoaded', function () {
                const itemsPerPage = 10;
                const itemList = document.querySelector('.item-list');
                const paginationContainer = document.getElementById('pagination');

                const totalItems = itemList.children.length;
                const totalPages = Math.ceil(totalItems / itemsPerPage);

                // Generar botones de paginación
                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('li');
                    pageButton.textContent = i;
                    pageButton.addEventListener('click', function () {
                        showPage(i);
                    });
                    paginationContainer.appendChild(pageButton);
                }

                // Función para mostrar la página seleccionada
                function showPage(pageNumber) {
                    const startIndex = (pageNumber - 1) * itemsPerPage;
                    const endIndex = startIndex + itemsPerPage;

                    for (let i = 0; i < totalItems; i++) {
                        itemList.children[i].style.display = (i >= startIndex && i < endIndex) ? 'block' : 'none';
                    }
                }

                // Mostrar la primera página al cargar la página
                showPage(1);
                });
            </script>
    </head>

    <body>
        <header id="header"></header>

        <main class="container mt-5">
            <div class="mainContainer">
                <h2 class="mb-4">Tiendas Existentes</h2>
                <div class="">
                    <p onclick="remvMap()" class="btn btn-success">Listado</p>
                    <p onclick="remvList()" class="btn btn-success">Mapa</p>
                </div>
                <div style="width: 100%;">
                    <div id="mainContainer">
                    <ul class="ulMain item-list">
                        <?php foreach ($users as $user): ?>
                        <li><?= $user['id_tienda'] ?> | <?= $user['nombre'] ?> || <?= $user['nombre_responsable'] ?> || Rol:<?= $user['telefono'] ?>
                       <a href="storeInfo.php?id=<?= $user['id_tienda'] ?>">Ver</a>                       
                        </li>        
                        <?php endforeach ?>
                        <!-- Agrega más elementos del formulario según sea necesario -->
                    </ul>
                </div>

                </div>
                <div id="map" style="width: 100%; height: 400px;" class="d-none"></div>
            </div>
        </main>
    <div id="pagination" class="pagination"></div>
    </body>

    </html>
