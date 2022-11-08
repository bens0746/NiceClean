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

    if (isset($_GET['delete'])) {
      $delete_id = $_GET['delete'];
      $deletestmt = $conn->prepare("DELETE FROM package WHERE package_id = $delete_id");
      $deletestmt->execute();

      if ($deletestmt) {
          echo "<script>alert('Data has been deleted successfully');</script>";
          $_SESSION['success'] = "Data has been deleted succesfully";
          header("location:". $_SERVER['HTTP_REFERER']);
      }               
    }

?>

<!-- Query Post Data -->
<?php
  if (isset($_GET['post_id'])) {
          $post_id = $_GET['post_id'];
          $stmt = $conn->query("SELECT * ,provinces.name_th AS province_name ,amphures.name_th AS amphure_name ,districts.name_th AS district_name FROM post,users,provinces,amphures,districts WHERE post.post_id='".$post_id."' AND post.user_id=users.user_id AND post.province_id=provinces.id AND post.amphure_id=amphures.id AND post.district_id=districts.id;");
          $stmt->execute();
          $data = $stmt->fetch();
  }
?>

<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $data['title']; ?> | NiceClean</title>
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
    <!-- Summernote CSS - CDN Link --> 
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <!-- //Summernote CSS - CDN Link -->
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
              <h1 class="text-4xl font-semibold text-white">แก้ไขโพสต์</h1>
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
            <div
              class="wow fadeInUp relative mx-auto max-w-[1025px] overflow-hidden rounded-lg bg-white py-14 px-8 sm:px-12 md:px-[60px] shadow-lg"
              data-wow-delay=".15s"
            >
              <form action="post_edit_db.php" method="POST"  enctype="multipart/form-data">
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

              

                <div class="error-text"></div>

                <input type="hidden" readonly value="<?php echo $data['post_id']; ?>" name="post_id" required>
                <input type="hidden" value="<?php echo $data['img_title']; ?>"name="img2" required>
                

                <div class="mb-6">
                  <img loading="lazy" width="50%" src="uploads/posts/<?php echo $data['img_title']; ?>" id="previewImg" alt="" class="mx-auto mt-6">
                  <label for="img" class="text-xl mb-2 text-body-color">รูปปก</label>
                  <input
                    type="file" 
                    accept="image/*" 
                    id="imgInput"
                    name="img_title"
                    class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                  />
                  
                </div>
                <div class="mb-6 border-b-4 rounded-lg border-primary">
                <label for="title" class="text-xl mb-2 text-body-color">หัวข้อ</label>
                  <input
                    type="text"
                    value="<?php echo $data['title']; ?>"
                    name="title"
                    placeholder="หัวข้อโพสต์"
                    class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                    />
                </div>
                <div class="mb-6 content border-b-4 rounded-lg border-primary">
                <label for="content" class="text-xl mb-2 text-body-color ">รายละเอียด</label>
                  <textarea
                    id="your_summernote"
                    name="content"
                  >
                  <?php echo $data['content']; ?>
                    </textarea>
                </div>
                <div class="grid grid-cols-3 gap-4">
                  <?php      
                    $query  = $conn->prepare("SELECT * FROM provinces");
                    $query ->execute();
                  ?>
                  <div class="relative">
                      <select name="province_id" id="province" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                          <option value="<?php echo $data['province_id']; ?>"><?php echo $data['province_name']; ?></option>
                      <?php foreach($query as $q){ ?>
                          <option value="<?=$q['id']?>"><?=$q['name_th']?></option>
                      <?php }?>
                      </select>
                      <br>
                  </div>
                  <div class="relative">
                      <select name="amphure_id" id="amphure" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                          <option value="<?php echo $data['amphure_id']; ?>"><?php echo $data['amphure_name']; ?></option>
                      </select>
                      <br>
                  </div>
                  <div class="relative">
                      <select name="district_id" id="district" class="block appearance-none w-full bg-gray-100 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                          <option value="<?php echo $data['district_id']; ?>"><?php echo $data['district_name']; ?></option>
                      </select>
                      <br>
                  </div>
                </div>
                <?php 
                  $sqlPackage = $conn->query("SELECT * FROM package WHERE package.post_id ='".$data['post_id']."';");
                  $sqlPackage->execute();
                ?>
                <div class="mb-6 border px-3 py-3 bg-primary rounded-lg">
                  <p class="text-white text-center text-4xl">รายการแพ็คเกจ</p>
                  <div class="field_wrapper">
                  <a href="javascript:void(0);" id="add_button" title="เพิ่มเพ็กเกจ"><i class="fa-solid fa-circle-plus text-green-500 text-4xl"></i><p class="text-lg text-white">เพิ่มแพ็คเกจได้สูงสุด 3 แพ็คเกจ</p></a>
                  <?php 
                  foreach($sqlPackage as $i=>$p){ ?>
                    <div>
                      <div class="mt-3">
                      <?php if( $i > 0 ){ ?> 
                        <a data-id="<?php echo $p['package_id']; ?>" href="?delete=<?php echo $p['package_id']; ?>" class="focus:outline-none text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                          ลบเพ็คเกจที่ <?php echo $i+1?>
                        </a>
                      <?php }?>
                      </div>
                      <input type="hidden" value="<?php echo $p['package_id']; ?>" name="package_id[]" required>
                        <input type="text" 
                        name="package_name[]"
                        value="<?php echo $p['package_name'] ?>"
                        placeholder="ชื่อแพ็กเกจที่ <?php echo $i+1 ?>"
                        class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 my-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                        />
                        <textarea name="package_detail[]"
                        placeholder="รายละเอียดแพ็กเกจที่ <?php echo $i+1 ?>"
                        class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                        rows="10"><?php echo  str_replace("<br>",PHP_EOL,($p['package_detail'])); ?></textarea>  

                        <input type="number" 
                        name="package_price[]"
                        value="<?php echo $p['package_price'] ?>"
                        placeholder="ราคา"
                        class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 my-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"
                        />
                    </div>
                    <?php }?>
                  </div>
                </div>
                <div class="mb-10">
                  <input
                    type="submit"
                    name="update_post"
                    value="แก้ไข"
                    class="bordder-primary w-full cursor-pointer rounded-md border bg-green-500 py-3 px-5 text-base text-white transition duration-300 ease-in-out hover:shadow-md"
                  />
                  <button type="button" onClick="location.href='post_own.php'" class="bordder-primary w-full mt-2 cursor-pointer rounded-md border bg-gray-400 py-3 px-5 text-base text-white transition duration-300 ease-in-out hover:shadow-md">
                  <span>ยกเลิก</span>
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ====== Forms Section End -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="assets/js/script_province.js"></script>
    <script>
        let imgInput = document.getElementById('imgInput');
        let previewImg = document.getElementById('previewImg');

        imgInput.onchange = evt => {
            const [file] = imgInput.files;
                if (file) {
                    previewImg.src = URL.createObjectURL(file)
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $("#your_summernote").summernote({
              placeholder: 'รายละเอียดของงาน',
              tabsize: 2,
              height: 500,
              theme: 'paper'
            });
            $('.dropdown-toggle').dropdown();
        });
    </script>

  <script type="text/javascript"> // Package insert
      $(document).ready(function(){
          var maxField = 3; //Input fields increment limitation
          var addButton = $('#add_button'); //Add button selector
          var wrapper = $('.field_wrapper'); //Input field wrapper
          var x = <?= $i+1 ?>; //เริ่ม นับจากเดิม +1
          
          //Once add button is clicked
          $(addButton).click(function(){
              //Check maximum number of input fields
              if(x < maxField){ 
                  x++; //Increment field counter
                  $(wrapper).append('<div><a href="javascript:void(0);" id="remove_button"><i class="fa-solid fa-circle-minus text-red-600 text-4xl"></i></a><input type="hidden" value="" name="package_ADD[]" required><input type="text" name="package_name_ADD[]" value="" placeholder="ชื่อแพ็กเกจที่ '+ x +'" class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 my-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none" required/><textarea name="package_detail_ADD[]" value="" placeholder="รายละเอียดแพ็กเกจที่ ' + x +'" class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none"rows="10" required></textarea><input type="number" name="package_price_ADD[]" value="" placeholder="ราคา"class="bordder-[#E9EDF4] w-full rounded-md border bg-[#FCFDFE] py-3 px-5 my-5 text-base text-body-color placeholder-[#ACB6BE] outline-none transition focus:border-primary focus-visible:shadow-none" required/></div>'); //Add field html
              }
          });
          
          //Once remove button is clicked
          $(wrapper).on('click', '#remove_button', function(e){
              e.preventDefault();
              $(this).parent('div').remove(); //Remove field html
              x--; //Decrement field counter
          });
      });
    </script>
  </body>
</html>
