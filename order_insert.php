<?php

    session_start();
    require_once 'config/db.php';

    if (!isset($_SESSION['user_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header('location: signin.php');
    }

    if (isset($_POST['order_cf']))  {
        $post_id = $_POST['post_id'];
        $customer_id = $_SESSION['user_login'];
        $message = $_POST['message'];
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $cleaner_id = $_POST['cleaner_id'];
        $orderStart = $_POST['orderStart'];
        $package_id = $_POST['package_id'];
        $confirm = 0;


                       
            $stmt =$conn->prepare("INSERT INTO orders(post_id, order_start, customer_id, cleaner_id, message, package_id, confirm, lat, lng) 
                                    VALUES (:post_id, :order_start, :customer_id, :cleaner_id, :message, :package_id, :confirm, :lat, :lng)");
            
            $stmt->bindParam(":post_id",$post_id);
            $stmt->bindParam(":customer_id",$customer_id);
            $stmt->bindParam(":cleaner_id",$cleaner_id);
            $stmt->bindParam(":order_start",$orderStart);
            $stmt->bindParam(":message",$message);
            $stmt->bindParam(":lat",$lat);
            $stmt->bindParam(":lng",$lng);
            $stmt->bindParam(":package_id",$package_id);
            $stmt->bindParam(":confirm",$confirm);
            $stmt->execute();

            header("location: mycalender.php"); // สำเร็จ

            } else{
                header("location: index.php"); // ผิดพลาด
            }                   
?>