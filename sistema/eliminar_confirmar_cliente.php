<?php
    session_start();
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
    {
        header("location: ./");
    }

    include '../conexion.php';

    if(!empty($_POST))
    {
        if(empty($_POST['idcliente']))
        {
            header('location: lista_clientes.php');
            mysqli_close($conection);
        }
  
        $idcliente = $_POST['idcliente'];

        // $query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");

        $query_delete = mysqli_query($conection, "UPDATE cliente SET estatus = 0 WHERE idcliente = $idcliente");
        mysqli_close($conection);
        if($query_delete)
        {
            header('location: lista_clientes.php');
        }else{
            echo "Error al Eliminar";
        }
    }




    if(empty($_REQUEST['id']))
    {
        header('location: lista_clientes.php');
        mysqli_close($conection);
    }else{

        

        $idcliente = $_REQUEST['id'];

        $query = mysqli_query($conection, "SELECT * FROM cliente
                                            WHERE idcliente = $idcliente");

        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if($result > 0)
        {
            while($data = mysqli_fetch_array($query)) 
            {
                $dni = $data['dni'];
                $nombre = $data['nombre'];
                $telefono = $data['telefono'];
                $correo = $data['correo'];
                $direccion = $data['direccion'];
            }
        }else{
            header('location: lista_clientes.php');
        }
    }





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Eliminar Cliente</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="data_delete">
            <i class="fas fa-user-times fa-7x" style="color: #e66062; margin-left: 50px;"></i>
            <br><br>
            <h2>Está Seguro de Eliminar el Cliente?</h2>
            <p>DNI: <span><?php echo $dni; ?></span></p>
            <p>Nombre: <span><?php echo $nombre; ?></span></p>
            <p>Telefono: <span><?php echo $telefono; ?></span></p>
            <p>Email: <span><?php echo $correo; ?></span></p>
            <p>Direccion: <span><?php echo $direccion; ?></span></p>

            <form action="" method="post">
                <input type="hidden" name="idcliente" value="<?php echo $idcliente; ?> ">
                <a href="lista_clientes.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Eliminar" class="btn_ok">
            </form>
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>