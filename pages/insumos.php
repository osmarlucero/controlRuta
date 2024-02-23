<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $insumos = $categoryController->getInsumos();
   
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
        <link rel="StyleSheet" href= "../CSS/colorFullCrateInsumos.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Inventarios</title>
       <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
              $("#header").load("menu.php"); 
            });
        </script> 
        <script>
            function mostrarAlerta(id) {
                // Obtener el radio button seleccionado
                var radioSeleccionado = document.querySelector('input[name="miCheckbox"]:checked');

                if (radioSeleccionado) {
                    // Obtener el valor del radio button seleccionado
                    var valorRadio = radioSeleccionado.value;
                    // Puedes agregar más lógica aquí según sea necesario
                }else {
                    alert("Selecciona un radio button antes de hacer clic en Añadir");
                }
                if(id!=valorRadio){                
                    var cantidad = prompt("Cantidad Que deseas añadir");
                    // Mostrar la alerta con los datos del formulario
                    if (id!="12") {
                        var rute ="id="+id+"&action=updateStock&idDon="+radioSeleccionado+"&cantidad="+cantidad;
                        $.ajax({
                            url:"../app/categoryController.php",
                            type: 'POST',
                            dataType: 'html',
                            data: rute,
                        })
                        .done(function(respuesta){
                            //$("#bodyT").html(respuesta);
                            if(respuesta.length>0){
                                products= JSON.parse(respuesta);
                                agregarFilaMethod();
                            }
                            else
                                alert("No hay producto existente con ese codigo")
                        })
                        .fail(function(){
                            console.log("ERROR");
                        })
                        .always(function(){
                            console.log("complete");
                        });
                    }else
                        alert("Ingresa Parametros");
                    }else
                        alert("No puedes agregarle a el mismo articulo");

            }
        </script>
    </head>
    

    <body>

        <header id="header"></header>
        <!-- Formulario 1: Usuarios -->
        <main class="container d-flex align-items-center justify-content-center">
            <div class="mainContainer">
                <p class="">Insumos Existentes</p>
                <ul class="ulMain item-list">
                   <table class="default">
                        <tr>
                            <td>Nombre</td>
                            <td>Estatus</td>
                            <td>Responsable</td>
                            <td>Stock</td>
                            <td>Opciones</td>
                        </tr>
                        <?php foreach ($insumos as $insumo): ?>
                        <tr>
                            <td><input type="radio" id="miCheck"value="<?= $insumo['id'] ?>" name="miCheckbox"><?= $insumo['nombre'] ?></td>
                            <td><?= $insumo['estatus'] ?></td>
                            <td><?= $insumo['responsable'] ?></td>
                            <td><?= $insumo['stock'] ?></td>
                            <td onclick="mostrarAlerta(<?= $insumo['id'] ?>)">Añadir</td>
                        </tr>
                        <?php endforeach ?>

                    </table>
                    <!-- Agrega más elementos del formulario según sea necesario -->
                </ul>
            </div>
        </main>
       
        
    </body>
</html>