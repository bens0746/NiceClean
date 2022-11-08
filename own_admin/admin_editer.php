<?php 
    session_start();
    require_once "../config/db.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> NiceClean</title>

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="style.css">
        
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <nav>
        <div class="nav-bar">
            <i class='bx bx-menu sidebarOpen' ></i>
            
            <div class="menu">
                <div class="logo-toggle">
                    <span class="logo"><a href="#">Admin niceclean</a></span>
                    <i class='bx bx-x siderbarClose'></i>
                </div>

                <ul class="nav-links">
                    <li id="btnreport"><a href="admin_report.php">ประวัติการจ้างงาน</a></li>
                    <li id="btnmain"><a href="admin_main.php">Cleaner verify</a></li>
                    <li id="btneditcleaner"><a href="admin_cleanerediter.php">จัดการ Cleaner</a></li>
                    <li id="btnedituser"><a href="admin_userediter.php">จัดการ User</a></li>
                    <li id="btneditpost"><a href="admin_postedit.php">จัดการ โพสต์</a></li>
                    <li><a href="https://isrmuti.com/niceclean/index.php">ออกจากหลังบ้าน</a></li>
                </ul>
            </div>

            <div class="darkLight-searchBox">
                <div class="dark-light">
                    <i class='bx bx-moon moon'></i>
                    <i class='bx bx-sun sun'></i>
                </div>
            
                   </div>

                </div>
            </div>
        </div>
    </nav>


</body>
</html>