<!DOCTYPE html>
<html lang="en">
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <link rel="StyleSheet" href= "CSS/indexCSS.css?v=0.0.2" />
     <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="shortcut icon" href="Imagenes/Blockbuster_logo.svg.png" />
     <meta charset="UTF-8">
     <meta http-equiv =»Cache-Control» content =»no-cache»/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="app/jquery-3.5.1.min.js"></script>
</head>
<body>
    <div id="logo_location">
        <div id="logo_inner">
             <!--<img src="Imagenes/yosi.png" id="image_logo"> -->
        </div>
    </div>
    <div id="container">
        <!-- Inicio primer container-->
        <div id="main">
            <form action="app/reportController.php" method="POST">
                <div id="list_container">
                    <div class="title">
                        <h2> Iniciar Sesion.</h2>
                    </div>
                    <ul>
                        <li><input type="text" name="user"placeholder="User" id="user" required></li>
                        <li><input type="password" name="passLog" placeholder="Password" id="passs" required></li>
                    </ul>
                    <div id="button_container">
                        
                        <input type="hidden" name="action" value="login">
                        
                        <!--<a href="Pages/start_page.php?name=Inicio" class="font_style style_login button_style">
                                Iniciar Sesion
                        </a> -->
                       <center> 

                            <button type="submit" class="col-5  text-center btn btn-outline-primary">
                                Iniciar Sesion
                            </button>
                            <a href="pages/main.php">ENTRAR</a>
                        </center>
                    </div>
                </div>
            </form>
           
        </div>
    </div>
</body>                     
</html>