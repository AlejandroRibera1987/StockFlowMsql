<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'StockFlow';

$conection = @mysqli_connect($host,$user,$password,$db);

//mysqli_close($conection);

if(!$conection){
  echo "Error de Conexion";
}

?>
