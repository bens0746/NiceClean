<?php 
    session_start();
    require_once "config/db.php";

    if($_GET['order_id']){
        $order_id = $_GET['order_id'];

        $stmt = $conn->prepare("
        SELECT post.post_id, post.title, post.img_title, package.package_name,package.package_price, orders.customer_id, orders.order_id, orders.order_start, orders.message, orders.confirm, orders.status, orders.lat, orders.lng
        FROM orders,post,package
        WHERE orders.order_id =$order_id AND orders.post_id = post.post_id AND orders.package_id = package.package_id");

        $stmt->execute();
        $rowEdit = $stmt->fetch(PDO::FETCH_ASSOC);

        if($rowEdit ['customer_id'] != $_SESSION['user_login'] ){
          echo "<script>alert('ไม่ใช่ออเดอร์ของคุณ');window.location='mycalender.php';</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>แก้ไขออเดอร์ | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="assets/css/mobiscroll.jquery.min.css">
    <script src="assets/js/mobiscroll.jquery.min.js"></script>
    
    <!-- ==== WOW JS ==== -->
    <script src="assets/js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>
  </head>
  <body>
    <!-- ====== Header Start ====== -->
    <?php include("includes/navbar_role_check.php") ?>
    <!-- ====== Header End ====== -->

    <!-- ====== Banner Section Start -->
    <div
      class="relative z-10 overflow-hidden bg-primary pt-[120px] pb-[100px] md:pt-[130px] lg:pt-[160px]"
    >
      <div class="container">
        <div class="-mx-4 flex flex-wrap items-center">
          <div class="w-full px-4">
            <div class="text-center">
              <h1 class="text-4xl font-semibold text-white">แก้ไขออเดอร์</h1>
            </div>
          </div>
        </div>
      </div>
      <div>
        <span class="absolute top-0 left-0 z-[-1]">
          <svg
            width="495"
            height="470"
            viewBox="0 0 495 470"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle
              cx="55"
              cy="442"
              r="138"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="50"
            />
            <circle
              cx="446"
              r="39"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="20"
            />
            <path
              d="M245.406 137.609L233.985 94.9852L276.609 106.406L245.406 137.609Z"
              stroke="white"
              stroke-opacity="0.08"
              stroke-width="12"
            />
          </svg>
        </span>
        <span class="absolute top-0 right-0 z-[-1]">
          <svg
            width="493"
            height="470"
            viewBox="0 0 493 470"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <circle
              cx="462"
              cy="5"
              r="138"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="50"
            />
            <circle
              cx="49"
              cy="470"
              r="39"
              stroke="white"
              stroke-opacity="0.04"
              stroke-width="20"
            />
            <path
              d="M222.393 226.701L272.808 213.192L259.299 263.607L222.393 226.701Z"
              stroke="white"
              stroke-opacity="0.06"
              stroke-width="13"
            />
          </svg>
        </span>
      </div>
      <div class="custom-shape-divider-bottom-1664647965">
          <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
              <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
          </svg>
      </div>
    </div>
    <!-- ====== Banner Section End -->

    <!-- ====== Forms Section Start -->
    <section class="bg-[#F4F7FF] py-14 lg:py-20">
      <div class="container">
        <div class="-mx-4 flex flex-wrap">
          <div class="w-full px-4">
            <!-- ====== Contact Start ====== -->
            <div>
                <div class="bg-white sm:max-w-full max-w-md rounded overflow-hidden shadow-lg">
                    <div class="text-center p-6  border-b">
                        <img class="h-24 w-24 rounded-full mx-auto" src="uploads/posts/<?php echo $rowEdit['img_title']; ?>" alt="post_img" />
                        <p class="pt-2 text-lg font-semibold">
                            <?php echo $rowEdit['title']?>
                        </p>
                        <?php if(isset($_SESSION['error'])) { ?>
                            <div class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                                <?php
                                echo $_SESSION['error'];
                                unset($_SESSION['error']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['success'])) { ?>
                            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                                <?php
                                echo $_SESSION['success'];
                                unset($_SESSION['success']);
                                ?>
                            </div>
                        <?php } ?>
                        <?php if(isset($_SESSION['warning'])) { ?>
                            <div class="p-4 mb-4 text-sm text-yellow-700 bg-yellow-100 rounded-lg dark:bg-yellow-200 dark:text-yellow-800" role="alert">
                                <?php
                                echo $_SESSION['warning'];
                                unset($_SESSION['warning']);
                                ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="border-b">
                        <!-- First list item -->
                        <div class="px-6 py-3 hover:bg-gray-200 flex">
                            <div class="pl-3">
                                <p class="text-xl font-semibold">
                                แพ็กเกจ 
                                </p>
                                <p class="text-lg text-gray-600">
                                ชื่อแพ็กเกจ: <?php echo $rowEdit['package_name']?>
                                </p>
                                <p class="text-lg text-gray-600">
                                ราคา: <?php echo $rowEdit['package_price']?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="border-b">
                        <!-- First list item -->
                        <div class="px-6 py-3 hover:bg-gray-200 flex">
                            <div class="pl-3">
                                <p class="text-xl font-semibold">
                                วันนัด
                                </p>
                                <p class="text-lg text-gray-600">
                                วันที่: <?php echo $rowEdit['order_start']?>
                                </p>
                                <p class="text-lg text-gray-600">
                                หมายเหตุ: <?php echo $rowEdit['message']?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <form action="order_edit_db.php" method="post">
                    <div class="border-b">
                        <!-- First list item -->
                        <div class="px-6 py-3 hover:bg-gray-200 flex">
                            <div class="pl-3">
                                <p class="text-xl font-semibold">
                                เลื่อนวันนัด
                                </p>
                                <label class="m-5 p-1">
                                    <input readonly id="picker" style="text-align:center" name="orderDateNew" mbsc-input placeholder="เลือกวันที่..."/>
                                </label> 
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="<?php echo $rowEdit['order_start']?>" required name="orderDateOld">
                    <div class="border-b">
                        <!-- First list item -->
                        <div class="px-6 py-3 hover:bg-gray-200 flex">
                            <div class="pl-3 w-full">
                                <p class="text-xl font-semibold">
                                เหตุผลถ้ามีโปรดระบุ
                                </p>
                                <textarea name="messageNew" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="หมายเหตุ"><?php echo $rowEdit['message']?></textarea> 
                            </div>
                        </div>
                    </div>
                    <div class="border-b">
                      <!-- First list item -->
                      <div class="px-6 py-3 hover:bg-gray-200">
                          <div class="pl-3">
                              <p class="text-xl font-semibold">
                              เลือกสถานที่ดำเนินงาน 
                                <a class="text-sm text-gray-600" onClick="window.location.reload();">
                                  ( ถ้าแผนที่ไม่แสดง กดที่นี่เพิ่อรีเฟรช )
                                </a>
                              </p>
                              <div id="map" style="width:100%; height:50vh;"></div>
                              <input type="text" id="lat" value="<?php echo $rowEdit['lat']; ?>" name="lat" hidden/>
                              <input type="text" id="lng" value="<?php echo $rowEdit['lng']; ?>" name="lng" hidden/>
                          </div>
                      </div>
                    </div>
                    <input type="hidden" value="<?php echo $rowEdit['order_id']; ?>" required name="order_id">
                    <input type="hidden" value="<?php echo $rowEdit['confirm']; ?>" required name="confirm">
                    <div class="border-b">
                        <div class="px-6 py-4 text-center">
                            <button type="submit" name="order_edit" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-yellow-400 text-white">
                            แก้ไขออเดอร์
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!-- ====== Contact End ====== -->
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Forms Section End -->

    <!-- ====== Footer Section Start -->
    <?php include("includes/footer.php") ?>
    <!-- ====== Footer Section End -->

    <!-- ====== Back To Top Start -->
    <a
      href="javascript:void(0)"
      class="back-to-top fixed bottom-8 right-8 left-auto z-[999] hidden h-10 w-10 items-center justify-center rounded-md bg-primary text-white shadow-md transition duration-300 ease-in-out hover:bg-dark"
    >
      <span
        class="mt-[6px] h-3 w-3 rotate-45 border-t border-l border-white">
      </span>
    </a>
    <!-- ====== Back To Top End -->

    <!-- ====== All Scripts -->
    <script src="assets/js/main.js"></script>
    <?php


      if (isset($_SESSION['user_login'])){
          $statement = $conn->prepare("SELECT order_start FROM orders WHERE orders.post_id ='".$rowEdit['post_id']."' AND status=0 
          UNION
          SELECT exclusionday.ex_day FROM exclusionday WHERE post_id ='".$rowEdit['post_id']."';");
          $statement-> execute();
          $result = $statement->fetchAll(PDO::FETCH_ASSOC);
      
          // เช็คว่ามีวันจองหรือไม่มี
          if(!empty($result)){
                  /* fetch object array */
                foreach($result as $obj){
                  $json_invalid[] = array(
                      'start' => $obj['order_start'],
                  );
              }

              foreach($result as $obj){
                $json_labels[] = array(
                    'date' => $obj['order_start'],
                    'textColor' => '#4B5CC4',
                    'text'=> 'วันที่จอง',
                );
            }

              foreach($result as $obj){
                $json_colors[] = array(
                    'date' => $obj['order_start'],
                    'highlight' => '#4B5CC4',
                );
            }

            $inv = json_encode($json_invalid);
            $lab = json_encode($json_labels);
            $col = json_encode($json_colors);

          }else{
            $inv = json_encode('');
            $lab = json_encode('');
            $col = json_encode('');
          }
      }

      
    ?>
    <script>
      mobiscroll.setOptions({
          locale: mobiscroll.localeTh,         // Specify language like: locale: mobiscroll.localePl or omit setting to use default
          theme: 'ios',                        // Specify theme like: theme: 'ios' or omit setting to use default
          themeVariant: 'light'            // More info about themeVariant: https://docs.mobiscroll.com/5-18-2/range#opt-themeVariant
      });
   
      // 'YYYY-MM-DD' 

      $(function () {
          let invDate = <?= $inv ?>;
          let labDate = <?= $lab ?>;
          let colDate = <?= $col ?>;
          let toDay = Date.now();
          $("[id='picker']").mobiscroll().datepicker({
              controls: ['calendar'],
              dateFormat: 'YYYY-MM-DD',
              display: 'anchored',
              touchUi: true,
              buttons: [{
                  text: 'ปิด',
                  handler: 'cancel',
              }],
              min: new Date(toDay),
              showOuterDays: true,
              invalid: invDate,
              labels: labDate,
              colors: colDate,
          });
      })
    </script>
    
    <!-- GOOGLE MAP -->

    <?php
        $stmt = $conn->prepare("

        SELECT orders.lat, orders.lng
        FROM orders,users,post,package
        WHERE orders.order_id ='".$_GET['order_id']."' AND orders.cleaner_id = users.user_id AND orders.post_id = post.post_id AND orders.package_id = package.package_id");
        
        $stmt->execute();
        $rowLatLng = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcAMUSwndFdLNDIfXHOjXp8JcjSdPY_O0&callback=initMap"></script>
    <script>

    var latDB = <?php echo json_encode($rowLatLng['lat']); ?>;
    var lngDB = <?php echo json_encode($rowLatLng['lng']); ?>;

    function initMap() {
            var map = new google.maps.Map(document.getElementById('map'),{
                    center: new google.maps.LatLng(latDB,lngDB),
                    scrollwheel: true,
                    zoom:15,
                    mapTypeId:google.maps.MapTypeId.HYBRID
                });
                // Marker
                var marker;
                function placeMarker(location) {
                  if ( marker ) {
                    marker.setPosition(location);
                  } else {
                    marker = new google.maps.Marker({
                      position: location,
                      map: map,
                      draggable: true,
                      title:"สถานที่ดำเนินงาน"
                    });
                  }
                }

                // ฟังก์ชั่นคลิก Main
                google.maps.event.addListener(map, 'click', function(event) {
                  placeMarker(event.latLng);

                // เก็บค่า lat,lng
                map.panTo(event.latLng);
                    document.getElementById("lat").value=event.latLng.lat(); 
                    document.getElementById("lng").value=event.latLng.lng();

                // แสดง info บน marker
                var info=new google.maps.InfoWindow({
                    content: '<div style="font-size:15px">สถานที่ดำเนินงาน</div>'
                });
                // คลิกเพื่อแสดง info บน marker
                    google.maps.event.addListener(marker,'click',function(){
                      info.open(map,marker);
                });
                // แสดง lat,lng
                    google.maps.event.addListener(marker,'dragend',function(){
                      document.getElementById('lat').value=marker.getPosition('').lat();
                      document.getElementById('lng').value=marker.getPosition('').lng();
                      alert(lat+" "+ lng);
                });

              });

            // Marker OLD
            var marker = new google.maps.Marker({
                position: new google.maps.LatLng(latDB,lngDB),
                map: map,
                draggable: true,
                title:"สถานที่ดำเนินงาน"
                });

            }
    </script>
  </body>
</html>
