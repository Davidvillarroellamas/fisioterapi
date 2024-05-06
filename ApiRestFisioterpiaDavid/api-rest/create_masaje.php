<?php
    
require_once('../includes/Masaje.php');
//header('Access-Control-Allow-Origin: *');

if ($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['nombre']) && isset($_POST['descripcion']) && isset($_POST['duracion']) && isset($_POST['precio'])) {

    Masaje::create_masaje($_POST['nombre'], $_POST['descripcion'], $_POST['duracion'], $_POST['precio']);
    
} else {
    echo 'No se encontraron todos los datos necesarios';
}
?>
