<?php
    session_start();
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
    {
        header("location: ./");
    }

    include '../conexion.php';

    if(!empty($_POST))
    {
        if(empty($_POST['idproveedor']))
        {
            header('location: lista_proveedor.php');
            mysqli_close($conection);
        }
  
        $idproveedor = $_POST['idproveedor'];

        // $query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");

        $query_delete = mysqli_query($conection, "UPDATE proveedor SET estatus = 0 WHERE codproveedor = $idproveedor");
        mysqli_close($conection);
        if($query_delete)
        {
            header('location: lista_proveedor.php');
        }else{
            echo "Error al Eliminar";
        }
    }




    if(empty($_REQUEST['id']))
    {
        header('location: lista_proveedor.php');
        mysqli_close($conection);
    }else{

        

        $idproveedor = $_REQUEST['id'];

        $query = mysqli_query($conection, "SELECT * FROM proveedor
                                            WHERE codproveedor = $idproveedor");

        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if($result > 0)
        {
            while($data = mysqli_fetch_array($query)) 
            {
                $proveedor = $data['proveedor'];
                $contacto = $data['contacto'];
                $telefono = $data['telefono'];
                $correo = $data['correo'];
                $direccion = $data['direccion'];
            }
        }else{
            header('location: lista_proveedor.php');
        }
    }





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Eliminar Proveedor</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="data_delete">
            <i class="fas fa-user-times fa-7x" style="color: #e66062; margin-left: 50px;"></i>
            <br><br>
            <h2>Está Seguro de Eliminar el Proveedor?</h2>
            <p>DNI: <span><?php echo $proveedor; ?></span></p>
            <p>Nombre: <span><?php echo $contacto; ?></span></p>
            <p>Telefono: <span><?php echo $telefono; ?></span></p>
            <p>Email: <span><?php echo $correo; ?></span></p>
            <p>Direccion: <span><?php echo $direccion; ?></span></p>

            <form action="" method="post">
                <input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?> ">
                <a href="lista_proveedor.php" class="btn_cancel"><i class="fas fa-ban"></i> Cancelar</a>
                <input type="submit" value="Eliminar" class="btn_ok">
            </form>
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>