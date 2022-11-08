<?php

require_once 'config/db.php';


if(isset($_POST['profileEdit'])){
    $user_id = $_POST['user_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $lineID = $_POST['lineID'];
    $img = $_FILES['img'];

    $img2 = $_POST['img2'];
    $upload = $_FILES['img']['name'];
}

if ($upload != '') {
    $allow = array('jpg', 'jpeg', 'png');
    $extension = explode('.', $img['name']);
    $fileActExt = strtolower(end($extension));
    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
    $filePath = 'uploads/profiles/'.$fileNew;

    if (in_array($fileActExt, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
        move_uploaded_file($img['tmp_name'], $filePath);
        }
    }

} else {
    $fileNew = $img2;
}

    $stmt =$conn->prepare("UPDATE users  SET  firstname = :firstname,  lastname = :lastname, gender = :gender, phone = :phone, lineID = :lineID, img = :img WHERE users.user_id =:user_id");
    $stmt->bindParam(":user_id",$user_id);
    $stmt->bindParam(":firstname",$firstname);
    $stmt->bindParam(":lastname",$lastname);
    $stmt->bindParam(":img",$fileNew);
    $stmt->bindParam(":gender",$gender);
    $stmt->bindParam(":phone",$phone);
    $stmt->bindParam(":lineID",$lineID);
    $stmt->execute();

    if ($stmt) {
        unset($stmt);
        $_SESSION['success'] = "แก้ไขสำเร็จ";
        header("location: profile_edit.php?user=$user_id");
    } else {
        unset($stmt);
        $_SESSION['error'] = "แก้ไขผิดพลาด";
        header("location: profile_edit.php?user=$user_id");
    }

?>