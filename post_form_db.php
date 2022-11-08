<?php

    session_start();
    require_once 'config/db.php';

    if (isset($_POST['post_form']))  {
        $user_id=$_SESSION['cleaner_login'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $province = $_POST['province_id'];
        $amphure = $_POST['amphure_id'];
        $district = $_POST['district_id'];
        $img_title = $_FILES['img_title'];

        $package_name = $_POST['package_name'];
        $package_detail = str_replace(PHP_EOL,"<br>",$_POST['package_detail']);
        $package_price = $_POST['package_price'];




        if (empty($title)){
            $_SESSION['error']='กรุณาใส่หัวข้อ';
            header("location: post_form.php");
        } elseif (empty($content)){
            $_SESSION['error']='กรุณารายละเอียด';
            header("location: post_form.php");
        } else {


            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode('.', $img_title['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'uploads/posts/'.$fileNew;

            $dom = new \domdocument('1.0', 'UTF-8');
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
            //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
            $images = $dom->getElementsByTagName('img');

            //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
            foreach($images as $k => $img_content){
                $data = $img_content->getAttribute('src');
                list($type, $data) = explode(';', $data);
                list(, $data)= explode(',', $data);
                $data = base64_decode($data);

                //ตั้งชื่อรูปภาพใหม่โดยอ้างอิงจากเวลา
                $image_name= time().$k.'.png';

                //อัพโหลดภาพไปยัง public
                $path = 'uploads/post_contents/'. $image_name;
                
                //ทำการอัพโหลดภาพ
                file_put_contents($path, $data);
                $img_content->removeAttribute('src');
                $img_content->setAttribute('src','uploads/post_contents/'.$image_name);
            }
            $content = $dom->saveHTML($dom->documentElement) . PHP_EOL . PHP_EOL;


            if (!isset($_SESSION['error'])){
                if (in_array($fileActExt, $allow)) {
                    if ($img_title['size'] > 0 && $img_title['error'] == 0) {                   

                        if (move_uploaded_file($img_title['tmp_name'], $filePath)) {
            
                        $stmt =$conn->prepare("INSERT INTO post(title, content, img_title, user_id, province_id, amphure_id, district_id) 
                                                VALUES (:title, :content, :img_title, :user_id, :province_id, :amphure_id, :district_id)");
                        
                        $stmt->bindParam(":user_id",$user_id);
                        $stmt->bindParam(":title",$title);
                        $stmt->bindParam(":content",$content);
                        $stmt->bindParam(":province_id",$province);
                        $stmt->bindParam(":amphure_id",$amphure);
                        $stmt->bindParam(":district_id",$district);
                        $stmt->bindParam(":img_title",$fileNew);
                        $stmt->execute();

                        $last_post_id = $conn->lastInsertId();

                            foreach ($package_name as $key => $value) {
                            
                                $stmt1 =$conn->prepare("INSERT INTO package(package_name, package_detail, package_price, post_id) 
                                VALUES (:package_name, :package_detail, :package_price, :post_id)");
        
                                $stmt1->bindParam(":package_name",$package_name[$key]);
                                $stmt1->bindParam(":package_detail",$package_detail[$key]);
                                $stmt1->bindParam(":package_price",$package_price[$key]);
                                $stmt1->bindParam(":post_id",$last_post_id);
                                $stmt1->execute();

                                unset($stmt);
                                unset($stmt1);
                            }

                        }
                        
                    }
                }
                $_SESSION['success']='โพสต์เรียบร้อยแล้ว <a href="post_own.php" class="font-semibold underline hover:text-green-800"> คลิกที่นี่ </a>เพื่อดูโพสต์';
                header("location: post_form.php");

            } else{
                $_SESSION['error']="มีบางอย่างผิดพลาด";
                header("location: post_form.php");
            }         
        }            
    }
?>