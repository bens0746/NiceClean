<?php 
    session_start();
    require_once "config/db.php";

    if (isset($_POST['review_form'])) {

      $sqlDateEndCheck = $conn->prepare("SELECT orders.order_end, orders.status FROM orders WHERE orders.order_id ='".$_POST['order_id']."';");
      $sqlDateEndCheck->execute();
      $rowDateEndCheck =  $sqlDateEndCheck->fetch(PDO::FETCH_ASSOC);

      if ($rowDateEndCheck['status'] == 1){
          $rating = $_POST['rating'];
          $comment = str_replace(PHP_EOL,"<br>",$_POST['comment']);
          $post_id = $_POST['post_id'];
          $user_id = $_POST['user_id'];
          $order_id = $_POST['order_id'];
          $status = 2;

          $stmt =$conn->prepare("INSERT INTO reviews(rating, comment, post_id, user_id, order_id) 
                                VALUES (:rating, :comment, :post_id, :user_id, :order_id)");
                          
          $stmt->bindParam(":rating",$rating);
          $stmt->bindParam(":comment",$comment);
          $stmt->bindParam(":post_id",$post_id);
          $stmt->bindParam(":user_id",$user_id);
          $stmt->bindParam(":order_id",$order_id);
          $stmt->execute();

          $stmt1 =$conn->prepare("UPDATE orders  SET  status = :status WHERE orders.order_id = $order_id");
          $stmt1->bindParam(":status",$status);
          $stmt1->execute();

          if ($stmt){
              unset($stmt);
              header("location: mycalender.php");
          }
      }else{
        echo "<script>alert('คุณได้รีวิวไปแล้ว');window.location='mycalender.php';</script>";
      }


       
    }

    if (isset($_GET['order_id'])){
      $order_id = $_GET['order_id'];

        $sqlOrder = $conn->prepare("SELECT post.post_id, post.title, post.img_title, package.package_name, orders.customer_id FROM post,package,orders WHERE post.post_id = orders.post_id AND orders.order_id =$order_id AND package.package_id = orders.package_id AND orders.customer_id ='".$_SESSION['user_login']."';");
        $sqlOrder->execute();
        $rowOrder = $sqlOrder->fetch(PDO::FETCH_ASSOC);

        if($rowOrder['customer_id'] != $_SESSION['user_login'] ){
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
    <title>รีวิว | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="./assets/css/rating.css">
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
              <h1 class="text-4xl font-semibold text-white">Review</h1>
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
    </div>
    <!-- ====== Banner Section End -->

    <!-- ====== Forms Section Start -->
    <section class="bg-[#F4F7FF] py-14 lg:py-20">
      <div class="container">
        <div class="-mx-4 flex flex-wrap">
          <div class="w-full px-4">
            <div class="mb-4">
              <img src="uploads/posts/<?php echo $rowOrder['img_title']; ?>" class="mx-auto max-w-xs h-auto rounded-lg" alt="post_img">
              <p class="text-center text-2xl">
                <?php echo $rowOrder['title']?>
              </p>
              <p class="text-center text-2xl">
                แพ็คเกจ: <?php echo $rowOrder['package_name']?>
              </p>
            </div>
            <form action="review.php" method="post" enctype="multipart/form-data">
                <h1>คะแนนความพึงพอใจ</h1>
                <fieldset class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required/><label class = "full" for="star5" title="5 stars"></label>
                    <input type="radio" id="star4" name="rating" value="4" required/><label class = "full" for="star4" title="4 stars"></label>
                    <input type="radio" id="star3" name="rating" value="3" required/><label class = "full" for="star3" title="3 stars"></label>
                    <input type="radio" id="star2" name="rating" value="2" required/><label class = "full" for="star2" title="2 stars"></label>
                    <input type="radio" id="star1" name="rating" value="1" required/><label class = "full" for="star1" title="1 star"></label>
                </fieldset>
                <textarea name="comment"
                placeholder="รายละเอียด"
                class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                rows="10"></textarea>

                <input type="text" hidden value='<?php echo $rowOrder['post_id']?>' name="post_id">
                <input type="text" hidden value='<?php echo $_SESSION['user_login']?>' name="user_id">
                <input type="text" hidden value='<?php echo $order_id?>' name="order_id">
                <input
                    type="submit"
                    name="review_form"
                    value="ยืนยัน"
                    class="bordder-primary w-full text-center cursor-pointer rounded-md border bg-green-500 py-3 px-5 text-base text-white transition duration-300 ease-in-out hover:shadow-md"
                />
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
    <script src="assets/js/main.js"></script>
  </body>
</html>
