<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
// เรียกใช้งานไฟล์เชื่อมต่อกับฐานข้อมูล
include 'config/db.php';

$json_data= array();

// Cleaner View
if (isset($_SESSION['cleaner_login'])){
    $statement = $conn->prepare("SELECT * FROM orders,post,users WHERE orders.post_id=post.post_id AND users.user_id=orders.customer_id AND orders.cleaner_id='".$_SESSION['cleaner_login']."'");
    $statement-> execute();
    $result = $statement->fetchAll();


    /* fetch object array */
    foreach($result as $obj){

        if ($obj['confirm']==0 and $obj['status']==0){
            $color = '#B1B1B1';
        }elseif ($obj['confirm']==1 and $obj['status']==0){
            $color = '#F1C40F';
        }elseif ($obj['confirm']==2 and $obj['status']==0){
            $color = '#3398FF';
        }elseif ($obj['confirm']==2 and $obj['status']==1){
            $color = '#2ECC71';
        }else{
            $color = '#B0E0F0';
        }

        $json_data[] = array(
            'id' => $obj['order_id'],
            'title' => $obj['firstname'],
            'start' => $obj['order_start'],
            'end' => $obj['order_end'],
            'color' => $color,
            'url' => 'dataEventsPopup.php?order_id='. $obj['order_id'],
        );
    }
}


// User View
if (isset($_SESSION['user_login'])){
    $statement = $conn->prepare("SELECT * FROM orders,post,users WHERE orders.post_id=post.post_id AND users.user_id=orders.customer_id AND orders.customer_id='".$_SESSION['user_login']."'");
    $statement-> execute();
    $result = $statement->fetchAll();


    /* fetch object array */
    foreach($result as $obj){

        if ($obj['confirm']==0 and $obj['status']==0){
            $color = '#B1B1B1';
        }elseif ($obj['confirm']==1 and $obj['status']==0){
            $color = '#F1C40F';
        }elseif ($obj['confirm']==2 and $obj['status']==0){
            $color = '#3398FF';
        }elseif ($obj['confirm']==2 and $obj['status']==1){
            $color = '#2ECC71';
        }else{
            $color = '#B0E0F0';
        }

        $json_data[] = array(
            'id' => $obj['order_id'],
            'title' => $obj['title'],
            'start' => $obj['order_start'],
            'end' => $obj['order_end'],
            'color' => $color,
            'url' => 'dataEventsPopup.php?order_id='. $obj['order_id'],
        );
    }
}


$json = json_encode($json_data);
echo $json;
?>