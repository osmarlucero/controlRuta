<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>Menu</title>
            <link rel="StyleSheet" href= "../CSS/menu.css?v=0.0.2" />

     <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <script type="text/javascript">
          function displayLock(){
            document.getElementById("remover").classList.remove("d-none");
            document.getElementById("remover").classList.add("d-block");
          }
          function displayUnlock(){
            document.getElementById("remover").classList.remove("d-flex");
            document.getElementById("remover").classList.add("d-none");//document.getElementById("demo").style.color = "red";
          }
          function displayLock_(){
            document.getElementById("remover_").classList.remove("d-none");
            document.getElementById("remover_").classList.add("d-block");
          }
          function displayUnlock_(){
            document.getElementById("remover_").classList.remove("d-flex");
            document.getElementById("remover_").classList.add("d-none");//document.getElementById("demo").style.color = "red";
          }
        </script>
</head>
<body>
  <header id="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
              <div class="container-fluid">
                <a class="navbar-brand" href="#">POST</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="main.php">Inicio</a>
                    </li>
                    <li onmouseover="displayLock_()" onmouseout="displayUnlock_()"class="nav-item ">
                      <a  class="nav-link">Insumos</a>
                      <ul id="remover_" class="position-fixed d-none list-unstyled">
                        <li class="nav-item bg-light">
                            <a class="nav-link"  href="insumos.php">Existencias</a>
                        </li>
                        <li class="nav-item bg-light">
                            <a class="nav-link d-none"  href="setProducInfo.php">Categorias</a>
                        </li>
                        <li class="nav-item bg-light">
                            <a class="nav-link"  href="upload.php">Subir Producto</a>
                        </li>
                      </ul>
                    </li>
                    <li class="nav-item">
                      <form action="../app/reportController.php" method="POST">
                          <input type="hidden" name="action" value="logout">
                          <button type="submit" id="logout" class="pt-2 font_style font_color">Cerrar Sesion
                          </button>
                      </form>
                    </li>
                  </ul>                  
                </div>
              </div>
            </nav>
    </header>
  
</body>           
</html>