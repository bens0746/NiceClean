<?php

session_start();
require_once 'config/db.php';

$secret ="6Lfx55ciAAAAADh2eD6f1Zm9fwbniBhVhffknEcD";

if (isset($_POST['g-recaptcha-response'])){
    $captcha = $_POST['g-recaptcha-response'];
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
    $responseData = json_decode($verifyResponse);
    
    if(!$captcha){
        $_SESSION['error'] = 'กรุณาป้อน reCAPTCHA';
        header("location: signup.php");
    }

    if (isset($_POST['signup']) && $responseData->success)  {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $day = $_POST['day'];
                if($day <= 9){
                    $day = sprintf("%02d", $day);
                }

        $month = $_POST['month'];
                if($month == 'มกราคม'){
                    $month = "01";
                }elseif($month == 'กุมภาพันธ์'){
                    $month = "02";
                }elseif($month == 'มีนาคม'){
                    $month = "03";
                }elseif($month == 'เมษายน'){
                    $month = "04";
                }elseif($month == 'พฤษภาคม'){
                    $month = "05";
                }elseif($month == 'มิถุนายน'){
                    $month = "06";
                }elseif($month == 'กรกฎาคม'){
                    $month = "07";
                }elseif($month == 'สิงหาคม'){
                    $month = "08";
                }elseif($month == 'กันยายน'){
                    $month = "09";
                }elseif($month == 'ตุลาคม'){
                    $month = "10";
                }elseif($month == 'พฤศจิกายน'){
                    $month = "11";
                }elseif($month == 'ธันวาคม'){
                    $month = "12";
                }else{
                    return false;
                }

        $year = $_POST['year'];
        $birthdate = $year."-".$month."-".$day;
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $phone = $_POST['phone'];
        $lineID = $_POST['lineID'];
        $urole = 'user';
        $verify = 0;
        $img = $_FILES['img'];

        // Check input
        if (empty($firstname)){
            $_SESSION['error']='กรุณาใส่ชื่อ';
            header("location: signup.php");
        } elseif (empty($lastname)){
            $_SESSION['error']='กรุณาใส่นามสกุล';
            header("location: signup.php");
        } elseif (empty($email)){
            $_SESSION['error']='กรุณาใส่อีเมล';
            header("location: signup.php");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error']='รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signup.php");
        }   elseif (empty($password)){
            $_SESSION['error']='กรุณาใส่รหัสผ่าน';
            header("location: signup.php");
        }   elseif (strlen($_POST['password']) >20 || strlen($_POST['password']) <5 ){
            $_SESSION['error']='รหัสผ่านต้องมีความยาวระหว่าง 5-20 ตัวอักษร';
            header("location: signup.php");
        }   elseif (empty($c_password )){
            $_SESSION['error']='กรุณายืนยันรหัสผ่าน';
            header("location: signup.php");
        }   elseif ($password != $c_password) {
            $_SESSION['error']='รหัสผ่านไม่ตรงกัน';
            header("location: signup.php");
        }   else {
            
            try{
                $check_email =$conn->prepare("SELECT email FROM users WHERE email =:email");
                $check_email -> bindParam(":email", $email);
                $check_email -> execute();
                $row =$check_email->fetch(PDO::FETCH_ASSOC);

                $allow = array('jpg', 'jpeg', 'png');
                        $extension = explode('.', $img['name']);
                        $fileActExt = strtolower(end($extension));
                        $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
                        $filePath = 'uploads/profiles/'.$fileNew;

                if ($row['email'] == $email){
                    $_SESSION['warning']='มีอีเมลนี้อยู่ในระบบแล้ว <a href="signin.php" class="font-semibold underline hover:text-yellow-800"> คลิกที่นี่ </a>เพื่อเข้าสู่ระบบ';
                    header("location: signup.php");

                } elseif (!isset($_SESSION['error'])){
                    $passwordHash = password_hash ($password, PASSWORD_DEFAULT);
                    if (in_array($fileActExt, $allow)) {
                        if ($img['size'] > 0 && $img['error'] == 0) {
                            if (move_uploaded_file($img['tmp_name'], $filePath)) {
                
                            $stmt =$conn->prepare("INSERT INTO users(firstname, lastname, birthdate, gender, email, password,img ,urole, phone, lineID, verify) 
                                                    VALUES (:firstname, :lastname, :birthdate, :gender, :email, :password,:img, :urole, :phone, :lineID, :verify)"); //ใส่ img
                            
                            $stmt->bindParam(":firstname",$firstname);
                            $stmt->bindParam(":lastname",$lastname);
                            $stmt->bindParam(":birthdate",$birthdate);
                            $stmt->bindParam(":gender",$gender);
                            $stmt->bindParam(":email",$email);
                            $stmt->bindParam(":password",$passwordHash);
                            $stmt->bindParam(":phone",$phone);
                            $stmt->bindParam(":lineID",$lineID);
                            $stmt->bindParam(":img",$fileNew);
                            $stmt->bindParam(":verify",$verify);
                            $stmt->bindParam(":urole",$urole);
                            $stmt->execute();
                            } 
                        } 
                    } 
                    $_SESSION['success']='สมัครสมาชิกเรียบร้อย <a href="signin.php" class="font-semibold underline hover:text-green-800"> คลิกที่นี่ </a>เพื่อเข้าสู่ระบบ';
                    header("location: signup.php");
                } else{
                    $_SESSION['error']="มีบางอย่างผิดพลาด";
                    header("location: signup.php");
                }

            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }             
    }
}


if (isset($_POST['g-recaptcha-response'])){
    $captcha = $_POST['g-recaptcha-response'];
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
    $responseData = json_decode($verifyResponse);
    
    if(!$captcha){
        $_SESSION['error'] = 'กรุณาป้อน reCAPTCHA';
        header("location: signup.php");
    }
    // สมัคร Cleaner
    if (isset($_POST['signup_cleaner']) && $responseData->success)  {
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $day = $_POST['day'];
        if($day <=9){
            $day = sprintf("%02d", $day);
        }
        $month = $_POST['month'];
            if($month == 'มกราคม'){
                $month = "01";
            }elseif($month == 'กุมภาพันธ์'){
                $month = "02";
            }elseif($month == 'มีนาคม'){
                $month = "03";
            }elseif($month == 'เมษายน'){
                $month = "04";
            }elseif($month == 'พฤษภาคม'){
                $month = "05";
            }elseif($month == 'มิถุนายน'){
                $month = "06";
            }elseif($month == 'กรกฎาคม'){
                $month = "07";
            }elseif($month == 'สิงหาคม'){
                $month = "08";
            }elseif($month == 'กันยายน'){
                $month = "09";
            }elseif($month == 'ตุลาคม'){
                $month = "10";
            }elseif($month == 'พฤศจิกายน'){
                $month = "11";
            }elseif($month == 'ธันวาคม'){
                $month = "12";
            }else{
                return false;
            }
        $year = $_POST['year'];
        $birthdate = $year."-".$month."-".$day;
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $c_password = $_POST['c_password'];
        $phone = $_POST['phone'];
        $lineID = $_POST['lineID'];
        $urole = 'user';
        $uroleCleaner = 'cleaner';
        $verify = 0;
        $img = $_FILES['img'];
        $imgProof = $_FILES['imgProof'];
        $status = 0;

        // Check input
        if (empty($firstname)){
            $_SESSION['error']='กรุณาใส่ชื่อ';
            header("location: signup.php");
        } elseif (empty($lastname)){
            $_SESSION['error']='กรุณาใส่นามสกุล';
            header("location: signup.php");
        } elseif (empty($email)){
            $_SESSION['error']='กรุณาใส่อีเมล';
            header("location: signup.php");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error']='รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signup.php");
        }   elseif (empty($password)){
            $_SESSION['error']='กรุณาใส่รหัสผ่าน';
            header("location: signup.php");
        }   elseif (strlen($_POST['password']) >20 || strlen($_POST['password']) <5 ){
            $_SESSION['error']='รหัสผ่านต้องมีความยาวระหว่าง 5-20 ตัวอักษร';
            header("location: signup.php");
        }   elseif (empty($c_password )){
            $_SESSION['error']='กรุณายืนยันรหัสผ่าน';
            header("location: signup.php");
        }   elseif ($password != $c_password) {
            $_SESSION['error']='รหัสผ่านไม่ตรงกัน';
            header("location: signup.php");
        }   else {
            
            try{
                $check_email =$conn->prepare("SELECT email FROM users WHERE email =:email");
                $check_email -> bindParam(":email", $email);
                $check_email -> execute();
                $row =$check_email->fetch(PDO::FETCH_ASSOC);

                    $allow = array('jpg', 'jpeg', 'png');
                    $extension = explode('.', $img['name']);
                    $fileActExt = strtolower(end($extension));
                    $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
                    $filePath = 'uploads/profiles/'.$fileNew;

                    $allow1 = array('jpg', 'jpeg', 'png');
                    $extension1 = explode('.', $imgProof['name']);
                    $fileActExt1 = strtolower(end($extension1));
                    $fileNew1 = rand() . "." . $fileActExt1;  // rand function create the rand number 
                    $filePath1 = 'uploads/cleaner_proof/'.$fileNew1;

                if ($row['email'] == $email){
                    $_SESSION['warning']='มีอีเมลนี้อยู่ในระบบแล้ว <a href="signin.php" class="font-semibold underline hover:text-yellow-800"> คลิกที่นี่ </a>เพื่อเข้าสู่ระบบ';
                    header("location: signup.php");

                } elseif (!isset($_SESSION['error'])){
                    $passwordHash = password_hash ($password, PASSWORD_DEFAULT);
                    if (in_array($fileActExt, $allow)) {
                        if ($img['size'] > 0 && $img['error'] == 0 && $imgProof['size'] > 0 && $imgProof['error'] == 0) {
                            if (move_uploaded_file($img['tmp_name'], $filePath) && move_uploaded_file($imgProof['tmp_name'], $filePath1)) {
                
                            $stmt =$conn->prepare("INSERT INTO users(firstname, lastname, birthdate, gender, email, password,img ,urole, phone, lineID, verify) 
                                                    VALUES (:firstname, :lastname, :birthdate, :gender, :email, :password,:img, :urole, :phone, :lineID, :verify)"); //ใส่ img
                            
                            $stmt->bindParam(":firstname",$firstname);
                            $stmt->bindParam(":lastname",$lastname);
                            $stmt->bindParam(":birthdate",$birthdate);
                            $stmt->bindParam(":gender",$gender);
                            $stmt->bindParam(":email",$email);
                            $stmt->bindParam(":password",$passwordHash);
                            $stmt->bindParam(":phone",$phone);
                            $stmt->bindParam(":lineID",$lineID);
                            $stmt->bindParam(":img",$fileNew);
                            $stmt->bindParam(":verify",$verify);
                            $stmt->bindParam(":urole",$uroleCleaner);
                            $stmt->execute();


                            $last_user_id = $conn->lastInsertId();
                            $stmt1 =$conn->prepare("INSERT INTO cleaner_reg(user_id, imgProof, status) 
                                                    VALUES (:user_id, :imgProof, :status)");
                                            
                            $stmt1->bindParam(":user_id",$last_user_id);
                            $stmt1->bindParam(":imgProof",$fileNew1);
                            $stmt1->bindParam(":status",$status);
                            $stmt1->execute();

                            } 
                        } 
                    } 
                    unset( $stmt);
                    unset( $stmt1);
                    $_SESSION['warning']='สมัครสมาชิกเรียบร้อย <a href="signin.php" class="font-semibold underline hover:text-yellow-800"> คลิกที่นี่ </a>เพื่อเข้าสู่ระบบ และรอการยืนยันตัวตนจากระบบ';
                    header("location: signup.php");
                } else{
                    unset( $stmt);
                    unset( $stmt1);
                    $_SESSION['error']="มีบางอย่างผิดพลาด";
                    header("location: signup.php");
                    
                }

            } catch(PDOException $e){
                echo $e->getMessage();
            }
        }             
    }
}
?>