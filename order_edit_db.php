<?php
    session_start();
    require_once 'config/db.php';

// user
    if (isset($_POST['order_edit']))  {

        $order_id = $_POST['order_id'];
        $orderDateNew = $_POST['orderDateNew'];
        $orderDateOld = $_POST['orderDateOld'];
        $messageNew = $_POST['messageNew'];
        $confirm = $_POST['confirm'];
        $latNew = $_POST['lat'];
        $lngNew = $_POST['lng'];

        if($orderDateNew !=''){
            if($confirm == 0 ){

                $stmt =$conn->prepare("UPDATE orders  SET  order_start = :order_start,  message = :message, lat =:lat, lng =:lng WHERE orders.order_id =$order_id");
                $stmt->bindParam(":order_start",$orderDateNew);
                $stmt->bindParam(":message",$messageNew);
                $stmt->bindParam(":lat",$latNew);
                $stmt->bindParam(":lng",$lngNew);
                $stmt->execute();
    
            }elseif($confirm == 2){
    
                $stmt1 =$conn->prepare("INSERT INTO orders_shift(order_start_new, message_new, order_id, lat_new, lng_new) 
                VALUES (:order_start_new, :message_new, :order_id, :lat_new, :lng_new)");
    
                $stmt1->bindParam(":order_start_new",$orderDateNew);
                $stmt1->bindParam(":message_new",$messageNew);
                $stmt1->bindParam(":order_id",$order_id);
                $stmt1->bindParam(":lat_new",$latNew);
                $stmt1->bindParam(":lng_new",$lngNew);
                $stmt1->execute();
    
                $confirm1 = 1;
                $stmt1 =$conn->prepare("UPDATE orders  SET  confirm = :confirm WHERE orders.order_id =$order_id");
                $stmt1->bindParam(":confirm",$confirm1);
                $stmt1->execute();
            }else{
    
            }
    
    
    
            if ($stmt) {
                unset($stmt);
                $_SESSION['success'] = "เลื่อนวันนัดสำเร็จ";
                header("location: order_edit.php?order_id=$order_id ");
            }elseif($stmt1){
                unset($stmt1);
                $_SESSION['warning'] = "รอการยืนยันจาก Cleaner";
                header("location: order_edit.php?order_id=$order_id ");
            }else {
                unset($stmt);
                unset($stmt1);
                $_SESSION['error'] = "ดำเนินการไม่สำเร็จ";
                header("location: order_edit.php?order_id=$order_id ");
            }


        }else{ //if order_startNew not change
            if($confirm == 0 ){

                $stmt =$conn->prepare("UPDATE orders  SET  order_start = :order_start,  message = :message, lat =:lat, lng =:lng WHERE orders.order_id =$order_id");
                $stmt->bindParam(":order_start",$orderDateOld);
                $stmt->bindParam(":message",$messageNew);
                $stmt->bindParam(":lat",$latNew);
                $stmt->bindParam(":lng",$lngNew);
                $stmt->execute();
    
            }elseif($confirm == 2){
    
                $stmt1 =$conn->prepare("INSERT INTO orders_shift(order_start_new, message_new, order_id, lat_new, lng_new) 
                VALUES (:order_start_new, :message_new, :order_id, :lat_new, :lng_new)");
    
                $stmt1->bindParam(":order_start_new",$orderDateOld);
                $stmt1->bindParam(":message_new",$messageNew);
                $stmt1->bindParam(":order_id",$order_id);
                $stmt1->bindParam(":lat_new",$latNew);
                $stmt1->bindParam(":lng_new",$lngNew);
                $stmt1->execute();
    
                $confirm1 = 1;
                $stmt1 =$conn->prepare("UPDATE orders  SET  confirm = :confirm WHERE orders.order_id =$order_id");
                $stmt1->bindParam(":confirm",$confirm1);
                $stmt1->execute();
            }else{
    
            }
    
    
    
            if ($stmt) {
                unset($stmt);
                $_SESSION['success'] = "เลื่อนวันนัดสำเร็จ";
                header("location: order_edit.php?order_id=$order_id ");
            }elseif($stmt1){
                unset($stmt1);
                $_SESSION['warning'] = "รอการยืนยันจาก Cleaner";
                header("location: order_edit.php?order_id=$order_id ");
            }else {
                unset($stmt);
                unset($stmt1);
                $_SESSION['error'] = "ดำเนินการไม่สำเร็จ";
                header("location: order_edit.php?order_id=$order_id ");
            }
        }

    }



//cleaner
    if($_GET['cf'] and $_GET['order_id']){

        $shift_id = $_GET['cf'];
        $order_id = $_GET['order_id'];

        $Shift = $conn->prepare("SELECT order_start_new, message_new, lat_new, lng_new FROM orders_shift WHERE shift_id=$shift_id");
        $Shift->execute();
        $rowShift = $Shift->fetch(PDO::FETCH_ASSOC);

        $order_start_new = $rowShift['order_start_new'];
        $message_new = $rowShift['message_new'];
        $lat_new = $rowShift['lat_new'];
        $lng_new = $rowShift['lng_new'];

        $stmt =$conn->prepare("UPDATE orders  SET  order_start = :order_start,  message = :message, lat =:lat, lng =:lng WHERE orders.order_id =$order_id");
        $stmt->bindParam(":order_start",$order_start_new);
        $stmt->bindParam(":message",$message_new);
        $stmt->bindParam(":lat",$lat_new);
        $stmt->bindParam(":lng",$lng_new);
        $stmt->execute();

        $confirm2 = 2;
        $stmt1 =$conn->prepare("UPDATE orders  SET  confirm = :confirm WHERE orders.order_id =$order_id");
        $stmt1->bindParam(":confirm",$confirm2);
        $stmt1->execute();

        $deletestmt = $conn->query("DELETE FROM orders_shift WHERE shift_id = $shift_id");
        $deletestmt->execute();

        if ($stmt and $stmt1 and $deletestmt) {
            unset($stmt);
            unset($stmt1);
            $_SESSION['success'] = "ยืนยันสำเร็จ";
            header("location: ". $_SERVER['HTTP_REFERER']);
        }else{
            unset($stmt);
            unset($stmt1);
            $_SESSION['error'] = "ดำเนินการไม่สำเร็จ";
            header("location: ". $_SERVER['HTTP_REFERER']);
        }
        
    }

    if($_GET['cc'] and $_GET['order_id_cc']){

        $shift_id = $_GET['cc'];
        $order_id = $_GET['order_id_cc'];

        $confirm2 = 2;
        $stmt1 =$conn->prepare("UPDATE orders  SET  confirm = :confirm WHERE orders.order_id =$order_id");
        $stmt1->bindParam(":confirm",$confirm2);
        $stmt1->execute();

        $deletestmt = $conn->query("DELETE FROM orders_shift WHERE shift_id = $shift_id");
        $deletestmt->execute();

        if ($stmt1 and $deletestmt) {
            unset($stmt1);
            $_SESSION['warning'] = "ยกเลิกการเลื่อน";
            header("location: ". $_SERVER['HTTP_REFERER']);
        }else{
            unset($stmt1);
            $_SESSION['error'] = "ดำเนินการไม่สำเร็จ";
            header("location: ". $_SERVER['HTTP_REFERER']);
        }
    }
?>