<?php 
    require_once("db.php");

    unset($_SESSION['user']);
    session_destroy();
    header('refresh:1;url=/');
?>