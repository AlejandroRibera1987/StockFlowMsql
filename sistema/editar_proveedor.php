<?php
    session_start();
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
    {
        header("location: ./");
    }

include "../conexion.php";

    if(!empty($_POST))
    {
        $alert = '';

        if(empty($_POST['proveedor']) || empty($_POST['contacto']) || empty($_POST['telefono']))
        {
            $alert ='<p class="msg_error">Proveedor, Contacto y Telefono son Campos Obligatorios.</p>';
        }else{
            
            $idproveedor = $_POST['id'];
            $proveedor = $_POST['proveedor'];            
            $contacto = $_POST['contacto'];
            $email = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

                $sql_update = mysqli_query($conection, " UPDATE proveedor
                                                         SET proveedor = '$proveedor', correo = '$email', contacto = '$contacto', telefono = '$telefono', direccion = '$direccion'
                                                         WHERE codproveedor = $idproveedor ");
                

                if($sql_update)
                {
                    $alert ='<p class="msg_save">Exito al Actualizar Proveedor.</p>';                 
                }else{
                    $alert ='<p class="msg_error">Error al Actualizar Proveedor.</p>';
                }
                
            }
        }
       // mysqli_close($conection);


    //Mostrar Datos
    if(empty($_GET['id']))
    {
        header('location: lista_proveedor.php');
        mysqli_close($conection);
    }
    $idproveedor = $_GET['id'];

    $sql = mysqli_query($conection, "SELECT * FROM proveedor
                                        WHERE codproveedor = $idproveedor and estatus = 1");

    mysqli_close($conection);
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0)
    {
        header('location: lista_proveedor.php');
    }else{
      
        while($data = mysqli_fetch_array($sql)) 
        {
            $idproveedor = $data['codproveedor'];
            $proveedor = $data['proveedor'];
            $contacto = $data['contacto'];
            $telefono = $data['telefono'];
            $correo = $data['correo'];
            $direccion = $data['direccion'];

        }
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Editar Proveedor</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="form_register">
            <h1><i class="far fa-edit"></i> Editar Proveedor</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert:''; ?>
            </div>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $idproveedor; ?>">
                <label for="proveedor">Proveedor</label>
                <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor" value="<?php echo $proveedor; ?>">
                <label for="contacto">Contacto</label>
                <input type="text" name="contacto" id="contacto" placeholder="Nombre del Contacto" value="<?php echo $contacto; ?>">
                <label for="correo">Correo Electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico" value="<?php echo $correo; ?>">
                <label for="telefono">Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono" value="<?php echo $telefono; ?>">
                <label for="direccion">Dirección / Url</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección o Url" value="<?php echo $direccion; ?>">
                
                <input type="submit" value="Editar Proveedor" class="btn_save">
            </form>
           
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>