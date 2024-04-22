<?php
    include "../app/categoryController.php";
    $categoryController = new categoryController();
    $users = $categoryController->getUser($_GET['id']);
   
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
        <link rel="StyleSheet" href= "../CSS/colorFullUsersEdit.css?v=0.0.2" />
        <link rel="StyleSheet" href= "../CSS/uploadCSS.css?v=0.0.2" />
        <meta http-equiv="Last-Modified" content="0">
        <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
        <meta http-equiv="Pragma" content="no-cache">
        <title>Editar Usuarios</title>
       <script src="../app/jquery-3.5.1.min.js"></script>
        <script>
            $(function(){
              $("#header").load("menu.php"); 
            });
        </script> 
    </head>
    

    <body>

        <header id="header"></header>
        <!-- Formulario 1: Usuarios -->
       <main class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="mainContainer">
        <h1 class="text-center mb-4">Creación de Usuario</h1>
        <form action="../app/categoryController.php" method="POST" id="add_form" enctype="multipart/form-data">
            <?php foreach ($users as $user): ?>
                <div class="mb-3">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $user['nombre'] ?>" required> 
                    <input type="hidden" class="form-control" id="id" name="id" value="<?= $user['id'] ?>" >
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?=$user['apellido']?>" required>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" id="mac" name="mac" placeholder="M.A.C. (En caso de ser Vendedor)" value="<?=$user['mac_impresora']?>" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" id="rol" name="rol">
                            <?php if ($_SESSION['rol'] === 'Admin'): ?>
                            <option value="Administrador">Administrador</option>
                        <?php endif; ?>
                        <option value="Vendedor" <?php echo ($user['rol'] === 'Vendedor') ? 'selected' : ''; ?>>Vendedor</option>
                        <option value="Encargado" <?php echo ($user['rol'] === 'Encargado') ? 'selected' : ''; ?>>Encargado</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Subir</button>
                <input type="hidden" name="action" value="updateUser">
            <?php endforeach; ?>
        </form>
    </div>
</main>

        <div id="pagination" class="pagination"></div>
        
    </body>
</html>