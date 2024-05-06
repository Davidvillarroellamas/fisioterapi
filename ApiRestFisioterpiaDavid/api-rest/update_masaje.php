<?php
require('../includes/Masaje.php');


parse_str(file_get_contents("php://input"), $_PUT);

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_PUT['nombre']) && isset($_PUT['descripcion']) && isset($_PUT['duracion']) && isset($_PUT['precio']) && isset($_PUT['id'] )) {
    Masaje::update_masaje($_PUT['id'], $_PUT['nombre'], $_PUT['descripcion'], $_PUT['duracion'], $_PUT['precio']);
} else {
    echo 'No se han proporcionado todos los datos necesarios para la actualización';
}

?>
