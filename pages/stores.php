<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $users = $categoryController->getLocations();
    /*if(isset($_SESSION)==false  || $_SESSION['id']==false){
        header("Location:../");
    }*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <meta http-equiv="Expires" content="0">
    <link rel="StyleSheet" href= "../CSS/colorFullUsers.css?v=0.0.2" />
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <title>Tiendas</title>
   <script src="../app/jquery-3.5.1.min.js"></script>
    <script>
        $(function(){
            $("#header").load("menu.php"); 
        });
    </script> 
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCek2wbl-E5DjBL9AtoM2J6RL209xmGj30&callback=initMap" async defer></script>
     <script>
       
    function initMap() {
        // Array de ubicaciones de ejemplo
        //getStores();
        //console.log(stores);
        var locations=<?php echo json_encode($users); ?> ;
        parseFloat(locations[0].lat);
        for (var i=0; i<locations.length;i++) {
            locations[i].lat=parseFloat(locations[i].lat);
            locations[i].lng=parseFloat(locations[i].lng);
        }
        // Crea un nuevo mapa y centra en la primera ubicación si hay al menos una ubicación
        if (locations.length > 0) {
            var map = new google.maps.Map(document.getElementById('map'), {
                center: locations[0],
                zoom: 12
            });

            // Agrega marcadores e infoWindows para cada ubicación en el array
            for (var i = 0; i < locations.length; i++) {
                addMarker(locations[i], map,locations[i].id_tienda);
            }
        }

        function addMarker(location, map,id) {
            var marker = new google.maps.Marker({
                position: location,
                map: map,
                title: 'Ubicación ' + (i + 1)
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



</head>

<body>
    <header id="header"></header>
    <!-- Formulario 1: Usuarios -->
    <main class="container d-flex align-items-center justify-content-center">
        <div class="mainContainer">
            <p class="">Tiendas Existentes</p>
            <ul class="ulMain item-list">
                <li> 
                    <div id="map" style="width: 500px; height: 400px;"></div>
                </li>        
                <!-- Agrega más elementos del formulario según sea necesario -->
            </ul>
        </div>
    </main>
</body>
</html>
