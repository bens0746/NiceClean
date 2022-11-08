<?php 
    session_start();
    require_once "config/db.php";
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DataEventsPopup | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="assets/css/tailwind.css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <?php include 'includes/calender_include.php'; ?>
    

  </head>
  <body>
   <?php 
    if(isset($_SESSION['cleaner_login'])){
        include './dataEventsPopupCleaner.php';
    }else{
        include './dataEventsPopupUser.php';
    }
   ?>

  </body>
</html>