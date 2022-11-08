<?php 
    session_start();
    require_once "config/db.php";

      if($_GET['post_id']){
        $post_id = $_GET['post_id'];
        $stmt = $conn->prepare("SELECT * FROM post WHERE post_id = $post_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }


    if (!empty($_POST['orderDate'])) {
        if (isset($_POST['order'])) {
          $dateOrder = $_POST['orderDate'];
          $package_id = $_POST['package_id'];
      }
    }else {
      echo '<script>alert("กรุณาเลือกวันที่จอง");</script>';
      echo '<script> 
              window.location.href="post_detail.php?post_id='.$post_id.'";
            </script>';
    }

    
    
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Confirm | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />

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
              <h1 class="text-4xl font-semibold text-white">ยืนยันการจอง</h1>
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

    <?php

          $sqlSelectDate = $conn->prepare("SELECT order_start FROM orders WHERE orders.post_id =$post_id AND orders.order_start = '".$dateOrder."' AND status=0;");
          $sqlSelectDate->execute();
          $sqlDate = $sqlSelectDate->fetch(PDO::FETCH_ASSOC);

          $dateOrder1 = $dateOrder;
        // เช็ควันซ้ำกัน
          if ($dateOrder1 = $sqlDate) {
            echo '<script>alert("วันที่ท่านเลือกมีคนจองแล้ว\nกรุณาเลือกวันใหม่อีกครั้ง");</script>';
            echo '<script> 
                    window.location.href="post_detail.php?post_id='.$post_id.'";
                  </script>';
          }
          
    ?>
    <?php 
      $sqlSelectq = $conn->prepare("SELECT * FROM post,users,package WHERE post.user_id=users.user_id AND post.post_id='".$_GET['post_id']."' AND package.package_id =$package_id");
      $sqlSelectq->execute();
      $sqlSelectRow = $sqlSelectq->fetch(PDO::FETCH_ASSOC);
    ?>
    <section class="bg-[#F4F7FF] py-14 lg:py-20">
      <div class="container">
          <div class="bg-white sm:max-w-full max-w-md rounded overflow-hidden shadow-lg">
              <div class="text-center p-6  border-b">
                  <img class="h-24 w-24 rounded-lg mx-auto" src="uploads/posts/<?php echo $sqlSelectRow['img_title']; ?>" alt="post_img" />
                  <p class="pt-2 text-lg font-semibold">
                  <?php echo $sqlSelectRow['title']; ?>
                  </p>
              </div>
          <div class="border-b">
              <!-- First list item -->
              <div class="px-6 py-3 hover:bg-gray-200 flex">
                  <div class="pl-3">
                      <p class="text-xl font-semibold">
                      แพ็กเกจ
                      </p>
                      <p class="text-lg text-gray-600">
                      ชื่อแพ็กเกจ: <?php echo $sqlSelectRow['package_name'] ?>
                      </p>
                      <p class="text-lg text-gray-600">
                      ราคา: <?php echo $sqlSelectRow['package_price'] ?>
                      </p>
                  </div>
              </div>
          </div>
          <div class="border-b">
              <!-- First list item -->
          <form action="order_insert.php" method="post">
              <div class="px-6 py-3 hover:bg-gray-200">
                  <div class="pl-3">
                      <p class="text-xl font-semibold">
                      วันนัด
                      </p>
                      <p class="text-lg text-gray-600">
                      วันที่: <?php echo $dateOrder; ?>
                      </p>
                      <p class="text-xl font-semibold">
                      หมายเหตุ:<textarea id="message" name="message" rows="4" class="w-full rounded-md border bg-[#FCFDFE] py-3 px-3 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                              placeholder="เช่น ให้มาเวลา 08.00น หรือ ให้โทรมาก่อน"></textarea>
                      </p>
                  </div>
              </div>
          </div>
          <div class="border-b">
              <!-- First list item -->
              <div class="px-6 py-3 hover:bg-gray-200">
                  <div class="pl-3">
                      <p class="text-xl font-semibold">
                      เลือกสถานที่ดำเนินงาน
                      </p>
                      <div id="map" style="width:100%; height:50vh;"></div>
                      <input type="text" id="lat" name="lat" hidden/>
                      <input type="text" id="lng" name="lng" hidden/>
                  </div>
              </div>
          </div>
          <div class="px-6 py-4 text-center">
            <input type="hidden" value="<?php echo $sqlSelectRow['post_id']; ?>" required name="post_id">
            <input type="hidden" value="<?php echo $sqlSelectRow['user_id']; ?>" required name="cleaner_id">
            <input type="hidden" value="<?php echo $dateOrder; ?>" required name="orderStart">
            <input type="hidden" value="<?php echo $package_id; ?>" required name="package_id">
              <button type="submit"
                name="order_cf"
                class=" bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-full">
                ยืนยัน
              </button> 
              <button type="button" onclick="location.href='post_detail.php?post_id=<?php echo $sqlSelectRow['post_id']; ?>'" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-full">
                ยกเลิก
              </button>
          </div>
        </form>
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
        class="mt-[6px] h-3 w-3 rotate-45 border-t border-l border-white"
      ></span>
    </a>
    <!-- ====== Back To Top End -->

    <!-- ====== All Scripts -->
    <script src="assets/js/main.js"></script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcAMUSwndFdLNDIfXHOjXp8JcjSdPY_O0&callback=initMap"></script>
    <script>
        function initMap(){
          
        var map=new google.maps.Map(document.getElementById('map'),{
            scrollwheel:true,
            zoom:13,
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
      if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function (position) {
            initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
            map.setCenter(initialLocation);
        });
      }
        
    }
    </script>
  </body>
</html>
