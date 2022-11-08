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
        header("location: signin.php");
    }

    if (isset($_POST['signin']) && $responseData->success) {
        $email = $_POST['email'];
        $password = $_POST['password'];

    
        if (empty($email)) {
            $_SESSION['error'] = 'กรุณากรอกอีเมล';
            header("location: signin.php");
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error'] = 'รูปแบบอีเมลไม่ถูกต้อง';
            header("location: signin.php");
        } else if (empty($password)) {
            $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
            header("location: signin.php");
        } else if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
            $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร';
            header("location: signin.php");
        } else {
            try {

                $check_data = $conn->prepare("SELECT * FROM users WHERE email = :email");
                $check_data->bindParam(":email", $email);
                $check_data->execute();
                $row = $check_data->fetch(PDO::FETCH_ASSOC);

                if ($check_data->rowCount() > 0) {

                    if ($email == $row['email']) {
                        if (password_verify($password, $row['password'])) {
                            if ($row['urole'] == 'admin') {
                                $_SESSION['admin_login'] = $row['user_id'];
                                $_SESSION['user_id'] = $row['user_id'];
                                header("location: index.php");
                            } elseif ($row['urole'] == 'cleaner') {
                                $_SESSION['cleaner_login'] = $row['user_id'];
                                $_SESSION['user_id'] = $row['user_id'];
                                header("location: index.php");
                            } else {
                                $_SESSION['user_login'] = $row['user_id'];
                                $_SESSION['user_id'] = $row['user_id'];
                                header("location: index.php");
                            }
                        } else {
                            $_SESSION['error'] = 'รหัสผ่านผิด';
                            header("location: signin.php");
                        }
                    } else {
                        $_SESSION['error'] = 'อีเมลผิด';
                        header("location: signin.php");
                    }
                } else {
                    $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
                    header("location: signin.php");
                }

            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        }
    }
}
?>