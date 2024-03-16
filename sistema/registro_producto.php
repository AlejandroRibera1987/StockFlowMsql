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
	<title>StockFlow || Registro Producto</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<div class="form_register">
            <h1><i class="fas fa-solid fa-box-open"></i> Registro Producto</h1>
            <hr>
            <div class="alert">
                <?php echo isset($alert) ? $alert:''; ?>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <label for="proveedor">Proveedor</label>
                <select name="proveedor" id="proveedor">
                    <option value="1">Sony</option>
                </select>                
                <label for="producto">Producto</label>
                <input type="text" name="producto" id="producto" placeholder="Nombre del Producto">
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" placeholder="Precio del Producto">
                <label for="cantidad">Cantidad</label>
                <input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
                <label for="codbarra">Codigo de Barra</label>
                <input type="text" name="codbarra" id="codbarra" placeholder="Escanee el Codigo de Barra">
                
                <div class="photo">
                    <label for="foto">Foto</label>
                    <div class="prevPhoto">
                        <span class="delPhoto notBlock">X</span>
                        <label for="foto"></label>
                    </div>
                    <div class="upimg">
                        <input type="file" name="foto" id="foto">
                    </div>
                    <div id="form_alert"></div>
                </div>


                <input type="submit" value="Guardar Producto" class="btn_save">
            </form>
        </div>
	</section>


	<?php include "include/footer.php" ?>
</body>
</html>