<?php 
    session_start();
    require_once "config/db.php";
    include("includes/check_login.php");

    if (!isset($_SESSION['cleaner_login'])) {
        $_SESSION['error'] = 'กรุณาเข้าสู่ระบบ!';
        header("location: signin.php");
      }
  
      if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $getUser = $conn->prepare("SELECT user_id FROM post WHERE post.post_id = $post_id;");
        $getUser->execute();
        $getUser_id = $getUser->fetch(PDO::FETCH_ASSOC);
  
        if ($getUser_id['user_id'] != $cleaner_id){
          $_SESSION['error'] = 'ไม่ใช่โพสต์ของคุณ!';
          header("location: post_own.php");
        }
      }

?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>วันหยุด | NiceClean</title>
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

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="assets/css/mobiscroll.jquery.min.css">
    <script src="assets/js/mobiscroll.jquery.min.js"></script>

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
              <h1 class="text-4xl font-semibold text-white">วันหยุด</h1>
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

    <!-- คิวรี่ post_id -->
    <?php      
    $sqlSelectq = $conn->prepare("SELECT post_id,img_title,title FROM post,users WHERE post.user_id=users.user_id AND post.post_id='".$_GET['post_id']."'");
    $sqlSelectq->execute();
    $sqlSelectRow = $sqlSelectq->fetch(PDO::FETCH_ASSOC);
    ?>
    <section class="bg-[#F4F7FF] py-14 lg:py-20">
      <div class="container">
        <div class="-mx-4 flex flex-wrap bg-white p-5 rounded-xl shadow-xl">
          <div class="w-3/4 px-4 mx-auto">
          <form action="post_exday_db.php" method="post" enctype="multipart/form-data">
            <?php if(isset($_SESSION['success'])) { ?>
                    <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800" role="alert">
                        <?php
                        echo $_SESSION['success'];
                        unset($_SESSION['success']);
                        ?>
                    </div>
            <?php } ?>
            <?php if(isset($_SESSION['error'])) { ?>
                    <div class="flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                        <?php
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                        ?>
                    </div>
            <?php } ?>
            <a
              class="mb-8 text-2xl font-bold leading-snug text-primary sm:text-2xl sm:leading-snug md:text-[40px] md:leading-snug"
              >
              <?php echo $sqlSelectRow['title']?>
            </a>
            <div class="mb-6">
                <img loading="lazy" width="30%" src="uploads/posts/<?php echo $sqlSelectRow['img_title']; ?>" alt="img_post"
                class="max-w-full h-auto rounded-lg mx-auto"
                >
            </div>
            <input type="hidden" readonly value="<?php echo $sqlSelectRow['post_id']; ?>" name="post_id">
                <input id="calendar" type="hidden" name="exDate"/>
              <input
                type="submit"
                name="post_exday"
                value="เพิ่มวันหยุด"
                class="border-primary w-full mt-2 cursor-pointer rounded-md border bg-primary py-3 px-5 text-base text-white transition duration-300 ease-in-out hover:shadow-md"
              />
              <input
                type="submit"
                name="delete_post_exday"
                value="ลบวันหยุด"
                class="border-red-600 w-full mt-2 cursor-pointer rounded-md border bg-red-600 py-3 px-5 text-base text-white transition duration-300 ease-in-out hover:shadow-md"
              />
              <button type="button" onClick="location.href='post_own.php'" class="bordder-primary w-full mt-10 cursor-pointer rounded-md border bg-gray-400 py-3 px-5 text-base text-white transition duration-300 ease-in-out hover:shadow-md">
                ย้อนกลับ
              </button>
          </form>
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

    <?php
      if (isset($_SESSION['cleaner_login'])){
          $statement = $conn->prepare("SELECT order_start,ex_day FROM orders LEFT OUTER JOIN exclusionday ON orders.post_id = exclusionday.post_id WHERE orders.post_id =$post_id
                                        UNION
                                        SELECT order_start,ex_day FROM orders RIGHT OUTER JOIN exclusionday ON orders.post_id = exclusionday.post_id WHERE exclusionday.post_id=$post_id;");
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
                    'textColor' => '#f8b042',
                    'text'=> 'จองแล้ว',
                );
            }

              foreach($result as $obj){

                $json_colors[] = array(
                  'date' => $obj['ex_day'],
                  'highlight' => '#FF2A2A',
              );
                $json_colors[] = array(
                  'date' => $obj['order_start'],
                  'highlight' => '#f8b042',
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

    <script src="assets/js/main.js"></script>
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
          $('#calendar').mobiscroll().datepicker({
              controls: ['calendar'],
              display: 'inline',
              dateFormat: 'YYYY-MM-DD',
              min: new Date(toDay),
              showOuterDays: true,
              selectMultiple: true,
              invalid: invDate,
              labels: labDate,
              colors: colDate,
          });
      })

    </script>
  </body>
</html>