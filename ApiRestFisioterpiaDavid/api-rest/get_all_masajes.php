<?php
    require('../includes/Masaje.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' ) {
          
         Masaje::get_all_masajes();
        
        
    }


?>