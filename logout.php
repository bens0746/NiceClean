<?php 

    session_start();
    unset($_SESSION['user_login']);
    unset($_SESSION['admin_login']);
    unset($_SESSION['cleaner_login']);
    session_destroy();
    header('location: index.php');

?>