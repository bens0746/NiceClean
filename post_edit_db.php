<?php

    session_start();
    require_once 'config/db.php';


    if (isset($_POST['update_post'])) {
        $post_id = $_POST['post_id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $province = $_POST['province_id'];
        $amphure = $_POST['amphure_id'];
        $district = $_POST['district_id'];
        $img = $_FILES['img_title'];


        $img2 = $_POST['img2'];
        $upload = $_FILES['img_title']['name'];

        $package_id = $_POST['package_id'];
        $package_name = $_POST['package_name'];
        $package_detail = str_replace(PHP_EOL,"<br>",$_POST['package_detail']);
        $package_price = $_POST['package_price'];

        $package_id_ADD = $_POST['package_id_ADD'];
        $package_name_ADD = $_POST['package_name_ADD'];
        $package_detail_ADD = str_replace(PHP_EOL,"<br>",$_POST['package_detail_ADD']);
        $package_price_ADD = $_POST['package_price_ADD'];

        $packageADD = $_POST['package_ADD'];

        
        $dom = new \domdocument('1.0', 'UTF-8');
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));
        //ดึงเอาส่วนที่เป็นรูปภาพมาจาก summernote
        $images = $dom->getElementsByTagName('img');


        //ลูปรูปภาพและทำการเข้ารหัสรูปภาพ
        foreach($images as $k => $img_content){  
            if (preg_match_all('/\bdata:image\b/', $img_content->getAttribute('src'))) {
                $img_content->getElementsByTagName('img');

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
        }
        $content = $dom->saveHTML($dom->documentElement) . PHP_EOL . PHP_EOL;
        


        if ($upload != '') {
            $allow = array('jpg', 'jpeg', 'png');
            $extension = explode('.', $img['name']);
            $fileActExt = strtolower(end($extension));
            $fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
            $filePath = 'uploads/posts/'.$fileNew;

            if (in_array($fileActExt, $allow)) {
                if ($img['size'] > 0 && $img['error'] == 0) {
                move_uploaded_file($img['tmp_name'], $filePath);
                }
            }

        } else {
            $fileNew = $img2;
        }

        $stmt =$conn->prepare("UPDATE post  SET  title = :title,  content = :content, img_title = :img_title, province_id = :province_id, amphure_id = :amphure_id, district_id = :district_id WHERE post.post_id = :post_id");
        $stmt->bindParam(":post_id",$post_id);
        $stmt->bindParam(":title",$title);
        $stmt->bindParam(":content",$content);
        $stmt->bindParam(":img_title",$fileNew);
        $stmt->bindParam(":province_id",$province);
        $stmt->bindParam(":amphure_id",$amphure);
        $stmt->bindParam(":district_id",$district);
        $stmt->execute();



            if (isset($package_id)){

                foreach ($package_id as $key => $value) {
                        $stmt1 =$conn->prepare("UPDATE package SET  package_name = :package_name,  package_detail = :package_detail, package_price = :package_price WHERE package.package_id =:package_id");
                        $stmt1->bindParam(":package_id",$package_id[$key]);
                        $stmt1->bindParam(":package_name",$package_name[$key]);
                        $stmt1->bindParam(":package_detail",$package_detail[$key]);
                        $stmt1->bindParam(":package_price",$package_price[$key]);
                        $stmt1->execute();

                }
            }

            if (isset($packageADD)){

                foreach ($package_name_ADD as $key => $value) {
                        $stmt2 =$conn->prepare("INSERT INTO package(package_name, package_detail, package_price, post_id) 
                                        VALUES (:package_name, :package_detail, :package_price, :post_id)");
                        $stmt2->bindParam(":package_name",$package_name_ADD[$key]);
                        $stmt2->bindParam(":package_detail",$package_detail_ADD[$key]);
                        $stmt2->bindParam(":package_price",$package_price_ADD[$key]);
                        $stmt2->bindParam(":post_id",$post_id);
                        $stmt2->execute();
                }            
            }

        if ($stmt and $stmt1) {
            $_SESSION['success'] = "แก้ไขสำเร็จแล้ว";
            header("location: post_edit.php?post_id=$post_id ");
        } else {
            $_SESSION['error'] = "แก้ไขไม่สำเร็จ!!!";
            header("location: post_edit.php?post_id=$post_id ");
        }
    }
?>