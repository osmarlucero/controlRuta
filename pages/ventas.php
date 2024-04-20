<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $insumos = $categoryController->getVentas();
    $cantidades = $categoryController->getStats();
   
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
    <link rel="StyleSheet" href="../CSS/colorFullUsers.css?v=0.0.2" />
    <link rel="StyleSheet" href="../CSS/colorFullCrateInsumos.css?v=0.0.2" />
    <meta http-equiv="Last-Modified" content="0">
    <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
    <meta http-equiv="Pragma" content="no-cache">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<!-- Tu script personalizado aquí -->


    <title>Ventas</title>
    <script>
        $(function(){
          $("#header").load("menu.php"); 
          $(document).ready(function() {
            $("#mostrarModal").click(function() {
            $('#reportModal').modal('show');
           
          });
        document.getElementById('generate').addEventListener('click', function() {
        const productoInput = 15;//document.getElementById('productoInput').value;
        const xhr = new XMLHttpRequest();
        const url = '../app/categoryController.php';
        const params = 'action=getSellsDate&dateStart=2024-04-12&dateEnd=2024-04-19&userM=4141';

        xhr.open('POST', url, true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Obtener la respuesta como un objeto JSON
                const responseData = JSON.parse(xhr.responseText);
                
                // Convertir el objeto JSON a una matriz
                const dataArray = responseData.map(item => [
                    item.nombre_articulo,
                    item.nombre_tienda,
                    item.cantidad_total
                ]);
                
                // Mostrar la matriz en la consola
                console.log(dataArray);
            }
        };
        xhr.send(params);
    });
});
        });  
    </script> 
    <script type="text/javascript">
        var cant = <?php echo json_encode($cantidades); ?>;
        console.log(cant);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const itemsPerPage = 5;
        const itemList = document.querySelector('#salesTable'); // Modifica el selector para apuntar al ID de la tabla
        const paginationContainer = document.getElementById('pagination');

        const totalItems = itemList.rows.length - 1; // Resta 1 para excluir la fila de encabezados
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
            const endIndex = Math.min(startIndex + itemsPerPage, totalItems); // Asegúrate de no exceder el número total de ítems

            for (let i = 1; i <= totalItems; i++) {
                if (i > startIndex && i <= endIndex) {
                    itemList.rows[i].style.display = 'table-row';
                } else {
                    itemList.rows[i].style.display = 'none';
                }
            }
        }

        // Mostrar la primera página al cargar la página
        showPage(1);
    });
    function onRemove(){
        // Obtén una referencia al elemento
        var elemento = document.getElementById("tableItems");
        var elementoSt = document.getElementById("lista-ventas");
        // Remueve la clase
        elemento.classList.remove("d-flex");
        elementoSt.classList.add("d-flex");
         setTimeout(function() {
                elemento.classList.add("d-none");
                elementoSt.classList.remove("hiding");
            }, 200); // El tiempo debe coincidir con la duración de la transición CSS
       
    }
    function onAdd(){
        // Obtén una referencia al elemento
        var elemento = document.getElementById("tableItems");
        var elementoSt = document.getElementById("lista-ventas");
        // Remueve la clase
        elemento.classList.remove("d-none");
        elementoSt.classList.add("d-none");
        setTimeout(function() {
                elemento.classList.add("hiding");
                elementoSt.classList.remove("d-flex");
            }, 200); // El tiempo debe coincidir con la duración de la transición CSS
    }
    </script>
    <!-- Incluir la biblioteca xlsx -->

   <script>
      
        function generar(datos, nombreArchivo) {
            // Crear un nuevo libro de Excel
            const wb = XLSX.utils.book_new();

            // Crear una nueva hoja con los datos
            const ws = XLSX.utils.aoa_to_sheet(datos);

            // Agregar la hoja al libro
            XLSX.utils.book_append_sheet(wb, ws, "Hoja1");

            // Generar el archivo Excel
            XLSX.writeFile(wb, nombreArchivo + ".xlsx");
        }
</script>


     <style>
        .nav-item {
            cursor: pointer;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-right: 10px;
        }
        .btn-p{
            background-color: #000000;
            color: white;
        }
        #lista-ventas{
            margin-top: 5%;
        }
    </style>
</head>
<body>

    
    <header id="header"></header>
    <!-- -->
    <!-- Modal -->
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="reportModalLabel">Generar Reporte XLS</h5>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="startDate" class="form-label">Ingresa Fecha Inicio:</label>
            <input type="date" class="form-control" id="startDate" required>
        </div>
        <div class="mb-3">
            <label for="endDate" class="form-label">Ingresa Fecha Final:</label>
            <input type="date" class="form-control" id="endDate" required>
        </div>
        <div class="mb-3">
            <label for="responsable" class="form-label">Ingresa Responsable:</label>
            <input type="number" class="form-control" id="responsable" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="generate" >Generar XLS</button>
      </div>
    </div>
  </div>
</div>

    <!-- -->
    <!-- Formulario 1: Usuarios -->
    <main class="container d-flex align-items-center justify-content-center">
        <div class="mainContainer">
            <ul class="nav">
                <li class="nav-item btn-p" onclick="onAdd()">Ventas Realizadas</li>
                <li class="nav-item btn-p" onclick="onRemove()">Estadisticas</li>
                <button type="button" class="btn btn-primary" id="mostrarModal">Generar Reporte</button>

            </ul>
            <ul id="tableItems" class="ulMain item-list">
               <table id="salesTable" class="default">
                    <tr>
                        <td>No De Venta</td>
                        <td>Fecha De Venta</td>
                        <td>Cliente</td>
                        <td>Tipo De Venta</td>
                        <td>Cantidad De Piezas</td>
                        <td>Total Venta</td>
                        <td>Forma De Pago</td>
                    </tr>
                    <?php foreach ($insumos as $insumo): ?>
                    <tr>
                        <td><a href="detalleVenta.php?id=<?= $insumo['venta_id'] ?>" class="btn btn-success"><?= $insumo['venta_id'] ?></a></td>
                        <td><?= $insumo['fecha_venta'] ?></td>
                        <td><?= $insumo['nombre_tienda'] ?></td>
                        <td><?= $insumo['tipo_venta'] ?></td>
                        <td><?= $insumo['cantidad_piezas'] ?></td>
                        <td><?= $insumo['total_venta'] ?></td>
                        <td><?= $insumo['forma_de_pago'] ?></td>
                    </tr>
                    <?php endforeach ?>


                </table>
                <!-- Agrega más elementos del formulario según sea necesario -->
            </ul>
             <ul id="lista-ventas" class="d-none" style="background-color: white;"><canvas id="grafico-ventas" width="400" height="200"></canvas></ul>
             <script>
    // Datos de ejemplo para las ventas
    const datosVentas = <?php echo json_encode($cantidades); ?>;

    // Obtener los nombres y ventas de los productos
    const nombresProductos = datosVentas.map(producto => producto.nombre);
    const ventasProductos = datosVentas.map(producto => producto.ventas);

    // Generar una paleta de colores aleatorios
    const paletaColores = [];
    for (let i = 0; i < nombresProductos.length; i++) {
        const color = getRandomColor();
        paletaColores.push(color);
    }

    // Crear el gráfico
    const ctx = document.getElementById('grafico-ventas').getContext('2d');
const chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: nombresProductos,
        datasets: [{
            label: 'Ventas',
            data: ventasProductos,
            backgroundColor: '#3498db', // Cambiar el color de fondo a rojo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1,
            datalabels: {
                anchor: 'end',
                align: 'top'
            }
        }]
    },
    options: {
        plugins: {
            datalabels: {
                formatter: function(value, context) {
                    return value;
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

    // Función para obtener un color aleatorio
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
</script>
        </div>
    </main>
   <div id="pagination" class="pagination"></div>
 

<script>

</script>


</body>
</html>
