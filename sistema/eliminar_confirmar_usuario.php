<?php
    session_start();
    if($_SESSION['rol'] != 1)
    {
        header("location: ./");
    }

    include '../conexion.php';

    if(!empty($_POST))
    {
        if($_POST['idusuario'] == 1){
            header('location: lista_usuarios.php');
            mysqli_close($conection);
            exit;
        }
        
        $idusuario = $_POST['idusuario'];

        // $query_delete = mysqli_query($conection, "DELETE FROM usuario WHERE idusuario = $idusuario");

        $query_delete = mysqli_query($conection, "UPDATE usuario SET estatus = 0 WHERE idusuario = $idusuario");
        mysqli_close($conection);
        if($query_delete)
        {
            header('location: lista_usuarios.php');
        }else{
            echo "Error al Eliminar";
        }
    }




    if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1)
    {
        header('location: lista_usuarios.php');
        mysqli_close($conection);
    }else{

        

        $idusuario = $_REQUEST['id'];

        $query = mysqli_query($conection, "SELECT u.nombre, u.usuario, r.rol
                                            FROM usuario u
                                            INNER JOIN
                                            rol r
                                            ON u.rol = r.idrol
                                            WHERE u.idusuario = $idusuario ");

        mysqli_close($conection);
        $result = mysqli_num_rows($query);

        if($result > 0)
        {
            while($data = mysqli_fetch_array($query)) 
            {
                $nombre = $data['nombre'];
                $usuario = $data['usuario'];
                $rol = $data['rol'];
            }
        }else{
            header('location: lista_usuarios.php');
        }
    }





?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Eliminar Usuario</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="data_delete">
            <i class="fas fa-user-times fa-7x" style="color: #e66062; margin-left: 50px;"></i>
            <br><br>
            <h2>Está Seguro de Eliminar el Usuario?</h2>
            <p>Nombre: <span><?php echo $nombre; ?></span></p>
            <p>Usuario: <span><?php echo $usuario; ?></span></p>
            <p>Tipo de Usuario: <span><?php echo $rol; ?></span></p>

            <form action="" method="post">
                <input type="hidden" name="idusuario" value="<?php echo $idusuario; ?> ">
                <a href="lista_usuarios.php" class="btn_cancel">Cancelar</a>
                <input type="submit" value="Aceptar" class="btn_ok">
            </form>
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>