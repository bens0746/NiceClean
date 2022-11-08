<?php 
    session_start();
    require_once "config/db.php";


    // เพิ่มข้อมูลวันที่
    if (isset($_POST['post_exday'])){
        $exDay = $_POST['exDate'];
        $post_id = $_POST['post_id'];

        $exDayArrayString = explode(", ",$exDay);
        $items = array();
        $count = 0;
        foreach($exDayArrayString as $i => $day){
          $items[$count++] = $day;
  
          $stmt =$conn->prepare("INSERT INTO exclusionday(ex_day,post_id) 
                                VALUES (:ex_day, :post_id)");
        
          $stmt->bindParam(":post_id",$post_id);
          $stmt->bindParam(":ex_day",$day);
          $stmt->execute();
        }
        unset($exDayArrayString);

        $_SESSION['success']='เพิ่มวันหยุดเรียบร้อยแล้ว';
        header("location: post_exday.php?post_id=$post_id");
      }

      // ลบข้อมูลวันที่
      if (isset($_POST['delete_post_exday'])){
        $exDay = $_POST['exDate'];
        $post_id = $_POST['post_id'];

        $exDayArrayString = explode(", ",$exDay);
        $items = array();
        $count = 0;
        foreach($exDayArrayString as $i => $day){
          $items[$count++] = $day;
  
          $stmt =$conn->prepare("DELETE FROM exclusionday WHERE ex_day='".$day."' AND exclusionday.post_id=$post_id;");
          $stmt->execute();
          
        }
        unset($exDayArrayString);

        $_SESSION['error']='ลบวันหยุดเรียบร้อยแล้ว';
        header("location: post_exday.php?post_id=$post_id");
      }


?>