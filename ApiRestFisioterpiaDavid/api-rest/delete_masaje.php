<?php
    require('../includes/Masaje.php');

    if ($_SERVER['REQUEST_METHOD'] =='DELETE' && isset($_GET['id'])) {
       
       
        Masaje::delete_masaje($_GET['id']);
        
    }else{
        echo'No se envio el id del Masaje';
    }


?>