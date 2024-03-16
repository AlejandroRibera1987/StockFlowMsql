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

        if(empty($_POST['contacto']) || empty($_POST['correo']) || empty($_POST['telefono']) || empty($_POST['proveedor']))
        {
            $alert ='<p class="msg_error">Nombre, Telefono, Proveedor y Contacto son Obligatorios.</p>';
        }else{
            
                $proveedor = $_POST['proveedor'];
                $contacto = $_POST['contacto'];
                $email = $_POST['correo'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $usuario_id = $_SESSION['idUser'];

                $query_insert = mysqli_query($conection, "INSERT INTO proveedor(proveedor,contacto,telefono,correo, direccion, usuario_id)
                                                            VALUE ('$proveedor','$contacto','$telefono','$email', '$direccion', '$usuario_id')");
                    if($query_insert)
                    {
                        $alert ='<p class="msg_save">Proveedor Creado Correctamente</p>';
                    }else{
                        $alert ='<p class="msg_error">Error al crear el Proveedor</p>';
                    }
                }
            
                mysqli_close($conection);
            
    }

?>






<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Registro Proveedor</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="form_register">
            <h1><i class="far fa-building"></i> Registro Proveedor</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert:''; ?>
            </div>

            <form action="" method="post">
                <label for="proveedor">Proveedor</label>
                <input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">
                <label for="contacto">Contacto</label>
                <input type="text" name="contacto" id="contacto" placeholder="Nombre del Contacto">
                <label for="correo">Correo Electronico</label>
                <input type="email" name="correo" id="correo" placeholder="Correo Electronico">
                <label for="telefono">Telefono</label>
                <input type="number" name="telefono" id="telefono" placeholder="Telefono">
                <label for="direccion">Dirección / Url</label>
                <input type="text" name="direccion" id="direccion" placeholder="Dirección o Url">
                
                <input type="submit" value="Guardar Proveedor" class="btn_save">
            </form>
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>