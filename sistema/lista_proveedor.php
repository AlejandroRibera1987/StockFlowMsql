<?php
    session_start();

    if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
    {
        header("location: ./");
    }

include "../conexion.php";

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<?php  include "include/scripts.php" ?>
	<title>StockFlow || Clientes</title>
</head>
<body>
	<?php include "include/header.php" ?>
	<section id="container">
		<h2><i class="far fa-building"></i> Lista de Proveedores</h2>
        <a href="registro_proveedor.php" class="btn_new"><i class="fas fa-plus"></i> Cargar Proveedor</a>
        <form action="buscar_proveedor.php" method="get" class="form_search">
            <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
            <input type="submit" value="Buscar" class="btn_search">
        </form>
        <table>
            <tr>
                <th>ID</th>
                <th>Proveedor</th>
                <th>Contacto</th>
                <TH>Telefono</TH>
                <th>Correo</th>
                <th>Direccion</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        <?php

            //Paginador
            $sql_registe = mysqli_query($conection, "SELECT COUNT(*) as total_registro FROM proveedor WHERE estatus = 1;");
            $result_register = mysqli_fetch_array($sql_registe);
            $total_registro = $result_register['total_registro'];

            $por_pagina = 5;

            if(empty($_GET['pagina']))
            {
                $pagina = 1;
            }else{
                $pagina = $_GET['pagina'];
            }

            $desde = ($pagina-1) * $por_pagina;
            $total_paginas = ceil($total_registro / $por_pagina);

            $query = mysqli_query($conection, "SELECT * FROM proveedor  
                                                WHERE estatus = 1 
                                                LIMIT $desde,$por_pagina     
                                                ");

            mysqli_close($conection);

            $result = mysqli_num_rows($query);

            if($result > 0)
            {
                while ($data = mysqli_fetch_array($query)){
                    $formato = 'Y-m-d H:i:s';
                    $fecha = DateTime::createFromFormat($formato,$data["date_add"]);
                    
        ?>

                <tr>
                    <td><?php echo $data["codproveedor"];?></td>
                    <td><?php echo $data['proveedor'];?></td>
                    <td><?php echo $data["contacto"];?></td>
                    <td><?php echo $data["telefono"];?></td>
                    <td><?php echo $data["correo"];?></td>
                    <td><?php echo $data["direccion"];?></td>
                    <td><?php echo $fecha->format('d/m/y');?></td>
                    <td>
                        <a class="link_edit" href="editar_proveedor.php?id=<?php echo $data["codproveedor"];?>"><img src="img/editar.png" alt=""></a>
                        
                        <a class="link_delete" href="eliminar_confirmar_proveedor.php?id=<?php echo $data["codproveedor"];?>"><img src="img/eliminar.png" alt="eliminar"></a>

                    </td>
                </tr>

            <?php
                }
            }
            ?>
        </table>

        <div class="paginador">
            <ul>
                <?php
                    if($pagina != 1)
                    {
                ?>
                <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina - 1; ?>"><<<</a></li>

                <?php
                    }
                    for($i=1; $i <= $total_paginas; $i++)
                    {
                        if($i == $pagina)
                        {
                            echo '<li class="pageSelected">'.$i.'</li>';
                        }else{
                            echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                        }
                    }

                    if($pagina != $total_paginas)
                    {
                ?>
                <li><a href="?pagina=<?php echo $pagina + 1; ?>">>>></a></li>
                <li><a href="?pagina=<?php echo $total_paginas; ?>">>|</a></li>
               <?php
                    }
                ?> 
            </ul>
        </div>

	</section>


	<?php include "include/footer.php" ?>
</body>
</html>