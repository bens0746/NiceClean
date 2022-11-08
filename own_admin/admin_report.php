<?php
    require_once("../config/db.php");

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

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
<div class="home">
<div class="container text-center">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <td>ชื่อ / สกุล ผู้ใช้บริการ</td>
                    <td>จ้างงาน</td>
                    <td>ชื่อ / สกุล Cleaner</td>
                    <td>จ้างงานผ่าน</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    $select_stmt = $conn->prepare('SELECT (SELECT users.firstname FROM users WHERE users.user_id = orders.customer_id) AS FnameCustomer, 
                    (SELECT users.lastname FROM users WHERE users.user_id = orders.customer_id) AS LnameCustomer ,
                    (SELECT users.firstname FROM users WHERE users.user_id = orders.cleaner_id) AS FnameClener ,
                    (SELECT users.lastname FROM users WHERE users.user_id = orders.cleaner_id) AS LnameClener ,
                    (SELECT post.title FROM post WHERE post.post_id = orders.post_id) AS Priceformpost ,
                    (SELECT post.post_id FROM post WHERE post.post_id = orders.post_id) AS Posts_ID 
                    FROM orders ORDER BY orders.order_id desc');
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {

                    
                ?>
                    <tr>
                        <td><?php echo $row['FnameCustomer']; ?> <?php echo $row['LnameCustomer']; ?></td>
                        <td><p>--></p></td>
                        <td><?php echo $row['FnameClener']; ?> <?php echo $row['LnameClener']; ?></td>
                        <td><a href="/niceclean/post_detail.php?post_id=<?php echo $row['Posts_ID']; ?>"target="_blank" class="btn btn-info">View</a></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>
    
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>

</body>
</html>

