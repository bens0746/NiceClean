<?php
 session_start();
 require_once 'config/db.php';

    if(isset($_GET['change2_order_id'])){
        $order_id = $_GET['change2_order_id'];
        $confirm = 2; //ยืนยันออเดอร์
        

        $stmt =$conn->prepare("UPDATE orders  SET  confirm = :confirm WHERE orders.order_id = $order_id");
        $stmt->bindParam(":confirm",$confirm);
        $stmt->execute();

        if ($stmt) {
            header("location: dataEventsPopup.php?order_id=$order_id");
        }
    }

    if(isset($_GET['finish'])){
        $order_id = $_GET['finish'];
        $status = 1;
        $dateToDay = date('Y-m-d');

        $stmt =$conn->prepare("UPDATE orders  SET  status = :status, order_end = :order_end WHERE orders.order_id = $order_id");
        $stmt->bindParam(":status",$status);
        $stmt->bindParam(":order_end",$dateToDay);
        $stmt->execute();

        if ($stmt) {
            header("location: dataEventsPopup.php?order_id=$order_id");
        }

    }
?>