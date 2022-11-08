<?php 
    session_start();
    require_once "config/db.php";

?>
<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>โพสต์ | NiceClean</title>
    <link
      rel="shortcut icon"
      href="assets/images/favicon.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- ==== WOW JS ==== -->
    <script src="assets/js/wow.min.js"></script>
    <script>
      new WOW().init();
    </script>

  <!-- Ajax filter -->
  <!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $("#provincedata").load("post_grids_all.php");
      $("#province_dropdown").change(function(){
        var selected=$(this).val();
        $("#provincedata").load("post_search_filter.php",{selected_province: selected});
      });
    });
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
              <h1 class="text-4xl font-semibold text-white">โพสต์</h1>
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
      <div class="custom-shape-divider-bottom-1664647808">
          <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
              <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
          </svg>
      </div>
    </div>
    <!-- ====== Banner Section End -->

    <!-- ====== Blog Section Start -->
    <section class="pt-20 pb-10 lg:pt-[40px] lg:pb-20">
      <div class="container mx-auto">
        <div>
          <div class="relative inline-flex self-center">
              <svg class="text-white bg-primary absolute top-0 right-0 m-2 pointer-events-none p-2 rounded" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="40px" height="40px" viewBox="0 0 38 22" version="1.1">
                  <g id="ZahnhelferDE—Design" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                      <g id="ZahnhelferDE–Icon&amp;Asset-Download" transform="translate(-539.000000, -199.000000)" fill="#ffffff" fill-rule="nonzero">
                          <g id="Icon-/-ArrowRight-Copy-2" transform="translate(538.000000, 183.521208)">
                              <polygon id="Path-Copy" transform="translate(20.000000, 18.384776) rotate(135.000000) translate(-20.000000, -18.384776) " points="33 5.38477631 33 31.3847763 29 31.3847763 28.999 9.38379168 7 9.38477631 7 5.38477631"/>
                          </g>
                      </g>
                  </g>
              </svg>
              <form method="post" class="form-horizontal">
                <select name="provinces" id="province_dropdown" class="text-xl font-bold rounded border-2 text-gray-600 h-14 w-64 pl-5 pr-10 bg-white hover:border-primary focus:outline-none appearance-none">
                      <option value="">เลือกจังหวัด</option>
                    <?php      
                      $queryProvinces  = $conn->prepare("SELECT * FROM provinces");
                      $queryProvinces ->execute();
                      $query = $queryProvinces->fetchAll(PDO::FETCH_ASSOC);
                    ?>
                    <?php foreach($query as $q){ ?>
                      <option value="<?=$q['id']?>"><?=$q['name_th']?></option>
                    <?php }?>
                </select>
              </form>
          </div>
        </div>
        <div id="provincedata" class="flex flex-wrap -mx-4">
          
        </div>
      </div>
    </section>
    <!-- ====== Blog Section End -->

    <!-- Messenger Chat Plugin Code -->
    <div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

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

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "101757886069767");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v15.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/th_TH/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
  </body>
</html>
