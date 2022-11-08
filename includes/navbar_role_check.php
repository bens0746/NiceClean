<!-- topbar role check -->
<?php 
        if (isset($_SESSION['admin_login'])) {
            include("navbar_admin_login.php");
        }
        elseif (isset($_SESSION['cleaner_login'])) {
            include("navbar_cleaner_login.php");
        }
        elseif (isset($_SESSION['user_login'])) {
            include("navbar_user_login.php");
        }
        else 
            include("navbar.php");
    ?>
<!-- end topbar role check -->