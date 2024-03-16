<?php

  $alert = ''; 

  session_start();

  if(!empty($_SESSION['active']))
  {
    header('location: sistema/');
  }else{

  if(!empty($_POST))
  {
    
    if(empty($_POST['usuario']) || empty($_POST['clave']))
    {
      $alert = 'Ingrese su Usuario y Clave';
    }else{

      require_once "conexion.php";

      $user = mysqli_real_escape_string($conection,$_POST['usuario']);
      $pass = md5(mysqli_real_escape_string($conection,$_POST['clave']));

      $query = mysqli_query($conection, "SELECT * FROM usuario WHERE usuario= '$user' AND clave= '$pass'");
      mysqli_close($conection);
      $result = mysqli_num_rows($query);

      if($result > 0)
      {
        $data = mysqli_fetch_array($query);
        
        $_SESSION['active'] = true;
        $_SESSION['idUser'] = $data['idusuario'];
        $_SESSION['nombre'] = $data['nombre'];
        $_SESSION['email'] = $data['correo'];
        $_SESSION['user'] = $data['usuario'];
        $_SESSION['rol'] = $data['rol'];

        header('location: sistema/');        
      }else{
        $alert = 'El usuario o la clave son incorrectos';
        session_destroy();
      }
    }

  }
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>StockFlow</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="path/to/sweetalert2.min.css">
    <script src="sistema/js/olvido_usuario.js"></script>
  </head>
  <body>
    <section id="container">
      <div id="login">
          <h1>Login</h1>
          <form class="" action="" method="post">
            <!--<h3>Iniciar Sesión</h3>-->
            <!--<img src="img/Login.png" alt="Login">-->
            <div class="campos">
              <input type="text" name="usuario" placeholder="Usuario">          
              <input type="password" name="clave" placeholder="Contraseña">
            </div>
            <div class="recupero">
              <p><a href="#" id="miEnlace">Olvidaste tu Usuario</a></p>
              <p><a href="#">Olvidaste tu Contraseña</a></p>
            </div>
            <div class="alert"><?php echo isset($alert) ? $alert: ' '; ?></div>
            <input type="submit" value="INGRESAR">
          </form> 
        </div>   
    </section>
    <script src="path/to/sweetalert2.min.js"></script>
  </body>
</html>
