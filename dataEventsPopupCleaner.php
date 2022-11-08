<?php

if($_GET['order_id']){
    $stmt = $conn->prepare("
    
    SELECT users.user_id, users.img, users.firstname, users.lastname, users.email, users.phone, users.lineID, post.title, post.img_title, package.package_name,package.package_price, orders.order_id, orders.order_start, orders.order_end, orders.message, orders.confirm, orders.status, orders.lat , orders.lng
    FROM orders,users,post,package
    WHERE orders.order_id ='".$_GET['order_id']."' AND orders.customer_id = users.user_id AND orders.post_id = post.post_id AND orders.package_id = package.package_id");

    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $deletestmt = $conn->query("DELETE FROM orders WHERE order_id = $delete_id");
    $deletestmt->execute();

    if ($deletestmt) {
        echo "<script>alert('ลบออเดอร์แล้ว');</script>";
        header("location: deleteData.html");
    }               
}

?>
<!-- ====== Contact Start ====== -->
<div>
    <div class="bg-white sm:max-w-full max-w-md rounded overflow-hidden shadow-lg">
        <div class="text-center p-6  border-b">
            <img class="h-24 w-24 rounded-full mx-auto" src="uploads/profiles/<?php echo $row['img']; ?>" alt="profile" />
            <p class="pt-2 text-lg font-semibold">
            <?php echo $row['firstname']?> <?php echo $row['lastname']?>
            </p>
            <p class="text-sm text-gray-600">
            อีเมล: <?php echo $row['email']?>
            </p>
            <p class="text-sm text-gray-600">
            เบอร์โทร: <?php echo $row['phone']?>
            </p>
            <p class="text-sm text-gray-600">
            LINE ID: <?php echo $row['lineID']?>
            </p>
            <div class="mt-5">
            <a href="profile.php?user=<?php echo $row['user_id']?>" target="_blank" class="border rounded-full py-2 px-4 text-xs font-semibold text-gray-700">ดูโปรไฟล์</a>
            </div>
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
        <img class="h-12 w-12 rounded-xl" src="uploads/posts/<?php echo $row['img_title']; ?>" alt="profile" />
            <div class="pl-3">
                <p class="text-xl font-semibold">
                โพสต์
                </p>
                <p class="text-lg text-gray-600">
                <?php echo $row['title']?>
                </p>
            </div>
        </div>
    </div>
    <div class="border-b">
        <!-- First list item -->
        <div class="px-6 py-3 hover:bg-gray-200 flex">
            <div class="pl-3">
                <p class="text-xl font-semibold">
                แพ็กเกจ
                </p>
                <p class="text-lg text-gray-600">
                ชื่อแพ็กเกจ: <?php echo $row['package_name']?>
                </p>
                <p class="text-lg text-gray-600">
                ราคา: <?php echo $row['package_price']?>
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
                วันที่: <?php echo $row['order_start']?>
                </p>
                <p class="text-lg text-gray-600">
                หมายเหตุ: <?php echo $row['message']?>
                </p>
            </div>
        </div>
    </div>
    <?php if(isset($row['order_end'])){ ?>
        <div class="border-b">
            <!-- First list item -->
            <div class="px-6 py-3 hover:bg-gray-200 flex">
                <div class="pl-3">
                    <p class="text-xl font-semibold">
                    วันที่เสร็จสิ้นงาน
                    </p>
                    <p class="text-lg text-gray-600">
                    วันที่: <?php echo $row['order_end']?>
                    </p>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="border-b">
        <!-- First list item -->
        <div class="px-6 py-3 hover:bg-gray-200">
            <div class="pl-3">
                <p class="text-xl font-semibold">
                สถานที่ดำเนินงาน
                </p>
                <a class="text-sm text-gray-600 cursor-pointer" onClick="window.location.reload();">
                    ( ถ้าแผนที่ไม่แสดง กดที่นี่เพิ่อรีเฟรช )
                </a>
                <div id="map" style="width:100%; height:50vh;"></div>
            </div>
        </div>
        <div class="flex flex-wrap justify-center m-3">
            <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $row['lat']?>%2C<?php echo $row['lng']?>" target="_blank">
                <img src="https://upload.wikimedia.org/wikipedia/commons/b/bd/Google_Maps_Logo_2020.svg" alt="" srcset="">
                <div class='text-xl font-mono font-bold pt-0.5 text-gray-500'>
                    ขอเส้นทาง
                </div>
            </a>
        </div>
    </div>

    <?php
        if ($row['confirm']== 1 and $row['status']==0){ ?>
        <?php
            $stmt = $conn->prepare("

            SELECT order_start_new, message_new, shift_id, lat_new, lng_new
            FROM orders,orders_shift
            WHERE orders.order_id ='".$_GET['order_id']."' AND orders_shift.order_id ='".$_GET['order_id']."'");
            
            $stmt->execute();
            $rowNew = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <div class="border-b">
        <!-- First list item -->
            <div class="px-6 py-3 bg-yellow-100 hover:bg-yellow-200 flex">
                <div class="pl-3">
                    <p class="text-xl font-semibold">
                    ขอเลื่อนนัด
                    </p>
                    <p class="text-lg text-gray-600">
                    วันที่: <?php echo $rowNew['order_start_new']?>
                    </p>
                    <p class="text-lg text-gray-600">
                    หมายเหตุ: <?php echo $rowNew['message_new']?>
                    </p>
                </div>
            </div>
        </div>
        <div class="border-b">
        <!-- First list item -->
            <div class="px-6 py-3 bg-yellow-100 hover:bg-yellow-200">
                <div class="pl-3">
                    <p class="text-xl font-semibold">
                    สถานที่ดำเนินงานใหม่
                    </p>
                    <div id="mapNew" style="width:100%; height:50vh;"></div>
                </div>
            </div>
            <div class="flex flex-wrap justify-center m-3">
                <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $rowNew['lat_new']?>%2C<?php echo $rowNew['lng_new']?>" target="_blank">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/bd/Google_Maps_Logo_2020.svg" alt="" srcset="">
                    <div class='text-xl font-mono font-bold pt-0.5 text-gray-500'>
                        ขอเส้นทาง
                    </div>
                </a>
            </div>
        </div>
    <?php } ?>

    <div class="border-b">
        <!-- ยืนยันออเดอร์ -->
    <?php

        if ($row['confirm']== 0 and $row['status']==0){?>

        <div class="px-6 py-4 text-center flex flex-wrap justify-center">
                <a data-id="<?php echo $row['order_id']?>" href="" class="accept-btn border rounded py-2 px-4 mx-1 text-lg font-semibold bg-green-400 text-white">
                ตกลงรับออเดอร์
                </a>
                <a data-id="<?php echo $row['order_id']; ?>" href="?delete=<?php echo $row['order_id']; ?>" class="delete-btn border rounded py-2 px-4 mx-1 text-lg font-semibold bg-red-500 text-white">
                ยกเลิกออเดอร์
                </a>
        </div>
        <!-- ยืนยันแก้ไข -->
    <?php } elseif ($row['confirm']== 1 and $row['status']==0){?>

        <div class="px-6 py-4 text-center flex flex-wrap justify-center">
            <a href="order_edit_db.php?cf=<?php echo $rowNew['shift_id']?>&order_id=<?php echo $row['order_id']?>" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-yellow-400 text-white">
            รับทราบ
            </a>
            <a  href="order_edit_db.php?cc=<?php echo $rowNew['shift_id']?>&order_id_cc=<?php echo $row['order_id']?>" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-red-500 text-white">
            ยกเลิกออเดอร์
            </a>
        </div>
        <!-- แก้ไขแล้ว -->
    <?php } elseif ($row['confirm']== 2 and $row['status']==0){?>

    <div class="px-6 py-4 text-center flex flex-wrap justify-center">
        <a data-id="<?php echo $row['order_id']?>" href="" class="finish-btn border rounded py-2 px-4 mx-1 text-lg font-semibold bg-primary text-white">
        เสร็จสิ้นงาน
        </a>
        <a data-id="<?php echo $row['order_id']; ?>" href="?delete=<?php echo $row['order_id']; ?>" class="delete-btn border rounded py-2 px-4 mx-1 text-lg font-semibold bg-red-500 text-white">
        ยกเลิกออเดอร์
        </a>
    </div>
            <!-- จบออเดอร์ -->
    <?php } elseif ($row['confirm']== 2 and $row['status']==1){?>

    <div class="px-6 py-4 text-center flex flex-wrap justify-center">
        <a href="#" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-primary text-white">
        เสร็จสิ้น
        </a>
        <a href="invoice.php?order_id=<?php echo $row['order_id']?>" target="_blank" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-green-500 text-white">
        ใบเสร็จ
        </a>
    </div>
        <!-- จบออเดอร์ + ให้คะแนนความพึ่งพอใจแล้ว -->
    <?php }else{?>
        
        <div class="px-6 py-4 text-center flex flex-wrap justify-center">
            <a href="#" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-primary text-white">
            ให้คะแนนความพึงพอใจแล้ว
            </a>
            <a href="invoice.php?order_id=<?php echo $row['order_id']?>" target="_blank" class="border rounded py-2 px-4 mx-1 text-lg font-semibold bg-green-500 text-white">
            ใบเสร็จ
            </a>
        </div>
    <?php }?>
    </div>
</div>
<!-- ====== Contact End ====== -->

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
      $('.delete-btn').click(function(e) {
          const orderId = $(this).data('id')
          e.preventDefault();
          deleteConfirm(orderId);
      })

      $('.accept-btn').click(function(e) {
          const orderId = $(this).data('id')
          e.preventDefault();
          acceptConfirm(orderId);
      })

      $('.finish-btn').click(function(e) {
          const orderId = $(this).data('id')
          e.preventDefault();
          finishConfirm(orderId);
      })

      function deleteConfirm(orderId) {
        Swal.fire({
          title: 'ยกเลิกออเดอร์',
          text: 'ทำการยืนยันเพื่อลบออเดอร์',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'ยืนยันการลบ',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          showLoaderOnConfirm: true,
          preConfirm: function(){
            return new Promise(function(resolve) {
              $.ajax({
                url: 'dataEventsPopup.php',
                type: 'GET',
                data: 'delete=' + orderId,
              })
              .done(function() {
                Swal.fire({
                  title: 'สำเร็จ',
                  text: 'ยกเลิกออเดอร์สำเร็จ',
                  icon: 'success'
                }).then(() => {
                  document.location.href = 'deleteData.html';
                })
              })
              .fail(function() {
                Swal.fire('แย่แล้ว', 'มีบางอย่างผิดพลาด กับ ajax', 'error')
                window.location.reload();
              })
            })
          }
        })
      }

      function acceptConfirm(orderId) {
        Swal.fire({
          title: 'ยอมรับออเดอร์',
          text: 'ทำการยืนยันเพื่อรับออเดอร์',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#4ADE80',
          confirmButtonText: 'ยืนยัน',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          showLoaderOnConfirm: true,
          preConfirm: function(){
            return new Promise(function(resolve) {
              $.ajax({
                url: 'dataEventsUpdate.php',
                type: 'GET',
                data: 'change2_order_id=' + orderId,
              })
              .done(function() {
                Swal.fire({
                  title: 'สำเร็จ',
                  text: 'ยืนยันออเดอร์สำเร็จ',
                  icon: 'success'
                }).then(() => {
                  document.location.href = 'dataEventsPopup.php?order_id=' + orderId;
                })
              })
              .fail(function() {
                Swal.fire('แย่แล้ว', 'มีบางอย่างผิดพลาด กับ ajax', 'error')
                window.location.reload();
              })
            })
          }
        })
      }


      function finishConfirm(orderId) {
        Swal.fire({
          title: 'เสร็จสิ้นงาน',
          text: 'ทำการยืนยันเพื่อเสร็จสิ้นงาน',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#4ADE80',
          confirmButtonText: 'ยืนยัน',
          cancelButtonColor: '#d33',
          cancelButtonText: 'ยกเลิก',
          showLoaderOnConfirm: true,
          preConfirm: function(){
            return new Promise(function(resolve) {
              $.ajax({
                url: 'dataEventsUpdate.php',
                type: 'GET',
                data: 'finish=' + orderId,
              })
              .done(function() {
                Swal.fire({
                  title: 'เย้',
                  text: 'งานเสร็จแล้ว',
                  icon: 'success'
                }).then(() => {
                  document.location.href = 'dataEventsPopup.php?order_id=' + orderId;
                })
              })
              .fail(function() {
                Swal.fire('แย่แล้ว', 'มีบางอย่างผิดพลาด กับ ajax', 'error')
                window.location.reload();
              })
            })
          }
        })
      }
    </script>

<!-- MAP ORDER -->
    <?php
        $stmt = $conn->prepare("

        SELECT orders.lat, orders.lng
        FROM orders,users,post,package
        WHERE orders.order_id ='".$_GET['order_id']."' AND orders.customer_id = users.user_id AND orders.post_id = post.post_id AND orders.package_id = package.package_id");
        
        $stmt->execute();
        $rowLatLng = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>

    <?php
        $stmt1 = $conn->prepare("

        SELECT orders_shift.lat_new, orders_shift.lng_new 
        FROM orders,orders_shift 
        WHERE orders.order_id ='".$_GET['order_id']."' AND orders_shift.order_id ='".$_GET['order_id']."';");
        
        $stmt1->execute();
        $rowLatLngNew = $stmt1->fetch(PDO::FETCH_ASSOC);
    ?>

    <script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcAMUSwndFdLNDIfXHOjXp8JcjSdPY_O0&callback=initMap"></script>
    <script type="text/javascript">
    
    
        function initMap() {
            <?php if($row['confirm']== 1 and $row['status']==0){ ?>

                var latDB = <?php echo json_encode($rowLatLng['lat']); ?>;
                var lngDB = <?php echo json_encode($rowLatLng['lng']); ?>;

                var latDBNew = <?php echo json_encode($rowLatLngNew['lat_new']); ?>;
                var lngDBNew = <?php echo json_encode($rowLatLngNew['lng_new']); ?>;

                var map = new google.maps.Map(document.getElementById('map'),{
                        center: new google.maps.LatLng(latDB,lngDB),
                        scrollwheel: true,
                        zoom:15,
                        mapTypeId:google.maps.MapTypeId.HYBRID
                    });
                    // Marker
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latDB,lngDB),
                    map: map,
                    draggable: true,
                    title:"สถานที่ดำเนินงาน"
                    });

                var mapNew = new google.maps.Map(document.getElementById('mapNew'),{
                        center: new google.maps.LatLng(latDBNew,lngDBNew),
                        scrollwheel: true,
                        zoom:15,
                        mapTypeId:google.maps.MapTypeId.HYBRID
                    });
                    // Marker
                var markerNew = new google.maps.Marker({
                    position: new google.maps.LatLng(latDBNew,lngDBNew),
                    map: mapNew,
                    draggable: true,
                    title:"สถานที่ดำเนินงานใหม่"
                    });
            <?php }else{ ?>

                var latDB = <?php echo json_encode($rowLatLng['lat']); ?>;
                var lngDB = <?php echo json_encode($rowLatLng['lng']); ?>;

                var map = new google.maps.Map(document.getElementById('map'),{
                        center: new google.maps.LatLng(latDB,lngDB),
                        scrollwheel: true,
                        zoom:15,
                        mapTypeId:google.maps.MapTypeId.HYBRID
                    });
                    // Marker
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(latDB,lngDB),
                    map: map,
                    draggable: true,
                    title:"สถานที่ดำเนินงาน"
                    });

                <?php } ?>

            }
    </script>

