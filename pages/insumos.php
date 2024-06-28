<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $insumos = $categoryController->getInsumos();
   
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
        <title>Inventarios</title>
        <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
                $("#header").load("menu.php"); 
            });

            function mostrarFormulario() {
                var dialog = document.getElementById("dialogoModificar");
                dialog.showModal();
            }

            function cerrarFormulario() {
                var dialog = document.getElementById("dialogoModificar");
                dialog.close();
            }
        </script> 
    </head>
    
    <body>
        <header id="header"></header>
        <!-- Formulario 1: Usuarios -->
        <main class="container d-flex align-items-center justify-content-center">
            <div class="mainContainer">
                <p class="">Insumos Existentes <button onclick="mostrarFormulario()">Modificar</button></p>
                <ul class="ulMain item-list">
                   <table class="default">
    <tr>
        <td></td>
        <td>Victor</td>
        <td>Ivan</td>
        <td>Ivan</td>
        <td>Manufactura</td>
    </tr>
    <tr>
        <td>Cable Tipo C</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cable V8</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cable iPhone</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cable Tipo C a Tipo C</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cable Tipo C a iPhone</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Audifonos</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cargador de Carro USB</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cargador de Casa USB</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cargador de Carro Tipo C</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cargador de Casa Tipo C</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Exhibidores</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>Cargador de casa doble</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
</table>

                </ul>
                <dialog id="dialogoModificar">
                    <form>
                        <div class="mb-3">
                            <label for="producto" class="form-label">Producto</label>
                            <select id="producto" class="form-select">
                                <option value="tipo_c">Tipo C</option>
                                <option value="cable">Cable</option>
                                <option value="blister_tipo_c">Blister Tipo C</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="cantidad" class="form-label">Cantidad a mover</label>
                            <input type="number" class="form-control" id="cantidad">
                        </div>
                        <div class="mb-3">
                            <label for="de" class="form-label">De</label>
                            <select id="de" class="form-select">
                                <option value="victor">Victor</option>
                                <option value="ivan">Ivan</option>
                                <option value="chinos">Chinos</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="a" class="form-label">A</label>
                            <select id="a" class="form-select">
                                <option value="victor">Victor</option>
                                <option value="ivan">Ivan</option>
                                <option value="chinos">Chinos</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-secondary" onclick="cerrarFormulario()">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Mover</button>
                    </form>
                </dialog>
            </div>
        </main>
    </body>
</html>
